@extends('layouts.web')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-6">
  <div class="w-full max-w-3xl lg:w-3/5 bg-white shadow-lg rounded-lg p-8 px-8 py-10">
    <!-- Top Banner -->
    <div class="mb-6">
      <img 
        src="https://www.slideegg.com/image/catalog/477284-career-ppt-templates-free-download.png" 
        alt="Join As A Partner" 
        class="w-full h-48 object-cover shadow-md"
        style="width: full; height: 300px;" 
      />
    </div>


  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <h2 class="text-3xl font-bold text-gray-800 mb-6">Available Job Positions</h2>

     <ul class="space-y-4">
        @forelse ($careers as $career)
            <li class="bg-gray-50 border border-gray-200 p-5 rounded-xl shadow-sm hover:shadow-md transition duration-300">
                <a href="{{ route('job.view', $career->id) }}" class="flex items-center gap-x-4">
                    <div class="text-blue-600 text-xl px-6">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 hover:text-blue-700 transition">
                        {{ $career->title }}
                    </h3>
                </a>
            </li>
        @empty
            <li class="text-center text-gray-500">No job posts available at the moment.</li>
        @endforelse
    </ul>


  </div>

    
  </div>
</div>


@endsection
