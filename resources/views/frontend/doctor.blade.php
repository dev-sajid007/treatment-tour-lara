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
                <a href="#"
                  ><i class="fa-solid fa-angle-right"></i
                ></a>
              </li>
              <li><a href="./index.html">Cardiology and Cardiac Surgery</a></li>
              <li>
                <a href="./index.html"
                  ><i class="fa-solid fa-angle-right"></i
                ></a>
              </li>
              <li class="text-pink-700"><a href="./index.html">india</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- banner -->
      <div class="bg-pink-100 py-5">
        <div class="container mx-auto px-5">
          <h1 class="text-3xl font-semibold capitalize text-pink-700">
            Best Cardiology and Cardiac Surgery <br />
            Doctors In India
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
                    <li class="hover:text-pink-700">
                      <a href="#">india</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Turkey</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">UAE</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">Thailand</a>
                    </li>

                    <li class="hover:text-pink-700">
                      <a href="#">Malaysia</a>
                    </li>
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
                      class="px-2 py-2 border-2 rounded-md w-full focus:outline-pink-300 outline-1"
                      type="text"
                      name=""
                      id=""
                      placeholder="Enter city name"
                    />
                  </form>

                  <ul
                    class="flex flex-col h-[200px] overflow-hidden overflow-y-auto justify-between items-start font-medium gap-2 capitalize"
                  >
                    <li class="hover:text-pink-700">
                      <a href="#">kolkata</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">cennai</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">dubai</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">mumbai</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">kolalampur</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">istiambul</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">hydrabad</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">delhi</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">kerela</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">dhaka</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">london</a>
                    </li>
                    <li class="hover:text-pink-700">
                      <a href="#">rajsthan</a>
                    </li>
                  </ul>
                </div>
                <!-- filter by department-->
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
              </div>
              <!-- consaltancy -->
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
            </div>

            <div class="md:col-span-4">
              @if($doctors->isEmpty())
                <div class="text-center my-5 text-gray-500">
                  <p>No doctors found at the moment. Please check back later.</p>
                </div>
              @else
                @foreach($doctors as $doctor)
                <div class="grid grid-cols-6 my-5  border-b-2 border-pink-300">
                  <div class="col-span-2 pr-5" style="padding-right:20px;">
                    <div>
                      <img
                        class="cursor-pointer hover:scale-110 ease-in-out transition duration-150"
                        src="{{asset($doctor->profile_picture)}}"
                        alt=""
                      />
                    </div>
                    <div class="flex mt-5 justify-center items-center gap-2">
                      <i class="fa-solid text-orange-400 fa-star"></i>
                      <i class="fa-solid text-orange-400 fa-star"></i>
                      <i class="fa-solid text-orange-400 fa-star"></i>
                      <i class="fa-solid text-orange-400 fa-star"></i>
                      <i class="fa-regular text-orange-400 fa-star"></i>
                    </div>
                  </div>
                  <div class="col-span-4 w-full">
                    <div class="capitalize flex flex-col gap-2 text-start">
                      <h2 class="text-2xl font-semibold text-cyan-900">
                        <a href="./about-doctor.html">{{$doctor->user->name}}</a>
                      </h2>
                      <span class="text-lg font-normal text-pink-800"
                        >{{$doctor->category->name}}
                      </span>
                      <span class="text-base font-normal text-gray-500"
                        >{!! $doctor->qualification !!}
                      </span>
                    <!--   <span class="text-base font-normal text-cyan-900"
                        >Fortis Hospital, Noida
                      </span> -->
                      <span>
                        <i class="fa-solid fa-hospital"></i>
                        {{$doctor->state->name}}, {{$doctor->country->name}}
                      </span>
                      <h2 class="text-xl mt-5 font-semibold text-cyan-900">
                        highlights
                      </h2>

                      <p class="mb-5 text-base text-gray-500">
                        {{ Str::limit(strip_tags($doctor->bio), 400, '...') }}
                      </p>
                      <div>
                        <!-- <h2 class="text-pink-800 font-semibold text-xl">
                          treatments
                        </h2>
                        <ul class="list-disc text-gray-500">
                          <li>Aortic Dissection Repair Surgery</li>
                          <li>Aortofemoral Bypass Surgery</li>
                          <li>ASD (Atrial Septal Defect) Closure</li>

                          <li>Atrial Fibrillation Surgery</li>
                          <span class="text-pink-800 cursor-pointer"
                            >read more</span
                          >
                          <span class="hidden">
                            <li>CARDIAC SURGERY - ADULTS</li>
                            <li>Cardiac Tumour Treatment</li>
                            <li>Closure of defects like ASD VSD</li>
                            <li>Complex congenital heart surgeriesg</li>
                            <li>Minimal access surgeries for valves</li>
                            <li>Neonatal and Infant cardiac surgeries</li>
                            <li>Off Pump beating CABG LV restoration</li>
                            <li>PTE - Pulmonary Thromboendarterectomy</li>
                            <li>Ross Procedure</li>
                            <li>Single Ventricle Defects Surgery</li>
                            <li>surgery</li>
                            <li>
                              TAPVC - Total Anomalous Pulmonary Venous Connection
                              Repair Arterial Switch
                            </li>
                            <li>Thoracic Aortic Aneurysm Treatment</li>
                            <li>Valve Repair Replacement</li>
                          </span>
                        </ul> -->
                        <div
                          class="my-5 flex flex-row font-semibold text-white text-lg items-center gap-4"
                        >
                          <a
                            href="{{route('doctor.about', $doctor->id)}}"
                            class="cursor-pointer rounded-md px-4 py-2 bg-pink-800"
                          >
                            <i class="fa-regular fa-eye mr-4"></i>read more</a
                          >

                          @auth
                            <a
                                  href="{{route('web.appointment', $doctor->id)}}"
                                  class="cursor-pointer rounded-md px-4 py-2 bg-pink-800"
                                >
                              <i class="fa-regular fa-calendar-check mr-4"></i>book
                              appoinment
                            </a>
                          @else

                            <a
                                  href="/login"
                                  class="cursor-pointer rounded-md px-4 py-2 bg-pink-800"
                                >
                              <i class="fa-regular fa-calendar-check mr-4"></i>book
                              appoinment
                            </a>

                          @endauth
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              @endif
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

