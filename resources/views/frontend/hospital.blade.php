@extends('layouts.web')

@section('content')
<div class="my-5">
        <div class="container mx-auto px-5">
          <div>
            <ul
              class="flex flex-row font-semibold capitalize text-slate-500 justify-start items-center gap-2"
            >
              <li><a href="/">Home</a></li>
              <li>
                <a href="#"
                  ><i class="fa-solid fa-angle-right"></i
                ></a>
              </li>
              <li><a href="#">hospitals</a></li>
              <li>
                <a href="./index.html"
                  ><i class="fa-solid fa-angle-right"></i
                ></a>
              </li>
              <li class="text-pink-700"><a href="#">{{$country->name}}</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- banner -->
      <div class="bg-pink-100 py-10">
        <div class="container mx-auto px-5">
          <h1 class="text-3xl font-semibold capitalize text-pink-700">
            best hospitals in {{$country->name}}
          </h1>
<!--           <p class="text-pink-900 my-5 text-base font-medium">
            <span class="font-semibold"> Unlock Exclusive Discount : </span>
            <span>
              Your Gateway to Premium Healthcare with Medsurge India Health
              Value Card.
            </span>
          </p> -->
<!--           <a
            href="#"
            class="text-base px-3 py-2 font-semibold text-white bg-pink-700 rounded-lg"
            ><button class="capitalize">get discount now</button></a
          > -->
        </div>
      </div>
      <!-- doctors -->
      <div class="my-10">
        <div class="container mx-auto px-5">
          <div class="grid grid-cols-1 gap-2 md:grid-cols-6">
            <div class="md:col-span-2">
              <!-- filter -->
              <div class="bg-white rounded-md p-5">
                <h2 class="my-4 capitalize text-xl font-semibold">filter</h2>
                <!-- filter by country -->
                <div>
                  <h2
                    class="my-4 capitalize text-cyan-900 text-2xl font-semibold"
                  >
                    by country
                  </h2>
                  <ul
                    class="flex flex-col justify-between items-start font-medium gap-2 capitalize"
                  >
                  @foreach($countries as $item)
                    <li class="hover:text-pink-700">
                      <a href="{{route('web.hospital', $item->id)}}">{{$item->name}}</a>
                    </li>
                  @endforeach
                  </ul>
                </div>
                <!-- filter by city name -->
                <div class="overflow-hidden">
                  <h2
                    class="my-4 capitalize text-cyan-900 text-2xl font-semibold"
                  >
                    by city
                  </h2>
                  <form action="" class="my-3">
                   <input
                      type="text"
                      placeholder="Search city..."
                      id="citySearch"
                      class="border px-3 py-2 rounded w-full mb-2"
                    />
                  </form>

                  <ul
                    id="cityList"
                    class="flex flex-col h-[200px] overflow-y-auto font-medium gap-2 capitalize"
                  >
                    @foreach($cities as $city)
                    <li class="hover:text-pink-700"><a href="{{ route('web.hospital', ['country' => $city->country_id, 'city' => $city->id]) }}">{{$city->name}}</a></li>
                    @endforeach
                    <!-- ... more cities -->
                  </ul>
                </div>
                <!-- filter by department-->
                {{--
                <div class="overflow-hidden">
                  <h2
                    class="my-4 capitalize text-cyan-900 text-2xl font-semibold"
                  >
                    by department
                  </h2>
                  <form action="" class="my-3">
                    <input
                      class="px-2 py-2 border-2 rounded-md w-full focus:outline-pink-300 outline-1"
                      type="text"
                      name=""
                      id=""
                      placeholder="Enter department"
                    />
                  </form>

                  <ul
                    class="flex flex-col h-[200px] overflow-hidden overflow-y-auto justify-between items-start font-medium gap-2 capitalize"
                  >
                    <li class="hover:text-pink-700">
                      <a href="#">Cardiology and Cardiac Surgery</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Cosmetic and Plastic Surgery</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Cardiology and Cardiac Surgery</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Cosmetic and Plastic Surgery</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Dental Treatment</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Cardiology and Cardiac Surgery</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Cosmetic and Plastic Surgery</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Dental Treatment</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Cardiology and Cardiac Surgery</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Cosmetic and Plastic Surgery</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Dental Treatment</a>
                    </li>
                  </ul>
                </div>
                --}}

              </div>
              <!-- consaltancy -->
             {{--
              <div
                class="border-2 my-10 bg-pink-50 border-blue-200 rounded-md p-5"
              >
                <h2
                  class="text-center text-cyan-900 text-2xl font-semibold capitalize"
                >
                  get free consaltancy
                </h2>
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
              --}}
            </div>

            <div class="md:col-span-4">
              @foreach($hospitals as $hospital)
              <div class="grid grid-cols-6 my-5 border-b-2 border-pink-300">
                <div class="col-span-2">
                  <div class="p-4">
                    <img
                      class="cursor-pointer hover:scale-110 ease-in-out transition duration-150"
                      src="{{ asset('storage/images/hospitals/' . $hospital->image) }}"
                      alt=""
                    />
                  </div>
                  <div class="flex mt-5 justify-center items-center gap-2">
                    <a
                      href="tel:{{$hospital->phone_number}}"
                      class="bg-pink-800 text-white font-semibold rounded-md px-4 py-3"
                      ><button class="capitalize">
                        <i class="fa-solid fa-phone"></i> contact hospital
                      </button></a
                    >
                  </div>
                </div>
                <div class="col-span-4 p-4 w-full">
                  <div class="capitalize flex flex-col gap-2 text-start">
                    <h2 class="text-3xl font-semibold text-cyan-900">
                     @php
                        $website = $hospital->website;
                        if (!Str::startsWith($website, ['http://', 'https://'])) {
                            $website = 'https://' . $website;
                        }
                    @endphp

                    <a href="{{ $website }}" target="_blank" class="inline-flex items-center gap-1 text-blue-600 hover:underline">
                        {{ $hospital->name }}
                        <i class="fa-solid fa-up-right-from-square"></i>
                    </a>
                    </h2>
                    <ul class="text-gray-500 text-base flex flex-col gap-3">
                      <li>
                        <i class="fa-solid fa-location-dot"></i>
                        {{$hospital->address}} 
                      </li>
                      <li>
                        <i class="fa fa-calendar"></i>
                        Established in : {{$hospital->established}} 
                      </li>
                      <li>
                        <i class="fa fa-bed mr-2"> </i>Number of Beds : {{$hospital->no_of_beds}} 
                      </li>
                      {{--
                      <li>
                        <i class="fa-regular fa-sun"></i>
                        {{$hospital->speciality_type}}
                      </li>
                      --}}
                    </ul>

                    @php
                        $cleanDescription = strip_tags($hospital->description);
                        $shortDescription = Str::limit($cleanDescription, 200);
                    @endphp

                    <p class="mb-5 text-base text-dark-600">
                        <span id="short-desc">{{ $shortDescription }}...</span>
                        <span id="full-desc" style="display:none;">{!! $cleanDescription !!}</span>
                    </p>
                    <span class="text-pink-800 cursor-pointer" onclick="toggleDescription(this)">Read more</span>
                  </div>
                </div>
              </div>
              
              @endforeach

            </div>

          </div>
           @if ($hospitals->lastPage() > 1)
            <div class="flex justify-center items-center my-5">
              <ul class="flex flex-row gap-4 text-base items-center capitalize font-medium text-black">

                {{-- Prev Button --}}
                @if ($hospitals->onFirstPage())
                  <li class="cursor-not-allowed py-1 px-3 border-2 border-gray-400 rounded-md text-gray-400">Prev</li>
                @else
                  <li class="cursor-pointer py-1 px-3 border-2 border-pink-800 rounded-md">
                    <a href="{{ $hospitals->previousPageUrl() }}">Prev</a>
                  </li>
                @endif

                {{-- Page Links --}}
                @for ($i = 1; $i <= $hospitals->lastPage(); $i++)
                  <li class="cursor-pointer py-1 px-3 border-2 rounded-md
                    {{ $hospitals->currentPage() == $i ? 'bg-pink-800 text-white border-pink-800' : 'border-pink-800' }}">
                    <a href="{{ $hospitals->url($i) }}">{{ $i }}</a>
                  </li>
                @endfor

                {{-- Next Button --}}
                @if ($hospitals->hasMorePages())
                  <li class="cursor-pointer py-1 px-3 border-2 border-pink-800 rounded-md">
                    <a href="{{ $hospitals->nextPageUrl() }}">Next</a>
                  </li>
                @else
                  <li class="cursor-not-allowed py-1 px-3 border-2 border-gray-400 rounded-md text-gray-400">Next</li>
                @endif

              </ul>
            </div>
          @endif

          <!-- discount banner -->
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
      </div>
      <!-- consultancy -->
      <div class="my-10 px-5 md:px-2 pb-5 pt-5 bg-pink-200">
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
                src="./src/assets/images/dr-female.webp"
                alt=""
              />
            </div>
            <!-- consaltancy -->
            {{--
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
              --}}
            </div>
          </div>
        </div>
      </div>

      <script>
    function toggleDescription(btn) {
        const shortDesc = document.getElementById("short-desc");
        const fullDesc = document.getElementById("full-desc");

        if (shortDesc.style.display === "none") {
            shortDesc.style.display = "inline";
            fullDesc.style.display = "none";
            btn.textContent = "Read more";
        } else {
            shortDesc.style.display = "none";
            fullDesc.style.display = "inline";
            btn.textContent = "Show less";
        }
    }
</script>


<script>
  document.getElementById('citySearch').addEventListener('input', function () {
    const filter = this.value.toLowerCase();
    const items = document.querySelectorAll('#cityList li');

    items.forEach(item => {
      const text = item.textContent.toLowerCase();
      item.style.display = text.includes(filter) ? '' : 'none';
    });
  });
</script>

@endsection

