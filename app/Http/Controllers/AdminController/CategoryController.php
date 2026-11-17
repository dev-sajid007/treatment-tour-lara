<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'nullable|in:medical,cosmetic'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->details = $request->details;
        $category->type = $request->input('type', 'medical');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'nullable|in:medical,cosmetic'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->details = $request->details;
        $category->type = $request->input('type', 'medical');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        // if ($category->image) {
        //     unlink(public_path('storage/img/' . $category->image));
        // }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }


    // Method to display subcategories
    public function indexsubcategory()
    {
        $subcategories = SubCategory::with('category')->get(); // Eager load categories
        $categories = Category::all(); // Fetch categories for selection in the form
        return view('admin.categories.subcategory_index', compact('subcategories', 'categories'));
    }

    // Store a SubCategory
    public function storesubcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'details' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $subCategory = new SubCategory;
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->details = $request->details;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName);
            $subCategory->image = $imageName;
        }

        $subCategory->save();

        return redirect()->route('indexsubcategory')->with('success', 'SubCategory created successfully.');
    }


      public function subEdit(Request $request, $id)
      {
         $sub = SubCategory::findOrFail($id);
         return view('admin.categories.edit', compact('sub'));
      }


      // Update SubCategory
      public function updatesubcategory(Request $request, $id)
      {

          $request->validate([
              'name' => 'required',
              'details' => 'nullable',
             
          ]);


  
          $subCategory = SubCategory::findOrFail($id);
          //$subCategory->category_id = $request->category_id;
          $subCategory->name = $request->name;
          $subCategory->details = $request->details;
  
          // if ($request->hasFile('image')) {
          //     $image = $request->file('image');
          //     $imageName = time() . '.' . $image->getClientOriginalExtension();
          //     $image->move(public_path('storage/img'), $imageName);
          //     $subCategory->image = $imageName;
          // }
  
          $subCategory->save();
  
          return redirect()->route('indexsubcategory')->with('success', 'SubCategory updated successfully.');
      }

      
  
      // Delete SubCategory
      public function deletesubcategory($id)
      {
          $subCategory = SubCategory::findOrFail($id);
        //   if ($subCategory->image) {
        //       unlink(public_path('storage/img/' . $subCategory->image));
        //   }
          $subCategory->delete();
  
          return redirect()->route('indexsubcategory')->with('success', 'SubCategory deleted successfully.');
      }
}
