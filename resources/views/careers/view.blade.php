@extends('layouts.web')

@section('content')


<style>
    /* General Styling */
    .custom-content h1, .custom-content h2, .custom-content h3 {
        color: #BE185D; /* Custom color for headings */
        font-weight: bold;
    }
    .custom-content h2 {
        font-size: 2rem; /* Default H2 font size */
        margin-top: 20px;
    }
    .custom-content h3 {
        font-size: 1.5rem; /* Default H3 font size */
        margin-top: 15px;
    }
    .custom-content p {
        font-size: 1rem;
        line-height: 1.7;
        margin-top: 10px;
    }

    /* Image Styling */
    .custom-content img {
        max-width: 100%; /* Ensures images never exceed their container */
        height: auto;
        display: block;
        margin: 15px auto; /* Center image */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
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

    /* List Styling */
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

    /* ✅ Mobile Responsiveness */
    @media (max-width: 768px) {
        .custom-content h2 {
            font-size: 1.5rem; /* Smaller H2 font for mobile */
        }
        .custom-content h3 {
            font-size: 1.3rem; /* Smaller H3 font */
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
            float: none; /* Disable float for mobile */
            margin: 10px auto; /* Center images */
            display: block;
        }
    }

    @media (max-width: 480px) {
        .custom-content h2 {
            font-size: 1.4rem; /* Even smaller H2 for very small screens */
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



<div class="container mx-auto px-5">

      <!-- Disease -->
      <div>
        <div class="container mx-auto px-5 mt-5">
          <h1
            class="font-semibold text-2xl capitalize text-start text-white bg-pink-500 p-3"
          >
            {{$career->title}}
          </h1>
          <div class="pt-6">
                  <div class="custom-content">
                      {!! $career->description !!}
                  </div>
          </div>
        </div>
      </div>

</div>

@endsection

