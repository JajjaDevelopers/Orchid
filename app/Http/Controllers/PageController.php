<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        return view('pages.home');
    }

    public function about() {
        return view('pages.about');
    }

    public function services() {
        $services = Service::where('is_active', true)->get();
        return view('pages.services', compact('services'));
    }

    public function gallery() {
        $images = GalleryImage::latest()->get();
        return view('pages.gallery', compact('images'));
    }

    public function contact() {
        return view('pages.contact');
    }
}