@extends('layouts.web')

@section('content')

<!-- Navigation Section -->
<div class="my-5">
  <div class="container mx-auto px-5">
    <!-- Placeholder for navigation -->
  </div>
</div>

<!-- Blog Filter / Main Section -->
<div class="my-10">
  <div class="container mx-auto px-5">

    <!-- Heading -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-cyan-800 capitalize">News and Blogs</h1>
      <div class="mt-2 w-24 h-1 bg-cyan-600 mx-auto rounded"></div>
    </div>

    <!-- Blog Grid -->
    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      @foreach($blogs as $blog)
        <a href="{{ route('blog.view', $blog->slug) }}" class="block transition-transform transform hover:scale-105">
          <div class="bg-white rounded-xl shadow-lg hover:shadow-xl overflow-hidden flex flex-col h-full">
            
            <!-- Blog Image -->
            <div class="h-48 overflow-hidden">
              <img
                class="object-cover w-full h-full transition-transform duration-300 hover:scale-110"
                src="{{ asset($blog->image) }}"
                alt="{{ $blog->slug }}"
              />
            </div>

            <!-- Blog Content -->
            <div class="p-4 flex flex-col justify-between flex-grow">
              <div>
                <h2 class="text-lg font-semibold text-cyan-800 mb-1 capitalize">
                  {{ Str::limit($blog->title, 50) }}
                </h2>
                <p class="text-sm text-gray-600">
                  {{ $blog->created_at->format('jS M Y') }}
                </p>
              </div>

              <!-- Uncomment to show excerpt -->
              {{-- <p class="text-sm text-gray-700 mt-3">
                {{ Str::limit(strip_tags($blog->content), 80) }}
              </p> --}}
            </div>
          </div>
        </a>
      @endforeach
    </div>

  </div>
</div>

@endsection
