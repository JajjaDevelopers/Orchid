<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\FrontPageContent;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FrontPageCmsRequest;
use Intervention\Image\Laravel\Facades\Image;

class FrontPageCms extends Controller
{
    //
    public function index()
    {
        $page_title = 'Front Page Cms';
        $frontPageContents = FrontPageContent::all();
        $carousel = $frontPageContents->firstWhere('id', 1);
        return view('backend.cms.index',compact('page_title','carousel'));
    }
    /**
     * Store or Update Front Page Cms
     *
     * @param FrontPageCmsRequest $request
     * @return void
     */
    public function storeOrUpdate(Request $request)
    {
        try {
            // Retrieve or create the carousel content entry (ID = 1)
            $content = FrontPageContent::firstOrCreate(
                ['id' => 1],
                ['carousel_images' => '', 'title' => null, 'description' => null, 'file_path' => null]
            );

            // Step 1: Get current images
            $existing = $content->carousel_images ? explode(',', $content->carousel_images) : [];

            // Step 2: Handle deletion of selected images
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imgPath) {
                    $storagePath = str_replace('storage/', '', $imgPath); // Adjust if needed
                    if (Storage::disk('public')->exists($storagePath)) {
                        Storage::disk('public')->delete($storagePath);
                    }
                    $existing = array_filter($existing, fn($item) => $item !== $imgPath);
                }
            }

            $newPaths = [];

            // Step 3: Handle new uploads
            if ($request->hasFile('carousel_images')) {
                foreach ($request->file('carousel_images') as $file) {
                    $imageName = uniqid('carousel_', true) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('cms', $imageName, 'public');

                    $newPaths[] = 'storage/' . $path;
                }
            }

            // Step 4: Merge old + new paths
            $combined = array_merge($existing, $newPaths);

            $content->carousel_images = implode(',', $combined);
            $content->save();

            return back()->with('success', 'Information updated successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to update carousel: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'An unexpected error occurred.');
        }
    }


}
