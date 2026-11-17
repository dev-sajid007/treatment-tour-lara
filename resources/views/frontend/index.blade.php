@extends('layouts.web')

@section('content')

<style type="text/css">
  .hero-container {
  background-color: #4c8df5; /* blue */
  height: 600px;
  display: flex;
  flex-direction: column;
  border-bottom-left-radius: 100px;
  position: relative;
  padding: 1rem;
}

.hero-text {
  color: white;
  width: 100%;
  padding-top: 1rem;
}

.hero-title {
  font-size: 2rem;
  font-weight: bold;
}

.hero-subtitle {
  text-transform: uppercase;
  margin-top: 1.5rem;
}

.hero-description {
  margin-top: 1.5rem;
  width: 80%;
}

.hero-form {
  width: 100%;
  margin-top: 2rem;
}

.form-title {
  text-align: center;
  font-weight: bold;
  color: white;
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.form-wrapper {
  background: linear-gradient(to bottom, #98befa, #4c8df5); /* pink-100 to blue-300 */
  padding: 1rem;
  width: 90%;
  margin: 0 auto;
  border-radius: 0.5rem;
}

input, textarea {
  width: 100%;
  padding: 0.5rem;
  border-radius: 0.375rem;
  margin-bottom: 0.75rem;
  border: none;
}

.input-row {
  display: flex;
  gap: 0.5rem;
}

.input-row input {
  width: 50%;
}

.checkbox-row {
  display: flex;
  align-items: left;
  gap: 0.5rem;
  margin-bottom: 1rem;
}



.hero-image {
  position: absolute;
  bottom: 0;
  left: 35%;
  width: 25rem;
  height: 25rem;
  display: none;
}

.hero-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.bottom-corner {
  height: 6rem;
  background-color: #4c8df5;
}

.bottom-round {
  height: 6rem;
  background-color: #f3f4f6; /* gray-100 */
  border-top-right-radius: 100px;
}

/* Desktop */
@media (min-width: 768px) {
  .hero-container {
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
  }

  .hero-text {
    width: 50%;
  }

  .hero-description {
    width: 40%;
  }

  .hero-form {
    width: 40%;
  }

  .hero-image {
    display: block;
  }
}

</style>

@if(session('success'))
    <div class="mb-6">
        <div class="flex items-center bg-green-100 border border-green-300 text-green-800 text-sm rounded-lg p-4" role="alert">
            <svg class="w-5 h-5 mr-2 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif
       <div>
        <div class="container mx-auto px-5">
          <div class="hero-container">
            <div class="hero-text">
              <h1 class="hero-title">{{$home_setting->top_title}}</h1>
              <p class="hero-subtitle">{{$home_setting->top_sub_title}}</p>
              <p class="hero-description">{{$home_setting->top_description}}</p>
            </div>

            <div class="hero-form">
              <h1 class="form-title">Get Free Information</h1>
              <div class="form-wrapper">
                <form method="POST" action="{{ route('contacts.store') }}">
                  @csrf
                  <input placeholder="Full Name" type="text"  name="first_name" id="first_name" required/>
                  <input placeholder="Address" type="text" name="last_name" id="last_name" required/>
                  <div class="input-row">
                    <input placeholder="Email" type="text" name="email" id="email" required/>
                    <input placeholder="Phone" type="text" name="phone_number" id="phone_number" required/>
                  </div>
                  <textarea placeholder="Write down your concern" name="message" id="message" required></textarea>
<!--                   <div class="checkbox-row">
                    <input type="checkbox" />
                    <p>Want to send video description?</p>
                  </div> -->
                <button style="background-color: #3b82f6; color: white; padding: 0.5rem; width: 100%; border: none; border-radius: 0.375rem; font-weight: 600; cursor: pointer; transition: background-color 0.3s ease;" 
                      onmouseover="this.style.backgroundColor='#2563eb';" 
                      onmouseout="this.style.backgroundColor='#3b82f6';" 
                      type="submit">
                      Submit
                  </button>

                </form>
              </div>
            </div>

            <div class="hero-image">
              <img src="{{ asset($home_setting->top_image) }}" style="width: 320px; height: 320px;margin-top: 80px;" alt="Top Section Image" />
            </div>
          </div>

          <div class="bottom-corner">
            <div class="bottom-round"></div>
          </div>


      <!-- treatment package -->
      <div class="my-5 md:my-16">
        <div class="container mx-auto px-5">
          <div>
            <h1
              class="mb-1 lg:mb-3 text-2xl py-5 capitalize lg:text-2xl xl:text-3xl font-semibold text-center"
            >
              {{$home_setting->about_title}}
              <!-- <span class="px-1 text-pink-800 font-bold">discount</span> -->
            </h1>

            <h6
              style="
                background: linear-gradient(
                  90deg,
                  rgb(243 243 243) 2%,
                  rgb(255 0 122) 50%,
                  rgb(255 245 245) 100%,
                  rgb(255 255 255) 100%
                );
              "
              class="flex gap-2 py-4 justify-center items-center my-5"
            >
              <span class="capitalize">
                {{$home_setting->about_sub_title}}</span
              >
              <img src="./src/assets/images/emoji.png" class="w-5" alt="" />
            </h6>
            <p class="text-center font-medium text-base text-gray-500">
              {{$home_setting->about_description}}
            </p>
            <div class="flex justify-center items-center my-5">
              <button class="px-4 py-2 rounded-md shadow-md bg-pink-800 font-semibold text-base text-white capitalize hover:text-gray-200 ">
                get discount now
              </button>
            </div>

          </div>
          <div class="pt-10">
            <h1
              class="mb-1 lg:mb-3 text-2xl py-5 capitalize lg:text-2xl xl:text-3xl font-semibold text-center"
            >
              {{$home_setting->package_title}}
              <!-- <span class="px-1 text-pink-800 font-bold">its packages</span> -->
            </h1>
            <div
              class="grid grid-cols-2 my-5 relative md:grid-cols-3 lg:grid-cols-5 items-center gap-2"
            >
            @foreach($packages as $package)
              <div
                class="flex flex-col justify-center items-center cursor-pointer gap-2 group"
              >
                <img
                    style="width: 200px;"
                  class="bg-pink-100 p-2 rounded-full"
                  src="{{ asset($package->image) }}"
                  alt="Face"
                />
                <h5 class="text-lg font-semibold capitalize text-pink-800">
                 {{$package->package_name}}
                </h5>
              </div>
            @endforeach

          </div>
            <div class="flex gap-2 py-4 justify-center items-center my-5">

                <a href="#" class="px-4 py-2 rounded-md shadow-md bg-pink-800 font-semibold text-base text-white"
                ><button class="capitalize hover:text-gray-200">
                  get more
                </button>
              </a>
            </div>
        </div>
      </div>

      <!-- podcast -->
      <div class="my-5 md:my-20 mt-8 md:mt-12 lg:mt-16">
        <div class="container mx-auto px-5">
          <h1
            class="text-center m-5 text-cyan-900 text-4xl font-semibold capitalize"
          >
            {{$home_setting->podcast_title ?? ''}}
          </h1>
          <div class="grid grid-cols-1 my-5 md:grid-cols-3 gap-5">
            @foreach($podcasts as $podcast)
            <div class="mx-auto">
              <iframe
                class="rounded-md shadow-lg"
                src="{{$podcast->video}}" 
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
              ></iframe>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- events and news -->
      <div class="my-15 mt-10" style="padding-top:10px; padding-bottom:10px;">
        <div class="container mx-auto px-5 mt-10">
          <h1 class="text-center m-5 text-cyan-900 text-4xl font-semibold capitalize" style="padding-top:10px; padding-bottom:20px;">
            {{$home_setting->news_event_title ?? ''}}
          </h1>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
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
          <!-- navigration -->
          <div class="flex my-8 justify-center items-center">
            <ul class="flex gap-2 text-xs items-center">
              <li class="text-pink-800"><i class="fa-solid fa-circle"></i></li>
              <li class="text-gray-500"><i class="fa-solid fa-circle"></i></li>
              <li class="text-gray-500"><i class="fa-solid fa-circle"></i></li>
            </ul>
          </div>
          <!-- view all news and events button -->
          <div class="flex justify-center items-center">
            <a
              class="px-4 py-3 rounded-md shadow-md bg-pink-800 text-white font-semibold hover:text-gray-500 capitalize text-base"
              href="{{route('blog.list')}}"
              >view all news and events</a
            >
          </div>
        </div>
      </div>

      <!-- blog -->

      <!-- FAQ -->
      <div class="my-5 md:my-16">
        <div class="container mx-auto px-5">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
              <div class="relative w-full">
                <div class="mx-auto px-5">
                  <div class="flex flex-col items-center">
                    <h2
                      class="mt-5 text-center text-pink-800 text-3xl font-bold tracking-tight md:text-5xl"
                    >
                      {{$home_setting->faq_title ?? ''}}
                    </h2>
                    <p class="mt-3 text-lg text-neutral-500 md:text-xl">
                      {{$home_setting->faq_sub_title ?? ''}}
                    </p>
                  </div>
                  <div
                    class="mx-auto mt-8 grid max-w-xl divide-y divide-neutral-200"
                  >
                    @foreach($faqs as $faq)
                    <div class="py-5">
                      <details class="group">
                        <summary
                          class="flex cursor-pointer list-none items-center justify-between font-medium"
                        >
                          <span class="font-semibold">
                            {{$faq->title}}</span
                          >
                          <span class="transition group-open:rotate-180">
                            <svg
                              fill="none"
                              height="24"
                              shape-rendering="geometricPrecision"
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.5"
                              viewBox="0 0 24 24"
                              width="24"
                            >
                              <path d="M6 9l6 6 6-6"></path>
                            </svg>
                          </span>
                        </summary>
                        <p
                          class="group-open:animate-fadeIn mt-3 text-neutral-600"
                        >
                          {{$faq->description}}
                        </p>
                      </details>
                    </div>
                    @endforeach

                  </div>
                </div>
              </div>
            </div>
            <div>
              <iframe
                width="100%"
                height="100%"
                class="rounded-md"
                src="{{$home_setting->video}}"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
      </div>



      <!-- service -->
      <div class="my-5 md:my-16">
        <div class="container mx-auto px-5 pb-5 lg:py-10">
          <div class="w-full flex flex-col gap-5 items-center justify-center">
            <h1
              class="mb-1 lg:mb-3 text-2xl lg:text-2xl xl:text-3xl font-semibold text-center"
            >
             <span class="px-1 text-pink-700 font-bold"
                >{{$home_setting->why_choose_title}}</span
              >
            </h1>
            <div
              class="max-w-4xl text-center text-sm text-gray-500 lg:text-lg leading-4 lg:leading-5 font-suse"
            >
              {{$home_setting->why_choose_des}}
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-2 my-8">
            <div
              class="w-full p-6 border border-solid border-slate-300 bg-white relative rounded-xl"
            >
              <div>
                <h2 class="text-xl text-pink-800 font-semibold">
                  {{$home_setting->first_card_title}}
                </h2>
                <p class="text-justify text-gray-600 leading-6 py-6">
                  {{$home_setting->first_card_des}}
                </p>
                <a class="mt-5 block rounded-md" href="#"
                  ><button
                    class="flex gap-3 bg-pink-700 text-white px-5 py-2 font-bold capitalize tracking-wide duration-300 hover:tracking-wider rounded hover:bg-black"
                  >
                    <span>learn more</span
                    ><span
                      ><i class="fa-solid fa-arrow-right"></i
                    ></span></button
                ></a>
              </div>
              <div
                class="absolute bottom-0 text-7xl pr-6 pb-6 text-slate-300 right-0"
              >
                <span><i class="fa-solid fa-heart-circle-bolt"></i></span>
              </div>
            </div>
            <div
              class="w-full p-6 border border-solid border-slate-300 bg-white relative rounded-xl"
            >
              <div>
                <h2 class="text-xl font-semibold text-pink-800">
                  {{$home_setting->second_card_title}}
                </h2>
                <p class="text-justify text-gray-600 leading-6 py-6">
                  {{$home_setting->second_card_des}}
                </p>
                <a class="mt-5 block rounded-md" href="#"
                  ><button
                    class="flex gap-3 bg-pink-700 text-white px-5 py-2 font-bold capitalize tracking-wide duration-300 hover:tracking-wider rounded hover:bg-black"
                  >
                    <span>Explore now</span
                    ><span
                      ><i class="fa-brands fa-canadian-maple-leaf"></i
                    ></span></button
                ></a>
              </div>
              <div
                class="absolute bottom-0 text-7xl pr-6 pb-6 text-slate-300 right-0"
              >
                <span><i class="fa-solid fa-truck-moving"></i></span>
              </div>
            </div>
            <div
              class="w-full p-6 border border-solid border-slate-300 bg-white relative rounded-xl"
            >
              <div>
                <h2 class="text-xl font-semibold text-pink-800">
                  {{$home_setting->third_card_title}}
                </h2>
                <p class="text-justify text-gray-600 leading-6 py-6">
                  {{$home_setting->third_card_des}}
                </p>
                <a class="mt-5 block rounded-md" href="#"
                  ><button
                    class="flex gap-3 bg-pink-700 text-white px-5 py-2 font-bold capitalize tracking-wide duration-300 hover:tracking-wider rounded hover:bg-black"
                  >
                    <span>support for help</span
                    ><span><i class="fa-solid fa-hand"></i></span></button
                ></a>
              </div>
              <div
                class="absolute bottom-0 text-7xl pr-6 pb-6 text-slate-300 right-0"
              >
                <span><i class="fa-solid fa-hand-holding-hand"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- JavaScript to handle dropdown toggle -->

      <!--  Carousel  -->
     {{--
      <div class="relative my-10 w-full glide-01">
        <div class="container mx-auto px-5">
          <div class="mb-8">
            <h2 class="font-bold text-xl text-pink-700">
              <span class="tracking-[-4px] pr-4">-------</span
              ><span class="capitalize text-2xl font-semibold">Brands</span>
            </h2>
            <h1 class="text-2xl font-normal mt-2">Our Latest Case Studies</h1>
          </div>
        </div>
        <!-- Slides -->
        <div class="overflow-hidden cursor-pointer" data-glide-el="track">
          <ul
            class="relative w-full overflow-hidden p-0 whitespace-no-wrap flex flex-no-wrap [backface-visibility: hidden] [transform-style: preserve-3] [touch-action: pan-Y] [will-change: transform]"
          >
            <li>
              <img
                src="https://Tailwindmix.b-cdn.net/carousel/carousel-image-01.jpg"
                class="w-full max-w-full max-h-full m-auto"
              />
            </li>
            <li>
              <img
                src="https://Tailwindmix.b-cdn.net/carousel/carousel-image-02.jpg"
                class="w-full max-w-full max-h-full m-auto"
              />
            </li>
            <li>
              <img
                src="https://Tailwindmix.b-cdn.net/carousel/carousel-image-03.jpg"
                class="w-full max-w-full max-h-full m-auto"
              />
            </li>
            <li>
              <img
                src="https://Tailwindmix.b-cdn.net/carousel/carousel-image-04.jpg"
                class="w-full max-w-full max-h-full m-auto"
              />
            </li>
            <li>
              <img
                src="https://Tailwindmix.b-cdn.net/carousel/carousel-image-05.jpg"
                class="w-full max-w-full max-h-full m-auto"
              />
            </li>
          </ul>
        </div>
        <!-- Controls -->
        <div
          class="absolute left-0 flex items-center justify-between w-full h-0 px-4 top-2/3"
          data-glide-el="controls"
        >
          <button
            class="inline-flex items-center justify-center w-8 h-8 transition duration-300 border rounded-full lg:w-12 lg:h-12 text-white font-semibold hover:text-slate-900 focus-visible:outline-none bg-pink-700"
            data-glide-dir="<"
            aria-label="prev slide"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-5 h-5"
            >
              <title>prev slide</title>
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18"
              />
            </svg>
          </button>
          <button
            class="inline-flex items-center justify-center w-8 h-8 transition duration-300 border rounded-full lg:w-12 lg:h-12 text-white font-semibold hover:text-slate-900 focus-visible:outline-none bg-pink-700"
            data-glide-dir=">"
            aria-label="next slide"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-5 h-5"
            >
              <title>next slide</title>
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"
              />
            </svg>
          </button>
        </div>
      </div>
    --}}

@endsection




      