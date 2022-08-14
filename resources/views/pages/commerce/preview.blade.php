@extends('layouts.app')

@section('content')

@if (isset($product))


<section class="text-gray-600 body-font overflow-hidden">


    @if ($message = Session::get('success'))

    <div class="flex items-center justify-between p-4 text-green-700 border rounded border-green-900/10 bg-green-50" role="alert">
        <strong class="text-sm font-medium"> {{ $message }} </strong>

        <button class="close" data-dismiss="alert" class="opacity-90" type="button">
            <span class="sr-only"> Close </span>

            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>


    @endif

    <!-- to load styles -->

    <!-- bg -->
    <span class="bg-purple-400 bg-indigo-400 bg-red-400 bg-blue-400 bg-yellow-400 bg-orange-400 bg-green-400"></span>
    <div class="bg-pink-400  inline"></div>
    <!-- text -->
    <span class="text-red-400 text-blue-400 text-yellow-400 text-orange-400 text-green-400 text-pink-400 text-purple-400 text-indigo-400"></span>

    <!-- end load -->


    <div class="container px-5 pb-24 pt-12 mx-auto">
        <div class="lg:w-4/5 mx-auto flex flex-wrap">
            <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-80 max-h-80 sm:h-80 sm:max-h-80 object-contain object-center rounded " src="{{ asset('images/products/' . $product[0]->image_path) }}">
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-xs uppercase title-font text-gray-500 tracking-widest">{{ $product[0]->category }}</h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product[0]->name }}</h1>
                <div class="flex mb-4">
                    <a href="#productReviews" class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++) @if (round(number_format($avarageRate / 100,1))>= $i)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-{{$product[0]->color}}-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endif

                            @endfor
                            <span class="text-gray-600 ml-3">{{number_format($reviews->total())}} Reviews</span>
                    </a>
                    <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200 space-x-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fparse.com" target="_blank" rel="noopener" class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fbaryga.lt%2F{{$product[0]->id}}%2F{{ $product[0]->urltag }}" target="_blank" rel="noopener" class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                            </svg>
                        </a>
                        <button onclick="copysharelink()">
                            <i id="sharelinklogo" class="fa-solid fa-share-nodes text-gray-500"></i>
                            <i id="sharelinklogoactive" class="fa-solid fa-check text-gray-500 hidden"></i>

                        </button>
                    </span>
                </div>

                <script>
                    function copysharelink() {

                        navigator.clipboard.writeText('{{ route("products.show", ["id" => $product[0]->id, "slug" => $product[0]->urltag ]) }}');

                        document.getElementById('sharelinklogo').classList.toggle('hidden');
                        document.getElementById('sharelinklogoactive').classList.toggle('hidden');
                        setTimeout(() => {
                            document.getElementById('sharelinklogo').classList.toggle('hidden');
                            document.getElementById('sharelinklogoactive').classList.toggle('hidden');
                        }, 700);
                    }
                </script>

                <p class="leading-relaxed">{!! $product[0]->description !!}.</p>
                <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                    <div class="flex">
                        <span class="mr-3">Color</span>
                        <button class="border-2 border-gray-300 rounded-full w-6 h-6 focus:outline-none">
                            <div class="block flex justify-center mx-auto w-3 h-3 rounded-full bg-{{$product[0]->color}}-400"></div>
                        </button>
                        <!-- <button class="border-2 border-gray-300 ml-1 bg-gray-700 rounded-full w-6 h-6 focus:outline-none"></button>
                        <button class="border-2 border-gray-300 ml-1 bg-blue-500 rounded-full w-6 h-6 focus:outline-none"></button> -->
                    </div>
                    <div class="flex ml-6 items-center">
                        <!-- <span class="mr-3">Size</span>
                        <div class="relative">
                            <select class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-500 text-base pl-3 pr-10">
                                <option>SM</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                            </select>
                            <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6"></path>
                                </svg>
                            </span>
                        </div> -->
                    </div>
                </div>
                <div class="flex-col">
                    <form action="{{ route('cart.store', ['id' => $product[0]->id]) }}" method="post">
                        <div class="custom-number-input my-4 px-4 w-full">
                            <label>Choose quantity</label>
                            <div class="flex flex-row h-10 w-full my-4 rounded-lg relative bg-transparent mt-1">
                                <button type="button" data-action="decrement" class=" bg-gray-100 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                    <span class="m-auto text-2xl font-thin">−</span>
                                </button>
                                <input type="number" class="outline-none border-transparent focus:outline-none text-center w-full bg-gray-50 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="choosedQty" value="1"></input>
                                <button type="button" data-action="increment" class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                            </div>

                            <style>
                                input[type='number']::-webkit-inner-spin-button,
                                input[type='number']::-webkit-outer-spin-button {
                                    -webkit-appearance: none;
                                    margin: 0;
                                }

                                .custom-number-input input:focus {
                                    outline: none !important;
                                }

                                .custom-number-input button:focus {
                                    outline: none !important;
                                }
                            </style>

                            <script>
                                function decrement(e) {
                                    const btn = e.target.parentNode.parentElement.querySelector(
                                        'button[data-action="decrement"]'
                                    );
                                    const target = btn.nextElementSibling;
                                    let value = Number(target.value);
                                    if (value <= 1) {

                                    } else {
                                        value--;
                                        target.value = value;
                                    }

                                }

                                function increment(e) {
                                    const btn = e.target.parentNode.parentElement.querySelector(
                                        'button[data-action="decrement"]'
                                    );
                                    const target = btn.nextElementSibling;
                                    let value = Number(target.value);
                                    value++;
                                    target.value = value;
                                }

                                const decrementButtons = document.querySelectorAll(
                                    `button[data-action="decrement"]`
                                );

                                const incrementButtons = document.querySelectorAll(
                                    `button[data-action="increment"]`
                                );

                                decrementButtons.forEach(btn => {
                                    btn.addEventListener("click", decrement);
                                });

                                incrementButtons.forEach(btn => {
                                    btn.addEventListener("click", increment);
                                });
                            </script>
                        </div>
                        <div class="flex pt-2 mx-4">
                            <span class="title-font font-medium text-2xl text-gray-900"> €{{number_format($product[0]->price / 100,2)}}</span>
                            <div class="inline flex ml-auto">

                                @csrf

                                @if ($product[0]->quantity <= 0) <button disabled type="button" class=" bg-transparent focus:shadow-outline outline-none text-red-400 font-bold py-2 px-4 rounded">Sold out</button>
                                    @else
                                    <button class="shadow bg-green-400 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Add to cart</button>
                                    @endif
                            </div>
                            <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                                </svg>
                            </button>
                            @auth
                            @if(auth()->user()->admin)
                            <a href="{{ route('products.edit', ['id' => $product[0]->id]) }}" class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            @endif
                            @endauth

                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>

