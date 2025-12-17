<x-guest-layout>

    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-700 via-blue-600 to-blue-500 p-6">

        <!-- CARD LOGIN -->
        <div class="w-full max-w-md bg-white/90 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-white/30">

            <!-- TITLE -->
            <div class="text-center mb-6">

                <h1 class="text-3xl font-bold text-gray-800">
                    Login Admin <span class="text-blue-600">Desa Mojomanis</span>
                </h1>

                <p class="mt-1 text-gray-500 text-sm">
                    Silakan masuk untuk mengelola website desa
                </p>
            </div>

            <!-- STATUS -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700"/>
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700"/>
                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <label for="remember_me" class="flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <!-- BUTTON + FORGOT -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800"
                           href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif

                    <x-primary-button
                        class="ml-3 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl shadow-md transition">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- FOOTER -->
            <p class="text-center text-xs text-gray-500 mt-6">
                © {{ date('Y') }} Pemerintah Desa Mojomanis
            </p>

        </div>

        <!-- 🔙 TOMBOL KEMBALI -->
        <div class="mt-6 text-center">
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md text-white border border-white/40
                      rounded-xl hover:bg-white/30 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Beranda
            </a>
        </div>

        <!-- 🔐 TOMBOL FORGOT PASSWORD (BESAR) -->
        @if (Route::has('password.request'))
        <div class="mt-2 text-center">
            <a href="{{ route('password.request') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-white/90 hover:text-white transition">
                <i class="fas fa-unlock-alt"></i>
                Lupa Password?
            </a>
        </div>
        @endif

    </div>

</x-guest-layout>
