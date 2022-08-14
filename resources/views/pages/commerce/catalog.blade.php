@extends('layouts.app')

@section('content')




<div class="row">
    <div class="col-lg-12 text-center">
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
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br>
        @endif
    </div>
</div>

<div class="h-fit sm:block max-h-32  sm:w-full mx-auto bg-black my-1 relative overflow-hidden ">

    <img src="{{ asset('images/commerce/catalog/heets-slate-header.jpg') }}" class="h-full  opacity-50 w-full m-auto object-contain bg-gray-50" />
    <div class="">
        <h4 class="text-2xl font-bold text-white absolute w-full text-center h-full flex justify-center top-1/3 uppercase">Disposable vapes</h4>
        <h4 class="text-xs font-bold text-white absolute w-full text-center h-full flex justify-center top-2/3 uppercase">Categories <span><i class="fa-solid fa-caret-down text-white mx-1"></i></span></h4>
    </div>
</div>

<nav class="flex bg-gray-50 px-3  md:w-full md:mx-auto pt-8" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3 mx-3 md:px-8">
        <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">

                Home
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <h5 class="text-gray-500 px-2">/</h5>
                <a href="#" class="ml-1 text-sm font-semibold text-gray-500 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Products</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <h5 class="text-gray-500 px-2">/</h5>
                <span class="ml-1 text-sm font-semibold text-gray-300 md:ml-2 dark:text-gray-400">All</span>
            </div>
        </li>
    </ol>
</nav>




<div class="w-full flex justify-center bg-gray-50 ">
    <form action="{{ route('products.search') }}" method="GET" class="scale-90 md:scale-100 p-0 pt-8 sm:p-0 sm:pt-0 sm:mt-8 sm:ml-8 w-full sm:w-1/3">
        @csrf
        <div class="flex ">

            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-0 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-green-400 border border-green-400 rounded-l  focus:ring-4 focus:outline-none focus:ring-gray-100  " type="button">All <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg></button>
            <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(338px, 690px);">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200 disabled" aria-labelledby="dropdown-button">
                    <li>
                        <button type="button" class="inline-flex py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Clothes</button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Travel</button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sport</button>
                    </li>
                    <li>
                        <button type="button" class="inline-flex py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Events</button>
                    </li>
                </ul>
            </div>
            <div class="relative w-full">
                <input value="{{ old('keyword') }}" name="keyword" type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded border-l-gray-50 border-l-1 border border-gray-300 " placeholder="Find what you love" required="">
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-green-400 rounded border border-green-400 hover:border-green-500 hover:bg-green-500 shadow bg-green-400 hover:bg-green-500  text-white font-bold  rounded "><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg></button>
            </div>
        </div>
    </form>
</div>

<!-- SECTION-CONTENT -->
<section class="py-4 bg-gray-50">
    <div class="container max-w-screen-xl mx-auto px-3 bg-gray-50">

        <div class="flex flex-col md:flex-row  w-full md:mx-auto">
            <!-- <aside class="md:w-2/3 lg:w-1/4 px-4 mx-auto mt-24 ml-4">
           

                <a class=" scale-90 sm:p-0 sm:pt-0 sm:mt-8 sm:ml-8 w-full sm:w-1/3 md:hidden mb-5  w-full text-center px-4 py-2 inline-block text-lg text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:text-blue-600" href="#">
                    Filter by
                </a>

                <div class="hidden md:block px-6 py-4 border border-gray-200 bg-white rounded shadow-sm">
                    <h3 class="font-semibold mb-2">Category</h3>

                    <ul class="text-gray-500 space-y-1">
                        <li><a class="hover:text-blue-600 hover:underline" href="#">Disposable vapes </a></li>
                        <li><a class="hover:text-blue-600 hover:underline" href="#">Liquids </a></li>
                        <li><a class="hover:text-blue-600 hover:underline" href="#">Coils </a></li>
                        <li><a class="hover:text-blue-600 hover:underline" href="#">Accessories </a></li>
                    </ul>

                    <hr class="my-4">

                    <h3 class="font-semibold mb-2">Filter by</h3>
                    <ul class="space-y-1">
                        <li>
                            <label class="flex items-center">
                                <input name="" type="checkbox" checked="" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Samsung </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center">
                                <input name="" type="checkbox" checked="" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Huawei </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center">
                                <input name="" type="checkbox" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Tesla model </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center">
                                <input name="" type="checkbox" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Best brand </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center">
                                <input name="" type="checkbox" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Other brands </span>
                            </label>
                        </li>
                    </ul>

                    <hr class="my-4">

                    <h3 class="font-semibold mb-2">Sort by</h3>
                    <ul class="space-y-1">
                        <li>
                            <label class="flex items-center">
                                <input name="myselection" type="radio" checked="" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Lightblue </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center">
                                <input name="myselection" type="radio" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Orange </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center">
                                <input name="myselection" type="radio" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Silver </span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center">
                                <input name="myselection" type="radio" class="h-4 w-4">
                                <span class="ml-2 text-gray-500"> Darkblue </span>
                            </label>
                        </li>
                    </ul>

                </div>
                
            </aside>  -->
            <main class="w-full md:w-2/3 lg:w-3/4 px-1 md:px-0 md:w-3/4 md:mx-auto">
                <div>
                    <h2 class=" text-xl font-extrabold tracking-tight text-gray-700 sm:text-xl my-4 scale-95 -mx-1">Choose a product from our catalog</h2>
                </div>


                <!-- <div class="mx-2 md:w-3/5 md:max-auto">
                    <label for="default" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Default select</label>
                    <select id="default" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a country</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </div> -->


                <div class="  md:px-2 pt-8 mb-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-1">


                    @if (isset($results))
                    <p class="mb-6 text-gray-500 font-semibold text-sm px-2">{{$results}} </p>
                    @endif

                    @if(count($products) > 0)
                    <div class="w-full mx-auto my-2 md:px-0 flex justify-between">
                        <h5 class="text-gray-400 mx-2">Disposable vapes</h5>
                        <i class="fa-solid fa-sort mx-2"></i>
                    </div>

                    <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 sm:max-w-sm sm:mx-auto sm:max-w-full pb-8">


                        @foreach ($products as $product)<div class="">
                            @if ($product->quantity <= 0) <a href="{{ route('products.show', ['id' => $product->id ,'slug' => $product->urltag]) }}" class=" flex flex-col overflow-hidden opacity-50 ">
                                @else
                                <a href="{{ route('products.show', ['id' => $product->id ,'slug' => $product->urltag]) }}" class=" flex flex-col overflow-hidden ">
                                    @endif


                                    <!-- <div class="bg-{{$product->color}}-100 bg-opacity-50 rounded-sm shadow-sm hover:-translate-y-1 transition duration-500"> -->
                                    <div class="bg-white rounded-sm shadow-sm hover:-translate-y-1 transition duration-500">
                                        <img src="{{ asset('images/products/' . $product->image_path) }}" class="object-contain w-full h-40 max-h-40 sm:max-h-min sm:h-64  scale-95 hover:scale-100 transition duration-500" alt="" />
                                    </div>

                                    <div class="mt-2 flex justify-between">
                                        <h5 class="font-semibold text-gray-500 text-sm">
                                            {{Str::limit($product->name , 42)}}
                                        </h5>

                                        <p class=" text-xs text-gray-700">
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

                <h2 class=" text-2xl font-extrabold tracking-tight text-gray-700 sm:text-xl mx-2"> Unfortunately, no results found</h2>

                @endif
                @if (route('products.search'))
                {{ $products->appends(array_filter(request()->except('page')))->render() }}
                @else
                {{ $products->links() }}

                @endif
        </div>
        </main> <!-- col.// -->
    </div> <!-- grid.// -->

    </div> <!-- container .// -->
