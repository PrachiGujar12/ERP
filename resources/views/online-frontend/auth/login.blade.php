<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('customer.login') }}">
        @csrf
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" style="color:#fff !important" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" style="color:#fff !important" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" style="color:#fff !important" />
        </div>

        <!-- <div class="mt-4">
            <x-input-label for="user_type" :value="__('User Department')" /> 
            <select id="user_type" name="user_type" class="block mt-1 w-full form-control rounded" required>
                <option value="" disabled selected>Select User Type</option>
                <option value="admin">Admin</option>
                <option value="ppc">Production Planning & Control</option>
                <option value="purchase">Purchase</option>
                <option value="production">Production</option>
                <option value="quality">Quality</option>
                <option value="store">Store</option>
            </select>
        </div> -->

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center" style="color:#fff !important">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm " style="color:#fff !important">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('customer.register'))
            <a class="underline text-sm hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('customer.register') }}"  style="color:#fff !important">
                {{ __('Dont have an account? Create Account') }}
            </a>

            @endif

            <x-primary-button class="ms-3" style="background-color:#fff !important; color:#000">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>