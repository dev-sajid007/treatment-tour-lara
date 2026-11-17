    <footer>
      <div class="bg-pink-100 overflow-hidden">
        <div class="container mx-auto px-2">
          <div
            class="w-full mt-8 flex flex-col items-center justify-center pt-10"
          >
            <h1
              class="mb-1 lg:mb-3 text-xl lg:text-2xl xl:text-3xl font-medium text-center"
            >
              <span
                class="px-1 text-pink-700 font-bold"
                >{{$home_setting->footer_title}}</span
              >
            </h1>
            <p
              class="max-w-4xl text-center text-sm text-gray-600 lg:text-lg leading-4 lg:leading-5 font-suse"
            >
              {{$home_setting->footer_des}}
            </p>
          </div>
          <div class="grid grid-cols-1 capitalize my-8 md:grid-cols-4 gap-2">
            <div class="w-full">
              <figure class="w-full">
                <img
                  width="200"
                  height="128"
                  src="{{asset('web/assets/images/logo.webp')}}"
                  class="bg-transparent"
                />
              </figure>
              <p
                class="py-3 px-1 text-justify text-base font-medium text-gray-500"
              >
                {{$home_setting->footer_logo_des}}
              </p>
            </div>
            <!-- company -->
            <div class="w-full md:px-12">
              <h1 class="text-xl font-semibold text-pink-800">Company</h1>
              <ul class="p-2 mt-2 font-medium text-gray-500">
                @foreach($footer_pages as $page)
                <li class="flex gap-3 items-center justify-start my-2">
                  <a
                    class="duration-500 hover:ml-3 hover:text-primary hover:underline text-base"
                    href="{{route('page.view', $page->slug)}}"
                    >{{$page->page_name}}</a
                  >
                </li>
                @endforeach
               
                <li class="flex gap-3 items-center justify-start my-2">
                  <a
                    class="duration-500 hover:ml-3 hover:text-primary hover:underline text-base"
                    href="/doctor/register"
                    >Join as Doctor</a
                  >
                </li>
                <li class="flex gap-3 items-center justify-start my-2">
                  <a
                    class="duration-500 hover:ml-3 hover:text-primary hover:underline text-base"
                    href="/patient/register"
                    >Join as Patient</a
                  >
                </li>
              </ul>
            </div>
            <!-- news -->
            <div class="w-full text-gray-500 md:px-12">
              <h1 class="text-xl font-semibold text-pink-800">latest news</h1>
              @foreach($blogs as $blog)
              <div class="text-gray-500 text-base mt-2">
                <p>
                  <i class="fa-solid fa-calendar-days" aria-hidden="true"></i
                  ><span class="text-sm text-pink-800 px-2">{{ $blog->created_at->format('jS M Y') }}</span>
                </p>
                <a
                  class="font-medium text-base mt-1 leading-6 duration-300 hover:text-primary hover:underline block"
                  href="#"
                  >{{$blog->title}}</a
                >
              </div>
              @endforeach
              
            </div>
            <!-- contact us -->
            <div class="w-full">
              <h1 class="text-xl font-semibold text-pink-800 mb-4">
                Contact Us
              </h1>
              <div class="px-3 f py-1">
                <div class="flex text-gray-500 gap-4">
                  <figure class="text-primary text-2xl">
                    <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                  </figure>
                  <span class="font-medium text-base"
                    > {{$setting->address}}</span
                  >
                </div>
              </div>
              <div class="px-3 text-gray-500 py-1">
                <div class="flex gap-4">
                  <figure class="text-primary text-base">
                    <i
                      class="fa-solid fa-envelope-open-text"
                      aria-hidden="true"
                    ></i>
                  </figure>
                  <span class="font-medium text-base"
                    >{{$setting->business_email}}</span
                  >
                </div>
              </div>
              <div class="px-3 text-gray-500 py-1">
                <div class="flex gap-4">
                  <figure class="text-primary text-base">
                    <i class="fa-solid fa-phone-volume" aria-hidden="true"></i>
                  </figure>
                  <span class="font-medium text-base">{{$setting->phone}}</span>
                </div>
              </div>
              <div class="my-4">
                <form class="relative" action="#">
                  <input
                    placeholder="e.g. example@gmail.com"
                    class="bg-slate-100 w-full shadow-lg border-2 border-pink-600 focus:outline-none rounded-lg py-2 px-4"
                    type="text"
                  /><button
                    type="submit"
                    class="absolute right-0 top-0 bg-pink-700 text-slate-100 text-xl px-3 py-[7px] rounded-md hover:bg-slate-900 duration-500"
                  >
                    <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- copyright -->
      <div class="mx-auto py-5 bg-white px-5">
        <div class="flex flex-col justify-between items-center md:flex-row">
          <div>
            <p class="font-normal text-slate-500 text-base">
              @copyright
              <span class="font-semibold i italic text-pink-700">2025 </span>
              all right reverse by
              <a
                href="#"
                class="font-semibold text-slate-800 hover:text-pink-700 hover:border-b-2 border-pink-700 hover:tracking-wider transition-all duration-500 cursor-pointer"
                >Treatmenttour</a
              >
            </p>
          </div>
          <div>
            <ul class="flex justify-between text-base items-end gap-2">
              <li>
                <a
                  href="#"
                  class="py-2.5 px-4 rounded-md bg-white border hover:bg-pink-700 hover:text-white border-pink-700"
                  ><i class="fa-brands fa-facebook-f"></i
                ></a>
              </li>
              <li>
                <a
                  href="#"
                  class="py-2.5 px-3.5 rounded-md bg-white border hover:bg-pink-700 hover:text-white border-pink-700"
                  ><i class="fa-brands fa-linkedin-in"></i
                ></a>
              </li>
              <li>
                <a
                  href="#"
                  class="py-2.5 px-3.5 rounded-md bg-white border hover:bg-pink-700 hover:text-white border-pink-700"
                >
                  <i class="fa-brands fa-twitter"></i>
                </a>
              </li>
              <li>
                <a
                  href="#"
                  class="py-2.5 px-3.5 rounded-md bg-white border hover:bg-pink-700 hover:text-white border-pink-700"
                >
                  <i class="fa-brands fa-reddit-alien"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>





  </body>
</html>


