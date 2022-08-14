<div class="confirmAgeWindow">

    <!-- <script>
        var ageConfirmed = sessionStorage.getItem('ageConfirmed');
        if (ageConfirmed == 'false') {
            document.querySelector('.confirmAgeWindow').classList.add('hidden');
        }
    </script> -->

    <div id="popup-modal" tabindex="-1" class="bg-gray-900 bg-opacity-75 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal h-full justify-center items-center flex" aria-modal="true" role="dialog">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <form action="{{ route('info.ageconfirm') }}" method="post" class="relative bg-white rounded-lg shadow dark:bg-gray-700 top-1/4 md:top-1/3">
                @csrf
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">

                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">This site requires you to be over 18 years old?</h3>
                    <p class="mb-5 text-xs font-normal text-gray-500 dark:text-gray-400">You must be 18 years of age or older to view page. Please verify your age to enter.</p>
                    <div class="w-full flex justify-between flex-nowrap">
                        <button id="confirmAge" data-modal-toggle="popup-modal" type="submit" class="uppercase whitespace-nowrap text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-semibold rounded text-xs inline-flex items-center px-5 py-2.5 text-center mr-2">
                            I am 18 or older
                        </button>
                        <button data-modal-toggle="popup-modal" type="button" class="uppercase whitespace-nowrap text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded border border-gray-200 text-xs font-semibold px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">I am under 18</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- proceedToCheckout.addEventListener('click', () => {
        document.querySelector('.shoppingCart').classList.toggle('hidden');
        sessionStorage.removeItem('opened');
    }); -->

</div>