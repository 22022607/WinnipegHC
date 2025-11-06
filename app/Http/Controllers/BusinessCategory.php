<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Category;
class BusinessCategory extends Controller
{
    public function index()
    {
        $businesses = Business::orderBy('id','desc')->paginate(10);
        return view('business.index', compact('businesses'));
    }
    public function create()
    {
        return view('business.create');
    }
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable',
                'contact' => 'nullable',
                'website' => 'nullable|url|max:255',
                'rating' => 'nullable|numeric|min:0|max:5',
                'reviews' => 'nullable|integer|min:0',
                'hours' => 'nullable|string|max:255',
                'image' => 'nullable|image|max:2048',
                'featured' => 'nullable',
            ]);

            // Checkbox handling
            $data['featured'] = $request->has('featured') ? 1 : 0;

            // Handle image upload
             if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('business_images'), $filename);
              $data['image'] = 'business_images/' . $filename;
        }
                    

            Business::create($data);

            return redirect()
                ->route('business.index')
                ->with('success', 'Business added successfully.');
        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Business Store Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Show a simple error to user
            return back()->withInput()->withErrors([
                'error' => 'Something went wrong while saving the business. Please try again.',
            ]);
        }
    }
    public function edit($id)
    {
        $business = Business::findOrFail($id);
        return view('business.edit', compact('business'));
    }

    public function update(Request $request, $id)
    {
        try {
            $business = Business::findOrFail($id);

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable',
                'phone' => 'nullable',
                'website' => 'nullable|url|max:255',
                'rating' => 'nullable|numeric|min:0|max:5',
                'reviews' => 'nullable|integer|min:0',
                'hours' => 'nullable|string|max:255',
                'image' => 'nullable|image|max:2048',
                'featured' => 'nullable',
            ]);

            // Checkbox handling
            $data['featured'] = $request->has('featured') ? 1 : 0;

            // Handle image upload
           
            if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = preg_replace('/[^A-Za-z0-9\-_\.]/', '', $file->getClientOriginalName());

            $filename = $originalName;
            // dd($filename);

            $file->move(public_path('business_images'), $filename);

            $data['image'] = 'business_images/' . $filename;

            if ($business->image && file_exists(public_path($business->image))) {
                unlink(public_path($business->image));
            }
        } else {
           if ($business->image) {
                $data['image'] = $business->image;
            } else {
                unset($data['image']);
            }
            }
                    $business->update($data);

            return redirect()
                ->route('business.index')
                ->with('success', 'Business updated successfully.');
        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Business Update Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Show a simple error to user
            return back()->withInput()->withErrors([
                'error' => 'Something went wrong while updating the business. Please try again.',
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $business = Business::findOrFail($id);
            $business->delete();

            return redirect()
                ->route('business.index')
                ->with('success', 'Business deleted successfully.');
        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Business Delete Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Show a simple error to user
            return back()->withErrors([
                'error' => 'Something went wrong while deleting the business. Please try again.',
            ]); 

        }
    }
    public function category(Request $request)
    {

        $categories = Category::orderBy('id', 'asc')->paginate(10);
        return view('business.category', compact('categories'));
    }
    public function categoryCreate()
    {
        return view('business.categorycreate');
    }
    public function categoryStore(Request $request)
    {
        // dd($request->all());
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|max:2048',
            ]);

            $category = new Category();
            $category->name = $request->name;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $file->move(public_path('category_images'), $filename);
                $category->image = 'category_images/' . $filename;
            }
            $category->save();
            // dd($category);
            return redirect()->route('category')->with('success', 'Category added successfully.');
        } 
    }
}