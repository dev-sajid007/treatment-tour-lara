<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function show($slug)
        {
            
            $menu = Menu::with(['menuItems' => function ($query) {
                $query->whereParent(null) 
                    ->orWhere('slug', 'contact-us') 
                    ->orderBy('sort', 'ASC'); 
            }])->where('slug', $slug)
            ->firstOrFail();
            
            $menuItems = $menu->menuItems;

            return view('admin.menu.index', compact('menuItems', 'menu'));
          }
  public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'url' => 'nullable|string',
        'icon' => 'nullable|string|max:255',
        'image' => 'nullable|string|max:255',
        'is_visible' => 'required|boolean',
        'sorting' => 'nullable|integer',
        'parent' => 'nullable|exists:menu_items,id', // Validate if parent is specified
    ]);

    // Generate the slug
    $slug = \Str::slug($request->name);

    // Create the menu item
    MenuItem::create([
        'menu_id' => 1, // Hardcoded to 1
        'name' => $request->name,
        'slug' => $slug, // Add the generated slug
        'url' => $request->url,
        'icon' => $request->icon,
        'image' => $request->image,
        'is_visible' => $request->is_visible,
        'sort' => $request->sorting ?? 0,
        'parent' => $request->parent ?: null, 
    ]);

   $menu = Menu::findOrFail(1); 
   
    return redirect()->route('menus', ['slug' => $menu->slug])
                     ->with('success', 'Menu item successfully added.');

}





    public function edit($slug){

        $menu = Menu::with('menuItems')
                 ->where('slug', $slug)
                 ->firstOrFail();

        return view('admin.menu.edit', compact('menu'));
    }
public function update(Request $request, $slug)
{
    $menuItem = MenuItem::where('slug', $slug)->firstOrFail();

    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'url' => 'nullable|string',
        'icon' => 'nullable|string|max:255',
        'image' => 'nullable|string|max:255',
        'is_visible' => 'required|boolean',
        'sorting' => 'nullable|integer',
        'parent' => 'nullable|exists:menu_items,id', // Validate if parent is specified
    ]);

    $menuItem->name = $request->name;
    $menuItem->url = $request->url;
    $menuItem->icon = $request->icon;
    $menuItem->image = $request->image;
    $menuItem->is_visible = $request->is_visible;
    $menuItem->sort = $request->sorting;
    $menuItem->parent = $request->parent ?: null; // Set parent or null
    $menuItem->save();

    return redirect()->route('menus', ['slug' => $menuItem->menu->slug])
                            ->with('success', 'Menu updated successfully.');
}






}
