@extends('layouts.web')

@section('content')
<style type="text/css">
  .custom-button {
    display: inline-block;
    width: 100%;
    background-color: #9e1333; /* Tailwind's bg-blue-600 */
    color: white;
    font-weight: 600; /* font-semibold */
    padding: 0.5rem 1rem; /* py-2 px-4 */
    border-radius: 0.375rem; /* rounded-md */
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    border: none;
}

  .custom-button:hover {
      background-color: #9e1333; /* Tailwind's bg-blue-700 */
  }

  .custom-button:focus {
      outline: none;
      box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5); /* Tailwind's focus:ring-2 focus:ring-blue-500 */
  }

  .custom-button:active {
      background-color: #1E40AF; /* Darker blue on active */
  }

</style>


  <div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-3xl font-semibold text-gray-800  space-y-5 p-4">Get a Free Quote</h2>

        <form class="space-y-5 p-6" action="{{route('free-quotes.store')}}" method="POST">
          @csrf
            <div  class="py-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="name" type="text" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div  class="py-2">
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail Address</label>
                <input id="email" name="email" type="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div  class="py-2">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input id="phone" name="phone" type="tel" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div  class="py-2">
                <label for="destination" class="block text-sm font-medium text-gray-700">Choose a Treatment Destination</label>
                <select id="destination" name="destination" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 bg-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select location --</option>
                    @foreach($countries as $country)
                    <option value="{{$country->name}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </div>

            <div  class="py-2">
                <label for="treatment" class="block text-sm font-medium text-gray-700">What Treatment Are You Looking For?</label>
                <select id="treatment" name="treatment" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 bg-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select treatment --</option>
                    @foreach($treatments as $treatment)
                    <option value="{{$treatment->name}}">{{$treatment->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-start py-2">
                <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                <label for="terms" class="ml-2 text-sm text-gray-600">
                    I agree to the <a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
                </label>
            </div>

            <button type="submit" class="custom-button">
                Get a Free Quote
            </button>

        </form>
    </div>
</div>
@endsection