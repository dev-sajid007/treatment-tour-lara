@extends('layouts.web')

@section('content')

<style>
    /* Custom Styling (unchanged from your original with small refinements) */
    .custom-content h1, .custom-content h2, .custom-content h3 {
        color: #BE185D;
        font-weight: bold;
    }
    .custom-content h2 {
        font-size: 2rem;
        margin-top: 20px;
    }
    .custom-content h3 {
        font-size: 1.5rem;
        margin-top: 15px;
    }
    .custom-content p {
        font-size: 1rem;
        line-height: 1.7;
        margin-top: 10px;
    }
    .custom-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 15px auto;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .custom-content img.align-left {
        float: left;
        margin-right: 15px;
        margin-bottom: 10px;
    }
    .custom-content img.align-right {
        float: right;
        margin-left: 15px;
        margin-bottom: 10px;
    }
    .custom-content img.align-center {
        margin: 15px auto;
        display: block;
    }
    .custom-content ul, .custom-content ol {
        margin-top: 10px;
        padding-left: 25px;
        font-size: 1.1rem;
    }
    .custom-content ul {
        list-style-type: disc;
    }
    .custom-content ol {
        list-style-type: decimal;
    }
    .custom-content li {
        margin-bottom: 5px;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .custom-content h2 {
            font-size: 1.5rem;
        }
        .custom-content h3 {
            font-size: 1.3rem;
        }
        .custom-content p {
            font-size: 0.95rem;
        }
        .custom-content img {
            max-width: 100%;
            height: auto;
            margin: 10px auto;
        }
        .custom-content img.align-left,
        .custom-content img.align-right {
            float: none;
            margin: 10px auto;
            display: block;
        }
    }

    @media (max-width: 480px) {
        .custom-content h2 {
            font-size: 1.4rem;
        }
        .custom-content h3 {
            font-size: 1.2rem;
        }
        .custom-content p {
            font-size: 0.9rem;
        }
        .custom-content ul, .custom-content ol {
            font-size: 1rem;
            padding-left: 18px;
        }
    }
</style>

<!-- Blog Container -->
<div class="container mx-auto px-5 my-10">

    <!-- Featured Image -->
    <div class="mb-6">
        <img 
            src="{{ asset($blog->image) }}" 
            alt="{{ $blog->title }}" 
            class="w-full h-auto max-h-48 object-cover rounded-xl shadow-md"
            style="object-fit: cover; max-height:450px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"
        />

    
    </div>

    <!-- Blog Title & Date -->
    <div class="mb-6" style="padding-top:20px;">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight mb-2">
            {{ $blog->title }}
        </h1>
        <p class="text-sm text-gray-500">
            Published on {{ $blog->created_at->format('jS M Y') }}
        </p>
    </div>

    <!-- Blog Content -->
    <div class="custom-content prose max-w-none">
        {!! $blog->description !!}
    </div>

</div>

@endsection


