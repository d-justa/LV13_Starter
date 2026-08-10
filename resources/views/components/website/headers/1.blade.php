<header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-gray-200 bg-white/90 backdrop-blur relative">
    <div class="mx-auto container sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600 text-white font-bold">
                    C
                </div>

                <div>
                    <h1 class="text-lg font-bold text-gray-900">
                        CompanyName
                    </h1>
                    <p class="text-xs text-gray-500">
                        Your Tagline
                    </p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden items-center gap-8 md:flex">
                <a href="/" class="font-medium text-gray-700 hover:text-indigo-600 transition">
                    Home
                </a>

                <a href="/services" class="font-medium text-gray-700 hover:text-indigo-600 transition">
                    Services
                </a>

                <a href="/pricing" class="font-medium text-gray-700 hover:text-indigo-600 transition">
                    Pricing
                </a>

                <a href="/about" class="font-medium text-gray-700 hover:text-indigo-600 transition">
                    About
                </a>

                <a href="/contact" class="font-medium text-gray-700 hover:text-indigo-600 transition">
                    Contact
                </a>
            </nav>

            <!-- Desktop Right -->
            <div class="hidden items-center gap-3 md:flex">

                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 transition">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-lg bg-indigo-600 px-5 py-2 text-white hover:bg-indigo-700 transition">
                            Get Started
                        </a>
                    @endif
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="rounded-lg border border-gray-300 px-5 py-2 text-gray-700 hover:bg-gray-100 transition">
                            Logout
                        </button>
                    </form>
                @endauth

            </div>

            <!-- Mobile Toggle -->
            <button @click="open = !open" class="rounded-lg p-2 hover:bg-gray-100 md:hidden" aria-label="Toggle Menu">

                <!-- Hamburger -->
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <!-- Close -->
                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>

            </button>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" @click.outside="open = false" x-cloak
        class="absolute left-0 top-full w-full bg-white shadow-xl border-t border-gray-200 md:hidden">
        <nav class="p-5 space-y-2">

            <a href="/" class="block rounded-lg px-4 py-3 hover:bg-gray-100">
                Home
            </a>

            <a href="/services" class="block rounded-lg px-4 py-3 hover:bg-gray-100">
                Services
            </a>

            <a href="/pricing" class="block rounded-lg px-4 py-3 hover:bg-gray-100">
                Pricing
            </a>

            <a href="/about" class="block rounded-lg px-4 py-3 hover:bg-gray-100">
                About
            </a>

            <a href="/contact" class="block rounded-lg px-4 py-3 hover:bg-gray-100">
                Contact
            </a>

            <div class="my-4 border-t"></div>

            <a href="/login" class="block rounded-lg border px-4 py-3 text-center hover:bg-gray-50">
                Login
            </a>

            <a href="/register"
                class="mt-3 block rounded-lg bg-indigo-600 px-4 py-3 text-center text-white hover:bg-indigo-700">
                Get Started
            </a>

        </nav>
    </div>
</header>
