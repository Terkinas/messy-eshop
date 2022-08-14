@extends('layouts.app')

@section('content')
<section class="flex items-center h-full p-16 dark:bg-gray-900 dark:text-gray-100">
    <div class="container flex flex-col items-center justify-center px-5 mx-auto my-8">
        <div class="max-w-md text-center">
            <h2 class="mb-8 font-extrabold text-9xl dark:text-gray-600 text-gray-800">
                <span class="sr-only">Error</span>404
            </h2>
            <p class="text-2xl font-semibold md:text-3xl">Sorry, We couldn't find what <br> you are looking for.</p>
            <p class="mt-4 mb-8 dark:text-gray-400">Fortunately, our shop contains other products that might satisfy you.</p>
            <!-- <a rel="noopener noreferrer" href="#" class="shadow bg-green-400 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded flex items-center justify-center px-6 py-3">Grįžti į pradžią</a> -->
            <a rel="noopener noreferrer" href="#" class="shadow bg-green-400 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded flex items-center justify-center px-6 py-3">Back to store</a>
        </div>
    </div>
</section>

@endsection