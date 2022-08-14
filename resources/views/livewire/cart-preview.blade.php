<!-- This example requires Tailwind CSS v2.0+ -->
<div class="shoppingCart z-101 fixed hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <!--
    Background backdrop, show/hide based on slide-over state.

    Entering: "ease-in-out duration-500"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in-out duration-500"
      From: "opacity-100"
      To: "opacity-0"
  -->

    <script>
        var opened = sessionStorage.getItem('opened');
        if (opened == 'true') {
            document.querySelector('.shoppingCart').classList.remove('hidden');
        }
    </script>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <!--
          Slide-over panel, show/hide based on slide-over state.

          Entering: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-full"
            To: "translate-x-0"
          Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-0"
            To: "translate-x-full"
        -->
                <div class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                        <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping cart</h2>
                                <div class="ml-3 flex h-7 items-center">
                                    <button id="closeCartButton" type="button" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Close panel</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-8">
                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-gray-200">

                                        @if(isset($cart) && count($cart) > 0)

                                        @foreach ($cart as $item) <li class="flex py-6">

                                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border bg-gray-50 border-gray-200">
                                                <img src="{{ asset('images/products/' . $item['item']->image_path) }}" alt="{{ $item['item']['name'] }}" class="h-full w-full object-contain p-2 object-center">
                                            </div>

                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                                        <h3>
                                                            <a href="#">
                                                                {{Str::limit($item['item']['name'] , 42)}} </a>
                                                        </h3>
                                                        <p class="ml-4">€{{ number_format($item['item']['price'] / 100,2) }}</p>
                                                    </div>
                                                    <p class="mt-1 text-sm text-gray-500">{{ $item['item']['color'] }}</p>

                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-sm">
                                                    <div class="flex flex-1 items-end justify-between">
                                                        <!-- component -->
                                                        <div class="custom-number-input h-10 w-32 scale-90 origin-left">
                                                            <form action="{{ route('cart.update', ['id' => $item['item']->id]) }}" method="post">
                                                                @csrf
                                                                <div class="flex flex-row h-8 w-full rounded-lg relative bg-transparent mt-1">
                                                                    <button data-action="decrement" class=" bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                                                        <span class="m-auto text-2xl font-thin">−</span>
                                                                    </button>
                                                                    <input type="number" class="outline-none border-transparent focus:outline-none text-center w-full bg-gray-50 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="choosedQty" value="{{ $item['qty'] }}"></input>
                                                                    <button data-action="increment" class="bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                                                        <span class="m-auto text-2xl font-thin">+</span>
                                                                    </button>
                                                                    <!-- <p class="text-gray-400"> {{ $item['qty'] }} Qty.</p> -->
                                                                </div>
                                                            </form>




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


                                                        </div>


                                                        <div class="flex">
                                                            <form action="{{ route('cart.remove', ['id' => $item['item']->id]) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="font-medium text-red-600 hover:text-red-500">Remove</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                        </li>
                                        @endforeach

                                        @else

                                        <p class="mt-6 text-gray-400">Shopping cart is empty</p>

                                        @endif


                                        <script>
                                            function decrement(e) {
                                                const btn = e.target.parentNode.parentElement.querySelector(
                                                    'button[data-action="decrement"]'
                                                );
                                                const target = btn.nextElementSibling;
                                                let value = Number(target.value);
                                                value--;
                                                target.value = value;
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









                                        <!-- More products... -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Total:</p>
                                <p class="semibold">€{{number_format($totalPrice / 100,2)}}</p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Shipping and VAT calculated in the checkout.</p>
                            <div class="mt-6">
                                <a id="proceedToCheckout" href="{{ route('cart.checkout') }}" class="shadow bg-green-400 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded flex items-center justify-center px-6 py-3">Proceed to checkout</a>
                            </div>
                            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                <p>
                                    or <a href="{{ route('products.index') }}" class="font-medium text-green-400 hover:text-red-500">Continue shopping<span aria-hidden="true"> &rarr;</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    proceedToCheckout.addEventListener('click', () => {
        document.querySelector('.shoppingCart').classList.toggle('hidden');
        sessionStorage.removeItem('opened');
    });
    closeCartButton.addEventListener('click', () => {
        document.querySelector('.shoppingCart').classList.toggle('hidden');
        sessionStorage.removeItem('opened');
    })

    openCartButton.addEventListener('click', () => {
        document.querySelector('.shoppingCart').classList.toggle('hidden');
        sessionStorage.setItem('opened', 'true');
    })

    openCartButtonMobile.addEventListener('click', () => {
        document.querySelector('.shoppingCart').classList.toggle('hidden');

        if (opened == 'true') {
            sessionStorage.removeItem('opened');
        } else {
            sessionStorage.setItem('opened', 'true');
        }
    })
</script>