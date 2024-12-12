<x-guest-layout>
    <form method="POST" action="{{ route('customer.register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')"  style="color:#fff !important" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')"  style="color:#fff !important" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"  style="color:#fff !important" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

          <!-- Mobile Number -->
          <div class="mt-4">
            <x-input-label for="mobile_no" :value="__('Mobile Number')"  style="color:#fff !important" />

            <x-text-input id="mobile_no" class="block mt-1 w-full"
                            type="text"
                            name="mobile_no"
                             />

            <x-input-error :messages="$errors->get('mobile_no')" class="mt-2" />
        </div>

      
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ url('customer-login') }}"  style="color:#fff !important">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4"  style="background-color:#000 !important; color:#fff">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
