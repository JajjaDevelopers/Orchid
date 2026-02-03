<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Events;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriber as ModelsSubscriber;

class EventController extends Controller
{
    //

    public function index()
    {
        $page_title = 'View and Create Events';
        $events = Events::all();
        return view('backend.event.index', compact('page_title', 'events'));
    }
   
    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        $page_title = "Create Event";
        return view('backend.event.create', compact('page_title'));
    }

    /**
  * Store a newly created sermon in the database.
  *
  * @param \App\Http\Requests\StoreSermonRequest $request
  * @return \Illuminate\Http\JsonResponse
  */

  public function store(EventRequest $request)
  {
      DB::beginTransaction();
  
      try {
          $eventData = $request->validated();
  
          if ($request->hasFile('image')) {
              $image = $request->file('image');
              $imageName = uniqid('event_', true) . $eventData['title'] . '.' . $image->extension();
  
              // Store the file in 'public/sermons' directory
              $path = $image->storeAs('events', $imageName, 'public');
  
              // Save the correct public path to the database
              $eventData['image'] = 'storage/' . $path;
          }
  
          $event = Events::create($eventData);
  
          DB::commit();
  
          return response()->json([
              'message' => 'Event saved successfully!',
              'success' => true
          ], 201);
  
      } catch (\Exception $e) {
          DB::rollBack();
  
          Log::error('Failed to save event', [
              'error' => $e->getMessage(),
              'trace' => $e->getTraceAsString(),
              'request' => $request->all()
          ]);
  
          return response()->json([
              'message' => 'Failed to save event.',
              'error' => 'Unexpected error!'
          ], 500);
      }
  }

    /**
     * Return form for event registration
     *
     * @param string $slug
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function register(string $slug)
    {
        $event = Events::where('slug', $slug)->first();

        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        return view('pages.event_register', [
            'eventId' => $event->id,
            'event' => $event, 
        ]);
    }


    /**
     * Store registration info
     *
     * @param Request $request
     * @return void
     */
  public function storeRegister(Request $request)
  {
    try {
          // Validate input
          $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'event_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Case 1: Already registered with event = 1
        $alreadyRegistered = Subscriber::where('email', $request->email)
            ->where('event', 1)
            ->exists();

        if ($alreadyRegistered) {
            return response()->json([
                'message' => 'You have already registered for this event.',
            ], 409);
        }

        // Case 2: Email exists but event = 0 → update
        $existingSubscriber = Subscriber::where('email', $request->email)->first();
        if ($existingSubscriber) {
            $existingSubscriber->update([
                'phone' => $request->phone,
                'event' => 1,
                'eventId'=>$request->event_id
            ]);

            return response()->json(['message' => 'Registration successful.'], 200);
        }

        // Case 3: Create new registration
        Subscriber::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'event' => 1,
            'eventId'=>$request->event_id
        ]);

        return response()->json(['message' => 'Registration successful.'], 200);

    } catch (\Exception $e) {
        Log::error('Event Registration Error: ' . $e->getMessage());

        return response()->json([
            'message' => 'An unexpected error occurred. Please try again later.',
        ], 500);
    }
  }

}
