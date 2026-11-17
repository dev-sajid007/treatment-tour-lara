@extends('layouts.web')

@section('content')
<div class="my-5">
        <div class="container mx-auto px-5">
          <div>
            <ul
              class="flex flex-row font-semibold text-slate-500 justify-start items-center gap-2"
            >
              <li><a href="/">Home</a></li>
              <li>
                <a href="./index.html"
                  ><i class="fa-solid fa-angle-right"></i
                ></a>
              </li>
              <li><a href="#">{{$doctor->category->name ?? ''}}</a></li>
              <li>
                <a href="./index.html"
                  ><i class="fa-solid fa-angle-right"></i
                ></a>
              </li>
              <li class="text-pink-700"><a href="#">{{$doctor->user->name ?? ''}}</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- banner -->
      <div class="bg-pink-100 py-5">
        <div class="container mx-auto px-5">
          <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-semibold capitalize text-pink-700">
              {{$doctor->user->name ?? ''}}
            </h1>
            <p class="text-lg text-nowrap capitalize text-cyan-900">
              {{$doctor->category->name ?? ''}}
            </p>
<!--             <span class="text-cyan-900 text-base capitalize"
              >posstion: professor</span
            > -->

<!--             <span class="text-cyan-900 text-base capitalize"
              >experiance: 22 years</span
            > -->
<!--             <span class="text-pink-800 text-base font-semibold capitalize"
              ><i class="fa-regular fa-hospital"></i> medical park group</span
            > -->
            <span class="text-pink-800 text-base font-semibold capitalize"
              ><i class="fa-solid fa-location-crosshairs"></i>
               {{$doctor->state->name ?? ''}}, {{$doctor->country->name ?? ''}}</span
            >
          </div>
        </div>
      </div>
      <!-- doctors -->
      <div class="my-10">
        <div class="container mx-auto px-5">
          <div class="grid grid-cols-1 gap-2 md:grid-cols-6">
            <div class="md:col-span-2">
              <div
                class="bg-white rounded-md py-5 flex flex-col justify-between items-center gap-4"
              >
                <div>
                  <img src="{{asset($doctor->profile_picture)}}" alt="" />
                </div>
                <p class="text-center capitalize font-medium text-lg">share</p>
                <div
                  class="flex flex-row text-gray-600 justify-between items-center gap-5"
                >
                  <a href=""><i class="fa-brands fa-facebook"></i></a>
                  <a href=""><i class="fa-brands fa-twitter"></i></a>
                  <a href=""><i class="fa-solid fa-envelope"></i></a>
                  <a href=""><i class="fa-brands fa-square-whatsapp"></i></a>
                </div>
                <div class="flex justify-center items-center">
                  <a
                    href="{{route('web.appointment', $doctor->id)}}"
                    class="px-4 py-2 rounded-md bg-pink-800 text-base font-semibold text-white"
                    ><button class="capitalize">book appointment</button></a
                  >
                </div>
              </div>

              <!-- consaltancy -->
              <div
                class="border-2 my-10 bg-pink-50 border-blue-200 rounded-md p-5"
              >
                <h2
                  class="text-center text-cyan-900 text-2xl font-semibold capitalize"
                >
                  contact with doctor
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
                  <span
                    class="text-xs inline-block text-center w-full font-light text-cyan-900 capitalize"
                    >By submitting the form I agree to the
                    <a class="underline" href="#">Terms and Conditions</a>
                    of MedSurge India.
                  </span>
                </form>
              </div>
            </div>
            <div class="md:col-span-4">
              <!-- details about doctor -->
              <div>
                <ul class="flex flex-col capitalize justify-between gap-2">
                  <li
                    class="bg-pink-200 cursor-pointer relative rounded-sm py-5 p-2 text-start"
                  >
                    <div class="flex mx-5 flex-col gap-3">
                      <span class="font-semibold text-cyan-900 text-xl"
                        >about</span
                      >
                      <span class="text-pink-800 font-light text-xs"
                        >click to expand</span
                      >
                    </div>
                    <!-- that will click to collapsable like hide and show -->
                    <div
                      class="bg-white absolute top-[6rem] cursor-text left-0 p-5 w-full"
                    >
                      <span class="text-cyan-900 text-base"
                        ></span
                      >
                      <h1 class="font-semibold text-2xl my-4 text-cyan-900">
                        Brief About {{$doctor->user->name}}
                      </h1>
                      <p class="text-cyan-900 text-sm">
                       
                      </p>
                      
                      <div>
                          {!! $doctor->bio !!}
                      </div>
                      
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- pagination -->
          <div class="flex justify-center items-center my-5">
            <ul
              class="flex flex-row justify-between gap-4 text-base items-center capitalize font-medium text-black"
            >
              <li
                class="cursor-pointer py-1 px-3 border-2 border-pink-800 rounded-md"
              >
                <a href="#">prev</a>
              </li>
              <li
                class="cursor-pointer py-1 px-3 border-2 bg-pink-800 text-white border-pink-800 rounded-md"
              >
                <a href="#">1</a>
              </li>
              <li
                class="cursor-pointer py-1 px-3 border-2 border-pink-800 rounded-md"
              >
                <a href="#">3</a>
              </li>
              <li
                class="cursor-pointer py-1 px-3 border-2 border-pink-800 rounded-md"
              >
                <a href="#">3</a>
              </li>
              <li
                class="cursor-pointer py-1 px-3 border-2 border-pink-800 rounded-md"
              >
                <a href="#">10</a>
              </li>
              <li
                class="cursor-pointer py-1 px-3 border-2 border-pink-800 rounded-md"
              >
                <a href="#">next</a>
              </li>
            </ul>
          </div>
        </div>
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
      <div class="my-10 px-5 md:px-2 pt-5 bg-pink-200">
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

