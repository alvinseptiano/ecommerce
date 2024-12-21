<x-app-layout>
    <form method="POST" action="{{ route('login') }}" class="w-[400px] mx-auto p-6 my-16">
        <h2 class="text-2xl font-semibold text-center mb-8">
            Login to your account
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        @csrf
        <div class="gap-4 flex flex-col w-full max-w-md mx-auto">
            <div class="flex flex-col justify-start items-center w-full">
                <div class="mb-4 grow w-full">
                    <x-input type="email" name="email" class="w-full" placeholder="Your email address"
                        :value="old('email')" />
                </div>
                <div class="mb-4 w-full">
                    <x-input type="password" name="password" class="w-full" placeholder="Your password"
                        :value="old('password')" />
                </div>
            </div>
            <div class="flex justify-start items-center w-full">
                <label for="loginRememberMe">Remember Me</label>
                <input id="loginRememberMe" type="checkbox" class="ml-3 rounded border-gray-300 text-purple-500">
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-purple-700 hover:text-purple-600 w-full text-left">
                    Forgot Password?
                </a>
            @endif

            <p class="text-gray-500 mb-6 w-full">
                or
                <a href="{{ route('register') }}" class="text-sm text-purple-700 hover:text-purple-600">
                    create new account
                </a>
            </p>
            <button class="btn-primary bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 w-full">
                Login
            </button>
        </div>

    </form>
</x-app-layout>