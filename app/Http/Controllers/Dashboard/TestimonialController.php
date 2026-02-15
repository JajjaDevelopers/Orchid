<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('display_order', 'asc')->paginate(10);
        return view('backend.testimonials.index', compact('testimonials'));
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

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'event_type' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'display_order' => 'nullable|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ]);

        $data = [
            'client_name' => $request->client_name,
            'event_type' => $request->event_type,
            'message' => $request->message,
            'rating' => $request->rating ?? null,
            'display_order' => $request->display_order ?? 1,
            'is_active' => $request->has('is_active'),
        ];

        // Optional photo
        if ($request->hasFile('client_photo')) {
            $data['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial added successfully.');
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
            'event_type' => 'nullable|string|max:255',
            'message' => 'required|string',
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
}