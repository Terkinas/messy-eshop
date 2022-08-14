@extends('layouts.app')

@section('content')

<div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8 md:w-4/5">

    <div class="grid grid-cols-1 mt-8 lg:grid-cols-2 gap-x-16 gap-y-12">

        @foreach ($reviews as $review)
        @if ($review->accepted == false)


        <blockquote>
            @foreach ($products as $product)
            @if ($review->product_id == $product->id)
            <div><a class="font-semibold" href="{{ route('products.show', ['id' => $product->id, 'slug' => $product->urltag]) }}"> {{ $product->name }} </a>
                <img alt="product-image" class=" lg:w-1/2 w-full lg:h-auto h-24 max-h-24 sm:h-24 sm:max-h-24 object-contain object-left rounded " src="{{ asset('images/products/' . $product->image_path) }}">
            </div>
            @endif
            @endforeach

            <header class="sm:items-center sm:flex">
                <div class="flex -ml-1">
                    @for ($i = 1; $i <= 5; $i++) @if ($review->rating >= $i)
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
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

            <p class="mt-2 text-gray-700">@if ($review->description != '0')
                {{$review->description}}
                @endif
            </p>

            <footer class="mt-4">
                @foreach ($users as $user)
                @if ($user->id == $review->user_id)
                <p class="text-xs text-gray-500">{{$user->name}} - {{ date("d M Y", strtotime($review->created_at)) }}</p>
                @endif
                @endforeach

            </footer>

            <div class="flex space-x-2 w-full">

                <form action="{{route('reviews.reject', ['id' => $review->id ])}}" method="post" class="w-full">
                    @csrf
                    <!-- <span class="font-bold ">Išpūsti katalogą</span> -->
                    <button type="submit" class="my-2 relative  block text-center rounded border-1 border-transparent bg-red-400 text-base p-2 py-4 hover:bg-red-500  text-white w-full  font-semibold
                                    md:py-4 md:text-base ">Reject</button>
                </form>

                <form action="{{route('reviews.accept', ['id' => $review->id ])}}" method="post" class="w-full">
                    @csrf
                    <!-- <span class="font-bold ">Išpūsti katalogą</span> -->
                    <button type="submit" class="my-2  block text-center rounded border-1 border-transparent bg-green-400 text-base p-2 py-4 hover:bg-green-500  text-white w-full  font-semibold
                                    md:py-4 md:text-base ">Confirm</button>
                </form>


            </div>
        </blockquote>
        @endif
        @endforeach

    </div>
</div>

@endsection