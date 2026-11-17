@extends('layouts.web')

@section('content')

<!-- navigration -->
      <div class="my-5">
        <div class="container mx-auto px-5">

          <!-- Filters Section -->
          <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
              <h2 class="text-3xl font-semibold text-gray-900 mb-6">Search Treatment Packages</h2>

              <form action="{{ route('treatment.package') }}" method="GET" class="flex flex-col md:flex-row items-center gap-4">


                  
                  <!-- Country Filter -->
                  <div class="w-full md:w-1/3">
                      <label for="country_id" class="text-sm font-medium text-gray-700">Country</label>
                      <select name="country_id" id="country_id" class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                          <option value="">All Countries</option>
                          @foreach($countries as $country)
                              <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Treatment Category Filter -->
                  <div class="w-full md:w-1/3">
                      <label for="treatment_category_id" class="text-sm font-medium text-gray-700">Treatment Category</label>
                      <select name="treatment_category_id" id="treatment_category_id" class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-gray-700">
                          <option value="">All Categories</option>
                          @foreach($treatmentcategories as $category)
                              <option value="{{ $category->id }}" {{ request('treatment_category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Search Button -->
                  <div class="w-full md:w-auto">
                     <button type="submit" class="w-full md:w-auto px-6 py-3 mt-5 bg-blue-600 text-dark rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Search
                    </button>

                  </div>
                  
              </form>
          </div>



                <!-- Packages Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($packages as $package)
                    <a href="{{route('treatment.package.view', $package->id)}}">
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ asset($package->image) }}" alt="Package Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $package->package_name }}</h3>
                           <p class="mt-2 text-sm text-gray-600">{{ Str::limit(strip_tags($package->description), 100) }}</p>

                        </div>
                    </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center text-gray-500">
                        <p>No packages found for the selected filters.</p>
                    </div>
                    @endforelse
                </div>


        </div>
      </div>


   

@endsection