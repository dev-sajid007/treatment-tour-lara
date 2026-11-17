
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
                <a href="./index.html"
                  ><i class="fa-solid fa-angle-right"></i
                ></a>
              </li>

              <li class="text-pink-700">
                <a href="./index.html">doctor appointment</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- banner -->
      <div class="bg-pink-100 py-12 shadow-sm">
        <div class="container mx-auto px-5">
          <h1 class="text-3xl font-semibold capitalize text-pink-700">
            doctor appointment
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
      <div class="container mx-auto px-36">
        <h1 class="text-center my-5 font-semibold capitalize text-cyan-900 text-4xl">
          Doctor appointment for:
        </h1>

        <div class="flex justify-center items-center">
          <div class="border-2 border-pink-800 px-10 bg-white py-5 rounded-md grid grid-cols-2 gap-5">
            <div class="col-span-1">
              <img src="{{ asset($doctor->profile_picture) }}" alt="" />
            </div>
            <div class="col-span-1 flex flex-col gap-2 items-start">
              <h2 class="font-semibold text-pink-800 capitalize text-start text-2xl">
                {{ $doctor->user->name }}
              </h2>
              <span class="text-base capitalize text-gray-600 font-normal">
                {{ $doctor->category->name }}
              </span>
              <span class="text-pink-600 font-medium text-xl capitalize">
                Appointment Fee:
                <i class="fa-solid"></i> ${{ $doctor->consultation_fee }}
              </span>
            </div>
          </div>
        </div>

        <div class="mx-16 px-2 my-5">
          <a href="javascript:history.back()" class="bg-pink-800 rounded-md px-4 py-2 font-semibold text-white">
            <button class="capitalize">Change Doctor</button>
          </a>
        </div>

        <div class="flex justify-center items-center">
          <div class="mx-16">
            <div class="border-2 mt-3 bg-pink-50 border-blue-200 rounded-md p-10">
              <form action="{{ route('online.appointment', $doctor->user->id) }}" method="POST">
                @csrf
                <!-- Appointment Date -->
                <label for="appointment_date" class="font-semibold text-gray-600 capitalize text-lg">
                  Select Appointment Date:
                </label>
                <input
                  type="date"
                  name="appointment_date"
                  id="appointment_date"
                  class="w-full px-3 py-2 border-b-2 border-pink-500 font-medium bg-transparent outline-none"
                  required
                />

                <!-- Appointment Time -->
                <label for="appointment_time" class="font-semibold text-gray-600 capitalize text-lg mt-5">
                  Select Appointment Time:
                </label>
                <input
                  type="time"
                  name="appointment_time"
                  id="appointment_time"
                  class="w-full px-3 py-2 border-b-2 border-pink-500 font-medium bg-transparent outline-none"
                  required
                />

                <!-- Reason for Appointment -->
                <textarea
                  name="reason"
                  id="reason"
                  class="w-full mt-5 px-3 py-2 border-b-2 border-pink-500 font-medium bg-transparent outline-none"
                  placeholder="Write down your concern (optional)"
                ></textarea>

                <div class="check-box flex items-center justify-start mt-5 gap-2">
                  <input id="" placeholder="Want to send video description?" type="checkbox" class="cursor-pointer" name="" />
                  <p>Want to send video description?</p>
                </div>

                <!-- Payment Buttons -->
                <div class="flex justify-center items-center mt-5">
                  <a href="{{ route('pay.with.paypal', ['doctorId' => $doctor->user->id]) }}" class="bg-blue-500 text-white font-semibold py-2 px-6 rounded-md">
                    Pay with PayPal
                  </a>
                </div>

                <div class="flex justify-center items-center mt-5">
                  <a href="{{ route('pay.with.sslcommerz', ['doctorId' => $doctor->user->id]) }}" class="bg-green-500 text-white font-semibold py-2 px-6 rounded-md">
                    Pay with SSLCommerz
                  </a>
                </div>

                <input
                  type="submit"
                  class="w-full bg-pink-700 py-2 font-semibold text-base text-center my-5 text-white rounded-md"
                  value="Submit"
                />

                <span class="text-xs inline-block text-center w-full font-light text-cyan-900 capitalize">
                  By submitting the form, I agree to the
                  <a class="underline" href="#">Terms and Conditions</a>
                  of MedSurge India.
                </span>
              </form>
            </div>
          </div>
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