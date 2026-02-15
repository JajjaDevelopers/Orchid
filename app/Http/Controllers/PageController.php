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
        $query = Testimonial::query()->where('is_active', true);

        // Apply event_type filter if present
        if ($request->has('event_type') && $request->event_type !== null) {
            $query->where('event_type', $request->event_type);
        }

        // Paginate results
        $testimonials = $query->orderBy('display_order', 'asc')->paginate(9);

        // Preserve query string for pagination links
        $testimonials->appends($request->only('event_type'));

        return view('pages.testimonials', compact('testimonials'));
    }

    /**
     * Get blogs
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function gallery(Request $request)
    {
        // Define allowed categories (if no table)
        $categories = [
            'weddings' => 'Weddings',
            'introductions' => 'Introductions (Kwanjula/Kuhingira)',
            'corporate' => 'Corporate Events',
            'sports' => 'Sports Events',
            'church' => 'Church Events',
            'team' => 'Our Team',
            'others' => 'Others',
        ];

        $query = GalleryImage::query();

        if ($request->has('category') && array_key_exists($request->category, $categories)) {
            $query->where('category', $request->category);
        }

        $images = $query->latest()->paginate(12)->withQueryString();

        return view('pages.gallery', compact('images', 'categories'));
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