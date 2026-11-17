@extends('layouts.admin') 

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Home Settings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('home-settings.save') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col">
                <label>Top Title</label>
                <input type="text" name="top_title" class="form-control" value="{{ old('top_title', $setting->top_title ?? '') }}">
            </div>
            <div class="col">
                <label>Top Sub Title</label>
                <input type="text" name="top_sub_title" class="form-control" value="{{ old('top_sub_title', $setting->top_sub_title ?? '') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Top Description</label>
            <textarea name="top_description" class="form-control" rows="3">{{ old('top_description', $setting->top_description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Top Image</label>
            <input type="file" name="top_image" class="form-control">
            @if(!empty($setting->top_image))
                <img src="{{ asset($setting->top_image) }}" alt="Top Image" width="100" class="mt-2">
            @endif
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>About Title</label>
                <input type="text" name="about_title" class="form-control" value="{{ old('about_title', $setting->about_title ?? '') }}">
            </div>
            <div class="col">
                <label>About Sub Title</label>
                <input type="text" name="about_sub_title" class="form-control" value="{{ old('about_sub_title', $setting->about_sub_title ?? '') }}">
            </div>
        </div>

        <!-- About Description -->
        <div class="mb-3">
            <label>About Description</label>
            <textarea name="about_description" class="form-control" rows="3">{{ old('about_description', $setting->about_description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>About Button</label>
            <input type="text" name="about_button" class="form-control" value="{{ old('about_button', $setting->about_button ?? '') }}">
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Package Title</label>
                <input type="text" name="package_title" class="form-control" value="{{ old('package_title', $setting->package_title ?? '') }}">
            </div>
            <div class="col">
                <label>Podcast Title</label>
                <input type="text" name="podcast_title" class="form-control" value="{{ old('podcast_title', $setting->podcast_title ?? '') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>News & Event Title</label>
            <input type="text" name="news_event_title" class="form-control" value="{{ old('news_event_title', $setting->news_event_title ?? '') }}">
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>FAQ Title</label>
                <input type="text" name="faq_title" class="form-control" value="{{ old('faq_title', $setting->faq_title ?? '') }}">
            </div>
            <div class="col">
                <label>FAQ Sub Title</label>
                <input type="text" name="faq_sub_title" class="form-control" value="{{ old('faq_sub_title', $setting->faq_sub_title ?? '') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Video Link</label>
            <input type="text" name="video" class="form-control" value="{{ old('video', $setting->video ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Why Choose Title</label>
            <input type="text" name="why_choose_title" class="form-control" value="{{ old('why_choose_title', $setting->why_choose_title ?? '') }}">
        </div>

        <!-- Why Choose Description -->
        <div class="mb-3">
            <label>Why Choose Description</label>
            <textarea name="why_choose_des" class="form-control" rows="3">{{ old('why_choose_des', $setting->why_choose_des ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>First Card Title</label>
            <input type="text" name="first_card_title" class="form-control" value="{{ old('first_card_title', $setting->first_card_title ?? '') }}">
        </div>

        <!-- First Card Description -->
        <div class="mb-3">
            <label>First Card Description</label>
            <textarea name="first_card_des" class="form-control" rows="3">{{ old('first_card_des', $setting->first_card_des ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>First Card Button</label>
            <input type="text" name="first_card_button" class="form-control" value="{{ old('first_card_button', $setting->first_card_button ?? '') }}">
        </div>

        <!-- Second Card Title -->
        <div class="mb-3">
            <label>Second Card Title</label>
            <input type="text" name="second_card_title" class="form-control" value="{{ old('second_card_title', $setting->second_card_title ?? '') }}">
        </div>

        <!-- Second Card Description -->
        <div class="mb-3">
            <label>Second Card Description</label>
            <textarea name="second_card_des" class="form-control" rows="3">{{ old('second_card_des', $setting->second_card_des ?? '') }}</textarea>
        </div>

        <!-- Second Card Button -->
        <div class="mb-3">
            <label>Second Card Button</label>
            <input type="text" name="second_card_button" class="form-control" value="{{ old('second_card_button', $setting->second_card_button ?? '') }}">
        </div>

        <!-- Third Card Title -->
        <div class="mb-3">
            <label>Third Card Title</label>
            <input type="text" name="third_card_title" class="form-control" value="{{ old('third_card_title', $setting->third_card_title ?? '') }}">
        </div>

        <!-- Third Card Description -->
        <div class="mb-3">
            <label>Third Card Description</label>
            <textarea name="third_card_des" class="form-control" rows="3">{{ old('third_card_des', $setting->third_card_des ?? '') }}</textarea>
        </div>

        <!-- Third Card Button -->
        <div class="mb-3">
            <label>Third Card Button</label>
            <input type="text" name="third_card_button" class="form-control" value="{{ old('third_card_button', $setting->third_card_button ?? '') }}">
        </div>



        <div class="row mb-3">
            <div class="col">
                <label>Footer Title</label>
                <input type="text" name="footer_title" class="form-control" value="{{ old('footer_title', $setting->footer_title ?? '') }}">
            </div>
            <!-- Footer Description -->
            <div class="col">
                <label>Footer Description</label>
                <textarea name="footer_des" class="form-control" rows="3">{{ old('footer_des', $setting->footer_des ?? '') }}</textarea>
            </div>
        </div>

        <!-- Footer Logo Description -->
        <div class="mb-4">
            <label>Footer Logo Description</label>
            <textarea name="footer_logo_des" class="form-control" rows="3">{{ old('footer_logo_des', $setting->footer_logo_des ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