</section>




<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white pt-16 md:w-4/5 mx-auto">
    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl px-4 lg:px-10">Populiariausios prekės</h2>
    <div class="max-w-2xl mx-auto pb-12 pt-8 sm:pt-3  px-4 grid items-center grid-cols-1 gap-y-16 gap-x-8 sm:px-6 sm:py-32 sm:pb-12 lg:max-w-7xl lg:px-8 lg:grid-cols-2 lg:mt-8">
        <div class="grid sm:hidden grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8">

            @foreach ($productsPopular as $popular)
            <img src="{{ asset('images/products/' . $popular->image_path) }}" alt="product image" class="scale-75 rounded-lg">
            @endforeach



        </div>
        <div>
            <h2 class=" text-xl font-extrabold tracking-tight text-gray-700 sm:text-xl"> Vienkartinės elektroninės cigaretės (spalvotos)</h2>
            <p class="mt-4 text-gray-500">The walnut wood card tray is precision milled to perfectly fit a stack of Focus cards. The powder coated steel divider separates active cards from new ones, or can be used to archive important task lists.</p>

            <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
                <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Origin</dt>
                    <dd class="mt-2 text-sm text-gray-500">Designed by Baryga Hood, Inc.</dd>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Materials</dt>
                    <dd class="mt-2 text-sm text-gray-500">Solid battery base with rare earth magnets and flavoured cotton</dd>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Size</dt>
                    <dd class="mt-2 text-sm text-gray-500">6.25&quot; x 3.55&quot; x 1.15&quot;</dd>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Finish</dt>
                    <dd class="mt-2 text-sm text-gray-500">Hand soaked and finished with natural oil</dd>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Extra</dt>
                    <dd class="mt-2 text-sm text-gray-500">20mg Salt without carbon natural emissions</dd>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <dt class="font-medium text-gray-900">Considerations</dt>
                    <dd class="mt-2 text-sm text-gray-500">Made from natural materials. Grain and color vary with each item.</dd>
                </div>
            </dl>
            <!-- <a href="/" aria-label="" class="pt-8 mt-4 hover:text-gray-700 inline-flex items-center font-semibold transition-colors duration-200 text-gray-700 hover:text-deep-purple-800">
                Peržiurėti prekę
                <svg class="inline-block w-3 ml-2" fill="currentColor" viewBox="0 0 12 12">
                    <path d="M9.707,5.293l-5-5A1,1,0,0,0,3.293,1.707L7.586,6,3.293,10.293a1,1,0,1,0,1.414,1.414l5-5A1,1,0,0,0,9.707,5.293Z"></path>
                </svg>
            </a> -->
        </div>

        <div class="hidden sm:grid grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8">
            @foreach ($productsPopular as $popular)

            <a href="{{ route('products.show', ['id' => $product->id ,'slug' => $product->urltag]) }}" class=" flex flex-col overflow-hidden ">

                <img src="{{ asset('images/products/' . $popular->image_path) }}" alt="product image" class="scale-75 rounded-lg">
            </a>
            @endforeach
        </div>
    </div>

</div>

@endsection