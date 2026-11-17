@extends('layouts.web')

@section('content')

<style type="text/css">
  /* Default Content Styling */
  .ck-content {
    font-size: 1.125rem; /* Equivalent to Tailwind text-lg */
    color: #374151; /* Equivalent to Tailwind text-gray-800 */
    line-height: 1.75; /* Equivalent to Tailwind leading-relaxed */
  }

  /* Style Headings */
  .ck-content h2 {
    font-size: 1.5rem; /* Equivalent to Tailwind text-2xl */
    font-weight: bold;
    margin-top: 1rem;
  }

  .ck-content h3 {
    font-size: 1.25rem; /* Equivalent to Tailwind text-xl */
    font-weight: 600;
    margin-top: 1rem;
  }

  /* Style Paragraphs */
  .ck-content p {
    margin-top: 0.5rem;
  }

  /* Style Lists */
  .ck-content ul {
    list-style-type: disc;
    padding-left: 1.5rem; /* Equivalent to Tailwind list-inside */
    margin-top: 0.5rem;
  }

  .ck-content li {
    margin-bottom: 0.25rem;
  }

  /* Image Styling */
  .ck-content img {
    max-width: 100%; /* Ensures images never exceed their container */
    height: auto;
    display: block;
    margin: 15px auto; /* Center the image */
    border-radius: 8px; /* Optional: Add rounded corners */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Optional: Add subtle shadow */
  }

  .ck-content img.align-left {
    float: left;
    margin-right: 15px;
    margin-bottom: 10px;
  }

  .ck-content img.align-right {
    float: right;
    margin-left: 15px;
    margin-bottom: 10px;
  }

  .ck-content img.align-center {
    margin: 15px auto;
    display: block;
  }

  /* ✅ Mobile Responsiveness */
  @media (max-width: 768px) {
    /* Reduce font size for smaller screens */
    .ck-content h2 {
      font-size: 1.375rem; /* Smaller H2 font for mobile */
    }
    .ck-content h3 {
      font-size: 1.125rem; /* Smaller H3 font */
    }
    .ck-content p {
      font-size: 0.95rem;
    }

    /* Make sure images fit smaller screens */
    .ck-content img {
      max-width: 100%;
      margin: 10px auto;
    }

    /* Disable float for mobile screens and center images */
    .ck-content img.align-left,
    .ck-content img.align-right {
      float: none; /* Disable float for mobile */
      margin: 10px auto; /* Center images */
      display: block;
    }
  }

  @media (max-width: 480px) {
    /* Further reduce font size for very small screens */
    .ck-content h2 {
      font-size: 1.25rem; /* Smaller H2 for very small screens */
    }
    .ck-content h3 {
      font-size: 1.1rem;
    }
    .ck-content p {
      font-size: 0.85rem;
    }
    .ck-content ul, .ck-content ol {
      font-size: 1rem;
      padding-left: 18px;
    }
  }
</style>


<!-- Banner Image (Static) -->
<!-- <div class="w-full h-72 md:h-96 bg-cover bg-center  overflow-hidden" style="background-image: url('https://media.istockphoto.com/id/1261300973/photo/medical-business-meeting.jpg?s=612x612&w=0&k=20&c=-Y7zBnJElw3RDhwue2oMUhuE3OMmOIIVv9BCM2215Ps=');">
    <div class="w-full h-full bg-black bg-opacity-40 flex items-center justify-center">
        <h1 class="text-white text-4xl md:text-5xl font-bold">Treatment Package Details</h1>
    </div>
</div> -->
<div class="my-5">
  <div class="container mx-auto px-5">



      <!-- Package Details -->
      <div class="mt-8 max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
          
          <!-- Package Image -->
          <div class="w-full h-64 md:h-80 bg-gray-200 rounded-lg overflow-hidden">
              <img src="{{ asset($package->image) }}" alt="{{ $package->package_name }}" class="w-full h-full object-cover">
          </div>

          <!-- Package Information -->
          <h1 class="mt-6 text-3xl font-bold text-gray-800 pt-6 pb-6">{{ $package->package_name }}</h1>

          <div class="flex flex-wrap items-center mt-2 text-gray-600 text-lg">
              <span class="mr-4"><strong>Price:</strong> ${{ $package->price }}</span>
              <span class="mr-4"><strong>Category:</strong> {{ $package->category->category_name }}</span>
              <span><strong>Country:</strong> {{ $package->country->name }}</span>
          </div>
          <div class="max-w-full text-gray-800">
              <h2 class="text-2xl font-bold mt-4">Package Details</h2>
              <div class="ck-content">
                  {!! $package->description !!}
              </div>
          </div>

      </div>
  </div>
</div>


   

@endsection