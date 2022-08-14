<form action="{{ route('info.cookieagreement') }}" method="post" class="fixed left-0 right-0 bottom-0 z-40">
    @csrf
    <div class="pt-8 pb-3 bg-gray-50 border-gray-100 border-t-1">
        <div class="container px-4 mx-auto">
            <h3 class="font-heading text-xl text-gray-800 mb-4 md:text-center">Cookies on this site</h3>
            <p class="text-xs md:ml-24 text-gray-400 mb-8">We use our own cookies as well as third-party cookies on our websites to enhance your experience, analyze our traffic, and for security and marketing. Select "Accept All" to allow them to be used.We use our own cookies as well as third-party cookies on our websites to enhance your experience, analyze our traffic, and for security and marketing. Select "Accept All" to allow them to be used.</p>
            <div class="text-center"><button type="submit" class="inline-block w-full sm:w-auto px-7 py-4 mb-3 sm:mb-0 sm:mr-5 text-center font-medium bg-green-500 hover:bg-green-600 text-white rounded transition duration-250">Accept All Cookies</button><a href="" class="inline-block w-full sm:w-auto px-7 py-2 text-center font-medium border border-white text-gray-400 outline-none hover:text-gray-200 rounded">Reject Cookies</a></div>
        </div>
    </div>
</form>