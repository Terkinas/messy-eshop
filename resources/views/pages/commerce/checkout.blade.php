@extends('layouts.app')


@section('extra-header')

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

@endsection

@section('content')

<?php

$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

?>




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

        @if ( Request::get('itemName') )
        <div class="flex items-center justify-between p-4 text-red-700 border rounded border-red-900/10 bg-red-50" role="alert">
            @if (Request::get('itemQty') <= 0 ) <strong class="text-sm font-medium"> {{ Request::get('itemName') }} is sold out, please remove it in order to continue purchase </strong>
                @else
                <strong class="text-sm font-medium">Unfortunately, only {{Request::get('itemQty')}} <span class="opacity-75">'{{ Request::get('itemName') }}'</span> left!</strong>
                @endif


                <button class="close" data-dismiss="alert" class="opacity-90" type="button">
                    <span class="sr-only"> Close </span>

                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
        </div>
        @endif
    </div>
</div>

<section>
    <h1 class="sr-only">Checkout</h1>

    <div class="relative mx-auto max-w-screen-2xl">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="py-12 bg-gray-50 md:py-24">
                <div class="max-w-lg px-4 mx-auto lg:px-8">
                    <div class="flex items-center">
                        <span class="w-10 h-10 bg-green-300 rounded"></span>

                        <h2 class="ml-4 font-medium">Shopping Cart</h2>
                    </div>

                    @if ($cart !== null) <div class="mt-8">
                        <p class="text-2xl font-medium tracking-tight">€{{number_format($totalPrice / 100,2)}}</p>
                        <p class="mt-1 text-sm text-gray-500">Products in the shopping cart:</p>
                    </div>

                    <div class="mt-12">
                        <div class="flow-root">
                            <ul class="-my-4 divide-y divide-gray-200">
                                @foreach ($cart as $item)

                                <li class="flex py-6">
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border bg-gray-50 border-gray-200">
                                        <img src="{{ asset('images/products/' . $item['item']->image_path) }}" alt="{{ $item['item']['name'] }}" class="h-full w-full object-contain p-2 object-center">
                                    </div>

                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>
                                                    <a href="#"> {{Str::limit( $item['item']['name'] , 42)}} </a>
                                                </h3>
                                                <p class="ml-4 whitespace-nowrap">€ {{ number_format($item['item']['price'] / 100,2) }}</p>
                                            </div>
                                            @if ( Request::get('itemId') == $item['item']->id )


                                            @if (Request::get('itemQty') <= 0 ) <p class="text-red-400 text-xs">This item is out of stock</p>
                                                @else
                                                <p class="text-red-400 text-xs">Only {{Request::get('itemQty')}} left!</p>

                                                @endif
                                                @endif
                                                <p class="mt-1 text-sm text-gray-500">{{ $item['item']['color'] }}</p>


                                        </div>

                                        <div class="flex flex-1 items-end justify-between text-sm">
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
                                            <!-- <p class="text-gray-400"> {{ $item['qty'] }} Qty.</p> -->

                                            <div class="flex">
                                                <form action="{{ route('cart.remove', ['id' => $item['item']['id']]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="font-medium text-red-600 hover:text-red-500">Remove</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    @else

                    <p class="mt-6 text-gray-400">Shopping cart is empty</p>

                    @endif


                </div>
            </div>


            <!-- vartotojo form -->

            <div class="py-12 bg-white md:py-24">
                <div class="max-w-lg px-4 mx-auto lg:px-8">

                    @if ($cart !== null)
                    <form class="grid grid-cols-6 gap-4">
                        @csrf
                        <!-- <div class="col-span-3">
                            <label class="block mb-1 text-sm text-gray-600" for="first_name">
                                Vardas
                            </label>

                            <input required name="firstName" class="rounded shadow-sm border-gray-200 w-full text-sm p-2.5" type="text" id="frst_name" />
                        </div>

                        <div class="col-span-3">
                            <label class="block mb-1 text-sm text-gray-600" for="last_name">
                                Pavardė
                            </label>

                            <input required name="secondName" class="rounded shadow-sm border-gray-200 w-full text-sm p-2.5" type="text" id="last_name" />
                        </div> -->

                        <div class="col-span-6">
                            <label class="block mb-1 text-sm text-gray-600" for="email">
                                Email
                            </label>

                            <input placeholder="" value="{{ old('email') }}" required name="email" class="rounded shadow-sm border-gray-200 w-full text-sm p-2.5" type="email" id="customer_email" />
                        </div>


                        <!-- omniva imput -->

                        <div class="col-span-6 ">
                            <label class="hidden"><input type="radio" name="terminalCode" id="map-test" checked required>OmnivaMap - <span>ON</span></label>
                            <!-- <label><input type="radio" name="terminalCode" id="map-test-off">OmnivaMap - <span>OFF</span></label> -->
                        </div>





























                        <!-- end of omni -->

                        <!-- <div class="col-span-6">

                            <label class="block mb-1 text-sm text-gray-600" for="phone">
                                Telefonas
                            </label>
                            <div class="mt-2 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l border border-r-0 border-gray-300 bg-gray-50 text-gray-400 text-xs"> +370 </span>
                                <input required maxlength="6" type="text" name="telephone" id="number" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 placeholder:text-gray-300" placeholder="12345678">
                            </div>
                        </div>

                        <fieldset class="col-span-6">
                            <legend class="block mb-1 text-sm text-gray-600">
                                Jūsu adresas
                            </legend>

                            <div class="-space-y-px bg-white rounded shadow-sm">
                                <div>
                                    <label class="sr-only" for="country">Jūsu adresas</label>

                                    <select class="border-gray-200 relative rounded-t w-full focus:z-10 text-sm p-2.5" id="country" name="country" autocomplete="country-name">
                                        <option>Lithuania</option>
                                        @foreach ($countries as $country)
                                        <option>{{ $country }}</option>
                                        @endforeach
                                      
                                    </select>
                                </div>

                                <div>
                                    <label class=" sr-only" for="postal-code">
                                        Miestas
                                    </label>

                                    <input required value="{{ old('city') }}" class="border-gray-200 relative rounded-b w-full focus:z-10 text-sm p-2.5 placeholder-gray-400" type="text" name="city" id="city" autocomplete="city" placeholder="Miestas" />
                                </div>

                                <div>
                                    <label class="sr-only" for="postal-code">
                                        Gatvė, namo numeris
                                    </label>

                                    <input required class="border-gray-200 relative rounded-b w-full focus:z-10 text-sm p-2.5 placeholder-gray-400" type="text" name="street" id="street" autocomplete="street" placeholder="Gatvė, namo numeris" />
                                </div>


                            </div>



                            <label class="sr-only" for="country">Pašto kodas</label>
                            <div class="mt-2 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l border border-r-0 border-gray-300 bg-gray-50 text-gray-400 text-xs"> LT - </span>
                                <input required maxlength="6" type="text" name="postalCode" id="postalCode" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 placeholder:text-gray-300" placeholder="12345">
                            </div>
                        </fieldset> -->

                        <fieldset class="relative w-full col-span-6 mt-2">

                            <div class="flex justify-between mb-2">
                                <p class="font-bold">Total:</p>
                                <div class="flex">
                                    <p class="text-gray-800 mr-2 font-bold">€{{number_format($totalPrice / 100 + 10,2)}}</p>
                                    <p class="text-gray-400 text-xs py-1">( Shipping fee €{{ number_format(10, 2)}} ) </p>
                                </div>
                            </div>



                        </fieldset>



                        <div class="relative col-span-6 text-xs w-full items-center">
                            <input required id="link-checkbox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <p class="inline ml-1">I've read and agree with <a class="text-blue-500 hover:text-blue-400" href="{{ route('info.purchases') }}">Terms&Agreements</a></p>
                        </div>

                        <input type="hidden" id="stripe_publishable" value="{{env('STRIPE_PUBLISHABLE')}}">



                        <div>
                            <div class="form-group">

                                <div class="">
                                    <input class="form-control" id="amount" type="hidden" name="amount" value="{{number_format($totalPrice,2)}}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="stripe_publishable" value="{{env('STRIPE_PUBLISHABLE')}}">

                        <div class="col-span-6">
                            <button onclick="loadingStripe()" type="submit" id="donate" class="rounded bg-black text-sm p-2.5 text-white w-full block font-semibold uppercase gray-300 hover:bg-gray-800 duration-200 transition">
                                <i id="payloadingicon" class="opacity-0 fa-solid fa-circle-notch animate-spin text-white"></i>
                                <span id="payicon" class="mr-2"><i class="fas fa-donate">

                                    </i></span>Pay</button>
                        </div>


                    </form>
                    @endif
                </div>

            </div>

        </div>
    </div>
</section>


@endsection


@section('extra-js')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//js.stripe.com/v3/"></script>
<script src="/checkout.js"></script>










