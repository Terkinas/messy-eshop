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


<nav class="flex bg-white px-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Shop
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Products</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">All</span>
            </div>
        </li>
    </ol>
</nav>




<div class="w-full flex justify-center bg-white">
    <form action="{{ route('products.search') }}" method="GET" class="scale-90 p-3 pt-8 sm:p-0 sm:pt-0 sm:mt-8 sm:ml-8 w-full sm:w-1/3">
        @csrf
        <div class="flex ">

            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-0 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-gray-700 border border-gray-700 rounded-l  focus:ring-4 focus:outline-none focus:ring-gray-100  " type="button">All <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-gray-700 rounded border border-gray-700 hover:border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none "><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg></button>
            </div>
        </div>
    </form>
</div>


<div class="bg-white px-4 py-8 mb-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">

    <div>

        <h2 class=" text-xl font-extrabold tracking-tight text-gray-700 sm:text-xl mb-8 scale-90">Choose a product from our catalog</h2>

    </div>

    @if (isset($results))
    <p class="mb-6 text-gray-500 font-semibold scale-90">{{$results}} </p>
    @endif

    @if(count($products) > 0)


    <div class="grid gap-8 grid-cols-2 sm:grid-cols-3 sm:max-w-sm sm:mx-auto sm:max-w-full pb-8">


        @foreach ($products as $product)<div class="">
            @if($product->active == null)
            <h5 class="font-semibold text-green-500 text-sm opacity-75">
                Active
            </h5>
            @else
            <h5 class="font-semibold text-red-500 text-sm opacity-75">
                Inactive
            </h5>
            @endif
            <a href="{{ route('products.show', ['id' => $product->id ,'slug' => $product->urltag]) }}" class=" flex flex-col ">

                <div class="bg-gradient-to-t from-neutral-100 to-blue-50 rounded-sm shadow-sm hover:-translate-y-1 transition duration-500">
                    <img src="{{ asset('images/products/' . $product->image_path) }}" class="object-contain w-full h-40 max-h-40 sm:max-h-min sm:h-64 p-3 scale-95 hover:scale-100 transition duration-500" alt="" />
                </div>




                <div class="mt-2">
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
    {{ $products->links() }}
</div>




@endsection