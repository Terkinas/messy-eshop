@livewire('age-confirmation')

@livewire('cookies-agreement')


<div class="z-49">
    <div class="w-full bg-gray-100 py-2 text-center">
        <h2 class="text-red-500 font-bold text-xs md:text-base scale-75 whitespace-nowrap tracking-tight">Warning: The products contain Nicotine. Nicotine is an addictive chemical.</h2>
        <h3 class="text-gray-400  text-xs md:text-base scale-75">Free Shipping on any order over 50 EUR</h3>
    </div>








    <nav x-data="{ open: false }" class="bg-white ">
        <!-- Primary Navigation Menu -->
        <div class="md:w-4/5 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('welcome') }}">
                            <x-jet-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>


                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">

                    <!-- Navigation Links -->
                    <div class="hidden space-x-5 sm:-my-px sm:mr-10 sm:flex">
                        <x-jet-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                            {{ __('Home') }}
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')">
                            {{ __('Shop') }}
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('help.faq') }}" :active="request()->routeIs('help.faq')">
                            {{ __('FAQ') }}
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('help.contact') }}" :active="request()->routeIs('help.contact')">
                            {{ __('Contact') }}
                        </x-jet-nav-link>
                    </div>


                    <!-- pc version -->

                    <div class="ml-auto md:ml-0">
                        @auth
                        @if(auth()->user()->admin)
                        <a class="text-blue-500 px-3 py-2 inline-block ml-1 rounded-md hover:text-gray-800" href="{{ route('admin.menu') }}">
                            <i class="fa-solid fa-shield-halved"></i>
                        </a>
                        @endif
                        @endauth
                        <a class="text-gray-700 px-3  py-2 inline-block ml-1 rounded-md hover:text-gray-800" href="{{ route('products.index') }}">
                            <i class="fa fa-search"></i>
                        </a>
                        @if(null !== session()->get('cart') && count(session()->get('cart')->items) > 0)
                        <!-- <button id="openCartButton" class="text-gray-700 px-3 text-lg py-2 inline-block font-semibold rounded-md translate-y-0.5 hover:text-gray-500"> -->
                        <button id="openCartButton" class="text-gray-700 px-3 text-lg py-2 inline-block font-semibold rounded-md hover:text-gray-500">
                            <!-- <i class="fa-solid fa-bag-shopping"></i> -->
                            <!-- <p class="absolute px-1.5 py-1 text-xs scale-50 font-bold text-green-400">{{ count(session()->get('cart')->items) }}</p> -->
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="#4ade80" class="bi bi-bag color-gray-900" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg> -->
                            <!-- <p class="absolute px-1 py-2 text-xs scale-75 translate-x-0.5 origin-left font-bold text-white">{{ count(session()->get('cart')->items) }}</p> -->

                            <p class=" px-1 py-2 translate-x-0.5 origin-left font-bold"><i class="fa-solid fa-bucket text-green-400"></i> <span class="text-gray-300 text-xs">{{ count(session()->get('cart')->items) }} </span></p>




                            <!-- <span class="text-xs absolute text-gray-500 -translate-x-1 p-1 rounded-lg font-bold scale-75">{{ count(session()->get('cart')->items) }}</span></i> -->
                        </button>
                        @else
                        <!-- <button id="openCartButton" class="text-gray-700 px-3 text-lg py-2 inline-block font-semibold rounded-md translate-y-0.5 hover:text-gray-500"> -->
                        <button id="openCartButton" class="text-gray-700 px-3 text-lg py-2 inline-block font-semibold rounded-md hover:text-gray-500">
                            <!-- <i class="fa-solid fa-bag-shopping"></i></i> -->
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-bag color-gray-900" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                            </svg> -->
                            <i class="fa-solid fa-bucket"></i>


                        </button>
                        @endif

                    </div>

                    @if(isset(Auth::user()->name))
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                                @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Orders') }}
                                </x-jet-dropdown-link>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Settings') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    @else
                    <!-- <a href="{{ route('register') }}" class=" text-gray-500 px-3 py-2 inline-block ml-1 rounded-md hover:text-gray-800">
                    <i class="fa fa-user"></i>
                </a> -->
                    @endif

                </div>

                <!-- mobile version -->



                <div class="sm:hidden mt-3 ml-auto md:ml-0 mr-2 flex">
                    <a class="text-gray-500 px-3 border-t-2 border-transparent py-2 inline-block rounded-md hover:text-gray-800" href="{{ route('products.index') }}">
                        <i class="fa fa-search"></i>
                    </a>

                    @if(null !== session()->get('cart') && count(session()->get('cart')->items) > 0)
                    <button id="openCartButtonMobile" class="z-102 text-gray-700 overflow-visible px-3 -mt-3  inline-block text-lg rounded-md hover:text-gray-800">
                        <!-- <p class="absolute px-1.5 py-1 text-xs font-bold scale-50 text-green-400">{{ count(session()->get('cart')->items) }}</p> -->
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#4ade80" class="bi bi-bag color-gray-900" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                        </svg> -->
                        <!-- <i class="fa-solid fa-bucket text-green-400"></i> -->
                        <!-- <i class="fa-solid fa-bag-shopping"></i><span class="text-xs absolute text-gray-500 -translate-x-1 p-1 rounded-lg font-bold scale-75">{{ count(session()->get('cart')->items) }}</span></i> -->

                        <p class=" px-1 py-2 translate-x-0.5 origin-left font-bold flex"><i class="fa-solid fa-bucket text-green-400"></i> <span class="text-gray-300 text-xs ml-1">{{ count(session()->get('cart')->items) }} </span></p>
                    </button>
                    @else
                    <button id="openCartButtonMobile" class="z-102 text-gray-500 overflow-visible px-3 -mt-3  inline-block ml-1 text-lg rounded-md hover:text-gray-300">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bag color-gray-900" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                        </svg> -->
                        <i class="fa-solid fa-bucket"></i>
                    </button>
                    @endif
                    <!-- <button id="openCartButtonMobile" class="text-gray-500 px-3 py-2 inline-block ml-1 rounded-md hover:text-gray-800">
                        <i class="fa fa-shopping-cart"></i>
                    </button> -->

                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                        <svg class="h-6 w-6 scale-75" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                    {{ __('Home') }}
                </x-jet-responsive-nav-link>

                <x-jet-responsive-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')">
                    {{ __('Shop') }}
                </x-jet-responsive-nav-link>

                <x-jet-responsive-nav-link href="{{ route('help.faq') }}" :active="request()->routeIs('help.faq')">
                    {{ __('FAQ') }}
                </x-jet-responsive-nav-link>

                <x-jet-responsive-nav-link href="{{ route('help.contact') }}" :active="request()->routeIs('help.contact')">
                    {{ __('Contact') }}
                </x-jet-responsive-nav-link>
            </div>

            @if(isset(Auth::user()->name))
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Orders') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Settings') }}
                    </x-jet-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log out') }}
                        </x-jet-responsive-nav-link>
                    </form>
                </div>
            </div>
            @else
            <div class="pt-1 pb-1 border-t border-gray-100">
                <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Sign up') }}
                </x-jet-responsive-nav-link>
            </div>
            @endif

        </div>
    </nav>


</div>