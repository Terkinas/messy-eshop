@extends('layouts.app')

@section('content')


<main class=" bg-neutral-50 relative overflow-hidden ">
    <div class=" h-fit bg-white  sm:block max-h-72 sm:max-h-96  sm:w-4/5 md:w-full mx-auto md:rounded-md  sm:my-0 pb-8 relative overflow-hidden">
        <img src="{{ asset('images/commerce/welcome/disposable-vape-header-11.jpg') }}" class="animate-[fadeIn_1s_ease-in] h-full sm:h-96 w-full md:w-3/4 m-auto object-contain" />
    </div>
    <div class="  flex relative items-center overflow-hidden mb-8">


        <!-- svg -->

        <!-- <div class="absolute z-index-100 w-32 sm:w-64 left-2/3 sm:left-96 opacity-25">

        </div> -->


        <div class=" bg-white sm:flex-row relative  pb-8 sm:pt-8 mx-auto w-full">









            <div class="py-4 px-3 bg-white  w-full md:rounded-xl ">


                <div class=" sm:w-full md:4/5 lg:w-3/5 flex flex-col relative sm:mt-16 md:mx-auto md:text-center">
                    <span class="w-20 h-2 bg-green-400 mb-12 rounded-md animate-[fadeRL_2s_ease-in-out]">
                    </span>
                    <h1 class=" mb-8  font-bebas-neue uppercase text-4xl sm:text-5xl font-black flex flex-col leading-none text-gray-800 md:text-7xl">
                        Gaudyk
                        <span class="py-2 text-5xl sm:text-6xl">
                            Pilką debesį
                        </span>
                    </h1>
                    <!-- <p class="text-sm sm:text-base text-gray-700 mt-2 my-6 md:w-4/5 md:mx-auto">
                        Subscribe to our journal so you won't miss an opportunity to find out about deals first. Products are carefully sorted, products quantity is limited.
                    </p> -->
                    <!-- <div class="flex mt-8">
                    <a href="#" class=" py-2 px-4 rounded bg-green-500 border-2 border-transparent text-white text-md mr-4 hover:bg-green-400 font-semibold">
                        Pradėti
                    </a>
                    <a href="#" class=" py-2 px-4 rounded bg-transparent border-2 border-green-500 text-green-500 hover:border-green-400 hover:text-green-500 text-md font-semibold">
                        Skaityti daugiau
                    </a>
                </div> -->

                    <!-- catalog of 6 -->


                    @if(count($products) > 0)

                    <h2 class="mx-4 max-w-lg mb-3 font-sans text-xs font-bold tracking-tight sm:text-sm sm:leading-none
            md:w-4/5 md:text-center md:mx-auto text-center uppercase text-blue-500 scale-75">
                        Hurry up to buy <br class="hidden md:block" />

                    </h2>

                    <h2 class="mx-4 max-w-lg mb-6 font-sans text-xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-none
            md:w-4/5 md:text-center md:mx-auto text-center uppercase">
                        Best sellers <br class="hidden md:block" />

                    </h2>

                    <div class="grid gap-4 mx-0 grid-cols-2 align-around sm:grid-cols-2 sm:max-w-sm sm:mx-auto sm:max-w-full pb-8
            md:w-4/5 ">


                        @foreach ($topSellers as $key=>$product)
                        @if ($key > 1)
                        <div class="col-span-2 h-80 hidden md:hidden">
                            @else
                            <div class="">
                                <p></p>
                                @endif


                                <a href="{{ route('products.show', ['id' => $product->id ,'slug' => $product->urltag]) }}" class=" flex flex-col">

                                    <div class="bg-white rounded-sm shadow-sm hover:-translate-y-1 transition duration-500">

                                        @if ($key == 6)
                                        <img src="{{ asset('images/products/' . $product->image_path) }}" class="object-contain w-full h-80 max-h-80 sm:max-h-min sm:h-64  scale-95 hover:scale-100 transition duration-500" alt="" />
                                        @else
                                        <img src="{{ asset('images/products/' . $product->image_path) }}" class="object-contain w-full h-40 max-h-40 sm:max-h-min sm:h-64  scale-95 hover:scale-100 transition duration-500" alt="" />
                                        @endif

                                    </div>

                                    <div class="mt-2 flex justify-between">
                                        <h5 class="font-semibold text-gray-500 text-sm">
                                            {{Str::limit($product->name , 42)}}
                                        </h5>

                                        <p class=" text-xs text-gray-700">
                                            €{{number_format($product->price / 100,2)}}
                                        </p>
                                    </div>
                                </a>
                            </div>

                            @endforeach

                        </div>
                        @else

                        <h2 class=" text-2xl font-extrabold tracking-tight text-gray-700 sm:text-xl scale-90"> Unfortunately, no results found</h2>

                        @endif




                        <!-- end -->



                        <div class="text-center w-full md:justify-start justify-center items-end md:items-center md:flex flex-col justify-center">
                            <div class="relative mx-auto sm:w-full lg:w-full xl:w-1/2 w-3/4 mt-8">

                                <a href="{{route('products.index')}}" class="  block text-center rounded border-1 border-transparent bg-green-400 text-base p-2 py-4 hover:bg-green-500 md:mx-auto md:w-80 text-white w-full  font-semibold
                                    md:py-4 md:text-base ">
                                    <i class="fa-solid fa-store mr-1"></i>
                                    <!-- <span class="font-bold ">Išpūsti katalogą</span> -->
                                    <span class="font-bold ">More Products</span>
                                </a>
                            </div>
                            <p class="text-xs mx-auto mt-2 text-gray-400 mb-8 w-full  text-center">Products are designed by <span class="text-green-500">{{ config('app.name') }} Inc.</span></p>
                            <!-- <a class="text-center text-gray-900  border-1 border-grey-100 py-3 px-6 font-semibold focus:outline-none hover:bg-gray-50 bg-gray-100 rounded text-sm w-24 sm:w-52 whitespace-nowrap">Sign Up</a> -->
                        </div>

                        <!-- <div class="md:mx-auto flex flex-nowrap lg:flex-row md:flex-col justify-center sm:justify-start scale-90 my-3 sm:scale-100">
                            <button class="bg-gray-100 md:bg-white inline-flex pt-3 px-5 rounded-lg items-center hover:bg-gray-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 512 512">
                                    <path d="M99.617 8.057a50.191 50.191 0 00-38.815-6.713l230.932 230.933 74.846-74.846L99.617 8.057zM32.139 20.116c-6.441 8.563-10.148 19.077-10.148 30.199v411.358c0 11.123 3.708 21.636 10.148 30.199l235.877-235.877L32.139 20.116zM464.261 212.087l-67.266-37.637-81.544 81.544 81.548 81.548 67.273-37.64c16.117-9.03 25.738-25.442 25.738-43.908s-9.621-34.877-25.749-43.907zM291.733 279.711L60.815 510.629c3.786.891 7.639 1.371 11.492 1.371a50.275 50.275 0 0027.31-8.07l266.965-149.372-74.849-74.847z"></path>
                                </svg>
                                <span class="ml-4 flex items-start flex-col leading-none">
                                    <span class="text-xs text-gray-600 mb-1">GET IT ON</span>
                                    <span class="title-font text-sm font-medium whitespace-nowrap">Google Play</span>
                                </span>
                            </button>
                            <button class="bg-gray-100 md:bg-white inline-flex py-3 px-4 rounded-lg items-center lg:ml-4 md:ml-0 ml-4 md:mt-4 mt-0 lg:mt-0 hover:bg-gray-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 305 305">
                                    <path d="M40.74 112.12c-25.79 44.74-9.4 112.65 19.12 153.82C74.09 286.52 88.5 305 108.24 305c.37 0 .74 0 1.13-.02 9.27-.37 15.97-3.23 22.45-5.99 7.27-3.1 14.8-6.3 26.6-6.3 11.22 0 18.39 3.1 25.31 6.1 6.83 2.95 13.87 6 24.26 5.81 22.23-.41 35.88-20.35 47.92-37.94a168.18 168.18 0 0021-43l.09-.28a2.5 2.5 0 00-1.33-3.06l-.18-.08c-3.92-1.6-38.26-16.84-38.62-58.36-.34-33.74 25.76-51.6 31-54.84l.24-.15a2.5 2.5 0 00.7-3.51c-18-26.37-45.62-30.34-56.73-30.82a50.04 50.04 0 00-4.95-.24c-13.06 0-25.56 4.93-35.61 8.9-6.94 2.73-12.93 5.09-17.06 5.09-4.64 0-10.67-2.4-17.65-5.16-9.33-3.7-19.9-7.9-31.1-7.9l-.79.01c-26.03.38-50.62 15.27-64.18 38.86z"></path>
                                    <path d="M212.1 0c-15.76.64-34.67 10.35-45.97 23.58-9.6 11.13-19 29.68-16.52 48.38a2.5 2.5 0 002.29 2.17c1.06.08 2.15.12 3.23.12 15.41 0 32.04-8.52 43.4-22.25 11.94-14.5 17.99-33.1 16.16-49.77A2.52 2.52 0 00212.1 0z"></path>
                                </svg>
                                <span class="ml-4 flex items-start flex-col leading-none">
                                    <span class="text-xs text-gray-600 mb-1 whitespace-nowrap">Download on the</span>
                                    <span class="title-font font-medium text-sm whitespace-nowrap">App Store</span>
                                </span>
                            </button>

                        </div>
                        <p class="text-xs text-gray-400 mb-8 w-full text-center ">We will be launching our app soon.</p> -->
                    </div>

                </div>

            </div>
        </div>


        <!-- catalog of 6 -->


        @if(count($products) > 0)

        <h2 class="mx-4 max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-none
                md:w-4/5 md:text-center md:mx-auto py-4">
            Naujienos <br class="hidden md:block" />

        </h2>

        <div class="grid gap-4 mx-4 grid-cols-2 align-around sm:grid-cols-3 sm:max-w-sm sm:mx-auto sm:max-w-full pb-8
                md:w-3/5">


            @foreach ($products as $key=>$product)

            @if ($key == 6)
            <div class="col-span-2 h-80 md:hidden">
                @else
                <div class="">
                    <p></p>
                    @endif

                    @if ($product->quantity <= 0) <a href="{{ route('products.show', ['id' => $product->id ,'slug' => $product->urltag]) }}" class=" flex flex-col opacity-75"> @else <a href="{{ route('products.show', ['id' => $product->id ,'slug' => $product->urltag]) }}" class=" flex flex-col">
                            @endif


                            <!-- <div class="bg-{{$product->color}}-100 bg-opacity-50 rounded-sm shadow-sm hover:-translate-y-1 transition duration-500"> -->
                            <div class="bg-white rounded-sm shadow-sm hover:-translate-y-1 transition duration-500">
                                @if ($key == 6)
                                <img src="{{ asset('images/products/' . $product->image_path) }}" class="object-contain w-full h-80 max-h-80 sm:max-h-min sm:h-64 scale-95 hover:scale-100 transition duration-500" alt="" />
                                @else
                                <img src="{{ asset('images/products/' . $product->image_path) }}" class="object-contain w-full h-40 max-h-40 sm:max-h-min sm:h-64 scale-95 md:p-3 hover:scale-100 transition duration-500" alt="" />
                                @endif

                            </div>

                            <div class="mt-2 flex justify-between">
                                <h5 class="font-semibold text-gray-500 text-sm ">
                                    {{Str::limit($product->name , 42)}}
                                </h5>

                                <p class=" text-xs text-gray-700 ">
                                    €{{number_format($product->price / 100,2)}}
                                </p>
                            </div>
                            @if ($product->quantity <= 0) <div class="text-red-500 font-semibold uppercase text-xs"> sold out
                </div> @endif
                </a>
            </div>

            @endforeach

        </div>
        @else

        <h2 class=" text-2xl font-extrabold tracking-tight text-gray-700 sm:text-xl scale-90"> Unfortunately, no results found</h2>


    </div>
    @endif





    <!-- end -->






    <!-- photos feautures -->


    <div class="bg-white sm:w-4/5 mx-auto rounded mt-24 mb-8 py-12">
        <div class="py-12 max-w-2xl mx-auto  px-4 grid items-center grid-cols-1  gap-x-8 sm:px-6 sm:py-32 lg:max-w-7xl lg:px-8 lg:grid-cols-2">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:tracking-tight sm:text-4xl">Hitting the ground!</h2>
                <p class="mt-4 text-gray-500 mb-8 text-sm sm:text-base">Follow our blog magazine, don't miss an opportunity to win <i>prizes</i>, soon we will provide <span class="text-blue-400">more information</span> on that. Stay tuned!</p>



            </div>
            <div class="grid grid-cols-2 grid-rows-1 gap-4 sm:gap-6 lg:gap-8">
                <img src="{{ asset('images/commerce/welcome/localshop.png') }}" alt="Walnut card tray with white powder coated steel divider and 3 punchout holes." class="bg-gray-100 rounded-lg shadow-sm">
                <img src="{{ asset('images/commerce/welcome/tshirtbaryga.png') }}" alt="Top down view of walnut card tray with embedded magnets and card groove." class="bg-gray-100 rounded-lg shadow-sm">
            </div>
        </div>
    </div>








    <!-- next section -->

    <!-- 

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <section class="bg-gray-50">
        <div class="max-w-screen-xl px-4 py-12 mx-auto sm:px-6 lg:px-8 scale-90">
            <h2 class="text-2xl font-bold">
                Featured
            </h2>

            <div class="mt-4">
                <div class="swiper">
                    <ul class="swiper-wrapper">
                        @for ($i = 0; $i < 6; $i++) <li class="swiper-slide">
                            <div class="group relative mb-6  transition duration-500">
                                <div class=" relative w-full h-80 bg-gradient-to-t from-red-50 to-neutral-200 rounded-sm overflow-hidden group-hover:to-gray-50 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1 duration-300">
                                    <img src="{{ asset('images/commerce/welcome/pngwing.com.png') }}" alt="Collection of four insulated travel bottles on wooden shelf." class="w-full h-full object-center object-contain ">
                                </div>
                                <h3 class="mt-6 text-base text-gray-500">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        Išmanusis Apple Watch Series 4 laikrodis
                                    </a>
                                </h3>
                                <p class="text-sm font-semibold pt-1 text-red-400">249.99$</p>
                            </div>
                            </li>
                            @endfor




                    </ul>

                    <div class="max-w-sm sm:max-w-lg mx-auto mt-8 swiper-pagination "></div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .swiper-pagination {
            bottom: 0;
            position: relative;
        }
    </style>

    <script>
        new Swiper('.swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 32,
            autoplay: true,
            pagination: {
                type: 'progressbar',
                el: '.swiper-pagination',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        })
    </script>

 -->



    <!-- heading -->

    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
            <div>
                <p class="inline-block py-px mb-4 text-xs font-semibold tracking-wider text-green-400 uppercase rounded-full bg-teal-accent-400">
                    {{ config('app.name') }}
                </p>
            </div>
            <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                <span class="relative inline-block">
                    <svg viewBox="0 0 52 24" fill="currentColor" class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
                        <defs>
                            <pattern id="679d5905-e08c-4b91-a66c-84aefbb9d2f5" x="0" y="0" width=".135" height=".30">
                                <circle cx="1" cy="1" r=".7"></circle>
                            </pattern>
                        </defs>
                        <rect fill="url(#679d5905-e08c-4b91-a66c-84aefbb9d2f5)" width="52" height="24"></rect>
                    </svg>
                    <span class="relative">Our</span>
                </span>
                products are carefully picked to satisfy our customer
            </h2>
            <p class="text-base text-gray-700 md:text-lg">
                These short videos are made by unprofessionals, as it is only been made to determine quality of item.
            </p>
        </div>
        <div class="mx-auto lg:max-w-2xl">
            <div class="relative w-full transition-shadow duration-300 hover:shadow-xl bg-green-100 overflow-hidden rounded-lg">
                <img class="object-cover object-top w-full h-56 rounded shadow-lg sm:h-64 md:h-80 lg:h-96" src="{{ asset('images/commerce/welcome/disposable-vapes-video-thumbnail.png') }}" alt="" />

                <a target="_blank" href="https://www.youtube.com/watch?v=F8i2BMsFBik&ab_channel=UnCommonLee" aria-label="Play Video" class="absolute inset-0 flex items-center justify-center w-full h-full transition-colors duration-300 bg-gray-900 bg-opacity-50 group hover:bg-opacity-25">
                    <div class="flex items-center justify-center w-16 h-16 transition duration-300 transform bg-gray-100 rounded-full shadow-2xl group-hover:scale-110">
                        <svg class="w-10 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16.53,11.152l-8-5C8.221,5.958,7.833,5.949,7.515,6.125C7.197,6.302,7,6.636,7,7v10 c0,0.364,0.197,0.698,0.515,0.875C7.667,17.958,7.833,18,8,18c0.184,0,0.368-0.051,0.53-0.152l8-5C16.822,12.665,17,12.345,17,12 S16.822,11.335,16.53,11.152z"></path>
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>






    <!-- analizes -->
    <div class="px-4 py-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-8">
        <div class="md:w-4/5 md:mx-auto grid gap-5 row-gap-8 lg:grid-cols-2">
            <div class="flex flex-col justify-center">
                <div class="max-w-xl mb-6">
                    <div>
                        <p class=" inline-block px-1 py-px mb-4 text-xs font-semibold tracking-wider text-pink-400 uppercase rounded-full bg-teal-accent-400">
                            E-shop
                        </p>
                    </div>
                    <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-none">
                        Choose a product <br class="hidden md:block" />
                        from
                        <span class="inline-block text-deep-purple-accent-400">our asortiment</span>
                    </h2>
                    <p class="text-base text-gray-700 md:text-lg">
                        Our team carefully and thoroughly sort out our asortiment, witch would satisfy your expectation.
                    </p>
                </div>
                <a href="{{ route('products.index') }}" aria-label="" class="hover:text-blue-500 inline-flex items-center font-semibold transition-colors duration-200 text-blue-600 hover:text-deep-purple-800">
                    See the catalog
                    <svg class="inline-block w-3 ml-2" fill="currentColor" viewBox="0 0 12 12">
                        <path d="M9.707,5.293l-5-5A1,1,0,0,0,3.293,1.707L7.586,6,3.293,10.293a1,1,0,1,0,1.414,1.414l5-5A1,1,0,0,0,9.707,5.293Z"></path>
                    </svg>
                </a>
            </div>

            <!-- animate-[float_5s_ease-in-out_infinite] -->
            <div class="relative ">
                <svg class="animate-[float_5s_ease-in-out_infinite]" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 1062.23004 595" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path class="animate-[float_5s_ease-in-out_infinite]" d="M702.77148,153.76558q-.83989-.51-1.67993-.99H642.65161c-.42.66-.82007,1.33-1.21,2h63.01C703.8916,154.43556,703.33154,154.10555,702.77148,153.76558Zm-386.5,197.47v14.9c.25.02.51.02.76.03l-.5,28.64-.26-.13995v2.81994l.21009.11005-.21009,12.01v41.4h2v-106.52Q317.43159,347.72561,316.27148,351.23555Zm386.5-197.47q-.83989-.51-1.67993-.99H642.65161c-.42.66-.82007,1.33-1.21,2h63.01C703.8916,154.43556,703.33154,154.10555,702.77148,153.76558Zm176.5-.99h-556a7.00779,7.00779,0,0,0-7,7v581a7.01519,7.01519,0,0,0,7,7h556a7.00762,7.00762,0,0,0,7-7v-581A7.00763,7.00763,0,0,0,879.27148,152.77559Zm5,588a5.00181,5.00181,0,0,1-5,5h-556a5.00189,5.00189,0,0,1-5-5v-581a5.00832,5.00832,0,0,1,5-5h556a5.00824,5.00824,0,0,1,5,5Z" transform="translate(-47.49128 -152.77559)" fill="#3f3d56" />
                    <path d="M396.54035,586.78942c-25.90558-.62006-53.67749,13.89532-61.04907,38.73767l140.62439-5.72473q-3.98924-2.75748-8.01441-5.446C446.525,600.00554,422.44587,587.40953,396.54035,586.78942Z" transform="translate(-47.49128 -152.77559)" fill="#f2f2f2" />
                    <path d="M476.11567,619.80236c18.70032,12.92633,36.95013,26.72174,57.78656,35.69531,51.59418,22.21991,110.98785,11.85718,165.27521-2.58484,54.28735-14.442,109.70312-32.79193,165.38324-25.34839,31.57342,4.22089,61.38159,16.57367,91.85791,25.84131s63.26745,15.47345,94.0158,7.15277c30.74842-8.32068,58.483-34.70563,59.28693-66.5498C877.58887,551.08928,662.37614,549.81493,476.11567,619.80236Z" transform="translate(-47.49128 -152.77559)" fill="#f2f2f2" />
                    <path d="M108.54035,632.78942c-25.90558-.62006-53.67749,13.89532-61.04907,38.73767l140.62439-5.72473q-3.98924-2.75748-8.01441-5.446C158.525,646.00554,134.44587,633.40953,108.54035,632.78942Z" transform="translate(-47.49128 -152.77559)" fill="#f2f2f2" />
                    <path d="M188.11567,665.80236c18.70032,12.92633,36.95013,26.72174,57.78656,35.69531,51.59418,22.21991,110.98785,11.85718,165.27521-2.58484,54.28735-14.442,109.70312-32.79193,165.38324-25.34839,31.57342,4.22089,61.38159,16.57367,91.85791,25.84131s63.26745,15.47345,94.0158,7.15277c30.74842-8.32068,58.483-34.70563,59.28693-66.5498C589.58887,597.08928,374.37614,595.81493,188.11567,665.80236Z" transform="translate(-47.49128 -152.77559)" fill="#f2f2f2" />
                    <path d="M499.82792,451.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,499.82792,451.644Z" transform="translate(-47.49128 -152.77559)" fill="#e6e6e6" />
                    <rect x="309.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="326.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="343.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="360.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="377.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="394.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="411.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="428.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="445.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <path d="M649.87736,327.77105l-17.84607-38.39618a16.302,16.302,0,0,0-14.78314-9.43085h-21.028a18,18,0,1,0-31.14453,0H544.04771a16.302,16.302,0,0,0-14.78314,9.43085L511.4185,327.77105a16.30193,16.30193,0,0,0,14.78314,23.173h49.44629v186h10v-186h49.44629A16.30193,16.30193,0,0,0,649.87736,327.77105Z" transform="translate(-47.49128 -152.77559)" fill="#e6e6e6" />
                    <path d="M856.82792,451.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,856.82792,451.644Z" transform="translate(-47.49128 -152.77559)" fill="#e6e6e6" />
                    <rect x="666.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="683.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="700.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="717.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="734.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="751.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="768.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="785.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="802.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <path d="M694.82792,451.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,694.82792,451.644Z" transform="translate(-47.49128 -152.77559)" fill="#e6e6e6" />
                    <rect x="504.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="521.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="538.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="555.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="572.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="589.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="606.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="623.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="640.65665" y="298.86845" width="4" height="68.59998" fill="#ccc" />
                    <path d="M867.82792,382.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,867.82792,382.644Z" transform="translate(-47.49128 -152.77559)" fill="#e6e6e6" />
                    <rect x="677.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="694.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="711.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="728.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="745.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="762.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="779.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="796.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <rect x="813.65665" y="229.86845" width="4" height="68.59998" fill="#ccc" />
                    <path d="M824.82792,456.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,824.82792,456.644Z" transform="translate(-47.49128 -152.77559)" fill="#3b82f6" />
                    <rect x="634.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="651.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="668.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="685.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="702.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="719.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="736.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="753.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="770.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <path d="M641.82792,456.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,641.82792,456.644Z" transform="translate(-47.49128 -152.77559)" fill="#3b82f6" />
                    <rect x="451.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="468.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="485.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="502.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="519.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="536.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="553.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="570.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="587.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <path d="M696.82792,387.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,696.82792,387.644Z" transform="translate(-47.49128 -152.77559)" fill="#3b82f6" />
                    <rect x="506.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="523.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="540.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="557.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="574.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="591.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="608.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="625.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="642.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <path d="M446.82792,456.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,446.82792,456.644Z" transform="translate(-47.49128 -152.77559)" fill="#3b82f6" />
                    <rect x="256.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="273.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="290.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="307.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="324.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="341.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="358.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="375.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="392.65665" y="303.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <path d="M482.82792,387.644h-145.36a7.825,7.825,0,0,0-7.82,7.81994v52.96a7.825,7.825,0,0,0,7.82,7.82h145.36a7.825,7.825,0,0,0,7.82-7.82v-52.96A7.825,7.825,0,0,0,482.82792,387.644Z" transform="translate(-47.49128 -152.77559)" fill="#3b82f6" />
                    <rect x="292.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="309.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="326.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="343.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="360.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="377.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="394.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="411.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <rect x="428.65665" y="234.86845" width="4" height="68.59998" fill="#3f3d56" />
                    <path d="M952.80442,529.29406a16.67245,16.67245,0,0,0-.92706-2.523l-17.84607-38.39618a16.302,16.302,0,0,0-14.78314-9.43085H846.04771a16.302,16.302,0,0,0-14.78314,9.43085l-14.673,31.56915H398.23948l-14.20819-30.56915a16.302,16.302,0,0,0-14.78314-9.43085H296.04771a16.27567,16.27567,0,0,0-8.01544,2.11487l-12.30756-21.97784a7.51762,7.51762,0,0,0-14.07678,3.67315V636.36132a19.58267,19.58267,0,0,0,19.5827,19.5827H841.4083a19.58274,19.58274,0,0,0,14.00061-5.89093l94.69855-96.83465A19.40952,19.40952,0,0,0,952.80442,529.29406Z" transform="translate(-47.49128 -152.77559)" fill="#3f3d56" />
                    <path d="M854.24656,517.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V499.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,854.24656,517.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M887.24656,517.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V499.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,887.24656,517.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M920.24656,517.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V499.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,920.24656,517.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M552.24656,318.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V300.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,552.24656,318.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M585.24656,318.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V300.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,585.24656,318.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M618.24656,318.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V300.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,618.24656,318.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M304.24656,518.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V500.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,304.24656,518.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M337.24656,518.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V500.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,337.24656,518.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M370.24656,518.444h-9.19727a7.40984,7.40984,0,0,1-7.40136-7.40136V500.84539a7.40985,7.40985,0,0,1,7.40136-7.40137h9.19727a7.40985,7.40985,0,0,1,7.40137,7.40137v10.19727A7.40985,7.40985,0,0,1,370.24656,518.444Z" transform="translate(-47.49128 -152.77559)" fill="#fff" />
                    <path d="M247.17094,623.75884c-25.90558-.62-53.67749,13.89533-61.04907,38.73767l140.62438-5.72473q-3.98922-2.75748-8.0144-5.446C297.15562,636.975,273.07645,624.379,247.17094,623.75884Z" transform="translate(-47.49128 -152.77559)" fill="#3b82f6" />
                    <path d="M326.74625,656.77178c18.70032,12.92633,36.95014,26.72174,57.78656,35.69531C436.127,714.687,495.52067,704.32427,549.808,689.88226s109.70313-32.79194,165.38324-25.34839c31.57343,4.22088,61.38159,16.57367,91.85791,25.84131s63.26746,15.47345,94.01581,7.15277c30.74841-8.32068,58.483-34.70563,59.28693-66.54981C728.21946,588.05871,513.00672,586.78436,326.74625,656.77178Z" transform="translate(-47.49128 -152.77559)" fill="#3b82f6" />
                    <circle cx="767.07627" cy="60.12699" r="26.70075" fill="#fd6584" />
                    <path d="M874.32572,200.25933a13.23512,13.23512,0,0,0-11.17-9.29,1.08068,1.08068,0,0,0-.18,0,1.418,1.418,0,0,0-.22-.05c-8.94-1.16-18.88,1.66-25.57,7.8l-.07337.06734a13.543,13.543,0,0,1-12.82582,3.10644,11.89088,11.89088,0,0,0-3.76078-.41383,13.18351,13.18351,0,0,0-11.8,9.51,1.52647,1.52647,0,0,0,.69,1.69,6.673,6.673,0,0,0,2.79,1.42c2.21.47,4.44.9,6.67,1.29q6.54,1.14,13.15,1.85,4.365.465,8.75.74c6.04.38,12.11.47,18.16.28,3-.1,5.88-.2,8.62-1.52a12.79756,12.79756,0,0,0,4.95-4.31A14.54776,14.54776,0,0,0,874.32572,200.25933Z" transform="translate(-47.49128 -152.77559)" fill="#e6e6e6" />
                    <path d="M819.39572,239.15935a13.65229,13.65229,0,0,0-.56-3.3,13.26028,13.26028,0,0,0-11.18-9.29.9647.9647,0,0,0-.17,0,1.88685,1.88685,0,0,0-.23-.05,33.19372,33.19372,0,0,0-14.69,1.51,30.31757,30.31757,0,0,0-10.947,6.351,13.53612,13.53612,0,0,1-12.82651,3.11253,11.92644,11.92644,0,0,0-3.76652-.41357,13.18343,13.18343,0,0,0-11.8,9.51,1.5553,1.5553,0,0,0,.69,1.69,6.733,6.733,0,0,0,2.79,1.42c2.22.47,4.44.9,6.68,1.29q6.54,1.14,13.14,1.85a195.16559,195.16559,0,0,0,26.92,1.02c2.99-.1,5.88-.2,8.62-1.52a12.7697,12.7697,0,0,0,4.94-4.31A14.26445,14.26445,0,0,0,819.39572,239.15935Z" transform="translate(-47.49128 -152.77559)" fill="#e6e6e6" />
                    <path d="M829.30809,304.405a5.60972,5.60972,0,0,0,.62525,4.0841,3.40813,3.40813,0,0,0,3.96161,1.31053c2.797-.86838,5.55644-1.8854,8.32953-2.82773a1.53546,1.53546,0,0,0,1.04766-1.84518,1.51454,1.51454,0,0,0-1.84518-1.04766l-6.9298,2.35485c-.52273.17763-1.04358.37962-1.57624.52547-.05569.01525-.2592.06-.24824.059.02556-.00237.18358.0145.0082.00235q-.15-.04512.00207.01968l-.13254-.07544c.121.10071-.01458-.01348-.05627-.05577-.03674-.03728-.14476-.18594-.06133-.06376a1.85479,1.85479,0,0,1-.15708-.2756c.07319.16206-.06425-.23882-.07395-.29431a6.42383,6.42383,0,0,1,.10631-1.87054,1.50734,1.50734,0,0,0-1.5-1.5,1.53858,1.53858,0,0,0-1.5,1.5Z" transform="translate(-47.49128 -152.77559)" fill="#3f3d56" />
                    <path d="M717.62654,309.67211l7.39319,9.32218c.94082,1.1863,2.95772-.09794,2.50707-1.45942-.92158-2.78427,2.25946-4.33569,4.45518-4.79414,2.91329-.60828,5.83651-.50961,8.60082-1.76169,1.756-.79538.23267-3.38163-1.51416-2.59041-3.23363,1.46465-7.00412.79322-10.27849,2.2179-2.92668,1.27341-5.24081,4.449-4.15618,7.72586L727.141,316.873l-7.39319-9.32219a1.51045,1.51045,0,0,0-2.12132,0,1.5349,1.5349,0,0,0,0,2.12133Z" transform="translate(-47.49128 -152.77559)" fill="#3f3d56" />
                    <path d="M702.62654,200.67211l7.39319,9.32218c.94082,1.1863,2.95772-.09794,2.50707-1.45942-.92158-2.78427,2.25946-4.33569,4.45518-4.79414,2.91329-.60828,5.83651-.50961,8.60082-1.76169,1.756-.79538.23267-3.38163-1.51416-2.59041-3.23363,1.46465-7.00412.79322-10.27849,2.2179-2.92668,1.27341-5.24081,4.449-4.15618,7.72586L712.141,207.873l-7.39319-9.32219a1.51045,1.51045,0,0,0-2.12132,0,1.5349,1.5349,0,0,0,0,2.12133Z" transform="translate(-47.49128 -152.77559)" fill="#3f3d56" />
                </svg>
            </div>
        </div>
    </div>












    <!-- <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
            <div class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
                <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map" marginheight="0" marginwidth="0" scrolling="no" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=%C4%B0zmir+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>

            </div>
            <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md flex-col">
                    <div class="lg:w-1/1 lg:mt-4 px-6">
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">ADDRESS</h2>
                        <p class="mt-1">Pramonės pr. 222, LT-51332</p>
                    </div>
                    <div class="lg:w-1/2 px-6 mt-4 lg:mt-4 flex-col">
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                        <a class="text-indigo-500 leading-relaxed">tigi@alba.com</a>
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">PHONE</h2>
                        <p class="leading-relaxed">+370 (6) 00 38 333</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


