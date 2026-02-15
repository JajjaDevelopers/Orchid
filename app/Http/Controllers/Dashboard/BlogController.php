<?php

/**
 * This File contains BlogController and its methods
 * to handle blog post creation
 *
 * PHP version 8
 *
 * @category  Controllers
 * @package    App\Http\Controllers
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/petra.git
 */

namespace App\Http\Controllers\Dashboard;

use App\Models\Blog;
use GuzzleHttp\Client;
use App\Models\Category;
use App\Models\Comments;
use App\Models\BlogImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Utils;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

/**
 * This File Class handles blog creation
 *
 * PHP version 8
 *
 * @category  Controllers
 * @package    App\Http\Controllers
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/KIBOOLI-FELIX/petra.git
 */
class BlogController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $page_title = 'View All Blog Posts';
        $blogs = Blog::all();
        return view('backend.blog.index', compact('page_title', 'blogs'));
    }

    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        $page_title = "Create Blog Post";
        $categories = Category::all();
        return view('backend.blog.create', compact('page_title', 'categories'));
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\StoreBlogRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
 
    public function store(StoreBlogRequest $request)
    {
        DB::beginTransaction();
    
        try {
            $validatedData = $request->validated();
    
            $blogData = [
                'user_id' => Auth::id(),
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'excerpt' => $validatedData['excerpt'],
                'category_id' => $validatedData['category'],
                'status' => $validatedData['status'],
            ];
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid('blog_', true) . '_' . Str::slug($validatedData['title']) . '.' . $image->extension();
    
                // Save the image in storage/app/public/blogs
                $path = $image->storeAs('blogs', $imageName, 'public');
    
                // Save the public URL to database
                $blogData['image'] = 'storage/' . $path;
            }
    
            // Create the blog post
            $blog = Blog::create($blogData);
    
            DB::commit();
    
            return response()->json([
                'message' => 'Blog saved successfully!',
                'success' => true
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Failed to save blog', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
    
            return response()->json([
                'message' => 'Failed to save blog.',
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
     * Summary of edit
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        //
        $page_title = "Edit Blog Post";
        $categories = Category::all();
        $blog = Blog::findOrFail($id);
        return view('backend.blog.edit', compact('page_title', 'blog', 'categories'));
    }

    /**
     * Store Blog Updated Resource
     *
     * @param UpdateBlogRequest $request
     * @param string $id
     * @return void
     */
    public function update(StoreBlogRequest $request, string $id)
    {
        DB::beginTransaction();
    
        try {
            $validatedData = $request->validated();
            $blog = Blog::findOrFail($id);
    
            $blogData = [
                'user_id' => Auth::id(),
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'excerpt' => $validatedData['excerpt'],
                'category_id' => $validatedData['category'],
                'status' => $validatedData['status'],
            ];
    
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($blog->image) {
                    $oldImagePath = str_replace('storage/', '', $blog->image); 
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
    
                // Store new image
                $image = $request->file('image');
                $imageName = uniqid('blog_', true) . '_' . Str::slug($validatedData['title']) . '.' . $image->extension();
                $path = $image->storeAs('blogs', $imageName, 'public');
    
                // Update image path in blogData
                $blogData['image'] = 'storage/' . $path;
            }
    
            $blog->update($blogData);
    
            DB::commit();
    
            return response()->json([
                'message' => 'Blog updated successfully!',
                'success' => true
            ], 200);
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Failed to update blog', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
    
            return response()->json([
                'message' => 'Failed to update blog.',
                'error' => 'Unexpected error!'
            ], 500);
        }
    }
    

     /**
      * Summary of destroy
      * @param string $id
      * @return \Illuminate\Http\RedirectResponse
      */
    public function destroy(string $id)
    {
        // Find the blog post by ID
        $blog = Blog::findOrFail($id);

        // Begin a transaction
        DB::beginTransaction();

        try {
            // Check if there is an old image and delete it
            if ($blog->image) {
                $oldImagePath = public_path('/' . $blog->image);
                // Check if the file exists and delete it
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $blog->delete();

            DB::commit();
            // return response()->json($status);
            return redirect()->route('admin.blog.view')->with('success', 'Blog deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();
            // Log the error
            Log::error('Failed to delete the blog: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => request()->all(),
            ]);

            return redirect()->route('admin.blog.view')->with('error', 'Failed to delete the blog');
        }
    }

    /**
     * Return paginated blog posts with status not equal to 'draft' to be consumed by frontend
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllBlogs(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Set items per page

        try {
            // Fetch blogs where status is not 'draft'
            $blogs = Blog::with(['user', 'images'])
                ->where('status', 'published') // Filter out drafts
                ->paginate($perPage);

            // Check if blogs are empty
            if ($blogs->isEmpty()) {
                return response()->json([
                    'message' => 'No blogs found.',
                ], 404);
            }

            // Return blogs with pagination meta data
            return response()->json([
                'data' => BlogResource::collection($blogs),
                'meta' => [
                    'current_page' => $blogs->currentPage(),
                    'last_page' => $blogs->lastPage(),
                    'per_page' => $blogs->perPage(),
                    'total' => $blogs->total(),
                ],
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return response()->json([
                'message' => 'An error occurred while fetching blogs. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Return a single blog post with status not equal to 'draft' to be consumed by frontend
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleBlog(string $id)
    {
        try {
            // Fetch blog where status is not 'draft'
            $blog = Blog::where('id', $id)
                ->where('status', 'published')
                ->first();

            // Check if blog is found
            if (!$blog) {
                return response()->json([
                    'message' => 'Blog post not found or is a draft.',
                ], 404);
            }

            // Return the blog resource
            return new BlogResource($blog);
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return response()->json([
                'message' => 'An error occurred while fetching the blog post. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store Comment
     *
     * @param Request $request
     * @return void
     */
    public function storeComment(Request $request)
    {
        $validated = $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'content' => 'required|string|max:3000',
        ]);
    
        $comment = Comments::create($validated);
    
        return response()->json([
            'comment' => $comment->fresh(),
            'message' => 'Comment posted successfully.'
        ]);
    }
}
