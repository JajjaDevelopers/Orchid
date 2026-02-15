<?php

/**
 * This File contains Newsletter Controller and its methods
 *
 *
 * PHP version 8
 *
 * @category  Controllers
 * @package    App\Http\Controllers
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/KIBOOLI-FELIX/petra.git
 */

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\NewsletterStoreRequest;

/**
 * This is  Newsletter Controller class
 *
 *
 * PHP version 8
 *
 * @category  Controllers
 * @package    App\Http\Controllers
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/mribrahimsite.git
 */
class NewsletterController extends Controller
{
    public function index()
    {
        $page_title = 'Admin Panel View Newsletters';
        $newsletters = Newsletter::all();
        return view('backend.newsletters.index', compact('page_title', 'newsletters'));
    }
    /**
     * Return newsletter creation form
     *
     * @return void
     */
    public function create()
    {
        //
        $page_title = "Admin Panel Create Newsletter";
        return view('backend.newsletters.create', compact('page_title'));
    }

    /**
     * Store news letter resource
     *
     * @param NewsletterStoreRequest $request
     * @return void
     */
    public function store(NewsletterStoreRequest $request)
    {
        try {
            $validateData = $request->validated();
            $attachments = $request->input('attachments', []);
            $video_urls = $request->input('video_urls', []);
            $content = strip_tags($validateData['content']);
            $newsletter = Newsletter::create([
                'subject' => $validateData['subject'],
                'content' => $content,
                'attachments' => json_encode($attachments),
                'video_urls' => json_encode($video_urls),
                // 'scheduled_at' => $validateData['scheduled_at'],
            ]);

            return redirect()->route('admin.newsletter.view')->with('success', 'Newsletter created.');
        } catch (\Exception $e) {
            Log::error('Failed to save newsletter: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'data' => $request->except(['attachments']),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Failed to create newsletter.');
        }
    }

    /**
     * Return specific newsletter resource for update
     *
     * @param string $id
     * @return void
     */
    public function edit(string $id)
    {
        //
        $page_title = "Admin Panel Edit Newsletter";
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->attachments = json_decode($newsletter->attachments);
        $newsletter->video_urls = json_decode($newsletter->video_urls);
        return view('backend.newsletters.edit', compact('page_title', 'newsletter'));
    }

    /**
     * Update newsletter resource.
     *
     * @param NewsletterStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsletterStoreRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();

            // Retrieve the newsletter or fail
            $newsletter = Newsletter::findOrFail($id);

            // Retrieve existing attachments directly as an array
            $existingAttachments = json_decode($newsletter->attachments, true) ?? [];
            $existingVideoUrls = json_decode($newsletter->video_urls, true) ?? [];
            $newAttachments = $request->input('attachments', []);
            $video_urls = $request->input('video_urls', []);
            if ($video_urls == null) {
                $video_urls = [];
            }
            if ($newAttachments == null) {
                $newAttachments == [];
            }
            // Merge the attachments, ensuring unique entries
            $mergedAttachments = array_unique(array_merge($existingAttachments, $newAttachments));
            $mergedVideo_urls = array_unique(array_merge($existingVideoUrls, $video_urls));
            // Sanitize the content
            $content = strip_tags($validatedData['content']);

            // Update the newsletter with the validated data
            $newsletter->update([
                'subject' => $validatedData['subject'],
                'content' => $content,
                'is_sent' => false,
                'attachments' => json_encode($mergedAttachments),
                'video_urls' => json_encode($mergedVideo_urls),
            ]);

            return redirect()->route('admin.newsletter.view')->with('success', 'Newsletter updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update newsletter: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'data' => $request->except(['attachments']),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Failed to update newsletter.');
        }
    }


    /**
     * Destroys specific news letter resource
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        //
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();
        return redirect()->route('admin.newsletter.view')->with('success', 'Newsletter deleted successfully!');
    }

    /**
     * Send news letter to active subscribers
     *
     * @param int $id
     * @return void
     */
    public function send($id)
    {
        try {
           // Find the newsletter by ID
            $newsletter = Newsletter::findOrFail($id);

           // Get all active subscribers
            $subscribers = Subscriber::where('status', 'active')->get();

            if ($subscribers->isNotEmpty()) {
          // Ensure each subscriber has a token
                $subscribers->each(function ($subscriber) {
                    if (!$subscriber->token) {
                        $subscriber->token = Str::random(32); // Generate a token if not present
                    }
                });

          // Prepare the data for upsert
                $createdAt = Carbon::parse('2025-02-07T12:34:16.000000Z')->format('Y-m-d H:i:s');
                $subscribersData = $subscribers->map(function ($subscriber) use ($createdAt) {
                        return [
                        'id' => $subscriber->id, // Ensure ID is passed
                        'email' => $subscriber->email,
                        'ip_address' => $subscriber->ip_address ?? '127.0.0.1', // Use a default IP if not present
                        'name' => $subscriber->name ?? '?', // Use a default name if not present
                        'status' => $subscriber->status,
                        'token' => $subscriber->token,
                        'created_at' => $createdAt,
                        'updated_at' => now()->format('Y-m-d H:i:s'),
                        ];
                });

          // Upsert the subscribers data
                Subscriber::upsert($subscribersData->toArray(), ['id'], ['token', 'updated_at']);

          // Send the newsletter to each subscriber
                foreach ($subscribers as $subscriber) {
                        Mail::to($subscriber->email)->send(new NewsletterMail(
                            $newsletter->subject,
                            $newsletter->content,
                            $subscriber->token,
                            json_decode($newsletter->attachments, true),
                            json_decode($newsletter->video_urls, true)
                        ));
                }

          // Update the newsletter status
                $newsletter->update(['is_sent' => true]);

                return redirect()->route('admin.newsletter.view')->with('success', 'Newsletter sent successfully.');
            } else {
                return redirect()->route('admin.newsletter.view')->with('success', 'No active subscribers!');
            }
        } catch (\Exception $e) {
            Log::error('Failed to send newsletter: ' . $e->getMessage(), [
            'newsletter_subject' => $newsletter->subject,
            'attachments' => $newsletter->attachments,
            'error_trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'Failed to send newsletter.');
        }
    }
}
