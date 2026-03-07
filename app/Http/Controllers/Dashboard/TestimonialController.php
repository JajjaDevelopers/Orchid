<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\TestimonialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('display_order', 'asc')->paginate(10);
         $linkRecord = TestimonialLink::where('is_active', true)->first();
        $link = null;

        if($linkRecord){
            $link = route('orchid.testimonials.token', ['token' => $linkRecord->token]);
        }
        return view('backend.testimonials.index', compact('testimonials','link'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        $eventTypes = [
            'weddings' => 'Weddings',
            'introductions' => 'Introductions (Kwanjula/Kuhingira)',
            'corporate' => 'Corporate Events',
            'sports' => 'Sports Events',
            'church' => 'Church Events',
            'others' => 'Others',
        ];
        $page_title = "Create Testimonial";

        return view('backend.testimonials.create', compact('eventTypes','page_title'));
    }

    public function storeTestimonial(Request $request)
    {
        $link = TestimonialLink::where('token',$request->token)
            ->where('is_active',true)
            ->first();

        if(!$link){
            return back()->with('error','Invalid or expired testimonial link.');
        }
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'event_type' => 'nullable|string|max:255',
            'message' => 'required|string',
            'phone_contact'=>'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'display_order' => 'nullable|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ]);

        $data = [
            'client_name' => $request->client_name,
            'event_type' => $request->event_type,
            'message' => $request->message,
            'phone_contact'=>$request->phone_contact,
            'rating' => $request->rating ?? null,
            'display_order' => $request->display_order ?? 1,
            'is_active' => 1,
        ];

        // Optional photo
        if ($request->hasFile('client_photo')) {
            $data['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->back()
            ->with('success', 'Thank you Testimonial Received.');
    }


    /**
     * Show the form for editing a testimonial.
     */
    public function edit(Testimonial $testimonial)
    {
        $eventTypes = [
            'weddings' => 'Weddings',
            'introductions' => 'Introductions (Kwanjula/Kuhingira)',
            'corporate' => 'Corporate Events',
            'sports' => 'Sports Events',
            'church' => 'Church Events',
            'others' => 'Others',
        ];

        return view('backend.testimonials.edit', compact('testimonial', 'eventTypes'));
    }

    /**
     * Update a testimonial.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'event_type' => 'required|string|max:255',
            'message' => 'required|string',
            'phone_contact'=>'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'display_order' => 'nullable|integer|min:1',
            'is_active' => 'sometimes|boolean', //
        ]);

        $data = [
            'client_name' => $request->client_name,
            'event_type' => $request->event_type,
            'message' => $request->message,
            'rating' => $request->rating ?? null,
            'display_order' => $request->display_order ?? 1,
            'is_active' => $request->has('is_active'), //
        ];

        // Handle optional new client photo
        if ($request->hasFile('client_photo')) {
            // Delete old photo if exists
            if ($testimonial->client_photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($testimonial->client_photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->client_photo);
            }

            $data['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove a testimonial.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete photo if exists
        if ($testimonial->client_photo && Storage::disk('public')->exists($testimonial->client_photo)) {
            Storage::disk('public')->delete($testimonial->client_photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
    /**
     * Generate Testimonial
     *
     * @return void
     */
    public function generateLink()
    {
        $token = Str::random(32);

        $link = TestimonialLink::first();

        if ($link) {
            $link->update([
                'token' => $token,
                'expires_at' => now()->addMonths(6)
            ]);
        } else {
            $link = TestimonialLink::create([
                'token' => $token,
                'expires_at' => now()->addMonths(6)
            ]);
        }

        $url = route('orchid.testimonials.token', $token);

        return back()->with('success', 'Share this link with your clients: '.$url);
    }

    public function publicForm(Request $request,$token){
        return view('pages.testimonial_form',compact('token'));
    }

    
}