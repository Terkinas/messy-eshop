@extends('layouts.app')

@section('content')

<section class="bg-gray-50 py-16">
    <div class="container flex flex-col justify-center px-4 py-8 mx-auto md:p-8">
        <h2 class="text-2xl font-semibold sm:text-4xl">Frequently asked questions</h2>
        <p class="mt-4 mb-8 dark:text-gray-400">Most frequently asked questions will be added here.</p>
        <div class="space-y-4">
            <details class="w-full border rounded-lg  cursor-pointer">
                <summary class="px-4 py-6 focus:outline-none focus-visible:ring-violet-400">How we deliver our products?</summary>
                <p class="px-4 py-4 pt-1 ml-4 -mt-4 dark:text-gray-400 text-gray-600">If shipping address is inaccurate or carrier can't reach out to customer on phone, it's being dropped to local post. </p>
            </details>
            <details class="w-full border rounded-lg  cursor-pointer">
                <summary class="px-4 py-6 focus:outline-none focus-visible:ring-violet-400">What to do, if product description doesn't specify, what I'm wondering of?</summary>
                <p class="px-4 py-4 pt-1 ml-4 -mt-4 dark:text-gray-400 text-gray-600">Contact us via email help@pixartey.com and we will kindly answer your unclarity in 1 business day. </p>
            </details>
        </div>
    </div>
</section>

@endsection