</main>












<!--  MAIN SECTION  -->
<section class="">











    <!-- SECTION-FEATURES //start -->
    <section class="bg-gray-50 py-12">
        <div class="container max-w-screen-xl mx-auto px-4 md:w-4/5">
            <h2 class="text-3xl font-bold mb-8">Why to choose us</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                {{-- <div>
					<figure class="flex mb-4">
						<div class="flex-shrink-0 mr-3">
							<span class="block w-16 h-16 rounded-lg bg-gray-400 text-blue-600 flex items-center justify-center">
								<i class="fa fa-money-bill text-xl"></i> 
							</span>
						</div>
						<figcaption>
							<h5 class="font-semibold">Reasonable prices</h5>
							<p class="text-gray-500"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
							</p>
						</figcaption>
					</figure>
				</div> --}}
                <div>
                    <figure class="flex mb-4">
                        <div class="flex-shrink-0 mr-3">
                            <span class="block w-16 h-16 rounded-lg bg-gray-100 text-red-500 flex items-center justify-center">
                                <i class="fa fa-star text-xl"></i>
                            </span>
                        </div>
                        <figcaption>
                            <h5 class="font-semibold">High quality</h5>
                            <p class="text-gray-500"> Mūsų asortimentas pripildytas daugeliu aukštos kokybės prekių
                            </p>
                        </figcaption>
                    </figure>
                </div>
                <div>
                    <figure class="flex mb-4">
                        <div class="flex-shrink-0 mr-3">
                            <span class="block w-16 h-16 rounded-lg bg-gray-100 text-gray-800 flex items-center justify-center">
                                <i class="fa-solid fa-truck text-xl "></i>
                            </span>
                        </div>
                        <figcaption>
                            <h5 class="font-semibold">Trackable shipping</h5>
                            <p class="text-gray-500"> Your parcel won't get lost as it's being tracked
                            </p>
                        </figcaption>
                    </figure>
                </div>
                <div>
                    <figure class="flex mb-4">
                        <div class="flex-shrink-0 mr-3">
                            <span class="block w-16 h-16 rounded-lg bg-gray-100 text-green-400 flex items-center justify-center">
                                <i class="fa fa-users text-xl"></i>
                            </span>
                        </div>
                        <figcaption>
                            <h5 class="font-semibold">Happy customers</h5>
                            <p class="text-gray-500"> We're receiving a feedback from our customers
                            </p>
                        </figcaption>
                    </figure>
                </div>
                {{-- <div>
					<figure class="flex mb-4">
						<div class="flex-shrink-0 mr-3">
							<span class="block w-16 h-16 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
								<i class="fa fa-thumbs-up text-xl"></i> 
							</span>
						</div>
						<figcaption>
							<h5 class="font-semibold">Happy customers</h5>
							<p class="text-gray-500"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
							</p>
						</figcaption>
					</figure>
				</div> --}}
                <!-- <div>
                    <figure class="flex mb-4">
                        <div class="flex-shrink-0 mr-3">
                            <span class="block w-16 h-16 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                <i class="fa fa-box text-xl"></i>
                            </span>
                        </div>
                        <figcaption>
                            <h5 class="font-semibold">Prekių įvairovė</h5>
                            <p class="text-gray-500"> Rinkitės iš plataus prekių asortimento
                            </p>
                        </figcaption>
                    </figure>
                </div> -->
            </div> <!-- grid .// -->
        </div> <!-- container .// -->
    </section>
    <!-- SECTION-FEATURES //END -->















    @endsection