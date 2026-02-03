<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Sermons;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\SermonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSermonRequest;

class SermonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $page_title = "View All Sermons";
        $sermons = Sermons::all();
        // return response($sermons);
        return view('backend.sermons.index', compact('page_title', 'sermons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $page_title = 'Add Sermon';
        return view('backend.sermons.create', compact('page_title'));
    }

  /**
  * Store a newly created sermon in the database.
  *
  * @param \App\Http\Requests\StoreSermonRequest $request
  * @return \Illuminate\Http\JsonResponse
  */

  public function store(StoreSermonRequest $request)
  {
      DB::beginTransaction();
  
      try {
          $sermonData = $request->validated();
  
          if ($request->hasFile('image_url')) {
              $image = $request->file('image_url');
              $imageName = uniqid('sermon_', true) . $sermonData['title'] . '.' . $image->extension();
  
              // Store the file in 'public/sermons' directory
              $path = $image->storeAs('sermons', $imageName, 'public');
  
              // Save the correct public path to the database
              $sermonData['image_url'] = 'storage/' . $path;
          }
  
          $sermon = Sermons::create($sermonData);
  
          DB::commit();
  
          return response()->json([
              'message' => 'Sermon saved successfully!',
              'success' => true
          ], 201);
  
      } catch (\Exception $e) {
          DB::rollBack();
  
          Log::error('Failed to save sermon', [
              'error' => $e->getMessage(),
              'trace' => $e->getTraceAsString(),
              'request' => $request->all()
          ]);
  
          return response()->json([
              'message' => 'Failed to save sermon.',
              'error' => 'Unexpected error!'
          ], 500);
      }
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
        $page_title = "Update Sermon";
        $sermon = Sermons::findOrFail($id);
        return view('backend.sermons.edit', compact('page_title', 'sermon'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(StoreSermonRequest $request, string $id)
    {
        DB::beginTransaction();
    
        try {
            $sermonData = $request->validated();
            $sermon = Sermons::findOrFail($id);
    
            // If a new image is uploaded, handle old image deletion
            if ($request->hasFile('image_url')) {
                // Delete the old image if it exists
                if ($sermon->image_url && Storage::disk('public')->exists(str_replace('storage/', '', $sermon->image_url))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $sermon->image_url));
                }
    
                $image = $request->file('image_url');
                $imageName = uniqid('sermon_', true) . '_' . Str::slug($sermonData['title']) . '.' . $image->extension();
    
                // Store new image
                $path = $image->storeAs('sermons', $imageName, 'public');
    
                // Update image URL in the database
                $sermonData['image_url'] = 'storage/' . $path;
            }
    
            // Update sermon data
            $sermon->update($sermonData);
    
            DB::commit();
    
            return response()->json([
                'message' => 'Sermon updated successfully!',
                'success' => true
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Failed to update sermon', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
    
            return response()->json([
                'message' => 'Failed to update sermon.',
                'error' => 'Unexpected error!'
            ], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Find the blog post by ID
        $sermon = Sermons::findOrFail($id);

        // Begin a transaction
        DB::beginTransaction();

        try {
            // Check if there is an old image and delete it
            if ($sermon->image_url) {
                $oldImagePath = public_path('/' . $sermon->image_url);
                // Check if the file exists and delete it
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $sermon->delete();

            DB::commit();
            // return response()->json($status);
            return redirect()->route('admin.sermons.view')->with('success', 'Sermon deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            // Log the error
            Log::error('Failed to delete the sermon: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);

            return redirect()->route('admin.sermons.view')->with('error', 'Failed to delete the sermon');
        }
    }

}
