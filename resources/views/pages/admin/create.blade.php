@extends('layouts.app')

@section('content')


<div class="flex min-h-screen dark:bg-gray-900">



    <main class="w-full">


        <section class="container max-w-3xl p-6 mx-auto">

            <article class="bg-white rounded shadow-sm border border-gray-200 p-4 lg:p-6 my-5">

                <h2 class="mb-3 text-xl md:text-2xl font-semibold text-black">
                    Ikelti naują produktą
                </h2>

                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-1"> Pavadinimas </label>
                        <input name="name" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Type here" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> URL tagas </label>
                        <input name="urltag" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="hot-shower-head" />
                    </div>



                    <div class="mb-4">
                        <label class="block mb-1"> Subtitle </label>
                        <textarea name="subtitle" rows="4" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Type here"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> Description </label>
                        <textarea name="description" rows="4" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Type here"></textarea>
                    </div>




                    <div class="mb-4">
                        <label class="block mb-1"> Kategorija </label>
                        <!-- <input name="category" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Type here" /> -->
                        <select name="category" class="bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-2/4 sm:w-1/3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected="">Choose category</option>
                            @foreach ($categories as $key=>$category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> Spalva </label>
                        <input name="color" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Type here" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> Dydis </label>
                        <input name="size" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Type here" />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> Gamyklinė kaina </label>
                        <div class="grid grid-cols-3 gap-x-2 md:w-1/2">
                            <div class="col-span-2">
                                <input name="stock_price" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="0.00" />
                            </div>
                            <div>
                                <select disabled class="block appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Select one option">
                                    <option> EUR </option>
                                </select>
                            </div>
                        </div> <!-- flex grid -->
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> Kaina </label>
                        <div class="grid grid-cols-3 gap-x-2 md:w-1/2">
                            <div class="col-span-2">
                                <input name="price" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="0.00" />
                            </div>
                            <div>
                                <select disabled class="block appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Select one option">
                                    <option> EUR </option>
                                </select>
                            </div>
                        </div> <!-- flex grid -->
                    </div>

                    <!-- price on sale -->


                    <div class="mb-4">
                        <label class="block mb-1"> Kiekis </label>
                        <div class="grid grid-cols-3 gap-x-2 md:w-1/2">
                            <div class="col-span-2">
                                <input name="quantity" type="number" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="0" />
                            </div>
                        </div> <!-- flex grid -->
                    </div>


                    <div class="mb-4">
                        <label class="block mb-1"> Subtagas 1 </label>
                        <input name="subtag1" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Tag, Tag,..." />
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1"> Subtagas 2 </label>
                        <input name="subtag2" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="Tag, Tag,..." />
                    </div>

                    <div class="grid md:grid-cols-2 gap-x-2">


                    </div> <!-- grid -->





                    <div class="mb-4">
                        <label class="block mb-1"> Image upload </label>
                        <input name="image" type="file" class="w-72" placeholder="Type here" />
                    </div>


                    <!-- <div class="mb-4">
                        <label class="block mb-1"> Image URL </label>
                        <input name="imageURL" type="text" class="appearance-none border border-gray-200 bg-gray-100 rounded-md py-2 px-3 hover:border-gray-400 focus:outline-none focus:border-gray-400 w-full" placeholder="https:://" />
                    </div> -->

                    <label class="flex items-center w-max my-4">
                        <input name="active" type="checkbox" class="h-4 w-4">
                        <span class="ml-2 inline-block text-gray-500"> Publikuoti iš karto? </span>
                    </label>



                    <x-jet-button type="submit" wire:loading.attr="disabled">
                        {{ __('Pridėti') }}
                    </x-jet-button>

                    <x-jet-button type="submit" wire:loading.attr="disabled" class="bg-gray-50 text-gray-800 hover:bg-gray-200 hover:text-gray-700">
                        {{ __('Atšaukti') }}
                    </x-jet-button>

                    <!-- <a href="#" class="px-4 py-3 uppercase inline-block text-gray-700 bg-white shadow-sm border border-gray-200 rounded-md hover:bg-gray-100 hover:text-blue-600 text-xs font-bold "> Atšaukti </a> -->

                </form>

            </article>


        </section> <!-- container -->
    </main>
</div>


@endsection