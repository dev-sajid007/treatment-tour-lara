<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- font awesome icon -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link href="{{asset('/web/styles/output.css')}}" rel="stylesheet" />
    <title>Treatmenttour</title>
       
<script type="text/javascript" data-cfasync="false" src="https://humanchat.net/build/js/hb_latest.js?v=1.5.28" crossorigin="anonymous"></script>
<script>
var aiBot = new AiBot({embedId: '7aaCERJS8Ry8', remoteBaseUrl: 'https://humanchat.net/', version: '1.5.28'});
</script>
  </head>
  
  <body class="bg-gray-100">
      
    <header class="">
      <div class="bg-white">
        <div class="container mx-auto px-2">
          <div class="w-full flex justify-between items-center px-2 sm:px-0">
            <a class="flex items-center" href="/"
              ><img
                alt="Logo"
                width="80"
                height="30"
                src="{{asset('/web/assets/images/logo.webp')}}"
                style="color: transparent"
              />
              <p
                class="font-bold text-sm sm:text-xl uppercase tracking-wide hidden md:block"
              >
                <span class="block leading-5 text-blue-500">treatment</span
                ><span class="block leading-5 text-primary">tour</span>
              </p></a
            >
            <div class="flex gap-10">
              <div class="flex items-center gap-4 sm:gap-6">
                <a
                  class="text-sm bg-pink-700 text-white px-4 py-2 rounded-md font-bold hover:bg-black-700 duration-300"
                  href="/partner"
                  >Become Our Partner</a
                ><!-- <a
                  class="text-sm bg-pink-700 text-white px-4 py-2 rounded-md font-bold hover:bg-black-700 duration-300"
                  href="#"
                  >Booking</a> -->
                <button
                  class="text-sm relative hover:bg-pink-700 bg-slate-100 border border-solid border-slate-300 p-2 rounded-full capitalize font-bold fill-primary duration-500 hover:bg-primary hover:fill-slate-100 group"
                >
                  <span class="text-sm w-5 h-5 block"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                    >
                      <path
                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                      ></path></svg></span
                  ><span
                    class="opacity-0 duration-500 group-hover:opacity-100 absolute text-nowrap bg-primary text-pink-700 px-2 rounded-full font-medium top-10 -left-4"
                    >find now</span
                  ></button
                ><button
                  class="text-sm hover:bg-pink-700 bg-slate-100 border border-solid border-slate-300 p-2 rounded-full capitalize font-bold text-slate-600 fill-slate-600 duration-500 hover:bg-primary hover:fill-slate-100 relative group"
                >
                @auth
                    <span style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; border: 2px solid #ccc; display: inline-block;">
                        @if(Auth::user()->profile_picture)
                            <img 
                                src="{{ asset('uploads/profile/' . Auth::user()->profile_picture) }}" 
                                alt="Profile Picture"
                                style="width: 100%; height: 100%; object-fit: cover; display: block;"
                            />
                        @else
                            <img 
                                src="https://www.alaska.edu/_resources/images/placeholders/profile.png" 
                                alt="Default Profile"
                                style="width: 100%; height: 100%; object-fit: cover; display: block;"
                            />
                        @endif
                    </span>
                @else
                    <span style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; border: 2px solid #ccc; display: inline-block;">
                        <img 
                            src="https://www.alaska.edu/_resources/images/placeholders/profile.png" 
                            alt="Guest"
                            style="width: 100%; height: 100%; object-fit: cover; display: block;"
                        />
                    </span>
                @endauth




                  <span
                    class="opacity-0 duration-500 group-hover:opacity-100 absolute text-nowrap bg-primary text-pink-700 px-2 rounded-full font-medium top-10 -left-4"
                    >User Profile</span
                  ></button
                > 

                @auth

                  <a
                  target="_blank"
                  class="flex gap-3 items-center justify-center bg-black border border-solid border-slate-300 px-3 py-3 sm:py-2 sm:rounded-md uppercase font-bold text-slate-100 text-sm fill-slate-100 duration-500 hover:bg-primary rounded-full"
                  href="{{route('home')}}"
                  ><i class="w-4 h-4"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                      width="100%"
                      height="100%"
                    >
                      <path
                        d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"
                      ></path></svg></i
                  ><span class="hidden sm:block">Dashboard</span>
                  </a>

                @else
                <a
                  target="_blank"
                  class="flex gap-3 items-center justify-center bg-black border border-solid border-slate-300 px-3 py-3 sm:py-2 sm:rounded-md uppercase font-bold text-slate-100 text-sm fill-slate-100 duration-500 hover:bg-primary rounded-full"
                  href="/login"
                  ><i class="w-4 h-4"
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                      width="100%"
                      height="100%"
                    >
                      <path
                        d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"
                      ></path></svg></i
                  ><span class="hidden sm:block">Login</span>
                  </a>
                  @endauth
                  <button
                  id="menu-btn"
                  class="block lg:hidden size-12 rounded-lg p-2 sm:size-10 text-white fill-white bg-pink-700"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <rect
                      x="48"
                      y="48"
                      width="176"
                      height="176"
                      rx="20"
                      ry="20"
                      fill="none"
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="32"
                    ></rect>
                    <rect
                      x="288"
                      y="48"
                      width="176"
                      height="176"
                      rx="20"
                      ry="20"
                      fill="none"
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="32"
                    ></rect>
                    <rect
                      x="48"
                      y="288"
                      width="176"
                      height="176"
                      rx="20"
                      ry="20"
                      fill="none"
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="32"
                    ></rect>
                    <rect
                      x="288"
                      y="288"
                      width="176"
                      height="176"
                      rx="20"
                      ry="20"
                      fill="none"
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="32"
                    ></rect>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <nav class="w-full py-4 md:py-0 text-lg text-gray-700 bg-white">
        <!-- nav -->
        <div
          
          class="bg-pink-700  md:block text-base font-semibold w-full lg:w-auto"
        >
        <!-- desktop nav -->
          <div class="w-full hidden md:block py-0">
            <ul
              class="flex flex-col md:flex-row justify-center lg:gap-8 2xl:gap-12 items-center"
            >
              <li class="group relative text-gray-200">
                <button class="px-4 py-2 rounded">
                  <a class="flex items-center justify-center" href="/"
                    ><span>Home</span></a
                  >
                </button>
              </li>
              <li class="group relative text-gray-200">
                <button class="px-4 py-2 rounded">
                  <a class="flex items-center justify-center" href="/"
                    ><span>Doctors</span></a
                  >
                </button>
                <ul
                  class="absolute top-10 left-0 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] group-[.active]:py-4 lg:group-hover:py-4 z-[1]"
                >
                @foreach($categories as $category)
                  <li
                    class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                  >
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="#"
                      ><span class="leading-5 text-wrap"
                        >{{$category->name}}</span
                      ><i
                        class="block size-3 duration-500 group-[.children:hover]:rotate-90"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 320 512"
                        >
                          <path
                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"
                          ></path></svg></i
                    ></a>
                    <div
                      class="hidden group-[.children:hover]:block lg:absolute"
                      style="left: 100%; top: -50px"
                    >
                      <ul
                        class="lg:absolute top-[72px] left-0 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] group-[.active]:py-4 lg:group-hover:py-4 z-[1]"
                      >
                      @foreach($countries as $country)

                        <li
                          class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                        >
                          <a
                            class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                            href="{{ route('web.doctor', ['country' => $country->id, 'category' => $category->id]) }}"
                            ><span class="leading-5 text-wrap">{{$country->name}}</span></a
                          >
                        </li>
                      @endforeach
                       
                      </ul>
                    </div>
                  </li>
                  @endforeach
                  
                </ul>
              </li>
              <li class="group relative text-gray-200">
                <button class="px-4 py-2 rounded">
                  <a class="flex items-center justify-center" href="/"
                    ><span>Hospital</span></a
                  >
                </button>
                <ul
                  class="lg:absolute top-10 left-0 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] group-[.active]:py-4 lg:group-hover:py-4 z-[1]"
                >
                  @foreach($countries as $country)
                  <li
                    class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                  >
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="{{route('web.hospital', $country->id)}}"
                      ><span class="leading-5 text-wrap">{{$country->name}}</span></a
                    >
                  </li>
                  @endforeach
                 
                </ul>
              </li>
              <li class="group relative text-gray-200">
                <button class="px-4 py-2 rounded">
                  <a class="flex items-center justify-center" href="/"
                    ><span>Medical Treatment</span></a
                  >
                </button>
                <ul
                  class="lg:absolute top-10 left-0 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] group-[.active]:py-4 lg:group-hover:py-4 z-[1]"
                >@foreach($categories as $category)
                  <li
                    class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                  >
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="#"
                      ><span class="leading-5 text-wrap"
                        >{{$category->name}}</span
                      ><i
                        class="block size-3 duration-500 group-[.children:hover]:rotate-90"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 320 512"
                        >
                          <path
                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"
                          ></path></svg></i
                    ></a>
                    <div
                      class="hidden group-[.children:hover]:block lg:absolute"
                      style="left: 100%; top: -50px"
                    >
                      <ul
                        class="lg:absolute top-[72px] left-0 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] group-[.active]:py-4 lg:group-hover:py-4 z-[1]"
                      >@foreach($category->subcategories as $sub)
                        <li
                          class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                        >
                          <a
                            class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                            href="{{route('medical.treatment', $sub->id)}}"
                            ><span class="leading-5 text-wrap"
                              >{{$sub->name}}</span
                            ></a
                          >
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </li>
                @endforeach
                </ul>
              </li>
              <li class="group relative text-gray-200">
                <button class="px-4 py-2 rounded">
                  <a class="flex items-center justify-center" href="/"
                    ><span>Cosmetic Treatment</span></a
                  >
                </button>
                <ul
                  class="lg:absolute top-10 left-0 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] group-[.active]:py-4 lg:group-hover:py-4 z-[1]"
                >
                  @foreach($cosmetic_categories as $category)
                  <li
                    class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                  >
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href=""
                      ><span class="leading-5 text-wrap"
                        >{{$category->name}}</span
                      ><i
                        class="block size-3 duration-500 group-[.children:hover]:rotate-90"
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 320 512"
                        >
                          <path
                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"
                          ></path></svg></i
                    ></a>
                    <div
                      class="hidden group-[.children:hover]:block lg:absolute"
                      style="left: 100%; top: -50px"
                    >
                      <ul
                        class="lg:absolute top-[72px] left-0 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] group-[.active]:py-4 lg:group-hover:py-4 z-[1]"
                      >
                      @foreach($category->subcategories as $sub)
                        <li
                          class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                        >
                          <a
                            class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                            href="{{route('cosmetic.treatment', $sub->id)}}"
                            ><span class="leading-5 text-wrap"
                              >{{$sub->name}}</span
                            ></a
                          >
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="group relative text-gray-200">
                <button class="px-4 py-2 rounded">
                  <a class="flex items-center justify-center" href="/"
                    ><span>More</span></a
                  >
                </button>
                <ul
                  class="lg:absolute top-10 left-0 bg-white shadow-[0px_2px_4px_0px_rgba(0,0,0,0.1)] group-[.active]:py-4 lg:group-hover:py-4 z-[1]"
                >
                  <li
                    class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                  >
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="{{route('free-quotes.create')}}"
                      ><span class="leading-5 text-wrap">Free Quote</span></a
                    >
                  </li>
                  <li
                    class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                  >
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="{{route('treatment.package')}}"
                      ><span class="leading-5 text-wrap"
                        >Treatment Packages</span
                      ></a
                    >
                  </li>
                  <li
                    class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                  >
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="{{route('job.list')}}"
                      ><span class="leading-5 text-wrap">Career</span></a
                    >
                  </li>
                  @foreach($header_pages as $page)
                  <li
                    class="px-4 py-1 lg:w-64 hidden lg:group-hover:!block group-[.active]:block lg:group-[.active]:hidden group children relative"
                  >
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-slate-50 text-slate-500 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="{{route('page.view', $page->slug)}}"
                      ><span class="leading-5 text-wrap">{{$page->page_name}}</span></a
                    >
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="group relative text-gray-200">
                <button class="px-4 py-2 rounded">
                  <a class="flex items-center justify-center" href="{{route('contacts.create')}}"
                    ><span>Contact Us</span></a
                  >
                </button>
              </li>
            </ul>
          </div>
          <!-- Mobile nav  -->
          <div id="mobile-menu" class="w-full hidden  md:hidden py-0">
          
            <ul
              class="flex flex-col py-5 justify-center gap-4 lg:gap-8 2xl:gap-12 items-center text-start"
            >
              <!-- Home item -->
              <li class="relative text-gray-200">
                <a class="flex items-center justify-center" href="/">Home</a>
              </li>

              <!-- Doctor item -->
              <li class="text-center relative text-gray-200">
                <a
                  href="javascript:void(0)"
                  class="flex items-center justify-center"
                  onclick="toggleSubmenu('doctor-dropdown')"
                >
                  <span>Doctor</span>
                </a>

                <!-- First dropdown (Doctor) -->
                <ul class="bg-white rounded-md hidden" id="doctor-dropdown">
                  <!-- Cardiology item -->

                  @foreach($categories as $category)
                  <li class="px-4 py-1 lg:w-64">
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-pink-100 text-cyan-900 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="javascript:void(0)"
                      onclick="toggleSubmenu('cardiology-dropdown')"
                    >
                      <span class="leading-5 text-wrap"
                        >{{$category->name}}</span
                      >
                      <i class="block size-3 duration-500"></i>
                    </a>

                    <!-- Nested dropdown (Cardiology) -->
                    <div class="hidden" id="cardiology-dropdown">
                      <ul class="my-2">
                        @foreach($countries as $country)
                        <li>
                          <a
                            class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-pink-300 text-pink-800 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                            href="{{ route('web.doctor', ['country' => $country->id, 'category' => $category->id]) }}"
                          >
                            <span class="leading-5 text-wrap">{{$country->name}}</span>
                          </a>
                        </li>
                      @endforeach
                      
                      </ul>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </li>

              <!-- hospital item -->
              <li class="text-center relative text-gray-200">
                <a
                  href="javascript:void(0)"
                  class="flex items-center capitalize justify-center"
                  onclick="toggleSubmenu('hospital-dropdown')"
                >
                  <span>hospital</span>
                </a>

                <!-- Second dropdown (Services) -->
                <ul
                  class="bg-white rounded-md hidden my-4"
                  id="hospital-dropdown"
                >
                  <!-- Web Design item -->

                  @foreach($countries as $country)
                  <li class="px-4 py-1 lg:w-64">
                    <a
                      class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-pink-100 text-cyan-900 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                      href="{{route('web.hospital', $country->id)}}"
                      onclick="toggleSubmenu('india-dropdown')"
                    >
                      <span class="leading-5 text-wrap"
                        >{{$country->name}}</span
                      >
                      <i class="block size-3 duration-500"></i>
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              
              <!-- Medical Treatment -->
              <li class="text-center relative text-gray-200">
                <a
                  href="javascript:void(0)"
                  class="flex items-center capitalize justify-center"
                  onclick="toggleSubmenu('medical-dropdown')"
                >
                  <span>Medical Treatment</span>
                </a>

                <!-- Dropdown for Medical Categories -->
                <ul class="bg-white rounded-md hidden my-4" id="medical-dropdown">
                  @foreach($categories as $category)
                    <li class="px-4 py-1 lg:w-64">
                      <a
                        class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-pink-100 text-cyan-900 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                        href="javascript:void(0)"
                        onclick="toggleSubmenu('category-{{ $category->id }}')"
                      >
                        <span class="leading-5 text-wrap">{{ $category->name }}</span>
                        <i class="block size-3 duration-500"></i>
                      </a>

                      <!-- Nested dropdown for Subcategories -->
                      <ul class="hidden my-2" id="category-{{ $category->id }}">
                        @foreach($category->subcategories as $sub)
                          <li>
                            <a
                              class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-pink-300 text-pink-800 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                              href="{{ route('medical.treatment', $sub->id)}}"
                            >
                              <span class="leading-5 text-wrap">{{ $sub->name }}</span>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    </li>
                  @endforeach
                </ul>
              </li>



              <!-- Medical Treatment -->
              <li class="text-center relative text-gray-200">
                <a
                  href="javascript:void(0)"
                  class="flex items-center capitalize justify-center"
                  onclick="toggleSubmenu('cosmetic-dropdown')"
                >
                  <span>Cosmetic Treatment</span>
                </a>

                <!-- Dropdown for Medical Categories -->
                <ul class="bg-white rounded-md hidden my-4" id="cosmetic-dropdown">
                  @foreach($cosmetic_categories as $category)
                    <li class="px-4 py-1 lg:w-64">
                      <a
                        class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-pink-100 text-cyan-900 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                        href="javascript:void(0)"
                        onclick="toggleSubmenu('cosmetic_category-{{ $category->id }}')"
                      >
                        <span class="leading-5 text-wrap">{{ $category->name }}</span>
                        <i class="block size-3 duration-500"></i>
                      </a>

                      <!-- Nested dropdown for Subcategories -->
                      <ul class="hidden my-2" id="cosmetic_category-{{ $category->id }}">
                        @foreach($category->subcategories as $sub)
                          <li>
                            <a
                              class="flex gap-2 py-4 rounded-lg px-3 font-medium text-base capitalize w-full justify-between items-center bg-pink-300 text-pink-800 border border-solid border-slate-100 hover:bg-slate-100 hover:text-primary hover:fill-primary hover:tracking-wide duration-500"
                              href="{{ route('cosmetic.treatment', $sub->id)}}"
                            >
                              <span class="leading-5 text-wrap">{{ $sub->name }}</span>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    </li>
                  @endforeach
                </ul>
              </li>
              
              <!-- Treatment Package -->
              <li class="relative text-gray-200">
                <a class="flex items-center justify-center" href="{{route('treatment.package')}}"
                  >Treatment Package</a
                >
              </li>



              <!-- Free Quote -->
              <li class="relative text-gray-200">
                <a class="flex items-center justify-center" href="{{route('free-quotes.create')}}"
                  >Free Quote</a
                >
              </li>

              <li class="relative text-gray-200">
                <a class="flex items-center justify-center" href="{{route('job.list')}}"
                  >Career</a
                >
              </li>

              <!-- Contact item -->
              <li class="relative text-gray-200">
                <a class="flex items-center justify-center" href="{{route('contacts.create')}}"
                  >Contact</a
                >
              </li>
            </ul>
          </div>

        </div>
      </nav>
    </header>

<script type="text/javascript">
document.getElementById("menu-btn").addEventListener("click", () => {
  const mobileMenu = document.getElementById("mobile-menu");
  mobileMenu.classList.toggle("hidden");
});

function toggleSubmenu(id) {
  const submenu = document.getElementById(id);
  submenu.classList.toggle("hidden");
}



document.addEventListener("click", function (event) {
  const target = event.target;
  const submenu = document.querySelectorAll(".hidden");

  submenu.forEach((item) => {
    if (
      item.id && 
      !target.closest("#" + item.id) && 
      !item.classList.contains("hidden")
    ) {
      item.classList.add("hidden");
    }
  });
});

</script>