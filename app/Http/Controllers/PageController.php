<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Events;
use App\Models\Sermons;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Models\FrontPageContent;
use App\Http\Resources\BlogResource;
use App\Http\Resources\SermonResource;

class PageController extends Controller
{
    /**
     * Return home view
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $carousel = FrontPageContent::find(1);
    
        return view('pages.home',compact('carousel'));
    }
    /**
     * Summary of sermons
     * @return \Illuminate\Contracts\View\View
     */
    public function testimonials(Request $request)
    {
        $testimonials = Testimonial::latest()->paginate(9);
        return view('pages.testimonials', compact('testimonials'));
    }

    /**
     * Get blogs
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function gallery(Request $request)
    {
        $images = GalleryImage::latest()->paginate(12);
        return view('pages.gallery', compact('images'));
    }

    /**
     * Summary of events
     * @return \Illuminate\Contracts\View\View
     */
    public function events()
    {
        return view("pages.events");
    }

    /**
     * Summary of contact
     * @return \Illuminate\Contracts\View\View
     */
    public function contact()
    {
        return view("pages.contact");
    }
    /**
     * About us page
     *
     * @return void
     */
    public function aboutUs()
    {
        return view('pages.aboutus');
    }
}