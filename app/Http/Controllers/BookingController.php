<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
     public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'event_type' => 'required',
            'event_date' => 'required|date',
            'location' => 'required',
            'message' => 'nullable',
        ]);

        Booking::create($data);

        return back()->with('success', 'Booking request sent successfully.');
    }
}