@endif














<section id="productReviews">

    <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8 md:w-4/5">

        <h2 class="text-xl font-bold sm:text-2xl">Customer Reviews</h2>

        <!-- <form action="{{ route('reviews.store', ['id' => $product[0]->id]) }}" method="post">
            
        </form> -->


        <div class="flex items-center mt-4">
            <p class="text-3xl font-medium">
                {{number_format($avarageRate / 100,1)}}
                <span class="sr-only"> Average review score </span>
            </p>



            <div class="ml-4">
                <div class="flex -ml-1">
                    @for ($i = 1; $i <= 5; $i++) @if (round(number_format($avarageRate / 100,1))>= $i)
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-{{$product[0]->color}}-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        @endif

                        @endfor

                </div>

                <p class="mt-0.5 text-xs text-gray-500">Based on {{number_format($reviews->total())}} reviews</p>

            </div>
        </div>

        <div class="grid grid-cols-1 mt-8 lg:grid-cols-2 gap-x-16 gap-y-12 mb-12">



            @foreach ($reviews as $review)


            <blockquote>
                <header class="sm:items-center sm:flex">
                    <div class="flex -ml-1">
                        @for ($i = 1; $i <= 5; $i++) @if ($review->rating >= $i)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-{{$product[0]->color}}-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endif

                            @endfor


                    </div>

                    <p class="mt-2 font-medium sm:ml-4 sm:mt-0">{{ $review->heading }}</p>
                </header>

                <p class="mt-2 text-gray-700">{{ $review->description }}</p>

                <footer class="mt-4">

                    <p class="text-xs text-gray-500">{{$review->name}} - {{ date("d M Y", strtotime($review->created_at)) }}</p>

                </footer>

            </blockquote>

            @endforeach


        </div>

        {{ $reviews->links() }}

        @auth

        <!-- submit review -->
        <form action="{{ route('reviews.store', ['id'=>$product[0]->id]) }}" method="post" class="w-full max-w-lg my-12 mx-auto">
            @csrf
            <p class="text-gray-600 font-bold mb-2 text-center uppercase tracking-wide text-xs">Choose a rating</p>
            <div class="flex flex-wrap -mx-3 mx-auto mb-6">

                <div class="mx-auto">
                    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
                    <span class="star-rating mx-2 mb-6">
                        <input type="radio" name="rating" value="1" required><i></i>
                        <input type="radio" name="rating" value="2" required><i></i>
                        <input type="radio" name="rating" value="3" required><i></i>
                        <input type="radio" name="rating" value="4" required><i></i>
                        <input type="radio" name="rating" value="5" required><i></i>
                    </span>

                    <style type='text/css'>
                        .star-rating {
                            font-size: 0;
                            white-space: nowrap;
                            display: inline-block;
                            width: 125px;
                            height: 25px;
                            overflow: hidden;
                            position: relative;
                            /* background: url('https://thumbs.dreamstime.com/b/beautiful-golden-star-isolated-png-high-quality-illustration-beautiful-shining-gold-star-isolated-transparent-background-105019481.jpg'); */
                            background: url('/images/commerce/reviews/stars/yellow.png');
                            background-size: contain;

                        }

                        .star-rating i {
                            opacity: 0;
                            position: absolute;
                            left: 0;
                            top: 0;
                            height: 100%;
                            width: 20%;
                            z-index: 1;
                            /* background: url('https://png.pngtree.com/png-vector/20190223/ourmid/pngtree-star-vector-icon-png-image_696411.jpg'); */
                            background: url('/images/commerce/reviews/stars/yellow-filled.png');
                            /* background: url('images/commerce/reviews/stars/red.png'); */
                            background-size: contain;
                        }

                        .star-rating input {
                            -moz-appearance: none;
                            -webkit-appearance: none;
                            opacity: 0;
                            display: inline-block;
                            width: 20%;
                            height: 100%;
                            margin: 0;
                            padding: 0;
                            z-index: 2;
                            position: relative;
                        }

                        .star-rating input:hover+i,
                        .star-rating input:checked+i {
                            opacity: 1;
                        }

                        .star-rating i~i {
                            width: 40%;
                        }

                        .star-rating i~i~i {
                            width: 60%;
                        }

                        .star-rating i~i~i~i {
                            width: 80%;
                        }

                        .star-rating i~i~i~i~i {
                            width: 100%;
                        }
                    </style>
                    <script type='text/javascript'>
                        //<![CDATA[
                        $(window).load(function() {
                            $(':radio').change(
                                function() {
                                    // console.log(this.value);
                                    $('.choice').text(this.value + ' stars');
                                }
                            )
                        }); //]]>
                    </script>
                </div>
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        title
                    </label>
                    <input name="heading" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="nick" type="text">

                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        message
                    </label>
                    <textarea class=" no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-24 resize-none" name="description"></textarea>
                    <p class="text-gray-600 text-xs italic">Describe your opinion (optional)</p>
                </div>
            </div>
            <div class="flex md:items-center justify-center ">
                <div class="md:w-1/3">
                    <button type="submit" class="shadow bg-green-400 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded ">
                        Submit for review
                    </button>
                </div>
                <div class="md:w-2/3"></div>
            </div>
        </form>
        @endauth
        @guest
        <div class="flex-col md:items-center justify-center mt-20">
            <div class=" flex justify-center">
                <a href="{{ route('register') }}" class="shadow bg-green-400 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                    Sign in to leave a review
                </a>
            </div>
            <div class="flex justify-center my-2">
                <p class="text-gray-400 text-xs ">In order to leave a review you need to sign in first</p>
            </div>
        </div>
        @endguest
    </div>
</section>



@endsection