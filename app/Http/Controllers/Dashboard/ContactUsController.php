<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Contact;
use App\Mail\ContactReply;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactUsRequest;

/**
 * This is a contact us class
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
class ContactUsController extends Controller
{
    /**
     * Dislay latest contact us messages
     *
     * @return void
     */
    public function index()
    {
        $page_title = 'Admin View Contacts';
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.contacts.index', compact('page_title', 'contacts'));
    }
  /**
 * Store contact us info
 *
 * @param ContactUsRequest $request
 * @return \Illuminate\Http\JsonResponse
 */
public function store(ContactUsRequest $request)
{
    try {
        $validatedData = $request->validated();

        // Combine country_code and phone into full_phone if present
        if (!empty($validatedData['phone']) && !empty($validatedData['country_code'])) {
            $validatedData['phone'] = $validatedData['country_code'] . $validatedData['phone'];
            unset($validatedData['country_code']);
        }

        // Create the contact record
        $contact = Contact::create($validatedData);

        // Send email to admin users only
        $adminEmails = User::where('is_admin', 1)->pluck('email')->toArray();
        if (!empty($adminEmails)) {
            Mail::to($adminEmails)->send(new ContactUsMail($contact));
        }

        return response()->json([
            'message' => 'Your message has been sent successfully',
            'data' => $contact
        ], 200);

    } catch (\Exception $e) {
        Log::error('Failed to process contact form submission', [
            'error' => $e->getMessage(),
            'request_data' => $request->all(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'message' => 'There was an error sending your message. Please try again later.',
            'error' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}

    /**
     * Show contact resource
     *
     * @param string $id
     * @return void
     */
    public function show(string $id)
    {
        $page_title = "Admin Detailed Contact View";
        $contact = Contact::findOrFail($id);
        return view('backend.contacts.show', compact("page_title", "contact"));
    }

    /**
     * Delete resource contact resource
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contact.view')->with('success', 'Contact deleted successfully!');
    }

    /**
     * Reply to contact
     *
     * @param string $id
     * @return void
     */
    public function reply(string $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $emailData = $contact;
            $emailData->response = request()->response;
            Mail::to($contact->email)->send(new ContactReply($emailData));
            $contact->replied_to = true;
            unset($contact->response);
            $contact->save();

            return redirect()->route('admin.contact.view', $contact->id)->with('success', 'Response sent');
        } catch (\Exception $e) {
            Log::error('Contact form email failed to send: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('admin.contact.view', $contact->id)->with('error', ' Unexpected error occured while sending reply');
        }
    }

    /**
     * Mark as contact query as replied to
     *
     * @param string $id
     * @return void
     */
    public function markReplied(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->replied_to = true;
        $contact->save();
        return redirect()->route('admin.contact.view', $contact->id)->with('success', 'marked as replied to');
    }
}
