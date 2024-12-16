<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Sign In</h1>
                <br>
                <span for="email" :value="__('Use your email password')"></span>
                <input
                    type="email"
                    placeholder="Email"
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <input
                    id=""
                    type="password"
                    placeholder="Password"
                    name="password"
                    required autocomplete="current-password">
                <a href="#">Forget Your Password?</a>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <button>Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of the site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Login SSO</h1>
                    <p>Login directly without email and password using Single Sign On</p>
                    <button class="hidden" id="register">SSO Login</button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>