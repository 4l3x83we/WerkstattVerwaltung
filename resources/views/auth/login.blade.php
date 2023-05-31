<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
        Melden Sie sich bei Ihrem Konto an
    </h2>

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="remember_me" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" name="remember">
            </div>
            <div class="ml-3 text-sm">
                <label for="remember_me" class="font-medium text-gray-900 dark:text-white">{{ __('Remember me') }}</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">{{ __('Forgot your password?') }}</a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Login') }}
            </x-primary-button>
        </div>
        @if(Route::has('register'))
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                {{  __('Not registered?') }} <a href="{{ route('register') }}" class="text-primary-700 hover:underline dark:text-primary-500">{{  __('Create account') }}</a>
            </div>
        @endif
    </form>
</x-guest-layout>
