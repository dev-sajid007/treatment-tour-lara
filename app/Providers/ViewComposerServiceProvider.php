<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Country;
use App\Models\Speciality;
use App\Models\HomeSetting;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\PageGeneration;

class ViewComposerServiceProvider extends ServiceProvider
{

    public function register(): void
    {
     
    }


    public function boot(): void
    {
        $categories = Category::where('type', 'medical')->get();


        $cosmetic_categories = Category::where('type', 'cosmetic')->get();
  
        $countries = Country::all();
        $specialities = Speciality::all();
        $home_setting = HomeSetting::first();
        $blogs = Blog::latest()->take(4)->get();
        $setting = Setting::first();
        $header_pages = PageGeneration::where('placement', 'header')->get();
        $footer_pages = PageGeneration::where('placement', 'footer')->get();

        // Share them with all views
        View::share('categories', $categories);
        View::share('cosmetic_categories', $cosmetic_categories);
        View::share('countries', $countries);
        View::share('specialities', $specialities);
        View::share('home_setting', $home_setting);
        View::share('blogs', $blogs);
        View::share('setting', $setting);
        View::share('header_pages', $header_pages);
        View::share('footer_pages', $footer_pages);
    }
}
