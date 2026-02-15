<?php

/**
 * This File contains AdminController and its methods
 *
 *
 * PHP version 8
 *
 * @category  Controllers
 * @package    App\Http\Controllers
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link    https://github.com/KIBOOLI-FELIX/petra.git
 */

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\Mentorship;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This is an adminController class
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
class AdminController extends Controller
{
    //
    /**
     * Summary of dashboard info
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $page_title = "Admin Panel Dashboard";
        $subscriber = new Subscriber();
        $activeSubscribers = count($subscriber->where('status', 'active')->get());
        $pendingSubscribers = count($subscriber->where('status', 'pending')->get());
        $unSubscribed = count($subscriber->where('status', 'unsubscribed')->get());
        $subscribers = ["active" => $activeSubscribers,"pending" => $pendingSubscribers,"unsubscribed" => $unSubscribed];
        return view('backend.layouts.app', compact('page_title', 'subscribers',));
    }

    /**
     * Get Project Categories
     *
     * @return void
     */
    public function blogCategories()
    {
        $categories = Category::select('id', 'name')->get();
        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories retrieved successfully.',
        ], 200);
    }

    /**
     * Store resource
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        try {
            $category = new Category();
            $category->name = $request->categoryName;
            $category->save();
            return response()->json([
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
            ], 500);
        }
    }
}