<script>
    $(document).ready(function() {
        let test = $('#map-test').omniva({
            terminals: omnivaTerminals,
            country_code: omniva_current_country,
            callback: function(id) {
                test.parent().find('span').text(id);
            },
        });
        let test2 = $('#map-test-off').omniva({
            terminals: omnivaTerminals,
            country_code: omniva_current_country,
            autoHide: true,
            selector_container: $('#secondary')[0],
            callback: function(id, clicked) {
                console.log("We got response:", id);
                if (clicked) {
                    console.log('and it was manually clicked');
                }
                test2.parent().find('span').text(id);
            },
            translate: {
                modal_header: "Omniva paštomatai"
            }
        });
        $('input[type="radio"][name="terminalCode"]').on('click', function(e) {
            if ($(this).prop("id") == "map-test") {
                test.trigger('omniva.show');
                test2.trigger('omniva.hide');
            } else {
                test.trigger('omniva.hide');
                test2.trigger('omniva.show');
            }
        });

        $('#postcode').on('change', function(e) {
            test.trigger('omniva.postcode', [$(this).val()]);
        });

        test.click();
    });

    // Data for testing purposes
    var omniva_current_country = 'LT';
    var omnivaTerminals = [
        ["Alytaus NORFA Topolių paštomatas (naujas!)", "54.396616", "24.028241", "88895", "Alytus", "Topolių g. 1, Alytus", "Paštomatą rasite lauke prie sienos iš parkavimo aikštelės pusės"],
        ["Alytaus PC ARENA paštomatas", "54.409792", "24.014968", "88854", "Alytus", "Naujoji g. 7E, Alytus", "Paštomatą rasite lauke, prie pagrindinio įėjimo sienos dešiniojo kampo"],
        ["Alytaus RIMI Pulko paštomatas", "54.387953", "24.043778", "88855", "Alytus", "Pulko g. 53A, Alytus", "Paštomatą rasite lauke, prie įėjimo į prekybos centrą, kairėje pusėje"],
        ["Anykščių NORFA Vilniaus g. paštomatas", "55.522864", "25.098652", "88800", "Anykščiai", "Vilniaus g. 22, Anykščiai", "Paštomatą rasite lauke, prie įėjimo iš Kudirkos g. dešinėje pusėje"],
        ["Biržų NORFA paštomatas", "56.194351", "24.769201", "88866", "Biržai", "Respublikos g. 2E, Biržai", "Paštomatą rasite prie pagrindinio parduotuvės įėjimo, kairėje pusėje"],
        ["Druskininkų IKI Čiurlionio paštomatas", "54.011307", "23.990209", "88865", "Druskininkai", "Čiurlionio g. 107, Druskininkai", "Paštomatą rasite lauke, prie dešiniosios prekybos centro sienos"],
        ["Eišiškių NORFA paštomatas (naujas!)", "54.171456", "24.997282", "88896", "Eišiškės", "Vilniaus g. 19, Eišiškės", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Elektrėnų MAXIMA paštomatas (naujas!)", "54.785283", "24.658095", "88853", "Elektrėnai", "Rungos g. 4, Elektrėnai", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Gargždų NORFA paštomatas", "55.712518", "21.380646", "88801", "Gargždai", "Klaipėdos g. 41, Gargždai", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Garliavos NORFA paštomatas", "54.829127", "23.873354", "88876", "Kaunas", "Atgimimo g. 1, Jonučių k., Kauno raj. (Garliava)", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Ignalinos NORFA paštomatas", "55.342599", "26.170579", "88802", "Ignalina", "Taikos g. 20, Ignalina", "Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo"],
        ["Jonavos NORFA Žeimių paštomatas (naujas!)", "55.084468", "24.273708", "88897", "Jonava", "Žeimių g. 26A, Jonava ", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į prekybos centrą pusėje"],
        ["Jonavos RIMI paštomatas", "55.073180", "24.276370", "88867", "Jonava", "Vasario 16-osios g. 4, Jonava", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo pusėje"],
        ["Joniškio NORFA paštomatas (naujas!)", "56.228109", "23.604877", "88803", "Joniškis", "Vilniaus g. 47B, Joniškis", "Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo prie sienos"],
        ["Jurbarko MAXIMA CENTRO paštomatas", "55.077400", "22.767105", "88864", "Jurbarkas", "Dariaus ir Girėno g. 66, Jurbarkas", "Paštomatą rasite lauke, prie įėjimo į parduotuvę, dešinėje pusėje"],
        ["Kaišiadorių RIMI paštomatas", "54.856120", "24.443715", "88804", "Kaišiadorys", "Gedimino g. 115A, Kaišiadorys", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Kauno EXPRESS MARKET Vytauto paštomatas (naujas!)", "54.888035", "23.928545", "77749", "Kaunas", "Vytauto pr. 11, Kaunas", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Kauno IKI Girstučio paštomatas", "54.905754", "23.974659", "88875", "Kaunas", "Kovo 11-osios g. 22, Kaunas", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Kauno IKI Ramučių paštomatas (naujas!)", "54.954106", "24.031702", "88898", "Kaunas", "Centrinė g. 56, Ramučiai", "Paštomatą rasite lauke prie sienos iš Plento g. pusės"],
        ["Kauno IKI Sukilėlių paštomatas", "54.925103", "23.929296", "88829", "Kaunas", "Sukilėlių pr. 84, Kaunas", "Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje, prie kampo"],
        ["Kauno IKI Varnių paštomatas (naujas!)", "54.914537", "23.896816", "77700", "Kaunas", "Varnių g. 38A, Kaunas", "Paštomatą rasite lauke prie sienos iš Varnių g. pusės"],
        ["Kauno IKI Veiverių paštomatas", "54.862465", "23.885950", "88830", "Kaunas", "Veiverių g. 150A, Kaunas", "Paštomatą rasite lauke, prie sienos iš Lazdijų gatvės pusės"],
        ["Kauno MAXIMA Masiulio paštomatas", "54.885979", "24.005189", "88883", "Kaunas", "T.Masiulio g. 16E, Kaunas", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Kauno MAXIMA Ringaudų paštomatas (naujas!)", "54.888170", "23.799512", "77701", "Kaunas", "Gėlių g. 2B, Ringaudai, Kauno raj.", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Kauno PC AKROPOLIS paštomatas", "54.890926", "23.919338", "88863", "Kaunas", "Karaliaus Mindaugo pr. 49, Kaunas", "Paštomatą rasite lauke, 1-ame stovėjimo aikštelės aukšte, I-A įėjimas"],
        ["Kauno PC MOLAS paštomatas (naujas!)", "54.899461", "23.966459", "77702", "Kaunas", "Baršausko g. 66, Kaunas", "Paštomatą rasite lauke prie sienos, kairėje pagrindinio įėjimo į prekybos centrą pusėje"],
        ["Kauno PC RIVER MALL paštomatas", "54.903282", "23.898021", "88827", "Kaunas", "Jonavos g. 60, Kaunas", "Paštomatą rasite lauke, prie pagrindinio įėjimo į prekybos centrą, dešinėje pusėje"],
        ["Kauno PLC MEGA paštomatas", "54.939289", "23.889493", "88881", "Kaunas", "Islandijos pl. 32, Kaunas", "Paštomatą rasite lauke, prie Rimi iėjimo iš Islandijos pl. pusės"],
        ["Kauno PM URMAS paštomatas (naujas!)", "54.916459", "23.987895", "77703", "Kaunas", "Pramonės pr. 16, Kaunas", "Paštomatą rasite įvažiavę per 1C vartus prie Vakarinės galerijos esančio traukinio"],
        ["Kauno RIMI Baltijos paštomatas (naujas!)", "54.920636", "23.879736", "77704", "Kaunas", "Baltijos g. 58, Kaunas", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Kauno RIMI Europos paštomatas", "54.875631", "23.912434", "88882", "Kaunas", "Europos pr. 43, Kaunas", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Kauno RIMI Juozapavičiaus paštomatas (naujas!)", "54.865108", "23.945435", "77705", "Kaunas", "A.Juozapavičiaus pr. 11, Kaunas", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Kauno RIMI Krėvės paštomatas", "54.917362", "23.966171", "88836", "Kaunas", "V.Krėvės pr. 43A, Kaunas", "Paštomatą rasite lauke, prie įėjimo į prekybos centrą, kairėje pusėje"],
        ["Kauno RIMI Raudondvario paštomatas", "54.908863", "23.865946", "88874", "Kaunas", "Raudondvario pl. 94B, Kaunas", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Kauno RIMI Romainių paštomatas (naujas!)", "54.942779", "23.813154", "77706", "Kaunas", "Romainių g. 67C, Kaunas", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Kauno RIMI Savanorių paštomatas", "54.919866", "23.950340", "88884", "Kaunas", "Savanorių pr. 321, Kaunas", "Paštomatą rasite lauke, kairėje prekybos centro pusėje, prie sienos (netoli taromato)"],
        ["Kauno ŠILAS Baltų paštomatas", "54.929909", "23.884138", "88828", "Kaunas", "Baltų pr. 18, Kaunas", "Paštomatą rasite lauke, prie įėjimo į prekybos centrą, dešinėje pusėje"],
        ["Kauno ŠILAS Baranausko paštomatas", "54.909679", "23.956289", "88831", "Kaunas", "Baranausko g. 26, Kaunas", "Paštomatą rasite lauke, prie įėjimo į prekybos centrą, kairėje pusėje"],
        ["Kauno ŠILAS Juozapavičiaus paštomatas", "54.875175", "23.935797", "88832", "Kaunas", "Juozapavičiaus pr. 81A, Kaunas", "Paštomatą rasite lauke, prie įėjimo į prekybos centrą, dešinėje pusėje"],
        ["Kauno ŠILAS Vandžiogalos paštomatas (naujas!)", "54.945303", "23.882493", "77708", "Kaunas", "Vandžiogalos g. 22, Kaunas", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Kauno ŠILAS Škirpos paštomatas (naujas!)", "54.930214", "23.943344", "77707", "Kaunas", "K.Škirpos g. 17, Kaunas", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Kazlų Rūdos MAXIMA paštomatas (naujas!)", "54.751543", "23.493343", "77739", "Kazlų Rūda", "M.Valančiaus g. 7, Kazlų Rūda", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Kelmės MAXIMA Vytauto Didžiojo paštomatas", "55.630016", "22.930844", "88805", "Kelmė", "Vytauto Didžiojo g. 49, Kelmė", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Klaipėdos HERKAUS GALERIJA paštomatas (naujas!)", "55.715246", "21.130175", "77742", "Klaipėda", "H.Manto g. 22, Klaipėda", "Paštomatą rasite laukeprie sienos iš Ligoninės g. pusės"],
        ["Klaipėdos MAXIMA Šilutės pl. 68 paštomatas", "55.676559", "21.189166", "88885", "Klaipėda", "Šilutės pl. 68, Klaipėda", "Paštomatą rasite lauke, kairėje prekybos centro pusėje, prie sienos (netoli taromato)"],
        ["Klaipėdos NORFA Tauralaukio paštomatas", "55.753584", "21.142858", "88877", "Klaipėda", "Tauralaukio g. 1, Klaipėda", "Paštomatą rasite lauke, prie pastato sienos po stogu"],
        ["Klaipėdos NORFA Vingio paštomatas", "55.668081", "21.195697", "88872", "Klaipėda", "Vingio g. 21A, Klaipėda ", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Klaipėdos PC ARENA paštomatas", "55.687225", "21.155785", "88837", "Klaipėda", "Taikos pr. 64, Klaipėda", "Paštomatą rasite lauke, prie įėjimo į Rimi, kairėje pusėje"],
        ["Klaipėdos PC BIG1 paštomatas", "55.664533", "21.177448", "88841", "Klaipėda", "Taikos pr. 139, Klaipėda", "Paštomatą rasite lauke, prie prie sienos, pėsčiųjų alėjoje tarp BIG1 ir BIG2"],
        ["Klaipėdos PC STUDLENDAS paštomatas", "55.729055", "21.125150", "88839", "Klaipėda", "H.Manto g. 90, Klaipėda", "Paštomatą rasite lauke, dešinėje įėjimo į IKI pusėje, iš Šiaurės pr. pusės"],
        ["Klaipėdos RIMI Slengių paštomatas (naujas!)", "55.736771", "21.191771", "77710", "Slengiai", "Dangaus g. 34, Slengiai", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į prekybos centrą pusėje"],
        ["Klaipėdos TECHNORAMA paštomatas", "55.698207", "21.149172", "88873", "Klaipėda", "Taikos pr. 39, Klaipėda", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į parduotuvę pusėje"],
        ["Klaipėdos VIADA Priestočio paštomatas", "55.719124", "21.141022", "88838", "Klaipėda", "Priestočio g. 28, Klaipėda", "Paštomatą rasite lauke, prie įėjimo į parduotuvę, dešinėje pusėje"],
        ["Kretingos MAXIMA Rotušės paštomatas", "55.889772", "21.240982", "88806", "Kretinga", "Rotušės a. 15, Kretinga", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Kretingos NORFA paštomatas (naujas!)", "55.892317", "21.232706", "88893", "Kretinga", "Šventosios g. 25H, Kretinga ", "Paštomatą rasite lauke prie sienos iš parkavimo aikštelės pusės"],
        ["Kupiškio NORFA Purėno paštomatas (naujas!)", "55.836188", "24.993760", "77740", "Kupiškis", "A.Purėno g. 1, Kupiškis ", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Kuršėnų MAXIMA Vilniaus g. paštomatas", "56.000438", "22.949599", "88886", "Kuršėnai", "Vilniaus g. 43, Kuršėnai", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Kėdainių MAXIMA Basanavičiaus 93 paštomatas", "55.277651", "23.959059", "88861", "Kėdainiai", "J.Basanavičiaus g. 93, Kėdainiai", "Paštomatą rasite lauke, kairėje prekybos centro dalyje, prie sienos, po iškabomis"],
        ["Kėdainių MAXIMA Dariaus ir Girėno paštomatas (naujas!)", "55.308916", "23.979144", "77709", "Kėdainiai", "S.Dariaus ir S.Girėno g. 50A, Kėdainiai", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Lazdijų NORFA paštomatas", "54.238926", "23.511757", "88807", "Lazdijai", "Dzūkų g. 3, Lazdijai", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Lentvario IKI paštomatas (naujas!)", "54.644033", "25.046481", "77731", "Lentvaris", "Geležinkelio g. 38, Lentvaris", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Marijampolės MAXIMA Bažnyčios paštomatas", "54.556047", "23.346449", "88899", "Marijampolė", "Bažnyčios g. 38, Marijampolė", "Paštomatą rasite lauke prie sienos iš Laisvės g. pusės"],
        ["Marijampolės PC ARENA paštomatas", "54.560951", "23.354530", "88856", "Marijampolė", "Dariaus ir Girėno g. 3A, Marijampolė", "Paštomatą rasite lauke, prie įėjimo į JYSK kairėje pusėje"],
        ["Mažeikių IKI Ventos paštomatas (naujas!)", "56.308940", "22.324078", "77711", "Mažeikiai", "Ventos g. 10B, Mažeikiai", "Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje, už kampo prie sienos"],
        ["Mažeikių PC EIFELIS paštomatas", "56.299740", "22.353653", "88857", "Mažeikiai", "Žemaitijos g. 72, Mažeikiai", "Paštomatą rasite lauke, prie įėjimo į NORFA, kairėje pusėje"],
        ["Molėtų NORFA paštomatas (naujas!)", "55.224777", "25.405258", "77712", "Molėtai", "Vilniaus g. 99, Molėtai", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Naujosios Akmenės NORFA paštomatas (naujas!)", "56.319508", "22.873342", "88808", "Naujoji Akmenė", "Respublikos g. 30, Naujoji Akmenė", "Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo prie sienos"],
        ["Pabradės NORFA paštomatas (naujas!)", "54.979590", "25.755895", "77713", "Pabradė", "Molėtų g. 4A, Pabradė", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Pakruojo NORFA paštomatas (naujas!)", "55.979951", "23.856885", "77714", "Pakruojis", "Statybininkų g. 2A, Pakruojis", "Paštomatą rasite lauke, prie parduotuvės sienos"],
        ["Palangos RIMI paštomatas", "55.921020", "21.075963", "88870", "Palanga", "Malūno g. 10, Palanga", "Paštomatą rasite lauke, kairėje įėjimo pusėje, iš Klaipėdos pl. pusės"],
        ["Panevėžio MAXIMA LĖVUO paštomatas", "55.729027", "24.324492", "88849", "Panevėžys", "Klaipėdos g. 103, Panevėžys", "Paštomatą rasite lauke, prie įejimo į Maxima, dešinėje pusėje"],
        ["Panevėžio MAXIMA TURGAUS paštomatas", "55.728699", "24.370111", "88847", "Panevėžys", "Ukmergės g. 23, Panevėžys", "Paštomatą rasite lauke, kairėje įėjimo į Maxima pusėje, prie kampo"],
        ["Panevėžio NORFA Beržų paštomatas (naujas!)", "55.718296", "24.371654", "77715", "Panevėžys", "Beržų g. 27, Panevėžys ", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Panevėžio NORFA Smėlynės paštomatas (naujas!)", "55.744796", "24.369838", "77716", "Panevėžys", "Smėlynės g. 85, Panevėžys", "Paštomatą rasite lauke, prie parduotuvės sienos"],
        ["Panevėžio RIMI paštomatas", "55.728561", "24.342098", "88846", "Panevėžys", "Klaipėdos g. 82, Panevėžys", "Paštomatą rasite lauke, prie įėjimo į prekybos centrą kairėje pusėje"],
        ["Pasvalio NORFA paštomatas", "56.059471", "24.410913", "88809", "Pasvalys", "Ežero g. 1, Pasvalys", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Plungės IKI Laisvės paštomatas (naujas!)", "55.908829", "21.857685", "88894", "Plungė", "Laisvės g. 5, Plungė", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į turgų pusėje"],
        ["Plungės NORFA Kalniškių paštomatas", "55.904872", "21.844950", "88810", "Plungė", "Kalniškių g. 18, Plungė", "Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje, už kampo prie sienos"],
        ["Prienų NORFA paštomatas", "54.643128", "23.944950", "88812", "Prienai", "Revuonos g. 66, Prienai", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Radviliškio IKI paštomatas", "55.813206", "23.547457", "88817", "Radviliškis", "Gedimino g. 31B, Radviliškis", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Raseinių MAXIMA Maironio paštomatas", "55.386357", "23.126401", "88819", "Raseiniai", "Maironio g. 64, Raseiniai", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Rietavo MAXIMA paštomatas (naujas!)", "55.724309", "21.932529", "77717", "Rietavas", "Plungės g. 2, Rietavas", "Paštomatą rasite lauke prie sienos, galinėje parduotuvės pastato dalyje"],
        ["Rokiškio NORFA Panevėžio g. paštomatas", "55.947342", "25.589039", "88821", "Rokiškis", "Panevėžio g. 1D, Rokiškis", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Skuodo MAXIMA Mosėdžio paštomatas (naujas!)", "56.267776", "21.531389", "77718", "Skuodas", "Mosėdžio g. 2, Skuodas", "Paštomatą rasite lauke prie sienos iš Mosėdžio g. pusės"],
        ["Tauragės NORFA Gedimino paštomatas", "55.251360", "22.298812", "88851", "Tauragė", "Gedimino g. 28, Tauragė", "Paštomatą rasite lauke, prie prekybos centro sienos"],
        ["Telšių NORFA Gedimino paštomatas", "55.981785", "22.238605", "88868", "Telšiai", "Gedimino g. 8, Telšiai", "Paštomatą rasite prie pagrindinio įėjimo, dešinėje pusėje"],
        ["Telšių PC TULPĖ paštomatas  (naujas!)", "55.983917", "22.249697", "88891", "Telšiai", "Kęstučio g. 4, Telšiai", "Paštomatą rasite prie pagrindinio įėjimo, kairėje pusėje"],
        ["Trakų NORFA paštomatas (naujas!)", "54.627344", "24.945533", "77724", "Trakai", "Vilniaus g. 15C, Trakai", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Ukmergės IKI Vilniaus g. paštomatas", "55.244184", "24.773200", "88892", "Ukmergė", "Vilniaus g. 62, Ukmergė", "Paštomatą rasite lauke prie sienos, netoli taromato"],
        ["Ukmergės MAXIMA Žiedo paštomatas", "55.242752", "24.743786", "88869", "Ukmergė", "Žiedo g. 1, Ukmergė", "Paštomatą rasite įėjimo į parduotuvę, kairėje pusėje"],
        ["Utenos RIMI-SENUKAI paštomatas", "55.498111", "25.596356", "88860", "Utena", "J.Basanavičiaus g. 52, Utena", "Paštomatą rasite lauke, prie prekybos centro sienos iš autobusų stoties pusės"],
        ["Varėnos IKI paštomatas", "54.215309", "24.563934", "88834", "Varėna", "Sporto g. 1, Varėna", "Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo prie sienos"],
        ["Vilkaviškio NORFA Nepriklausomybės paštomatas", "54.658606", "23.030233", "88835", "Vilkaviškis", "Nepriklausomybės g. 61, Vilkaviškis", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus CUP paštomatas", "54.694023", "25.276537", "88871", "Vilnius", "Upės g. 9,  Vilnius", "Paštomatą rasite kairėje 3-ojo auktšo įėjimo pusėje, šalia automobilių stovėjimo aikštelės"],
        ["Vilniaus IKI Bajorų paštomatas (naujas!)", "54.754746", "25.261674", "77744", "Vilnius", "Bajorų kel. 4, Vilnius", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Vilniaus IKI Buivydiškių g. paštomatas (naujas!)", "54.713529", "25.238532", "77725", "Vilnius", "Buivydiškių g. 17, Vilnius", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje, už taromato"],
        ["Vilniaus IKI Didlaukio paštomatas", "54.728806", "25.269791", "88850", "Vilnius", "Didlaukio g. 80A, Vilnius", "Paštomatą rasite lauke, parkinge iš Baltupio g. pusės, prie sienos"],
        ["Vilniaus IKI Jeruzalės paštomatas", "54.743055", "25.278166", "88862", "Vilnius", "Jeruzalės g. 17, Vilnius", "Paštomatą rasite lauke, už kampo prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus IKI Saulėtekio paštomatas (naujas!)", "54.725016", "25.342257", "77748", "Vilnius", "Saulėtekio al. 43, Vilnius ", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje, po laiptais"],
        ["Vilniaus IKI Stanevičiaus paštomatas (naujas!)", "54.723732", "25.255186", "77727", "Vilnius", "S.Stanevičiaus g. 23, Vilnius", "Paštomatą rasite lauke prie sienos, dešinėje pagrindinio įėjimo į parduotuvę pusėje"],
        ["Vilniaus IKI Šeškinės paštomatas", "54.715581", "25.245704", "88852", "Vilnius", "Šeškinės g. 32, Vilnius", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus MAXIMA Antakalnio paštomatas (naujas!)", "54.715310", "25.316520", "77728", "Vilnius", "Antakalnio g. 75A, Vilnius", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Vilniaus MAXIMA Architektų paštomatas (naujas!)", "54.683020", "25.213188", "77729", "Vilnius", "Architektų g. 152, Vilnius", "Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje"],
        ["Vilniaus MAXIMA Grigiškių paštomatas", "54.670192", "25.098794", "88888", "Vilnius", "Kovo 11-osios g. 38B, Grigiškės", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus MAXIMA Grybo paštomatas", "54.703717", "25.315933", "88887", "Vilnius", "V. Grybo g. 21, Vilnius", "Paštomatą rasite lauke, prie sienos dešinėje pastato pusėje, prie taromato"],
        ["Vilniaus MAXIMA Kęstučio paštomatas (naujas!)", "54.693457", "25.251060", "77730", "Vilnius", "Kęstučio g. 37, Vilnius ", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Vilniaus MAXIMA Naugarduko paštomatas (naujas!)", "54.669109", "25.258908", "77732", "Vilnius", "Naugarduko g. 84, Vilnius", "Paštomatą rasite lauke prie sienos iš Naugarduko g. pusės"],
        ["Vilniaus MAXIMA Pilaitės paštomatas (naujas!)", "54.709891", "25.188744", "77733", "Vilnius", "Pilaitės pr. 31, Vilnius", "Paštomatą rasite lauke prie sienos iš Pilaitės pr. pusės"],
        ["Vilniaus MAXIMA Sausio 13-os paštomatas (naujas!)", "54.692867", "25.221685", "88822", "Vilnius", "Sausio 13-sios g. 2, Vilnius", "Paštomatą rasite lauke, kairėje įėjimo į Maxima pusėje, prie sienos"],
        ["Vilniaus MAXIMA Savanorių 31 paštomatas (naujas!)", "54.673977", "25.247888", "77726", "Vilnius", "Savanorių pr. 31, Vilnius", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus MAXIMA Taikos 162A paštomatas (naujas!)", "54.712398", "25.215338", "77747", "Vilnius", "Taikos g. 162A, Vilnius", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Vilniaus MAXIMA Tuskulėnų paštomatas", "54.702362", "25.288749", "88813", "Vilnius", "Tuskulėnų g. 66, Vilnius", "Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus MAXIMA Viršuliškių paštomatas", "54.709389", "25.222248", "88820", "Vilnius", "Viršuliškių g. 30, Vilnius", "Paštomatą rasite prie įvažiavimo į stovėjimo aikštelę"],
        ["Vilniaus MAXIMA Šaltkalvių paštomatas", "54.661525", "25.272317", "88889", "Vilnius", "Šaltkalvių g. 2, Vilnius", "Paštomatą rasite lauke,  prie pastato sienos šalia taromato"],
        ["Vilniaus NORFA Genių paštomatas", "54.688179", "25.421732", "88848", "Vilnius", "Genių g. 10A, Vilnius", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus NORFA Minsko paštomatas", "54.652141", "25.305245", "88878", "Vilnius", "Minsko pl. 3, Vilnius", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus NORFA Molėtų pl. paštomatas", "54.772007", "25.272299", "88890", "Vilnius", "Molėtų pl. 47, Vilnius", "Paštomatą rasite lauke, prie pastato sienos iš Molėtų pl. pusės"],
        ["Vilniaus NORFA Rygos paštomatas (naujas!)", "54.719011", "25.212367", "77734", "Vilnius", "Rygos g. 49, Vilnius", "Paštomatą rasite lauke prie sienos iš Rygos g. pusės"],
        ["Vilniaus NORFA Žvalgų paštomatas", "54.721530", "25.287830", "88879", "Vilnius", "Kalvarijų g. 151, Vilnius", "Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje, už kampo prie sienos"],
        ["Vilniaus PC DOMUS PRO paštomatas", "54.740274", "25.225183", "88811", "Vilnius", "Ukmergės g.  308, Vilnius", "Paštomatą rasite lauke, prie pastato sienos iš Ukmergės g. pusės"],
        ["Vilniaus PC MANDARINAS paštomatas", "54.731491", "25.246227", "88814", "Vilnius", "Ateities g. 91, Vilnius", "Paštomatą rasite lauke, prie įėjimo į prekybos centrą"],
        ["Vilniaus RIMI Architektų paštomatas", "54.673672", "25.213588", "88858", "Vilnius", "Architektų g. 19, Vilnius", "Paštomatą rasite lauke, už kampo prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus RIMI Fabijoniškių paštomatas (naujas!)", "54.720785", "25.244945", "77735", "Vilnius", "Ukmergės g. 233, Vilnius", "Paštomatą rasite lauke prie sienos iš Ukmergės g. pusės"],
        ["Vilniaus RIMI Kareivių paštomatas (naujas!)", "54.717897", "25.300539", "77736", "Vilnius", "Kareivių g. 11A, Vilnius", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į prekybos centrą pusėje, už kampo"],
        ["Vilniaus RIMI Medeinos paštomatas (naujas!)", "54.729596", "25.227436", "77737", "Vilnius", "Medeinos g. 8, Vilnius", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Vilniaus RIMI Rygos paštomatas", "54.715958", "25.224777", "88859", "Vilnius", "Rygos g. 8, Vilnius", "Paštomatą rasite lauke, už kampo prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Vilniaus RIMI Savanorių paštomatas", "54.675640", "25.257998", "88815", "Vilnius", "Kedrų g. 4, Vilnius", "Paštomatą rasite lauke, kairėje pagrindinio iėjimo į prekybos centrą pusėje, prie sienos"],
        ["Vilniaus RIMI Vydūno paštomatas", "54.707191", "25.188892", "88823", "Vilnius", "Vydūno g. 4, Vilnius", "Paštomatą rasite lauke, prie įėjimo į prekybos centrą"],
        ["Vilniaus RIMI Zarasų g. paštomatas (naujas!)", "54.680886", "25.311600", "77738", "Vilnius", "Zarasų g. 5A, Vilnius", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Vilniaus RIMI Žirmūnų paštomatas", "54.712017", "25.300741", "88816", "Vilnius", "Žirmūnų g. 64, Vilnius", "Paštomatą rasite lauke, prie \"Topo centro\" įėjimo, kairėje pusėje"],
        ["Vilniaus VC ŽALGIRIO 135 paštomatas (naujas!)", "54.704816", "25.272422", "77743", "Vilnius", "Žalgirio g. 135, Vilnius ", "Paštomatą rasite lauke prie sienos, prie įvažiavimo į vidinį kiemą iš Žalgirio g. pusės"],
        ["Vilniaus VIADA Saltoniškių paštomatas", "54.699135", "25.260015", "88818", "Vilnius", "Saltoniškių g. 12, Vilnius", "Paštomatą rasite lauke, dešinėje degalinės pusėje"],
        ["Vilniaus VIADA Saulėtekio paštomatas", "54.726292", "25.326769", "88826", "Vilnius", "Nemenčinės pl. 5, Vilnius", "Paštomatą rasite lauke, galinėje degalinės pusėje"],
        ["Visagino VIADA paštomatas", "55.594598", "26.438796", "88840", "Visaginas", "Statybininkų g. 1, Visaginas", "Paštomatą rasite lauke, už kampo prie sienos dešinėje įėjimo į degalinę pusėje"],
        ["Zarasų IKI Vytauto paštomatas (naujas!)", "55.736384", "26.264755", "88845", "Zarasai", "Vytauto g. 54, Zarasai", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["ŠILUTĖS PREKYBA Lietuvininkų 37 paštomatas", "55.343229", "21.471249", "88833", "Šilutė", "Lietuvininkų g. 37, Šilutė", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Šakių NORFA Šaulių paštomatas", "54.960627", "23.031055", "88824", "Šakiai", "Šaulių g. 49, Šakiai", "Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje"],
        ["Šalčininkų NORFA paštomatas (naujas!)", "54.317769", "25.383816", "77719", "Šalčininkai", "Vilniaus g. 2B, Šalčininkai", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Šeduvos NORFA paštomatas (naujas!)", "55.756241", "23.762468", "77720", "Šeduva", "Panevėžio g. 33, Šeduva", "Paštomatą rasite lauke prie sienos už kampo, dešinėje įėjimo į parduotuvę pusėje"],
        ["Šiaulių MOKI-VEŽI paštomatas", "55.917301", "23.301418", "88844", "Šiauliai", "Pramonės g. 7, Šiauliai", "Paštomatą rasite lauke, prie stiklinės vitrinos  kairėje įėjimo į prekybos centrą pusėje"],
        ["Šiaulių NORFA Tilžės 13A paštomatas (naujas!)", "55.911563", "23.268380", "77721", "Šiauliai", "Tilžės g. 13A, Šiauliai", "Paštomatą rasite lauke prie sienos iš parkavimo aikštelės pusės"],
        ["Šiaulių NORFA Valančiaus paštomatas", "55.938897", "23.305095", "88880", "Šiauliai", "M.Valančiaus g. 18, Šiauliai", "Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje"],
        ["Šiaulių PC ARENA paštomatas", "55.906536", "23.258636", "88842", "Šiauliai", "Gegužių g. 30, Šiauliai", "Paštomatą rasite lauke, prie įėjimo į JYSK dešinėje pusėje"],
        ["Šiaulių PC SAULĖS MIESTAS paštomatas (naujas!)", "55.927737", "23.307049", "77741", "Šiauliai", "Tilžės g. 109, Šiauliai", "Paštomatą rasite lauke prie sienos iš Autobusų stoties perono pusės"],
        ["Šiaulių VIADA Tilžės paštomatas", "55.944092", "23.331217", "88843", "Šiauliai", "Tilžės g. 274, Šiauliai", "Paštomatą rasite lauke prie degalinės"],
        ["Šilalės NORFA paštomatas", "55.490946", "22.188493", "88825", "Šilalė", "Tauragės g. 1, Šilalė", "Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo prie sienos"],
        ["Šilutės MAXIMA Miško paštomatas (naujas!)", "55.350800", "21.479337", "77746", "Šilutė", "Miško g. 7, Šilutė", "Paštomatą rasite lauke prie pastato sienos"],
        ["Širvintų MAXIMA paštomatas (naujas!)", "55.038093", "24.955586", "77722", "Širvintos", "I.Šeiniaus g. 19, Širvintos", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"],
        ["Švenčionių MAXIMA paštomatas (naujas!)", " 55.129970", "26.150541", "77723", "Švenčionys", "Vilniaus g. 37, Švenčionys", "Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje"]
    ];
</script>

<style>
    /**
* Map
**/
    .omniva-terminal-container *,
    .omniva-modal * {
        box-sizing: border-box;
    }

    .omniva-modal {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        -webkit-animation-name: fadeIn;
        -webkit-animation-duration: 0.4s;
        animation-name: fadeIn;
        animation-duration: 0.4s;
        z-index: 9999;
    }

    .omniva-modal-content {
        z-index: 20;
        position: fixed;
        top: 10%;
        left: 5%;
        background-color: #fefefe;
        border-radius: 5px;
        width: 90%;
        height: 80%;
        -webkit-animation-name: slideIn;
        -webkit-animation-duration: 0.4s;
        animation-name: slideIn;
        animation-duration: 0.4s;
    }

    .omniva-modal-close {
        color: #969696;
        float: right;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 0px;
        right: 20px;
    }

    .omniva-modal-close:hover,
    .omniva-modal-close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .omniva-modal-header {
        padding-top: 4px;
        padding-left: 26px;
        padding-right: 4px;
        color: black;
        height: 7%;
        /* prefixed to work with IE10 and Android <4.4 */
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -ms-flex-align: center;
        -webkit-align-items: center;
        -webkit-box-align: center;
        align-items: center;
    }

    .omniva-modal-header h5 {
        display: inline;
        padding: 0px;
        margin: 0px;
        font-size: 18px;
        font-weight: 700;
    }

    .omniva-modal-body {
        padding: 10px;
        height: 92%;
    }

    .omniva-modal-footer {
        height: 6%;
        align-items: center;
    }

    @-webkit-keyframes slideIn {
        from {
            bottom: -300px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }

    @keyframes slideIn {
        from {
            bottom: -300px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }

    @-webkit-keyframes fadeIn {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    .omniva-modal-search-btn {
        background-repeat: no-repeat;
        background-size: 20px 20px;
        background-position: center center;
        outline: none;
        border: 0;
        border-radius: 0 3px 3px 0;
        height: 36px;
        width: 30px;
        margin-left: -30px;
        display: block;
        float: left;
        background-color: #ff6319;
    }

    .omniva-li,
    .omniva-li a {
        font-size: 15px;
        color: black;
    }

    .omniva-li:hover {
        cursor: pointer;
        color: #555;
    }

    .omniva-li .omniva-details {
        text-align: left;
    }

    .omniva-modal-content .omniva-terminals-listing {
        margin: 0px;
        padding: 0px;
        color: black;
    }

    .omniva-modal-content .omniva-terminals-listing li {
        padding: 5px;
        border-radius: 4px;
        list-style-type: none;
        width: 100%;
    }

    .omniva-modal-content .omniva-terminals-listing li:nth-child(even) {
        background: #f2f2f2;
    }

    .omniva-select-terminal-btn {
        background-color: white;
        color: black;
        border: 1px solid black;
        border-radius: 2px;
        font-size: 14px;
        padding: 0px 5px;
        margin-bottom: 10px;
        margin-top: 5px;
        height: 25px;
    }

    .omniva-select-terminal-btn:hover {
        background-color: #555555;
        color: white;
    }

    .omniva-map-container {
        width: 59%;
        height: 100%;
        border: 1px solid black;
        background-color: lightgray;
        float: left;
    }

    .omniva-map {
        width: 100%;
        height: 100%;
    }

    .omniva-search-bar {
        width: 40%;
        min-height: 400px;
        padding: 0px 10px;
        float: left;
        overflow: hidden;
        padding-left: 26px;
    }

    .omniva-search-bar h4 {
        margin-top: 0px;
    }

    /** Tooltips*/

    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 200px;
        background-color: black;
        opacity: 0.9;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 110%;
        left: 50%;
        margin-left: -100px;
    }

    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: black transparent transparent transparent;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
    }

    /*
 * Custom scrollbar 
 **/

    .omniva-scrollbar {
        overflow: auto;
        display: inline-block;
        vertical-align: top;
        height: inherit;
        width: 100%;
        max-height: 50vh;
        position: relative;
        margin-top: 5px;
    }

    .omniva-scrollbar-style-8::-webkit-scrollbar-track {
        border: 1px solid rgba(0, 0, 0, 0.4);
        background-color: rgba(0, 0, 0, 0.4);
        border-radius: 5px;
    }

    .omniva-scrollbar-style-8::-webkit-scrollbar {
        width: 5px;
        background-color: rgba(0, 0, 0, 0, 0.4);
        border: 1px solid rgba(0, 0, 0, 0.4);
        border-radius: 5px;
    }

    .omniva-scrollbar-style-8::-webkit-scrollbar-thumb {
        border: 1px solid #000000;
        border-radius: 5px;
        background-color: #000000;
    }

    ol li {
        list-style-type: decimal;
        list-style-type: upper-roman;
    }

    .omniva-modal-content form {
        margin-bottom: 10px;
    }

    .omniva-search {
        position: relative;
    }

    .omniva-search form:after {
        content: "";
        clear: both;
        display: block;
    }

    .omniva-search form input {
        width: 100%;
        padding: 2px 10px;
        padding-right: 40px;
        border: 1px solid #555;
        border-radius: 3px;
        line-height: 30px;
        height: 36px;
        display: block;
        float: left;
        background-color: #ffffff;
    }

    .omniva-autocomplete {
        position: absolute;
        background: #fff;
        z-index: 9;
        border: 1px solid #ccc;
        top: 30px;
        max-width: 100%;
    }

    .omniva-autocomplete ul {
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .omniva-autocomplete ul li {
        cursor: pointer;
        padding: 5px;
        border-bottom: 1px solid #ccc;
        font-size: 14px;
    }

    .omniva-autocomplete ul li:nth-child(even) {
        background-color: #f5f5f5;
    }

    .omniva-autocomplete ul li:hover {
        background-color: #efefef;
        ;
    }

    @keyframes bounce {
        from {
            top: 0px;
        }

        to {
            top: -8px;
        }
    }

    @-webkit-keyframes bounce {
        from {
            top: 0px;
        }

        to {
            top: -8px;
        }
    }

    .omniva-map img.active {
        animation: bounce 0.7s infinite alternate;
        -webkit-animation: bounce 0.7s infinite alternate;
    }

    .omniva-back-to-list {
        cursor: pointer;
        padding: 2px 10px;
        width: auto;
        display: inline-block;
        font-size: 14px;
        position: relative;
        padding-left: 18px;
    }

    .omniva-back-to-list:before {
        content: "";
        display: block;
        width: 14px;
        height: 14px;
        top: 6px;
        left: 0px;
        /* background-image: url("../../../image/omniva/back.png"); */
        background-size: contain;
        position: absolute;
    }

    /**
* Terminal container
**/

    /* rounded bg-black text-sm p-2.5 text-white w-full block font-semibold uppercase gray-300 hover:bg-gray-800 duration-200 transition */

    /* .omniva-btn {


        border-radius: 3px;
        background-color: black;
        color: white;
        text-transform: uppercase;
        width: 100%;
        font-weight: 600;
        transition-duration: 0.2s;
        padding: 0.625rem 0.625rem;
        font-size: 0.875rem;

    } */

    .omniva-btn:hover {
        /* background-color: #1e293b; */
        background-color: #ddd;
    }

    .omniva-btn img {
        max-height: 20px;
        display: inline-block;
        right: 10px;
        position: absolute;
        /* top: 5px; */
        bottom: 0;
    }

    .omniva-terminal-container {
        position: relative;
        max-width: 500px;
    }

    .omniva-loading-overlay {
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
        z-index: 1000;
        border: none;
        margin: 0px;
        padding: 0px;
        background: rgb(255, 255, 255);
        opacity: 0.6;
        cursor: default;
    }

    .omniva-loading-overlay:before {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        content: "\f110";
        -webkit-animation: fa-spin .75s linear infinite;
        animation: fa-spin .75s linear infinite;
        height: 30px;
        width: 30px;
        line-height: 30px;
        font-size: 30px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -15px;
        margin-top: -15px;
        color: #EE3840;
    }

    /* omniva terminal selection */

    .omniva-terminals-list {
        position: relative;
        max-width: 500px;

    }

    .omniva-terminals-list .omniva-inner-container {
        position: absolute;
        background: #fff;
        z-index: 100;
        border: 1px solid #bbb;
        border-top: none;
        border-radius: 0 0 4px 4px;
        width: 100%;
    }

    .omniva-terminals-list .omniva-dropdown {
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        word-wrap: normal;
        overflow: hidden;
        height: 40px;
        line-height: 20px;
        width: 100%;
        position: relative;
        cursor: pointer;
        padding: 10px 20px 10px 5px;
        color: #aaa;
    }

    .omniva-terminals-list.open .omniva-dropdown {
        border-bottom: none;
        border-radius: 4px 4px 0 0;
    }

    .omniva-terminals-list .dropdown:before {
        position: absolute;
        content: "";
        right: 0px;
        width: 20px;
        height: 100%;
        top: 0;
        background-color: #fff;
    }

    .omniva-terminals-list .omniva-dropdown:after {
        position: absolute;
        content: "";
        border-color: #888 transparent transparent transparent;
        border-style: solid;
        border-width: 5px 4px 0 4px;
        height: 0;
        right: 7px;
        margin-left: -4px;
        margin-top: -2px;
        position: absolute;
        top: 50%;
        width: 0;
    }

    .omniva-terminals-list.open .omniva-dropdown:after {
        border-color: transparent transparent #888 transparent;
        border-width: 0px 4px 5px 4px;
    }

    .omniva-terminals-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
        height: 200px;
        overflow-y: auto;
    }

    .omniva-terminals-list ul li {
        background: none;
        border-radius: 0;
        border: none;
        padding: 3px 5px;
        margin: 0;
        cursor: pointer;
        line-height: 17px;
        font-size: 15px;
        padding-left: 10px;
    }

    .omniva-terminals-list ul li.omniva-city {
        font-weight: 600;
        padding-left: 5px;
    }

    .omniva-terminals-list ul li.selected {
        background-color: #ddd;
    }

    .omniva-terminals-list ul li a {
        text-decoration: underline;
    }

    .omniva-terminals-list ul li:hover a,
    .omniva-terminals-list ul li:hover {
        background-color: #0073aa;
        color: #ffffff;
    }

    .omniva-terminals-list .omniva-search-input[type='text']:focus,
    .omniva-terminals-list .omniva-search-input[type='text']:hover,
    .omniva-terminals-list .omniva-search-input[type='text']:active,
    .omniva-terminals-list .omniva-search-input[type='text'] {
        display: inline-block;
        padding: 2px 5px;
        width: 100%;
        border-bottom: 1px solid #ccc;
        margin-bottom: 4px;
        background-color: #4ade80;
        color: #ffffff;
    }

    .omniva-terminals-list .omniva-search-input::placeholder {
        /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: inherit;
        opacity: 1;
        /* Firefox */
    }

    .omniva-terminals-list .omniva-search-input:-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        color: inherit;
    }

    .omniva-terminals-list .omniva-search-input::-ms-input-placeholder {
        /* Microsoft Edge */
        color: inherit;
    }

    .omniva-terminals-list .omniva-show-more {
        padding: 5px;
        text-align: center;
    }

    /**
 * Media queries
 **/
    @media only screen and (max-width: 768px) {
        .omniva-modal-content {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .omniva-map-container {
            width: 100%;
            height: 50%;
        }

        .omniva-modal-body {
            padding: 0;
        }

        .omniva-found-terminals.omniva-scrollbar {
            max-height: 30vh;
        }

        .omniva-terminal-container {
            min-width: 170px;
        }

        .omniva-search input {
            width: calc(100% - 50px);
        }
    }

    @media only screen and (max-width: 808px) {
        .omniva-map-container {
            width: 99%;
            height: 30%;
            border: 1px solid black;
            background-color: lightgray;
        }

        .omniva-search-bar {
            width: 99%;
            margin-top: 5px;
            padding: 10px 10px 0px;
            overflow: hidden;
        }

        .omniva-scrollbar {
            overflow: auto;
            display: inline-block;
            vertical-align: top;
            height: inherit;
            max-height: 30vh;
            /* position: relative; */
            width: 100%;
            margin-top: 5px;
        }
    }

    @media screen and (min-width: 1500px) {
        .omniva-modal-content {
            z-index: 20;
            position: fixed;
            top: 10%;
            left: 15%;
            background-color: #fefefe;
            border-radius: 5px;
            width: 65%;
            height: 60%;
            -webkit-animation-name: slideIn;
            -webkit-animation-duration: 0.4s;
            animation-name: slideIn;
            animation-duration: 0.4s;
        }

        .omniva-scrollbar {
            max-height: 40vh;
        }
    }
</style>

<script>
    (function($, window) {
        window.omniva_version = (function() {
            return '1.1.1';
        }()); // global accesible Omniva version number
        $.fn.omniva = function(options) {
            var settings = $.extend({
                autoHide: false,
                maxShow: 8,
                showMap: true,
                country_code: 'LT',
                terminals: [],
                path_to_img: 'image/omniva/',
                selector_container: false, // false or HTMLElement
                callback: false,
                translate: null
            }, options);

            var defaultTranslate = {
                modal_header: 'Omniva terminals',
                search_bar_title: 'Omniva addresses',
                search_bar_placeholder: 'Enter postcode/address',
                search_back_to_list: 'Back to list',
                select_terminal: 'Choose terminal',
                show_on_map: 'Show on map',
                show_more: 'Show more',
                place_not_found: 'Place not found'
            }

            if (typeof options.translate !== 'undefined') {
                settings.translate = $.extend(defaultTranslate, settings.translate);
            } else {
                settings.translate = defaultTranslate;
            }

            //console.log('Omniva Initiated');

            var UI = {
                hook: $(this), // element thats been used to initialize omniva (normally radio button)
                // overlay used to show loading
                loader: $('<div class="omniva-loading-overlay" style="display: none;"></div>'),
                terminal_container: $('<div class="omniva-terminal-container" ' +
                    (settings.autoHide ? 'style = "display: none;"' : '') + '></div>'),
                container: $('<div class="omniva-terminals-list"></div>'),
                show_on_map_btn: $(
                    '<button type="button" class="omniva-btn ">' + settings.translate.show_on_map +
                    '  <img src="' + "{{asset('images/commerce/omniva/sasi.png')}}" + '" title="' + settings.translate.show_on_map + '">' +
                    '</button>'),
                dropdown: $('<div class="omniva-dropdown">' + settings.translate.select_terminal + '</div>'),
                search: $('<input type="text" placeholder="' + settings.translate.search_bar_placeholder + '" class="omniva-search-input"/>'),
                list: $('<ul></ul>'),
                showMapBtn: $('<li><a href="#" class="omniva-show-on-map">' + settings.translate.show_on_map + '</a></li>'),
                showMore: $('<div class="omniva-show-more"><a href="#">' + settings.translate.show_more + '</a></div>').hide(),
                innerContainer: $('<div class="omniva-inner-container"></div>').hide(),
                // map modal
                modal: $( // id="omnivaLtModal" 
                    '<div class="omniva-modal">' +
                    '  <div class="omniva-modal-content">' +
                    '    <div class="omniva-modal-header">' +
                    '      <span class="omniva-modal-close">&times;</span>' +
                    '      <h5>' + settings.translate.modal_header + '</h5>' +
                    '    </div>' +
                    '    <div class="omniva-modal-body">' +
                    '      <div class="omniva-map-container"></div>' +
                    '      <div class="omniva-search-bar">' +
                    '        <h4>' + settings.translate.search_bar_title + '</h4>' +
                    '        <div class="omniva-search">' +
                    '          <form>' +
                    '            <input type="text" placeholder="' + settings.translate.search_bar_placeholder + '" />' +
                    '            <button type="submit" class="omniva-modal-search-btn"></button>' +
                    '          </form>' +
                    '          <div class="omniva-autocomplete omniva-scrollbar" style="display:none;">' +
                    '            <ul></ul>' +
                    '          </div>' +
                    '        </div>' +
                    '        <div class="omniva-back-to-list" style="display:none;">' + settings.translate.search_back_to_list + '</div>' +
                    '        <div class="omniva-found-terminals omniva-scrollbar omniva-scrollbar-style-8">' +
                    '          <ul></ul>' +
                    '        </div>' +
                    '      </div>' +
                    '    </div>' +
                    '  </div>' +
                    '</div>')
            };

            var timeoutID = null;
            var currentLocationIcon = false;
            var searchTimeout = null;
            var terminalIcon = null;
            var homeIcon = null;
            var map = null;
            //var terminals = settings.terminals;
            var selected = false;
            var previous_list = false;
            var show_auto_complete = false;
            var uid = Math.random().toString(36).substr(2, 6);
            var clicked = false;

            updateSelection();

            UI.modal.appendTo(UI.terminal_container);
            if (settings.selector_container) {
                $(settings.selector_container).append(UI.terminal_container);
            } else {
                UI.terminal_container.insertAfter(UI.hook.parent());
            }
            UI.terminal_container.append(UI.loader, UI.container, UI.show_on_map_btn);
            UI.innerContainer.append(UI.search, UI.list, UI.showMore);
            UI.container.append(UI.dropdown, UI.innerContainer);

            // add images for css
            UI.modal.find('.omniva-back-to-list').css('background-image', 'url("' + `{{asset('images/commerce/omniva/back.png')}}` + '")');
            UI.modal.find('.omniva-modal-search-btn').css('background-image', 'url("' + `{{asset('images/commerce/omniva/search-w.png')}}` + '")');

            // Custom Events to update settings
            $(this).on('omniva.update.settings', function(e, new_settings) {
                if (typeof new_settings.translate !== 'undefined') { // there is changes to translate object
                    // we are dealing with shallow copy
                    var temp = $.extend({}, settings.translate);
                    settings = $.extend(settings, new_settings);
                    // merge old translation with new
                    settings.translate = $.extend(temp, new_settings.translate);
                } else {
                    settings = $.extend(settings, new_settings);
                }
            });

            // Custom Events to hide/show terminal selector
            $(this).on('omniva.show', function(e) {
                UI.terminal_container.show();
            });

            $(this).on('omniva.hide', function(e) {
                UI.terminal_container.hide();
            });

            // Custom Events to search by 
            $(this).on('omniva.postcode', function(e, postcode) {
                if (!postcode) {
                    return;
                }

                UI.search.val(postcode);
                findPosition(postcode, true);
            });

            $(this).on('omniva.select_terminal', function(e, id) {
                var selection = UI.list.find('li[data-id="' + id + '"]');
                if (selection.length > 0) {
                    UI.list.find('li').removeClass('selected');
                    selection.addClass('selected');
                    selectOption(selection);
                }
            });

            // Initialize leaflet map
            if (settings.showMap == true) {
                initMap();
            }

            // Generate terminal selector
            refreshList(false);

            // Show on map button to open modal
            UI.show_on_map_btn.on('click', function(e) {
                e.preventDefault();
                showModal();
            });

            // Show on map link inside dropdown
            UI.list.on('click', 'a.omniva-show-on-map', function(e) {
                e.preventDefault();
                showModal();
            });

            // Show more link inside dropdown
            UI.showMore.on('click', function(e) {
                e.preventDefault();
                showAll();
            });

            // Dropdown toggle
            UI.dropdown.on('click', function() {
                toggleDropdown();
            });

            // Debounce search input
            UI.search.on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    suggest(UI.search.val())
                }, 400);
            });

            // Prevent Enter button inside dropdown
            UI.search.on('keypress', function(event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });

            // clicking outside dropdown will close it
            $(document).on('mousedown', function(e) {
                if (!UI.container.is(e.target) && UI.container.has(e.target).length === 0 && UI.container.hasClass('open'))
                    toggleDropdown();
            });

            // back to list button
            UI.modal.find('.omniva-back-to-list').off('click').on('click', function() {
                listTerminals(settings.terminals, null);
                $(this).hide();
            });


            // initial search by something???
            //searchByAddress();


            function showModal() {
                settings.showMap = true;
                var searchInputEl = UI.modal.find('.omniva-search input');
                if (searchInputEl.val() !== UI.search.val()) {
                    searchInputEl.val(UI.search.val());
                    UI.modal.find('.omniva-search button').trigger('click');
                }
                if (selected != false) {
                    zoomTo(selected.pos, selected.id);
                }
                UI.modal.show();

                var event;
                if (typeof(Event) === 'function') {
                    event = new Event('resize');
                } else {
                    event = document.createEvent('Event');
                    event.initEvent('resize', true, true);
                }
                window.dispatchEvent(event);
            }

            // for dropdown functionality to show all the terminals
            function showAll() {
                UI.list.find('li').show();
                UI.showMore.hide();
            }

            // rebuilds terminal list inside map modal
            function refreshList(autoselect) {
                UI.modal.find('.omniva-back-to-list').hide();
                var city = false;
                var hide = false;
                var html = '';
                var foundTerminalsEl = UI.modal.find('.omniva-found-terminals');
                UI.list.html('');
                foundTerminalsEl.html('');
                $(settings.terminals).each(function(i, val) {
                    var li = $('<li></li>').attr({
                        'data-id': val[3],
                        'data-pos': '[' + [val[1], val[2]] + ']'
                    }).text(val[0]);
                    if (val['distance']) { // means we are searching
                        li.append(' <strong>' + val['distance'] + 'km</strong>');
                        hide = true;
                    }

                    html += '<li data-pos="[' + [val[1], val[2]] + ']" data-id="' + val[3] + '">' +
                        '  <div>' +
                        '    <a class="omniva-li">' + (i + 1) + '. <b>' + val[0] + ' ' + (val['distance'] ? val['distance'] + ' km.' : '') + '</b></a>' +
                        '    <div id="' + makeUID(val[3]) + '" class="omniva-details" style="display:none;">' +
                        '      <small>' + val[5] + '<br/>' + val[6] + '</small><br/>' +
                        '      <button type="button" class="omniva-select-terminal-btn" data-id="' + val[3] + '">' + settings.translate.select_terminal + '</button>' +
                        '    </div>' +
                        '  </div></li>';

                    if (selected != false && selected.id == val[3]) {
                        li.addClass('selected');
                    }
                    if (hide && /* counter */ (i + 1) > settings.maxShow) {
                        li.hide();
                    }
                    if (val[4] != city) {
                        var li_city = $('<li class = "omniva-city">' + val[4] + '</li>');
                        if (hide && /* counter */ (i + 1) > settings.maxShow) {
                            li_city.hide();
                        }
                        UI.list.append(li_city);
                        city = val[4];
                    }
                    UI.list.append(li);
                });
                UI.list.find('li').on('click', function() {
                    if (!$(this).hasClass('omniva-city')) {
                        UI.list.find('li').removeClass('selected');
                        $(this).addClass('selected');
                        clicked = true;
                        selectOption($(this));
                    }
                });
                if (autoselect == true) {
                    var first = UI.list.find('li:not(.omniva-city):first');
                    UI.list.find('li').removeClass('selected');
                    first.addClass('selected');
                    selectOption(first);
                }

                UI.list.scrollTop(0);
                if (settings.showMap == true) {
                    foundTerminalsEl.html('<ul class="omniva-terminals-listing" start="1">' + html + '</ul>');
                }
            }

            function selectOption(option) {
                selected = {
                    'id': option.attr('data-id'),
                    'text': option.text(),
                    'pos': JSON.parse(option.attr('data-pos')),
                    'distance': false
                };
                updateSelection();
                closeDropdown();
            }

            function updateSelection() {
                if (!selected) {
                    return;
                }

                UI.dropdown.html(selected.text);

                UI.hook.val(selected.id);
                if (settings.callback) {
                    settings.callback(selected.id, clicked);
                    clicked = false; // reset to default
                }
            }

            function toggleDropdown() {
                if (UI.container.hasClass('open')) {
                    UI.innerContainer.hide();
                    UI.container.removeClass('open')
                } else {
                    UI.innerContainer.show();
                    UI.innerContainer.find('.omniva-search-input').focus();
                    UI.container.addClass('open');
                }
            }

            function closeDropdown() {
                if (UI.container.hasClass('open')) {
                    UI.innerContainer.hide();
                    UI.container.removeClass('open')
                }
            }

            // sorts terminal list by title and resets distance
            function resetList() {
                settings.terminals.sort(function(a, b) {
                    a.distance = false;
                    b.distance = false;
                    return a[0].localeCompare(b[0]);
                });
            }

            function calculateDistance(y, x) {
                $.each(settings.terminals, function(key, location) {
                    distance = calcCrow(y, x, location[1], location[2]);
                    location['distance'] = distance.toFixed(2);
                });

                settings.terminals.sort(function(a, b) {
                    var distOne = a['distance'];
                    var distTwo = b['distance'];
                    return (parseFloat(distOne) - parseFloat(distTwo));
                });
            }

            function toRad(Value) {
                return Value * Math.PI / 180;
            }

            function calcCrow(lat1, lon1, lat2, lon2) {
                var R = 6371;
                var dLat = toRad(lat2 - lat1);
                var dLon = toRad(lon2 - lon1);
                var lat1 = toRad(lat1);
                var lat2 = toRad(lat2);

                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c;
                return d;
            }

            function resetSelector() {
                resetList();
                UI.showMore.hide();
                refreshList(false);
            }

            function findPosition(address, autoselect) {
                // reset list
                if (address == "") {
                    resetSelector();
                    return false;
                }

                if (address.length < 3) {
                    return false;
                }

                UI.loader.show();
                $.getJSON("https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/findAddressCandidates?" + prepAddress({
                    singleLine: address
                }) + "&sourceCountry=" + settings.country_code + "&category=&outFields=Postal&maxLocations=1&forStorage=false&f=pjson", function(data) {
                    if (data.candidates != undefined && data.candidates.length > 0) {
                        calculateDistance(data.candidates[0].location.y, data.candidates[0].location.x);
                        refreshList(autoselect);
                        UI.list.prepend(UI.showMapBtn);
                        UI.showMore.show();
                        if (settings.showMap == true) {
                            setCurrentLocation([data.candidates[0].location.y, data.candidates[0].location.x]);
                        }
                    }
                    UI.loader.hide();
                });
            }

            function suggest(address) {
                if (!address) {
                    resetSelector();
                    return;
                }
                if (address.length < 3) {
                    return;
                }
                $.getJSON("https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/suggest?" + prepAddress({
                    text: address
                }) + "&f=pjson&sourceCountry=" + settings.country_code + "&maxSuggestions=1", function(data) {
                    if (data.suggestions != undefined && data.suggestions.length > 0) {
                        findPosition(data.suggestions[0].text, false);
                    }
                });
            }

            // Prepares address for url (arcgis uses + instead of %20)
            function prepAddress(param) {
                return $.param(param).replace("%20", "+");
            }

            function initMap() {
                var mapEl = $('<div class="omniva-map"></div>')[0];
                UI.modal.find('.omniva-map-container').append(mapEl);
                if (settings.country_code == "LT") {
                    map = L.map(mapEl).setView([54.999921, 23.96472], 8);
                }
                if (settings.country_code == "LV") {
                    map = L.map(mapEl).setView([56.8796, 24.6032], 8);
                }
                if (settings.country_code == "EE") {
                    map = L.map(mapEl).setView([58.7952, 25.5923], 7);
                }
                L.tileLayer('https://maps.omnivasiunta.lt/tile/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.omniva.lt">Omniva</a>' +
                        ' | Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
                }).addTo(map);

                var Icon = L.Icon.extend({
                    options: {
                        iconSize: [29, 34],
                        iconAnchor: [15, 34],
                        popupAnchor: [-3, -76]
                    }
                });

                var Icon2 = L.Icon.extend({
                    options: {
                        iconSize: [32, 32],
                        iconAnchor: [16, 32]
                    }
                });


                terminalIcon = new Icon({
                    iconUrl: `{{asset('images/commerce/omniva/sasi.png')}}`
                });
                homeIcon = new Icon2({
                    iconUrl: `{{asset('images/commerce/omniva/locator_img.png')}}`
                });

                jQuery.each(settings.terminals, function(key, location) {
                    L.marker([location[1], location[2]], {
                            icon: terminalIcon,
                            terminalId: location[3]
                        })
                        .on('click', function(e) {
                            terminalDetails(this.options.terminalId);
                            listTerminals(settings.terminals, this.options.terminalId);
                        })
                        .addTo(map);
                });

                var omnivaSearchFormEl = UI.modal.find('.omniva-search form');
                var omnivaSearchInputEl = omnivaSearchFormEl.find('input');

                omnivaSearchInputEl.off('keyup focus').on('keyup focus', function() {
                    clearTimeout(timeoutID);
                    show_auto_complete = true;
                    timeoutID = setTimeout(function() {
                        autoComplete(omnivaSearchInputEl.val())
                    }, 500);
                });

                var autocompleteEl = UI.modal.find(".omniva-autocomplete");

                autocompleteEl.find('ul').off('click').on('click', 'li', function() {
                    omnivaSearchInputEl.val($(this).text());
                    omnivaSearchFormEl.trigger('submit');
                    autocompleteEl.hide();
                });

                // closes autocomplete inside modal
                UI.modal.click(function(e) {
                    if (!autocompleteEl.is(e.target) && autocompleteEl.has(e.target).length === 0) {
                        autocompleteEl.hide();
                    }
                });

                UI.modal.find('.omniva-modal-close').on('click', function() {
                    UI.modal.hide();
                });

                omnivaSearchFormEl.off('submit').on('submit', function(e) {
                    e.preventDefault();
                    var postcode = omnivaSearchInputEl.val();
                    UI.search.val(postcode); // send to search input outside modal
                    findPosition(postcode, false);
                    omnivaSearchInputEl.blur();
                    show_auto_complete = false;
                });

                var foundTerminalsEl = UI.modal.find('.omniva-found-terminals');

                foundTerminalsEl.on('click', 'li', function() {
                    zoomTo(JSON.parse($(this).attr('data-pos')), $(this).attr('data-id'));
                });

                foundTerminalsEl.on('click', 'li button', function() {
                    clicked = true;
                    terminalSelected($(this).attr('data-id'));
                });

                // populate current position
                //getLocation();
            }

            function autoComplete(address) {
                if (!show_auto_complete) {
                    return;
                }
                var autocompleteEl = UI.modal.find('.omniva-autocomplete');
                var autocompleteUlEl = autocompleteEl.find('ul');
                autocompleteUlEl.html('');
                autocompleteEl.hide();
                if (address == "" || address.length < 3) return false;

                $.getJSON("https://geocode.arcgis.com/arcgis/rest/services/World/GeocodeServer/suggest?" + prepAddress({
                    text: address
                }) + "&sourceCountry=" + settings.country_code + "&f=pjson&maxSuggestions=4", function(data) {
                    if (data.suggestions != undefined && data.suggestions.length > 0) {
                        $.each(data.suggestions, function(i, item) {
                            var li = $("<li data-magickey = '" + item.magicKey + "' data-text = '" + item.text + "'>" + item.text + "</li>");
                            autocompleteUlEl.append(li);
                        });
                    } else {
                        autocompleteUlEl.append('<li>' + settings.translate.place_not_found + '</li>');
                    }
                    autocompleteEl.show();
                });
            }

            function terminalDetails(id) {
                UI.modal.find('.omniva-details').hide();
                id = makeUID(id);
                dispOmniva = document.getElementById(id)
                if (dispOmniva) {
                    dispOmniva.style.display = 'block';
                }
            }

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(loc) {
                        if (selected == false) {
                            setCurrentLocation([loc.coords.latitude, loc.coords.longitude]);
                        }
                    });
                }
            }

            function setCurrentLocation(pos) {
                if (currentLocationIcon) {
                    map.removeLayer(currentLocationIcon);
                }
                currentLocationIcon = L.marker(pos, {
                    icon: homeIcon
                }).addTo(map);
                map.setView(pos, 16);
            }

            function listTerminals(locations, id) {
                // in case both are falsey ignore call
                if (id === null && !previous_list) {
                    return;
                }

                var foundTerminalsEl = UI.modal.find('.omniva-found-terminals');

                // return to previous list
                if (id === null && previous_list) {
                    foundTerminalsEl.empty().append(previous_list);
                    previous_list = false;
                    return;
                }

                if (id) {
                    //foundTerminalsEl.find('li').hide();
                    var terminal = foundTerminalsEl.find('li[data-id="' + id + '"]');
                    //terminal.show();
                    // update active marker if this is called from map
                    updateActiveMarker(id);
                    // check if activated terminal is in shown list
                    if (terminal.length > 0) {
                        terminal[0].scrollIntoView({
                            behavior: "smooth"
                        });
                        return;
                    } else {
                        // marker not on list, generate terminal info and enable back to list button
                        var html = '';
                        if (!previous_list) {
                            previous_list = foundTerminalsEl.find('.omniva-terminals-listing').detach();
                        }
                        UI.modal.find('.omniva-back-to-list').show();

                        for (var i = 0; i < locations.length; i++) {
                            if (locations[i][3] == id) {
                                html += '<li data-pos="[' + [locations[i][1], locations[i][2]] + ']" data-id="' + locations[i][3] + '" >' +
                                    '<div>' +
                                    '  <a class="omniva-li"><b>' + locations[i][0] + '</b></a>' +
                                    '  <div id="' + makeUID(locations[i][3]) + '" class="omniva-details">' +
                                    '  <small>' + locations[i][5] + ' <br/>' + locations[i][6] + '</small><br/>' +
                                    '  <button type="button" class="omniva-select-terminal-btn" data-id="' + locations[i][3] + '">' + settings.translate.select_terminal + '</button>' +
                                    '  </div>' +
                                    '</div></li>';
                                break;
                            }
                        }
                        foundTerminalsEl.empty().append($('<ul class="omniva-terminals-listing" start="1">' + html + '</ul>'));
                    }
                }
            }

            function makeUID(part) {
                return ['omniva', uid, part].join('-');
            }

            function zoomTo(pos, id) {
                terminalDetails(id);
                map.setView(pos, 14);
                updateActiveMarker(id);
            }

            function updateActiveMarker(id) {
                map.eachLayer(function(layer) {
                    if (layer.options.terminalId !== undefined && L.DomUtil.hasClass(layer._icon, "active")) {
                        L.DomUtil.removeClass(layer._icon, "active");
                    }
                    if (layer.options.terminalId == id) {
                        L.DomUtil.addClass(layer._icon, "active");
                    }
                });
            }

            function terminalSelected(terminal, close) {
                if (close === undefined) {
                    close = true;
                }

                for (var i = 0; i < settings.terminals.length; i++) {
                    if (settings.terminals[i][3] == terminal) {
                        selected = {
                            'id': terminal,
                            'text': settings.terminals[i][0],
                            'pos': [settings.terminals[i][1], settings.terminals[i][2]],
                            'distance': false
                        };
                        updateSelection();
                        break;
                    }
                }

                if (close) {
                    UI.modal.hide();
                }
            }

            return this;
        };

    }(jQuery, window));
</script>



@endsection