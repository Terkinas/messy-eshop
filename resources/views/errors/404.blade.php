@extends('layouts.app')

@section('content')
<section class="flex items-center h-full p-16 ">
    <div class="container flex flex-col items-center justify-center px-5 mx-auto my-8">
        <div class="max-w-md text-center">
            <h2 class="mb-8 font-extrabold text-9xl dark:text-gray-600">
                <span class="sr-only">Error</span>404
            </h2>
            <p class="text-2xl font-semibold md:text-3xl">Page Not Found</p>
            <p class="mt-4 mb-8 dark:text-gray-400">We are sorry, the page you requested could not be found. Please go back to the store.</p>
            <a rel="noopener noreferrer" href="{{ route('products.index') }}" class="px-8 py-3 bg-blue-600 font-semibold rounded text-white hover:bg-blue-500 transition duration-200">Back to Store</a>
        </div>
    </div>
</section>

@endsection