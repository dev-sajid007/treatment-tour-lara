<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Country;
use App\Models\State;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{


public function show($slug)
{
    try {
       
        $menu = Menu::with(['menuItems' => function ($query) {
            $query->where(function($q) {
                $q->whereNull('parent') 
                ->orWhere('slug', 'location'); 
            });
        }])->where('slug', $slug)->firstOrFail();

        
        $processedMenuItems = [];

        foreach ($menu->menuItems as $menuItem) {
           
            if ($menuItem->slug === 'doctors') {
               
                $categories = Category::all();
                $categoryItems = [];

                foreach ($categories as $category) {
                    
                    $countries = Country::all();
                    
                    $categoryItems[] = [
                        'id' => $category->id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'icon' => $category->icon,
                        'image' => $category->image,
                        'url' => '/doctors/' . $category->slug,
                        'children' => $countries->map(function ($country) {
                            return [
                                'id' => $country->id,
                                'name' => $country->name,
                                'slug' => $country->slug,
                                'icon' => '', 
                                'image' => '', 
                                'url' => '/doctors/locations/' . $country->slug,
                                'children' => []
                            ];
                        })->toArray()
                    ];
                }

                $processedMenuItems[] = [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'slug' => $menuItem->slug,
                    'icon' => $menuItem->icon,
                    'image' => $menuItem->image,
                    'url' => $menuItem->url,
                    'children' => $categoryItems
                ];
            } elseif ($menuItem->slug === 'hospital') {

                $countries = Country::all();
                
                $countryItems = $countries->map(function ($country) {
                    return [
                        'id' => $country->id,
                        'name' => $country->name,
                        'slug' => $country->slug,
                        'icon' => '', 
                        'image' => '', 
                        'url' => '/hospital/locations/' . $country->slug,
                        'children' => []
                    ];
                })->toArray();

                $processedMenuItems[] = [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'slug' => $menuItem->slug,
                    'icon' => $menuItem->icon,
                    'image' => $menuItem->image,
                    'url' => $menuItem->url,
                    'children' => $countryItems 
                ];
            } elseif ($menuItem->type === 'medical_treatment' || $menuItem->type === 'cosmetic_treatment') {
                
                $categories = Category::where('type', $menuItem->type === 'medical_treatment' ? 'medical' : 'cosmetic')->get();
                $categoryItems = [];

                foreach ($categories as $category) {
                    $subcategories = SubCategory::where('category_id', $category->id)->get();

                    $categoryItems[] = [
                        'id' => $category->id,
                        'name' => $category->name,
                        'slug' => $category->slug,
                        'icon' => $category->icon,
                        'image' => $category->image,
                        'url' => '/treatments/' . $category->slug,
                        'children' => $subcategories->map(function ($subcategory) {
                            return [
                                'id' => $subcategory->id,
                                'name' => $subcategory->name,
                                'slug' => $subcategory->slug,
                                'icon' => $subcategory->icon,
                                'image' => $subcategory->image,
                                'url' => '/treatments/' . $subcategory->slug,
                                'children' => []
                            ];
                        })->toArray()
                    ];
                }

                $processedMenuItems[] = [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'slug' => $menuItem->slug,
                    'icon' => $menuItem->icon,
                    'image' => $menuItem->image,
                    'url' => $menuItem->url,
                    'children' => $categoryItems
                ];
            } elseif ($menuItem->slug === 'more') {
                
                $childrenItems = MenuItem::where('parent', $menuItem->id)->get();

           
                $children = $childrenItems->map(function ($child) {
                    return [
                        'id' => $child->id,
                        'name' => $child->name,
                        'slug' => $child->slug,
                        'icon' => $child->icon,
                        'image' => $child->image,
                        'url' => $child->url,
                        'children' => [] 
                    ];
                })->toArray();

              
                $processedMenuItems[] = [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'slug' => $menuItem->slug,
                    'icon' => $menuItem->icon,
                    'image' => $menuItem->image,
                    'url' => $menuItem->url,
                    'children' => $children 
                ];
            } elseif ($menuItem->slug === 'location') {
    
        $countries = Country::all();

        $countryItems = $countries->map(function ($country) {
        $states = State::where('country_id', $country->id)->get();
        return [
            'id' => $country->id,
            'name' => $country->name,
            'slug' => $country->slug,
            'icon' => $country->icon,
            'image' => $country->image,
            'url' => '/location/' . $country->slug,
            'children' => $states->map(function ($state) {
                return [
                    'id' => $state->id,
                    'name' => $state->name,
                    'slug' => $state->slug,
                    'icon' => '', 
                    'image' => '', 
                    'url' => '/location/' . $state->slug,
                    'children' => []
                ];
            })->toArray()
        ];
    })->toArray();

    $processedMenuItems[] = [
        'id' => $menuItem->id,
        'name' => $menuItem->name,
        'slug' => $menuItem->slug,
        'icon' => $menuItem->icon,
        'image' => $menuItem->image,
        'url' => $menuItem->url,
        'children' => $countryItems 
    ];
}

    else {
                    $processedMenuItems[] = [
                        'id' => $menuItem->id,
                        'name' => $menuItem->name,
                        'slug' => $menuItem->slug,
                        'icon' => $menuItem->icon,
                        'image' => $menuItem->image,
                        'url' => $menuItem->url,
                        'children' => []
                    ];
                }
            }

        return response()->json([
            'data' => $processedMenuItems,
            'message' => 'Menu fetched successfully',
            'success' => true,
            'status' => 200
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'data' => [],
            'message' => 'Menu not found',
            'success' => false,
            'status' => 404
        ]);
    }
}

}



