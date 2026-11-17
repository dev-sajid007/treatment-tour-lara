@extends('layouts.web')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-6">
  <div class="w-full max-w-3xl lg:w-3/5 bg-white shadow-lg rounded-lg p-8 px-8 py-10">
    <!-- Top Banner -->
    <div class="mb-6">
      <img 
        src="https://media.licdn.com/dms/image/v2/C4E1BAQHSlAt8zgJvzQ/company-background_10000/company-background_10000/0/1618430953160/a_medical_partner_cover?e=2147483647&v=beta&t=Ea4n22t1eGBuGgqMuaZptX48HoYg1twbqwkL_6mrkr8" 
        alt="Join As A Partner" 
        class="w-full h-48 object-cover shadow-md"
        style="width: full; height: 300px;" 
      />
    </div>

    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800 p-6 md:p-8 lg:p-12">Join As A Partner</h2>
    <div class="p-6 md:p-8 lg:p-12">
      <form action="{{ route('partner.store') }}" id="partnerForm" class="space-y-6" method="post">
        @csrf
        <!-- Name -->
        <div class="p-4">
          <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
          <input
            type="text"
            id="name"
            name="name"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Enter your name"
            required
          />
        </div>

        <!-- Phone -->
        <div class="p-4">
          <label for="phone" class="block text-gray-700 font-medium mb-2">Phone</label>
          <input
            type="text"
            id="phone"
            name="phone"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Enter your phone number"
            required
          />
        </div>

        <!-- Email -->
        <div class="p-4">
          <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Enter your email"
            required
          />

          @error('email')
            <span class="text-red-500">{{ $message }}</span>
          @enderror
        </div>

        <!-- Partner Type -->
        <div class="p-4">
          <label class="block text-gray-700 font-medium mb-2">Partner Type</label>
          <div class="flex flex-wrap items-center space-x-6">
            <label class="flex items-center space-x-6">
              <input
                type="radio"
                name="partnerType"
                value="hospital"
                class="form-radio text-blue-500 focus:ring focus:ring-blue-300"
                onchange="toggleInput('hospital')"
              />
              <span class="mx-2">Hospital</span>
            </label>
            <label class="flex items-center space-x-6">
              <input
                type="radio"
                name="partnerType"
                value="clinic"
                class="form-radio text-blue-500 focus:ring focus:ring-blue-300"
                onchange="toggleInput('clinic')"
              />
              <span class="mx-2">Clinic</span>
            </label>
            <label class="flex items-center space-x-6">
              <input
                type="radio"
                name="partnerType"
                value="doctor"
                class="form-radio text-blue-500 focus:ring focus:ring-blue-300"
                onchange="toggleInput('doctor')"
              />
              <span class="mx-2">Doctor</span>
            </label>
            <label class="flex items-center space-x-6">
              <input
                type="radio"
                name="partnerType"
                value="sexologist"
                class="form-radio text-blue-500 focus:ring focus:ring-blue-300"
                onchange="toggleInput('sexologist')"
              />
              <span class="mx-2">Sexologist</span>
            </label>
            <label class="flex items-center space-x-6">
              <input
                type="radio"
                name="partnerType"
                value="beautician"
                class="form-radio text-blue-500 focus:ring focus:ring-blue-300"
                onchange="toggleInput('beautician')"
              />
              <span class="mx-2">Beautician</span>
            </label>
          </div>
        </div>

        <!-- Dynamic Name Input -->
        <div id="dynamicInput" class="hidden">
          <label for="partnerName" class="block text-gray-700 font-medium mb-2">
            <span id="dynamicLabel">Hospital/Clinic Name</span>
          </label>
          <input
            type="text"
            id="partnerName"
            name="partnerName"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Enter name"
          />
        </div>

        <div class="p-4">
          <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Enter your password"
            required
          />
        </div>

        <!-- Submit Button -->
        <div>
          <button
            type="submit"
            class="w-full bg-blue-500 text-white font-semibold py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 p-4"
          >
            Join
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function toggleInput(type) {
    const dynamicInput = document.getElementById('dynamicInput');
    const dynamicLabel = document.getElementById('dynamicLabel');
    const partnerNameInput = document.getElementById('partnerName');

    if (type === 'hospital' || type === 'clinic') {
      dynamicInput.classList.remove('hidden');
      dynamicLabel.textContent = type === 'hospital' ? 'Hospital Name' : 'Clinic Name';
      partnerNameInput.placeholder = type === 'hospital' ? 'Enter hospital name' : 'Enter clinic name';
    } else {
      dynamicInput.classList.add('hidden');
      partnerNameInput.value = '';
    }
  }
</script>

@endsection
