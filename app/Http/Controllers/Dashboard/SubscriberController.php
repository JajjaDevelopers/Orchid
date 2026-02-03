<?php

/**
 * This File contains Subscriber Controller and its methods
 * to handle subscriptions
 *
 * PHP version 8
 *
 * @category  Controllers
 * @package    App\Http\Controllers
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/mribrahimsite.git
 */

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use App\Http\Requests\SubscriberRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\SubscriptionConfirmationMail;
use App\Http\Requests\UpdateSubscriberRequest;
use Illuminate\Validation\ValidationException;

/**
 * This File Class handles subscribers
 *
 * PHP version 8
 *
 * @category  Controllers
 * @package    App\Http\Controllers
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/mribrahimsite.git
 */
class SubscriberController extends Controller
{
    /**
     *Return all subscribers
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //
        $page_title = "Admin Panel Subscribers";
        if ($request->ajax()) {
            $subscribers = Subscriber::with('event:id,title')->select(['id','email','status','name','eventId','created_at']) ;

            return DataTables::of($subscribers)
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d M Y H:i:s');
            })
            ->addColumn('status', function ($row) {
                switch ($row->status) {
                    case 'active':
                        return '<span class="badge badge-success">Active</span>';
                    case 'pending':
                        return '<span class="badge badge-warning">Pending</span>';
                    case 'unsubscribed':
                        return '<span class="badge badge-danger">Unsubscribed</span>';
                    default:
                        return '<span class="badge badge-secondary">Inactive</span>';
                }
            })
            ->addColumn('event_title', function ($row) {
                return $row->eventId && $row->event ? e($row->event->title) : 'N/A';
            })
            ->addColumn('event_registered', function ($row) {
                return $row->event
                    ? '<span class="badge badge-success">Yes</span>'
                    : '<span class="badge badge-danger">No</span>';
            })
            ->addColumn('actions', function ($row) {
                return '
         <a href="' . route('admin.subscriber.edit', $row->id) . '" class="btn btn-sm btn-warning subscriberUpdateInfo"
             data-toggle="tooltip-primary" title="Edit">
             <i class="fas fa-edit"></i>
         </a>
         <form action="' . route('admin.subscriber.destroy', $row->id) . '" method="POST" style="display:inline;">
             ' . csrf_field() . '
             ' . method_field('DELETE') . '
             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')"
                 data-toggle="tooltip-primary" title="Delete">
                 <i class="fas fa-trash"></i>
             </button>
         </form>
         ';
            })
            ->rawColumns(['status', 'actions','event_registered','event_title'])
            ->make(true);
        }
        return view('backend.subscribers.index', compact('page_title',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriberRequest $request)
    {


        try {
            // Validate the incoming request
            $validatedData = $request->validated();
            $validatedData['ip_address'] = $request->ip();
            $validatedData['token'] = Str::random(32);
            $subscriber = Subscriber::create($validatedData);
            // Send confirmation email
            Mail::to($subscriber->email)->send(new SubscriptionConfirmationMail($subscriber->token, $subscriber->email));
            return response()->json([
                'message' => 'Subscriber created successfully.',
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error occurred while creating the subscriber.',
                'error' => $e->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Confirms subscription
     *
     * @param string $token
     * @return void
     */
    public function confirmSubscription(string $token)
    {
        // Find the subscriber by the token
        $subscriber = Subscriber::where('token', $token)->first();

        if (!$subscriber) {
            $status = false;
        } else {
            // Update the subscriber's status to 'active' and clear the token
            $subscriber->update([
                'status' => 'active',
                'token' => null,
            ]);
            $status = true;
        }

        return view('backend.subscribers.confirmation', compact('status'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $subscriber = Subscriber::findOrFail($id);
        $view = view('backend.subscribers.edit', compact('subscriber'))->render();
        return response()->json(['html' => $view], 200);
    }
    /**
     * Store updated resource
     *
     * @param UpdateSubscriberRequest $request
     * @param string $id
     * @return void
     */
    public function update(UpdateSubscriberRequest $request, string $id)
    {
        //
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->update($request->validated());
        return response()->json(['message' => 'Subscriber updated successfully'], 201);
    }

    /**
     * Delete specified subscriber resource
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        //
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        return redirect()->route('admin.subscriber.view')->with('success', 'Subscriber deleted successfully!');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function unsubscribe($token)
    {
        try {
            $substatus = false;
            $subscriber =  Subscriber::where('token', $token)->first();
            if ($subscriber != null) {
                if ($subscriber->status === 'unsubscribed') {
                    $substatus = true;
                } else {
                    $subscriber->update(['status' => 'unsubscribed', 'token' => null]);
                }
            }
            return view('backend.subscribers.unsubscribe', compact('substatus'));
        } catch (\Exception $e) {
            Log::error('Failed to unsubscribe: ' . $e->getMessage(), ['token' => $token]);
            return abort(500, 'An error occurred while processing your request.');
        }
    }
}
