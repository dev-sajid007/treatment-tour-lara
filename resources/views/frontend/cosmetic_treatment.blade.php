@extends('layouts.web')

@section('content')

<!-- navigration -->
      <div class="my-5">
        <div class="container mx-auto px-5">

        </div>
      </div>


      <!-- filter -->
      <div class="my-10">
        <div class="container mx-auto px-5">
          <div class="grid grid-cols-3 md:grid-cols-7 gap-2">
            @foreach($specialities as $speciality)
            <a href="{{route('cosmetic.treatment.speciality', $speciality->id)}}">
            <!-- face -->
              <div
                id="face-tab"
                class="flex flex-col justify-center items-center cursor-pointer gap-2 group"
              >
                <img class="w-10" src="{{asset($speciality->logo)}}" alt="Face" />
                <h5
                  class="text-lg font-semibold capitalize border-b-2 border-transparent group-hover:border-pink-800"
                >
                  {{$speciality->name}}
                </h5>
              </div>
            </a>
            @endforeach
          </div>

          <!-- items -->
          <div class="grid my-8 grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($clinics as $clinic)
              <div
                id="face-item"
                class="flex flex-col rounded-md cursor-pointer shadow-md bg-white p-4 justify-between items-start gap-2 transition-transform transform hover:scale-105"
              >
                <!-- Clinic Image -->
                <div class="w-full h-48 flex justify-center items-center overflow-hidden mb-4">
                  <img
                    class="object-cover w-full h-full"
                    src="{{ asset('storage/img/' . $clinic->main_image) }}"
                    alt="{{ $clinic->name }}"
                  />
                </div>

                <!-- Clinic Information -->
                <div class="flex flex-col items-start gap-1 w-full">
                  <div class="flex items-start justify-between w-full">
                    <span class="text-xl font-semibold text-cyan-800 capitalize">
                      {{ $clinic->state->name }}, {{ $clinic->country->name }}
                    </span>
                    <!-- Uncomment if you want to display the rating -->
                    <!--
                    <span class="flex items-center text-orange-400">
                      <i class="fa-solid fa-star mx-1"></i> 4.9
                    </span>
                    -->
                  </div>

                  <!-- Clinic Name (aligned left) -->
                  <h6 class="text-lg font-semibold text-gray-700 capitalize mb-2 text-left">
                    {{ $clinic->name }}
                  </h6>

                  <!-- Clinic Description (aligned left) -->
                  <p class="text-sm text-gray-600 font-medium capitalize leading-relaxed text-left">
                    {!! $clinic->description !!}
                  </p>
                </div>
              </div>
            @endforeach
          </div>




      <!-- discount banner -->
      <div class="container mx-auto px-5">
        <div class="bg-pink-50 rounded-md shadow-md py-8 md:py-16 my-5">
          <div class="container mx-auto px-5">
            <h1 class="text-3xl font-semibold capitalize text-pink-700">
              get discount upto 30%
            </h1>
            <p class="text-pink-900 my-5 text-base font-medium">
              <span class="font-semibold"> Unlock Exclusive Discount : </span>
              <span>
                Your Gateway to Premium Healthcare with Medsurge India Health
                Value Card.
              </span>
            </p>
            <a
              href="#"
              class="text-base px-3 py-2 font-semibold text-white bg-pink-700 rounded-lg"
              ><button class="capitalize">get discount now</button></a
            >
          </div>
        </div>
      </div>

      <!-- consultancy -->
      <div class="mt-10 px-5 md:px-2 pt-5 bg-pink-200">
        <div class="container mx-auto">
          <!-- consultancy details -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="flex flex-col gap-10 capitalize items-start">
              <div>
                <h1 class="font-semibold text-cyan-900 text-4xl">
                  <span class="text-pink-800">start</span> your journey to good
                  <br />

                  health with
                  <span class="text-pink-800"> treatmenttour </span>
                </h1>
                <br />

                <h5 class="text-xl text-cyan-900 font-semibold">
                  trusted by patience from across the world
                </h5>
              </div>
              <div>
                <ul class="flex flex-col justify-between gap-2 text-gray-600">
                  <li>
                    <i class="fa-solid fa-person"></i>
                    1000+ patients assisted
                  </li>
                  <li>
                    <i class="fa-solid fa-earth-americas"></i> from 50+ country
                  </li>
                  <li>
                    <i class="fa-solid fa-hospital"></i> top 400 hospita and
                    clinic
                  </li>
                  <li>
                    <i class="fa-solid fa-user-doctor"></i> 1500% specilized
                    doctors
                  </li>
                </ul>
              </div>
            </div>
            <!-- image -->
            <div class="">
              <img
                class="w-full a"
                src="{{asset('web/assets/images/dr-female.webp')}}"
                alt=""
              />
            </div>
            <!-- consaltancy -->
            <div>
              <h2
                class="text-center text-cyan-900 text-2xl font-semibold capitalize"
              >
                get free consaltancy
              </h2>

              <div
                class="border-2 mt-3 bg-pink-50 border-blue-200 rounded-md p-5"
              >
                <form action="">
                  <input
                    type="text"
                    placeholder="Name"
                    class="w-full px-3 py-2 border-b-2 border-pink-500 font-medium bg-transparent outline-none"
                  />

                  <select
                    class="w-full mt-5 px-3 py-2 border-b-2 text-slate-500 capitalize border-pink-500 bg-transparent outline-none"
                    id=""
                  >
                    <option value="">Select a country</option>
                    <option value="us">United States</option>
                    <option value="ca">Canada</option>
                    <option value="uk">United Kingdom</option>
                    <option value="au">Australia</option>
                    <option value="in">India</option>
                    <option value="de">Germany</option>
                    <option value="fr">France</option>
                    <option value="jp">Japan</option>
                    <option value="br">Brazil</option>
                    <option value="za">South Africa</option>
                  </select>
                  <div
                    class="flex flex-col md:flex-row justify-between gap-2 mt-5"
                  >
                    <input
                      type="email"
                      placeholder="Email"
                      class="w-full px-3 py-2 border-b-2 border-pink-500 font-medium bg-transparent outline-none"
                    />
                    <input
                      type="text"
                      placeholder="Phone"
                      class="w-full px-3 py-2 border-b-2 border-pink-500 font-medium bg-transparent outline-none"
                    />
                  </div>
                  <textarea
                    name=""
                    class="w-full mt-5 px-3 py-2 border-b-2 border-pink-500 font-medium bg-transparent outline-none"
                    id=""
                    placeholder="Write down your concern"
                  ></textarea>
                  <div
                    class="check-box flex items-center justify-start mt-5 gap-2"
                  >
                    <input
                      id=""
                      placeholder="Want to send video discription ?"
                      type="checkbox"
                      class="cursor-pointer"
                      name=""
                    />
                    <p>Want to send video discription ?</p>
                  </div>
                  <input
                    type="submit"
                    class="w-full bg-pink-700 py-2 font-semibold text-base text-center my-5 text-white rounded-md"
                    value="Submit"
                  />
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection