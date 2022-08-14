<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\MadePurchase;
use App\Models\Omniva;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeController extends Controller
{

    public function processStripeSuccess(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_KEY'));

        if (!session()->has('stripe_payment_intent')) {
            return back();
        }

        try {


            $payment_intent = $stripe->paymentIntents->capture(
                session()->get('stripe_payment_intent')
            );

            $data = $payment_intent['charges']['data'][0];

            // dd($data['metadata']['terminal_code']); //terminal code

            $customer = $stripe->customers->retrieve(
                $data['customer'],
                []
            );







            $terminals = array(
                0 =>
                array(
                    0 => 'Alytaus NORFA Topolių paštomatas (naujas!)',
                    1 => '54.396616',
                    2 => '24.028241',
                    3 => '88895',
                    4 => 'Alytus',
                    5 => 'Topolių g. 1, Alytus',
                    6 => 'Paštomatą rasite lauke prie sienos iš parkavimo aikštelės pusės',
                ),
                1 =>
                array(
                    0 => 'Alytaus PC ARENA paštomatas',
                    1 => '54.409792',
                    2 => '24.014968',
                    3 => '88854',
                    4 => 'Alytus',
                    5 => 'Naujoji g. 7E, Alytus',
                    6 => 'Paštomatą rasite lauke, prie pagrindinio įėjimo sienos dešiniojo kampo',
                ),
                2 =>
                array(
                    0 => 'Alytaus RIMI Pulko paštomatas',
                    1 => '54.387953',
                    2 => '24.043778',
                    3 => '88855',
                    4 => 'Alytus',
                    5 => 'Pulko g. 53A, Alytus',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į prekybos centrą, kairėje pusėje',
                ),
                3 =>
                array(
                    0 => 'Anykščių NORFA Vilniaus g. paštomatas',
                    1 => '55.522864',
                    2 => '25.098652',
                    3 => '88800',
                    4 => 'Anykščiai',
                    5 => 'Vilniaus g. 22, Anykščiai',
                    6 => 'Paštomatą rasite lauke, prie įėjimo iš Kudirkos g. dešinėje pusėje',
                ),
                4 =>
                array(
                    0 => 'Biržų NORFA paštomatas',
                    1 => '56.194351',
                    2 => '24.769201',
                    3 => '88866',
                    4 => 'Biržai',
                    5 => 'Respublikos g. 2E, Biržai',
                    6 => 'Paštomatą rasite prie pagrindinio parduotuvės įėjimo, kairėje pusėje',
                ),
                5 =>
                array(
                    0 => 'Druskininkų IKI Čiurlionio paštomatas',
                    1 => '54.011307',
                    2 => '23.990209',
                    3 => '88865',
                    4 => 'Druskininkai',
                    5 => 'Čiurlionio g. 107, Druskininkai',
                    6 => 'Paštomatą rasite lauke, prie dešiniosios prekybos centro sienos',
                ),
                6 =>
                array(
                    0 => 'Eišiškių NORFA paštomatas (naujas!)',
                    1 => '54.171456',
                    2 => '24.997282',
                    3 => '88896',
                    4 => 'Eišiškės',
                    5 => 'Vilniaus g. 19, Eišiškės',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                7 =>
                array(
                    0 => 'Elektrėnų MAXIMA paštomatas (naujas!)',
                    1 => '54.785283',
                    2 => '24.658095',
                    3 => '88853',
                    4 => 'Elektrėnai',
                    5 => 'Rungos g. 4, Elektrėnai',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                8 =>
                array(
                    0 => 'Gargždų NORFA paštomatas',
                    1 => '55.712518',
                    2 => '21.380646',
                    3 => '88801',
                    4 => 'Gargždai',
                    5 => 'Klaipėdos g. 41, Gargždai',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                9 =>
                array(
                    0 => 'Garliavos NORFA paštomatas',
                    1 => '54.829127',
                    2 => '23.873354',
                    3 => '88876',
                    4 => 'Kaunas',
                    5 => 'Atgimimo g. 1, Jonučių k., Kauno raj. (Garliava)',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                10 =>
                array(
                    0 => 'Ignalinos NORFA paštomatas',
                    1 => '55.342599',
                    2 => '26.170579',
                    3 => '88802',
                    4 => 'Ignalina',
                    5 => 'Taikos g. 20, Ignalina',
                    6 => 'Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo',
                ),
                11 =>
                array(
                    0 => 'Jonavos NORFA Žeimių paštomatas (naujas!)',
                    1 => '55.084468',
                    2 => '24.273708',
                    3 => '88897',
                    4 => 'Jonava',
                    5 => 'Žeimių g. 26A, Jonava ',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į prekybos centrą pusėje',
                ),
                12 =>
                array(
                    0 => 'Jonavos RIMI paštomatas',
                    1 => '55.073180',
                    2 => '24.276370',
                    3 => '88867',
                    4 => 'Jonava',
                    5 => 'Vasario 16-osios g. 4, Jonava',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo pusėje',
                ),
                13 =>
                array(
                    0 => 'Joniškio NORFA paštomatas (naujas!)',
                    1 => '56.228109',
                    2 => '23.604877',
                    3 => '88803',
                    4 => 'Joniškis',
                    5 => 'Vilniaus g. 47B, Joniškis',
                    6 => 'Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo prie sienos',
                ),
                14 =>
                array(
                    0 => 'Jurbarko MAXIMA CENTRO paštomatas',
                    1 => '55.077400',
                    2 => '22.767105',
                    3 => '88864',
                    4 => 'Jurbarkas',
                    5 => 'Dariaus ir Girėno g. 66, Jurbarkas',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į parduotuvę, dešinėje pusėje',
                ),
                15 =>
                array(
                    0 => 'Kaišiadorių RIMI paštomatas',
                    1 => '54.856120',
                    2 => '24.443715',
                    3 => '88804',
                    4 => 'Kaišiadorys',
                    5 => 'Gedimino g. 115A, Kaišiadorys',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                16 =>
                array(
                    0 => 'Kauno EXPRESS MARKET Vytauto paštomatas (naujas!)',
                    1 => '54.888035',
                    2 => '23.928545',
                    3 => '77749',
                    4 => 'Kaunas',
                    5 => 'Vytauto pr. 11, Kaunas',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                17 =>
                array(
                    0 => 'Kauno IKI Girstučio paštomatas',
                    1 => '54.905754',
                    2 => '23.974659',
                    3 => '88875',
                    4 => 'Kaunas',
                    5 => 'Kovo 11-osios g. 22, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                18 =>
                array(
                    0 => 'Kauno IKI Ramučių paštomatas (naujas!)',
                    1 => '54.954106',
                    2 => '24.031702',
                    3 => '88898',
                    4 => 'Kaunas',
                    5 => 'Centrinė g. 56, Ramučiai',
                    6 => 'Paštomatą rasite lauke prie sienos iš Plento g. pusės',
                ),
                19 =>
                array(
                    0 => 'Kauno IKI Sukilėlių paštomatas',
                    1 => '54.925103',
                    2 => '23.929296',
                    3 => '88829',
                    4 => 'Kaunas',
                    5 => 'Sukilėlių pr. 84, Kaunas',
                    6 => 'Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje, prie kampo',
                ),
                20 =>
                array(
                    0 => 'Kauno IKI Varnių paštomatas (naujas!)',
                    1 => '54.914537',
                    2 => '23.896816',
                    3 => '77700',
                    4 => 'Kaunas',
                    5 => 'Varnių g. 38A, Kaunas',
                    6 => 'Paštomatą rasite lauke prie sienos iš Varnių g. pusės',
                ),
                21 =>
                array(
                    0 => 'Kauno IKI Veiverių paštomatas',
                    1 => '54.862465',
                    2 => '23.885950',
                    3 => '88830',
                    4 => 'Kaunas',
                    5 => 'Veiverių g. 150A, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie sienos iš Lazdijų gatvės pusės',
                ),
                22 =>
                array(
                    0 => 'Kauno MAXIMA Masiulio paštomatas',
                    1 => '54.885979',
                    2 => '24.005189',
                    3 => '88883',
                    4 => 'Kaunas',
                    5 => 'T.Masiulio g. 16E, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                23 =>
                array(
                    0 => 'Kauno MAXIMA Ringaudų paštomatas (naujas!)',
                    1 => '54.888170',
                    2 => '23.799512',
                    3 => '77701',
                    4 => 'Kaunas',
                    5 => 'Gėlių g. 2B, Ringaudai, Kauno raj.',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                24 =>
                array(
                    0 => 'Kauno PC AKROPOLIS paštomatas',
                    1 => '54.890926',
                    2 => '23.919338',
                    3 => '88863',
                    4 => 'Kaunas',
                    5 => 'Karaliaus Mindaugo pr. 49, Kaunas',
                    6 => 'Paštomatą rasite lauke, 1-ame stovėjimo aikštelės aukšte, I-A įėjimas',
                ),
                25 =>
                array(
                    0 => 'Kauno PC MOLAS paštomatas (naujas!)',
                    1 => '54.899461',
                    2 => '23.966459',
                    3 => '77702',
                    4 => 'Kaunas',
                    5 => 'Baršausko g. 66, Kaunas',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje pagrindinio įėjimo į prekybos centrą pusėje',
                ),
                26 =>
                array(
                    0 => 'Kauno PC RIVER MALL paštomatas',
                    1 => '54.903282',
                    2 => '23.898021',
                    3 => '88827',
                    4 => 'Kaunas',
                    5 => 'Jonavos g. 60, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie pagrindinio įėjimo į prekybos centrą, dešinėje pusėje',
                ),
                27 =>
                array(
                    0 => 'Kauno PLC MEGA paštomatas',
                    1 => '54.939289',
                    2 => '23.889493',
                    3 => '88881',
                    4 => 'Kaunas',
                    5 => 'Islandijos pl. 32, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie Rimi iėjimo iš Islandijos pl. pusės',
                ),
                28 =>
                array(
                    0 => 'Kauno PM URMAS paštomatas (naujas!)',
                    1 => '54.916459',
                    2 => '23.987895',
                    3 => '77703',
                    4 => 'Kaunas',
                    5 => 'Pramonės pr. 16, Kaunas',
                    6 => 'Paštomatą rasite įvažiavę per 1C vartus prie Vakarinės galerijos esančio traukinio',
                ),
                29 =>
                array(
                    0 => 'Kauno RIMI Baltijos paštomatas (naujas!)',
                    1 => '54.920636',
                    2 => '23.879736',
                    3 => '77704',
                    4 => 'Kaunas',
                    5 => 'Baltijos g. 58, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                30 =>
                array(
                    0 => 'Kauno RIMI Europos paštomatas',
                    1 => '54.875631',
                    2 => '23.912434',
                    3 => '88882',
                    4 => 'Kaunas',
                    5 => 'Europos pr. 43, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                31 =>
                array(
                    0 => 'Kauno RIMI Juozapavičiaus paštomatas (naujas!)',
                    1 => '54.865108',
                    2 => '23.945435',
                    3 => '77705',
                    4 => 'Kaunas',
                    5 => 'A.Juozapavičiaus pr. 11, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                32 =>
                array(
                    0 => 'Kauno RIMI Krėvės paštomatas',
                    1 => '54.917362',
                    2 => '23.966171',
                    3 => '88836',
                    4 => 'Kaunas',
                    5 => 'V.Krėvės pr. 43A, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į prekybos centrą, kairėje pusėje',
                ),
                33 =>
                array(
                    0 => 'Kauno RIMI Raudondvario paštomatas',
                    1 => '54.908863',
                    2 => '23.865946',
                    3 => '88874',
                    4 => 'Kaunas',
                    5 => 'Raudondvario pl. 94B, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                34 =>
                array(
                    0 => 'Kauno RIMI Romainių paštomatas (naujas!)',
                    1 => '54.942779',
                    2 => '23.813154',
                    3 => '77706',
                    4 => 'Kaunas',
                    5 => 'Romainių g. 67C, Kaunas',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                35 =>
                array(
                    0 => 'Kauno RIMI Savanorių paštomatas',
                    1 => '54.919866',
                    2 => '23.950340',
                    3 => '88884',
                    4 => 'Kaunas',
                    5 => 'Savanorių pr. 321, Kaunas',
                    6 => 'Paštomatą rasite lauke, kairėje prekybos centro pusėje, prie sienos (netoli taromato)',
                ),
                36 =>
                array(
                    0 => 'Kauno ŠILAS Baltų paštomatas',
                    1 => '54.929909',
                    2 => '23.884138',
                    3 => '88828',
                    4 => 'Kaunas',
                    5 => 'Baltų pr. 18, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į prekybos centrą, dešinėje pusėje',
                ),
                37 =>
                array(
                    0 => 'Kauno ŠILAS Baranausko paštomatas',
                    1 => '54.909679',
                    2 => '23.956289',
                    3 => '88831',
                    4 => 'Kaunas',
                    5 => 'Baranausko g. 26, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į prekybos centrą, kairėje pusėje',
                ),
                38 =>
                array(
                    0 => 'Kauno ŠILAS Juozapavičiaus paštomatas',
                    1 => '54.875175',
                    2 => '23.935797',
                    3 => '88832',
                    4 => 'Kaunas',
                    5 => 'Juozapavičiaus pr. 81A, Kaunas',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į prekybos centrą, dešinėje pusėje',
                ),
                39 =>
                array(
                    0 => 'Kauno ŠILAS Vandžiogalos paštomatas (naujas!)',
                    1 => '54.945303',
                    2 => '23.882493',
                    3 => '77708',
                    4 => 'Kaunas',
                    5 => 'Vandžiogalos g. 22, Kaunas',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                40 =>
                array(
                    0 => 'Kauno ŠILAS Škirpos paštomatas (naujas!)',
                    1 => '54.930214',
                    2 => '23.943344',
                    3 => '77707',
                    4 => 'Kaunas',
                    5 => 'K.Škirpos g. 17, Kaunas',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                41 =>
                array(
                    0 => 'Kazlų Rūdos MAXIMA paštomatas (naujas!)',
                    1 => '54.751543',
                    2 => '23.493343',
                    3 => '77739',
                    4 => 'Kazlų Rūda',
                    5 => 'M.Valančiaus g. 7, Kazlų Rūda',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                42 =>
                array(
                    0 => 'Kelmės MAXIMA Vytauto Didžiojo paštomatas',
                    1 => '55.630016',
                    2 => '22.930844',
                    3 => '88805',
                    4 => 'Kelmė',
                    5 => 'Vytauto Didžiojo g. 49, Kelmė',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                43 =>
                array(
                    0 => 'Klaipėdos HERKAUS GALERIJA paštomatas (naujas!)',
                    1 => '55.715246',
                    2 => '21.130175',
                    3 => '77742',
                    4 => 'Klaipėda',
                    5 => 'H.Manto g. 22, Klaipėda',
                    6 => 'Paštomatą rasite laukeprie sienos iš Ligoninės g. pusės',
                ),
                44 =>
                array(
                    0 => 'Klaipėdos MAXIMA Šilutės pl. 68 paštomatas',
                    1 => '55.676559',
                    2 => '21.189166',
                    3 => '88885',
                    4 => 'Klaipėda',
                    5 => 'Šilutės pl. 68, Klaipėda',
                    6 => 'Paštomatą rasite lauke, kairėje prekybos centro pusėje, prie sienos (netoli taromato)',
                ),
                45 =>
                array(
                    0 => 'Klaipėdos NORFA Tauralaukio paštomatas',
                    1 => '55.753584',
                    2 => '21.142858',
                    3 => '88877',
                    4 => 'Klaipėda',
                    5 => 'Tauralaukio g. 1, Klaipėda',
                    6 => 'Paštomatą rasite lauke, prie pastato sienos po stogu',
                ),
                46 =>
                array(
                    0 => 'Klaipėdos NORFA Vingio paštomatas',
                    1 => '55.668081',
                    2 => '21.195697',
                    3 => '88872',
                    4 => 'Klaipėda',
                    5 => 'Vingio g. 21A, Klaipėda ',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                47 =>
                array(
                    0 => 'Klaipėdos PC ARENA paštomatas',
                    1 => '55.687225',
                    2 => '21.155785',
                    3 => '88837',
                    4 => 'Klaipėda',
                    5 => 'Taikos pr. 64, Klaipėda',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į Rimi, kairėje pusėje',
                ),
                48 =>
                array(
                    0 => 'Klaipėdos PC BIG1 paštomatas',
                    1 => '55.664533',
                    2 => '21.177448',
                    3 => '88841',
                    4 => 'Klaipėda',
                    5 => 'Taikos pr. 139, Klaipėda',
                    6 => 'Paštomatą rasite lauke, prie prie sienos, pėsčiųjų alėjoje tarp BIG1 ir BIG2',
                ),
                49 =>
                array(
                    0 => 'Klaipėdos PC STUDLENDAS paštomatas',
                    1 => '55.729055',
                    2 => '21.125150',
                    3 => '88839',
                    4 => 'Klaipėda',
                    5 => 'H.Manto g. 90, Klaipėda',
                    6 => 'Paštomatą rasite lauke, dešinėje įėjimo į IKI pusėje, iš Šiaurės pr. pusės',
                ),
                50 =>
                array(
                    0 => 'Klaipėdos RIMI Slengių paštomatas (naujas!)',
                    1 => '55.736771',
                    2 => '21.191771',
                    3 => '77710',
                    4 => 'Slengiai',
                    5 => 'Dangaus g. 34, Slengiai',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į prekybos centrą pusėje',
                ),
                51 =>
                array(
                    0 => 'Klaipėdos TECHNORAMA paštomatas',
                    1 => '55.698207',
                    2 => '21.149172',
                    3 => '88873',
                    4 => 'Klaipėda',
                    5 => 'Taikos pr. 39, Klaipėda',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į parduotuvę pusėje',
                ),
                52 =>
                array(
                    0 => 'Klaipėdos VIADA Priestočio paštomatas',
                    1 => '55.719124',
                    2 => '21.141022',
                    3 => '88838',
                    4 => 'Klaipėda',
                    5 => 'Priestočio g. 28, Klaipėda',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į parduotuvę, dešinėje pusėje',
                ),
                53 =>
                array(
                    0 => 'Kretingos MAXIMA Rotušės paštomatas',
                    1 => '55.889772',
                    2 => '21.240982',
                    3 => '88806',
                    4 => 'Kretinga',
                    5 => 'Rotušės a. 15, Kretinga',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                54 =>
                array(
                    0 => 'Kretingos NORFA paštomatas (naujas!)',
                    1 => '55.892317',
                    2 => '21.232706',
                    3 => '88893',
                    4 => 'Kretinga',
                    5 => 'Šventosios g. 25H, Kretinga ',
                    6 => 'Paštomatą rasite lauke prie sienos iš parkavimo aikštelės pusės',
                ),
                55 =>
                array(
                    0 => 'Kupiškio NORFA Purėno paštomatas (naujas!)',
                    1 => '55.836188',
                    2 => '24.993760',
                    3 => '77740',
                    4 => 'Kupiškis',
                    5 => 'A.Purėno g. 1, Kupiškis ',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                56 =>
                array(
                    0 => 'Kuršėnų MAXIMA Vilniaus g. paštomatas',
                    1 => '56.000438',
                    2 => '22.949599',
                    3 => '88886',
                    4 => 'Kuršėnai',
                    5 => 'Vilniaus g. 43, Kuršėnai',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                57 =>
                array(
                    0 => 'Kėdainių MAXIMA Basanavičiaus 93 paštomatas',
                    1 => '55.277651',
                    2 => '23.959059',
                    3 => '88861',
                    4 => 'Kėdainiai',
                    5 => 'J.Basanavičiaus g. 93, Kėdainiai',
                    6 => 'Paštomatą rasite lauke, kairėje prekybos centro dalyje, prie sienos, po iškabomis',
                ),
                58 =>
                array(
                    0 => 'Kėdainių MAXIMA Dariaus ir Girėno paštomatas (naujas!)',
                    1 => '55.308916',
                    2 => '23.979144',
                    3 => '77709',
                    4 => 'Kėdainiai',
                    5 => 'S.Dariaus ir S.Girėno g. 50A, Kėdainiai',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                59 =>
                array(
                    0 => 'Lazdijų NORFA paštomatas',
                    1 => '54.238926',
                    2 => '23.511757',
                    3 => '88807',
                    4 => 'Lazdijai',
                    5 => 'Dzūkų g. 3, Lazdijai',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                60 =>
                array(
                    0 => 'Lentvario IKI paštomatas (naujas!)',
                    1 => '54.644033',
                    2 => '25.046481',
                    3 => '77731',
                    4 => 'Lentvaris',
                    5 => 'Geležinkelio g. 38, Lentvaris',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                61 =>
                array(
                    0 => 'Marijampolės MAXIMA Bažnyčios paštomatas',
                    1 => '54.556047',
                    2 => '23.346449',
                    3 => '88899',
                    4 => 'Marijampolė',
                    5 => 'Bažnyčios g. 38, Marijampolė',
                    6 => 'Paštomatą rasite lauke prie sienos iš Laisvės g. pusės',
                ),
                62 =>
                array(
                    0 => 'Marijampolės PC ARENA paštomatas',
                    1 => '54.560951',
                    2 => '23.354530',
                    3 => '88856',
                    4 => 'Marijampolė',
                    5 => 'Dariaus ir Girėno g. 3A, Marijampolė',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į JYSK kairėje pusėje',
                ),
                63 =>
                array(
                    0 => 'Mažeikių IKI Ventos paštomatas (naujas!)',
                    1 => '56.308940',
                    2 => '22.324078',
                    3 => '77711',
                    4 => 'Mažeikiai',
                    5 => 'Ventos g. 10B, Mažeikiai',
                    6 => 'Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje, už kampo prie sienos',
                ),
                64 =>
                array(
                    0 => 'Mažeikių PC EIFELIS paštomatas',
                    1 => '56.299740',
                    2 => '22.353653',
                    3 => '88857',
                    4 => 'Mažeikiai',
                    5 => 'Žemaitijos g. 72, Mažeikiai',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į NORFA, kairėje pusėje',
                ),
                65 =>
                array(
                    0 => 'Molėtų NORFA paštomatas (naujas!)',
                    1 => '55.224777',
                    2 => '25.405258',
                    3 => '77712',
                    4 => 'Molėtai',
                    5 => 'Vilniaus g. 99, Molėtai',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                66 =>
                array(
                    0 => 'Naujosios Akmenės NORFA paštomatas (naujas!)',
                    1 => '56.319508',
                    2 => '22.873342',
                    3 => '88808',
                    4 => 'Naujoji Akmenė',
                    5 => 'Respublikos g. 30, Naujoji Akmenė',
                    6 => 'Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo prie sienos',
                ),
                67 =>
                array(
                    0 => 'Pabradės NORFA paštomatas (naujas!)',
                    1 => '54.979590',
                    2 => '25.755895',
                    3 => '77713',
                    4 => 'Pabradė',
                    5 => 'Molėtų g. 4A, Pabradė',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                68 =>
                array(
                    0 => 'Pakruojo NORFA paštomatas (naujas!)',
                    1 => '55.979951',
                    2 => '23.856885',
                    3 => '77714',
                    4 => 'Pakruojis',
                    5 => 'Statybininkų g. 2A, Pakruojis',
                    6 => 'Paštomatą rasite lauke, prie parduotuvės sienos',
                ),
                69 =>
                array(
                    0 => 'Palangos RIMI paštomatas',
                    1 => '55.921020',
                    2 => '21.075963',
                    3 => '88870',
                    4 => 'Palanga',
                    5 => 'Malūno g. 10, Palanga',
                    6 => 'Paštomatą rasite lauke, kairėje įėjimo pusėje, iš Klaipėdos pl. pusės',
                ),
                70 =>
                array(
                    0 => 'Panevėžio MAXIMA LĖVUO paštomatas',
                    1 => '55.729027',
                    2 => '24.324492',
                    3 => '88849',
                    4 => 'Panevėžys',
                    5 => 'Klaipėdos g. 103, Panevėžys',
                    6 => 'Paštomatą rasite lauke, prie įejimo į Maxima, dešinėje pusėje',
                ),
                71 =>
                array(
                    0 => 'Panevėžio MAXIMA TURGAUS paštomatas',
                    1 => '55.728699',
                    2 => '24.370111',
                    3 => '88847',
                    4 => 'Panevėžys',
                    5 => 'Ukmergės g. 23, Panevėžys',
                    6 => 'Paštomatą rasite lauke, kairėje įėjimo į Maxima pusėje, prie kampo',
                ),
                72 =>
                array(
                    0 => 'Panevėžio NORFA Beržų paštomatas (naujas!)',
                    1 => '55.718296',
                    2 => '24.371654',
                    3 => '77715',
                    4 => 'Panevėžys',
                    5 => 'Beržų g. 27, Panevėžys ',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                73 =>
                array(
                    0 => 'Panevėžio NORFA Smėlynės paštomatas (naujas!)',
                    1 => '55.744796',
                    2 => '24.369838',
                    3 => '77716',
                    4 => 'Panevėžys',
                    5 => 'Smėlynės g. 85, Panevėžys',
                    6 => 'Paštomatą rasite lauke, prie parduotuvės sienos',
                ),
                74 =>
                array(
                    0 => 'Panevėžio RIMI paštomatas',
                    1 => '55.728561',
                    2 => '24.342098',
                    3 => '88846',
                    4 => 'Panevėžys',
                    5 => 'Klaipėdos g. 82, Panevėžys',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į prekybos centrą kairėje pusėje',
                ),
                75 =>
                array(
                    0 => 'Pasvalio NORFA paštomatas',
                    1 => '56.059471',
                    2 => '24.410913',
                    3 => '88809',
                    4 => 'Pasvalys',
                    5 => 'Ežero g. 1, Pasvalys',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                76 =>
                array(
                    0 => 'Plungės IKI Laisvės paštomatas (naujas!)',
                    1 => '55.908829',
                    2 => '21.857685',
                    3 => '88894',
                    4 => 'Plungė',
                    5 => 'Laisvės g. 5, Plungė',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į turgų pusėje',
                ),
                77 =>
                array(
                    0 => 'Plungės NORFA Kalniškių paštomatas',
                    1 => '55.904872',
                    2 => '21.844950',
                    3 => '88810',
                    4 => 'Plungė',
                    5 => 'Kalniškių g. 18, Plungė',
                    6 => 'Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje, už kampo prie sienos',
                ),
                78 =>
                array(
                    0 => 'Prienų NORFA paštomatas',
                    1 => '54.643128',
                    2 => '23.944950',
                    3 => '88812',
                    4 => 'Prienai',
                    5 => 'Revuonos g. 66, Prienai',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                79 =>
                array(
                    0 => 'Radviliškio IKI paštomatas',
                    1 => '55.813206',
                    2 => '23.547457',
                    3 => '88817',
                    4 => 'Radviliškis',
                    5 => 'Gedimino g. 31B, Radviliškis',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                80 =>
                array(
                    0 => 'Raseinių MAXIMA Maironio paštomatas',
                    1 => '55.386357',
                    2 => '23.126401',
                    3 => '88819',
                    4 => 'Raseiniai',
                    5 => 'Maironio g. 64, Raseiniai',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                81 =>
                array(
                    0 => 'Rietavo MAXIMA paštomatas (naujas!)',
                    1 => '55.724309',
                    2 => '21.932529',
                    3 => '77717',
                    4 => 'Rietavas',
                    5 => 'Plungės g. 2, Rietavas',
                    6 => 'Paštomatą rasite lauke prie sienos, galinėje parduotuvės pastato dalyje',
                ),
                82 =>
                array(
                    0 => 'Rokiškio NORFA Panevėžio g. paštomatas',
                    1 => '55.947342',
                    2 => '25.589039',
                    3 => '88821',
                    4 => 'Rokiškis',
                    5 => 'Panevėžio g. 1D, Rokiškis',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                83 =>
                array(
                    0 => 'Skuodo MAXIMA Mosėdžio paštomatas (naujas!)',
                    1 => '56.267776',
                    2 => '21.531389',
                    3 => '77718',
                    4 => 'Skuodas',
                    5 => 'Mosėdžio g. 2, Skuodas',
                    6 => 'Paštomatą rasite lauke prie sienos iš Mosėdžio g. pusės',
                ),
                84 =>
                array(
                    0 => 'Tauragės NORFA Gedimino paštomatas',
                    1 => '55.251360',
                    2 => '22.298812',
                    3 => '88851',
                    4 => 'Tauragė',
                    5 => 'Gedimino g. 28, Tauragė',
                    6 => 'Paštomatą rasite lauke, prie prekybos centro sienos',
                ),
                85 =>
                array(
                    0 => 'Telšių NORFA Gedimino paštomatas',
                    1 => '55.981785',
                    2 => '22.238605',
                    3 => '88868',
                    4 => 'Telšiai',
                    5 => 'Gedimino g. 8, Telšiai',
                    6 => 'Paštomatą rasite prie pagrindinio įėjimo, dešinėje pusėje',
                ),
                86 =>
                array(
                    0 => 'Telšių PC TULPĖ paštomatas  (naujas!)',
                    1 => '55.983917',
                    2 => '22.249697',
                    3 => '88891',
                    4 => 'Telšiai',
                    5 => 'Kęstučio g. 4, Telšiai',
                    6 => 'Paštomatą rasite prie pagrindinio įėjimo, kairėje pusėje',
                ),
                87 =>
                array(
                    0 => 'Trakų NORFA paštomatas (naujas!)',
                    1 => '54.627344',
                    2 => '24.945533',
                    3 => '77724',
                    4 => 'Trakai',
                    5 => 'Vilniaus g. 15C, Trakai',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                88 =>
                array(
                    0 => 'Ukmergės IKI Vilniaus g. paštomatas',
                    1 => '55.244184',
                    2 => '24.773200',
                    3 => '88892',
                    4 => 'Ukmergė',
                    5 => 'Vilniaus g. 62, Ukmergė',
                    6 => 'Paštomatą rasite lauke prie sienos, netoli taromato',
                ),
                89 =>
                array(
                    0 => 'Ukmergės MAXIMA Žiedo paštomatas',
                    1 => '55.242752',
                    2 => '24.743786',
                    3 => '88869',
                    4 => 'Ukmergė',
                    5 => 'Žiedo g. 1, Ukmergė',
                    6 => 'Paštomatą rasite įėjimo į parduotuvę, kairėje pusėje',
                ),
                90 =>
                array(
                    0 => 'Utenos RIMI-SENUKAI paštomatas',
                    1 => '55.498111',
                    2 => '25.596356',
                    3 => '88860',
                    4 => 'Utena',
                    5 => 'J.Basanavičiaus g. 52, Utena',
                    6 => 'Paštomatą rasite lauke, prie prekybos centro sienos iš autobusų stoties pusės',
                ),
                91 =>
                array(
                    0 => 'Varėnos IKI paštomatas',
                    1 => '54.215309',
                    2 => '24.563934',
                    3 => '88834',
                    4 => 'Varėna',
                    5 => 'Sporto g. 1, Varėna',
                    6 => 'Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo prie sienos',
                ),
                92 =>
                array(
                    0 => 'Vilkaviškio NORFA Nepriklausomybės paštomatas',
                    1 => '54.658606',
                    2 => '23.030233',
                    3 => '88835',
                    4 => 'Vilkaviškis',
                    5 => 'Nepriklausomybės g. 61, Vilkaviškis',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                93 =>
                array(
                    0 => 'Vilniaus CUP paštomatas',
                    1 => '54.694023',
                    2 => '25.276537',
                    3 => '88871',
                    4 => 'Vilnius',
                    5 => 'Upės g. 9,  Vilnius',
                    6 => 'Paštomatą rasite kairėje 3-ojo auktšo įėjimo pusėje, šalia automobilių stovėjimo aikštelės',
                ),
                94 =>
                array(
                    0 => 'Vilniaus IKI Bajorų paštomatas (naujas!)',
                    1 => '54.754746',
                    2 => '25.261674',
                    3 => '77744',
                    4 => 'Vilnius',
                    5 => 'Bajorų kel. 4, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                95 =>
                array(
                    0 => 'Vilniaus IKI Buivydiškių g. paštomatas (naujas!)',
                    1 => '54.713529',
                    2 => '25.238532',
                    3 => '77725',
                    4 => 'Vilnius',
                    5 => 'Buivydiškių g. 17, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje, už taromato',
                ),
                96 =>
                array(
                    0 => 'Vilniaus IKI Didlaukio paštomatas',
                    1 => '54.728806',
                    2 => '25.269791',
                    3 => '88850',
                    4 => 'Vilnius',
                    5 => 'Didlaukio g. 80A, Vilnius',
                    6 => 'Paštomatą rasite lauke, parkinge iš Baltupio g. pusės, prie sienos',
                ),
                97 =>
                array(
                    0 => 'Vilniaus IKI Jeruzalės paštomatas',
                    1 => '54.743055',
                    2 => '25.278166',
                    3 => '88862',
                    4 => 'Vilnius',
                    5 => 'Jeruzalės g. 17, Vilnius',
                    6 => 'Paštomatą rasite lauke, už kampo prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                98 =>
                array(
                    0 => 'Vilniaus IKI Saulėtekio paštomatas (naujas!)',
                    1 => '54.725016',
                    2 => '25.342257',
                    3 => '77748',
                    4 => 'Vilnius',
                    5 => 'Saulėtekio al. 43, Vilnius ',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje, po laiptais',
                ),
                99 =>
                array(
                    0 => 'Vilniaus IKI Stanevičiaus paštomatas (naujas!)',
                    1 => '54.723732',
                    2 => '25.255186',
                    3 => '77727',
                    4 => 'Vilnius',
                    5 => 'S.Stanevičiaus g. 23, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje pagrindinio įėjimo į parduotuvę pusėje',
                ),
                100 =>
                array(
                    0 => 'Vilniaus IKI Šeškinės paštomatas',
                    1 => '54.715581',
                    2 => '25.245704',
                    3 => '88852',
                    4 => 'Vilnius',
                    5 => 'Šeškinės g. 32, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                101 =>
                array(
                    0 => 'Vilniaus MAXIMA Antakalnio paštomatas (naujas!)',
                    1 => '54.715310',
                    2 => '25.316520',
                    3 => '77728',
                    4 => 'Vilnius',
                    5 => 'Antakalnio g. 75A, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                102 =>
                array(
                    0 => 'Vilniaus MAXIMA Architektų paštomatas (naujas!)',
                    1 => '54.683020',
                    2 => '25.213188',
                    3 => '77729',
                    4 => 'Vilnius',
                    5 => 'Architektų g. 152, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, dešinėje įėjimo į parduotuvę pusėje',
                ),
                103 =>
                array(
                    0 => 'Vilniaus MAXIMA Grigiškių paštomatas',
                    1 => '54.670192',
                    2 => '25.098794',
                    3 => '88888',
                    4 => 'Vilnius',
                    5 => 'Kovo 11-osios g. 38B, Grigiškės',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                104 =>
                array(
                    0 => 'Vilniaus MAXIMA Grybo paštomatas',
                    1 => '54.703717',
                    2 => '25.315933',
                    3 => '88887',
                    4 => 'Vilnius',
                    5 => 'V. Grybo g. 21, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje pastato pusėje, prie taromato',
                ),
                105 =>
                array(
                    0 => 'Vilniaus MAXIMA Kęstučio paštomatas (naujas!)',
                    1 => '54.693457',
                    2 => '25.251060',
                    3 => '77730',
                    4 => 'Vilnius',
                    5 => 'Kęstučio g. 37, Vilnius ',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                106 =>
                array(
                    0 => 'Vilniaus MAXIMA Naugarduko paštomatas (naujas!)',
                    1 => '54.669109',
                    2 => '25.258908',
                    3 => '77732',
                    4 => 'Vilnius',
                    5 => 'Naugarduko g. 84, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos iš Naugarduko g. pusės',
                ),
                107 =>
                array(
                    0 => 'Vilniaus MAXIMA Pilaitės paštomatas (naujas!)',
                    1 => '54.709891',
                    2 => '25.188744',
                    3 => '77733',
                    4 => 'Vilnius',
                    5 => 'Pilaitės pr. 31, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos iš Pilaitės pr. pusės',
                ),
                108 =>
                array(
                    0 => 'Vilniaus MAXIMA Sausio 13-os paštomatas (naujas!)',
                    1 => '54.692867',
                    2 => '25.221685',
                    3 => '88822',
                    4 => 'Vilnius',
                    5 => 'Sausio 13-sios g. 2, Vilnius',
                    6 => 'Paštomatą rasite lauke, kairėje įėjimo į Maxima pusėje, prie sienos',
                ),
                109 =>
                array(
                    0 => 'Vilniaus MAXIMA Savanorių 31 paštomatas (naujas!)',
                    1 => '54.673977',
                    2 => '25.247888',
                    3 => '77726',
                    4 => 'Vilnius',
                    5 => 'Savanorių pr. 31, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                110 =>
                array(
                    0 => 'Vilniaus MAXIMA Taikos 162A paštomatas (naujas!)',
                    1 => '54.712398',
                    2 => '25.215338',
                    3 => '77747',
                    4 => 'Vilnius',
                    5 => 'Taikos g. 162A, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                111 =>
                array(
                    0 => 'Vilniaus MAXIMA Tuskulėnų paštomatas',
                    1 => '54.702362',
                    2 => '25.288749',
                    3 => '88813',
                    4 => 'Vilnius',
                    5 => 'Tuskulėnų g. 66, Vilnius',
                    6 => 'Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje',
                ),
                112 =>
                array(
                    0 => 'Vilniaus MAXIMA Viršuliškių paštomatas',
                    1 => '54.709389',
                    2 => '25.222248',
                    3 => '88820',
                    4 => 'Vilnius',
                    5 => 'Viršuliškių g. 30, Vilnius',
                    6 => 'Paštomatą rasite prie įvažiavimo į stovėjimo aikštelę',
                ),
                113 =>
                array(
                    0 => 'Vilniaus MAXIMA Šaltkalvių paštomatas',
                    1 => '54.661525',
                    2 => '25.272317',
                    3 => '88889',
                    4 => 'Vilnius',
                    5 => 'Šaltkalvių g. 2, Vilnius',
                    6 => 'Paštomatą rasite lauke,  prie pastato sienos šalia taromato',
                ),
                114 =>
                array(
                    0 => 'Vilniaus NORFA Genių paštomatas',
                    1 => '54.688179',
                    2 => '25.421732',
                    3 => '88848',
                    4 => 'Vilnius',
                    5 => 'Genių g. 10A, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                115 =>
                array(
                    0 => 'Vilniaus NORFA Minsko paštomatas',
                    1 => '54.652141',
                    2 => '25.305245',
                    3 => '88878',
                    4 => 'Vilnius',
                    5 => 'Minsko pl. 3, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                116 =>
                array(
                    0 => 'Vilniaus NORFA Molėtų pl. paštomatas',
                    1 => '54.772007',
                    2 => '25.272299',
                    3 => '88890',
                    4 => 'Vilnius',
                    5 => 'Molėtų pl. 47, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie pastato sienos iš Molėtų pl. pusės',
                ),
                117 =>
                array(
                    0 => 'Vilniaus NORFA Rygos paštomatas (naujas!)',
                    1 => '54.719011',
                    2 => '25.212367',
                    3 => '77734',
                    4 => 'Vilnius',
                    5 => 'Rygos g. 49, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos iš Rygos g. pusės',
                ),
                118 =>
                array(
                    0 => 'Vilniaus NORFA Žvalgų paštomatas',
                    1 => '54.721530',
                    2 => '25.287830',
                    3 => '88879',
                    4 => 'Vilnius',
                    5 => 'Kalvarijų g. 151, Vilnius',
                    6 => 'Paštomatą rasite lauke, dešinėje įėjimo į prekybos centrą pusėje, už kampo prie sienos',
                ),
                119 =>
                array(
                    0 => 'Vilniaus PC DOMUS PRO paštomatas',
                    1 => '54.740274',
                    2 => '25.225183',
                    3 => '88811',
                    4 => 'Vilnius',
                    5 => 'Ukmergės g.  308, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie pastato sienos iš Ukmergės g. pusės',
                ),
                120 =>
                array(
                    0 => 'Vilniaus PC MANDARINAS paštomatas',
                    1 => '54.731491',
                    2 => '25.246227',
                    3 => '88814',
                    4 => 'Vilnius',
                    5 => 'Ateities g. 91, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į prekybos centrą',
                ),
                121 =>
                array(
                    0 => 'Vilniaus RIMI Architektų paštomatas',
                    1 => '54.673672',
                    2 => '25.213588',
                    3 => '88858',
                    4 => 'Vilnius',
                    5 => 'Architektų g. 19, Vilnius',
                    6 => 'Paštomatą rasite lauke, už kampo prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                122 =>
                array(
                    0 => 'Vilniaus RIMI Fabijoniškių paštomatas (naujas!)',
                    1 => '54.720785',
                    2 => '25.244945',
                    3 => '77735',
                    4 => 'Vilnius',
                    5 => 'Ukmergės g. 233, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos iš Ukmergės g. pusės',
                ),
                123 =>
                array(
                    0 => 'Vilniaus RIMI Kareivių paštomatas (naujas!)',
                    1 => '54.717897',
                    2 => '25.300539',
                    3 => '77736',
                    4 => 'Vilnius',
                    5 => 'Kareivių g. 11A, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į prekybos centrą pusėje, už kampo',
                ),
                124 =>
                array(
                    0 => 'Vilniaus RIMI Medeinos paštomatas (naujas!)',
                    1 => '54.729596',
                    2 => '25.227436',
                    3 => '77737',
                    4 => 'Vilnius',
                    5 => 'Medeinos g. 8, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                125 =>
                array(
                    0 => 'Vilniaus RIMI Rygos paštomatas',
                    1 => '54.715958',
                    2 => '25.224777',
                    3 => '88859',
                    4 => 'Vilnius',
                    5 => 'Rygos g. 8, Vilnius',
                    6 => 'Paštomatą rasite lauke, už kampo prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                126 =>
                array(
                    0 => 'Vilniaus RIMI Savanorių paštomatas',
                    1 => '54.675640',
                    2 => '25.257998',
                    3 => '88815',
                    4 => 'Vilnius',
                    5 => 'Kedrų g. 4, Vilnius',
                    6 => 'Paštomatą rasite lauke, kairėje pagrindinio iėjimo į prekybos centrą pusėje, prie sienos',
                ),
                127 =>
                array(
                    0 => 'Vilniaus RIMI Vydūno paštomatas',
                    1 => '54.707191',
                    2 => '25.188892',
                    3 => '88823',
                    4 => 'Vilnius',
                    5 => 'Vydūno g. 4, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į prekybos centrą',
                ),
                128 =>
                array(
                    0 => 'Vilniaus RIMI Zarasų g. paštomatas (naujas!)',
                    1 => '54.680886',
                    2 => '25.311600',
                    3 => '77738',
                    4 => 'Vilnius',
                    5 => 'Zarasų g. 5A, Vilnius',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                129 =>
                array(
                    0 => 'Vilniaus RIMI Žirmūnų paštomatas',
                    1 => '54.712017',
                    2 => '25.300741',
                    3 => '88816',
                    4 => 'Vilnius',
                    5 => 'Žirmūnų g. 64, Vilnius',
                    6 => 'Paštomatą rasite lauke, prie "Topo centro" įėjimo, kairėje pusėje',
                ),
                130 =>
                array(
                    0 => 'Vilniaus VC ŽALGIRIO 135 paštomatas (naujas!)',
                    1 => '54.704816',
                    2 => '25.272422',
                    3 => '77743',
                    4 => 'Vilnius',
                    5 => 'Žalgirio g. 135, Vilnius ',
                    6 => 'Paštomatą rasite lauke prie sienos, prie įvažiavimo į vidinį kiemą iš Žalgirio g. pusės',
                ),
                131 =>
                array(
                    0 => 'Vilniaus VIADA Saltoniškių paštomatas',
                    1 => '54.699135',
                    2 => '25.260015',
                    3 => '88818',
                    4 => 'Vilnius',
                    5 => 'Saltoniškių g. 12, Vilnius',
                    6 => 'Paštomatą rasite lauke, dešinėje degalinės pusėje',
                ),
                132 =>
                array(
                    0 => 'Vilniaus VIADA Saulėtekio paštomatas',
                    1 => '54.726292',
                    2 => '25.326769',
                    3 => '88826',
                    4 => 'Vilnius',
                    5 => 'Nemenčinės pl. 5, Vilnius',
                    6 => 'Paštomatą rasite lauke, galinėje degalinės pusėje',
                ),
                133 =>
                array(
                    0 => 'Visagino VIADA paštomatas',
                    1 => '55.594598',
                    2 => '26.438796',
                    3 => '88840',
                    4 => 'Visaginas',
                    5 => 'Statybininkų g. 1, Visaginas',
                    6 => 'Paštomatą rasite lauke, už kampo prie sienos dešinėje įėjimo į degalinę pusėje',
                ),
                134 =>
                array(
                    0 => 'Zarasų IKI Vytauto paštomatas (naujas!)',
                    1 => '55.736384',
                    2 => '26.264755',
                    3 => '88845',
                    4 => 'Zarasai',
                    5 => 'Vytauto g. 54, Zarasai',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                135 =>
                array(
                    0 => 'ŠILUTĖS PREKYBA Lietuvininkų 37 paštomatas',
                    1 => '55.343229',
                    2 => '21.471249',
                    3 => '88833',
                    4 => 'Šilutė',
                    5 => 'Lietuvininkų g. 37, Šilutė',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                136 =>
                array(
                    0 => 'Šakių NORFA Šaulių paštomatas',
                    1 => '54.960627',
                    2 => '23.031055',
                    3 => '88824',
                    4 => 'Šakiai',
                    5 => 'Šaulių g. 49, Šakiai',
                    6 => 'Paštomatą rasite lauke, prie sienos kairėje įėjimo į prekybos centrą pusėje',
                ),
                137 =>
                array(
                    0 => 'Šalčininkų NORFA paštomatas (naujas!)',
                    1 => '54.317769',
                    2 => '25.383816',
                    3 => '77719',
                    4 => 'Šalčininkai',
                    5 => 'Vilniaus g. 2B, Šalčininkai',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                138 =>
                array(
                    0 => 'Šeduvos NORFA paštomatas (naujas!)',
                    1 => '55.756241',
                    2 => '23.762468',
                    3 => '77720',
                    4 => 'Šeduva',
                    5 => 'Panevėžio g. 33, Šeduva',
                    6 => 'Paštomatą rasite lauke prie sienos už kampo, dešinėje įėjimo į parduotuvę pusėje',
                ),
                139 =>
                array(
                    0 => 'Šiaulių MOKI-VEŽI paštomatas',
                    1 => '55.917301',
                    2 => '23.301418',
                    3 => '88844',
                    4 => 'Šiauliai',
                    5 => 'Pramonės g. 7, Šiauliai',
                    6 => 'Paštomatą rasite lauke, prie stiklinės vitrinos  kairėje įėjimo į prekybos centrą pusėje',
                ),
                140 =>
                array(
                    0 => 'Šiaulių NORFA Tilžės 13A paštomatas (naujas!)',
                    1 => '55.911563',
                    2 => '23.268380',
                    3 => '77721',
                    4 => 'Šiauliai',
                    5 => 'Tilžės g. 13A, Šiauliai',
                    6 => 'Paštomatą rasite lauke prie sienos iš parkavimo aikštelės pusės',
                ),
                141 =>
                array(
                    0 => 'Šiaulių NORFA Valančiaus paštomatas',
                    1 => '55.938897',
                    2 => '23.305095',
                    3 => '88880',
                    4 => 'Šiauliai',
                    5 => 'M.Valančiaus g. 18, Šiauliai',
                    6 => 'Paštomatą rasite lauke, prie sienos dešinėje įėjimo į prekybos centrą pusėje',
                ),
                142 =>
                array(
                    0 => 'Šiaulių PC ARENA paštomatas',
                    1 => '55.906536',
                    2 => '23.258636',
                    3 => '88842',
                    4 => 'Šiauliai',
                    5 => 'Gegužių g. 30, Šiauliai',
                    6 => 'Paštomatą rasite lauke, prie įėjimo į JYSK dešinėje pusėje',
                ),
                143 =>
                array(
                    0 => 'Šiaulių PC SAULĖS MIESTAS paštomatas (naujas!)',
                    1 => '55.927737',
                    2 => '23.307049',
                    3 => '77741',
                    4 => 'Šiauliai',
                    5 => 'Tilžės g. 109, Šiauliai',
                    6 => 'Paštomatą rasite lauke prie sienos iš Autobusų stoties perono pusės',
                ),
                144 =>
                array(
                    0 => 'Šiaulių VIADA Tilžės paštomatas',
                    1 => '55.944092',
                    2 => '23.331217',
                    3 => '88843',
                    4 => 'Šiauliai',
                    5 => 'Tilžės g. 274, Šiauliai',
                    6 => 'Paštomatą rasite lauke prie degalinės',
                ),
                145 =>
                array(
                    0 => 'Šilalės NORFA paštomatas',
                    1 => '55.490946',
                    2 => '22.188493',
                    3 => '88825',
                    4 => 'Šilalė',
                    5 => 'Tauragės g. 1, Šilalė',
                    6 => 'Paštomatą rasite lauke, kairėje įėjimo į prekybos centrą pusėje, už kampo prie sienos',
                ),
                146 =>
                array(
                    0 => 'Šilutės MAXIMA Miško paštomatas (naujas!)',
                    1 => '55.350800',
                    2 => '21.479337',
                    3 => '77746',
                    4 => 'Šilutė',
                    5 => 'Miško g. 7, Šilutė',
                    6 => 'Paštomatą rasite lauke prie pastato sienos',
                ),
                147 =>
                array(
                    0 => 'Širvintų MAXIMA paštomatas (naujas!)',
                    1 => '55.038093',
                    2 => '24.955586',
                    3 => '77722',
                    4 => 'Širvintos',
                    5 => 'I.Šeiniaus g. 19, Širvintos',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
                148 =>
                array(
                    0 => 'Švenčionių MAXIMA paštomatas (naujas!)',
                    1 => ' 55.129970',
                    2 => '26.150541',
                    3 => '77723',
                    4 => 'Švenčionys',
                    5 => 'Vilniaus g. 37, Švenčionys',
                    6 => 'Paštomatą rasite lauke prie sienos, kairėje įėjimo į parduotuvę pusėje',
                ),
            );

















            // dd($customer);

            //  dd($data);

            // foreach ($itemsList as $items) {
            //     foreach ($items as $item) {
            //         // $orderedItems[] = $item['item'];
            //     }
            // }
            //dd($orderedItems);

            // stripe might unique id
            // $data['created']

            $charge_id = $data['id'];




            // foreach ($request->session()->get('cart') as $items) {
            //     // $itemsList[] = $item;
            //     foreach ($items as $item) {
            //         dd($item['qty']);
            //     }
            // }




            // Insert into orders table
            $order = Order::create([
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'billing_email' => $data['billing_details']['email'],
                'billing_name' => $data['billing_details']['name'],
                'billing_address' => $data['billing_details']['address']['line1'],
                'billing_country' => $data['billing_details']['address']['country'],
                'billing_city' => $data['billing_details']['address']['city'],
                'billing_postalcode' => $data['billing_details']['address']['postal_code'],
                'billing_phone' => $customer['phone'],
                'billing_name_on_card' => null,
                'billing_discount' => 0,
                'billing_discount_code' => null,
                'billing_subtotal' => $data['amount'],
                'billing_tax' => 0,
                'billing_total' => 0,
                'error' => null,
            ]);

            // omniva info
            foreach ($terminals as $terminal) {
                if ($terminal[3] == $data['metadata']['terminal_code']) {
                    $omniva = Omniva::create([
                        'order_id' => $order->id ? $order->id : null,
                        'name' => $terminal[0],
                        'xcordinate' => $terminal[1],
                        'ycordinate' => $terminal[2],
                        'terminalId' => $terminal[3],
                        'city' => $terminal[4],
                        'street' => $terminal[5],
                        'comment' => $terminal[6],
                    ]);
                }
            }




            // dd($request->session()->get('cart'));

            // Insert into order_product table
            $CartItems = $request->session()->get('cart')->items;
            foreach ($CartItems as $item) {

                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item['item']->id,
                    'quantity' => $item['qty'],
                    'price' => $item['item']->price
                ]);

                $productsold = Product::find($item['item']->id);
                $productsold->quantity_sold += $item['qty'];
                $productsold->quantity -= $item['qty'];
                $productsold->save();
            }

            // dd($order, $request->session()->get('cart'));


            // return $order;

            // mail when shipping address
            //Mail::to($data['billing_details']['email'])->send(new MadePurchase($CartItems, $order, $request->session()->get('cart')));

            Mail::to($data['billing_details']['email'])->send(new MadePurchase($CartItems, $order, $request->session()->get('cart'), $omniva));


            session()->forget('stripe_payment_intent');

            // session()->forget('cart');
            session()->forget('cart');

            session()->put('payment_method', ['name' => 'stripe', 'id' => $charge_id]);



            // return back()->with('success', 'Payment is successful, we have sent you an email with all the details');

            return redirect()->route('cart.checkout')->with('success', 'Payment is successful, we have sent you an email with all the details');
        } catch (\Exception $e) {
            return back()->withErrors('Error, try again' . $e);
        }
    }

    public function stripeCheckout(Request $request)
    {
        $cartArray = array();


        foreach (session()->get('cart')->items as $item) {


            unset($data);

            $checkItem = Product::where('id', $item['item']->id)->where('quantity', '>', $item['qty'] - 1)->first();
            if (!$checkItem) {
                $missingItemQty = Product::where('id', $item['item']->id)->pluck('quantity');

                function getItemQty($missingItemQty)
                {
                    if ($missingItemQty >= 0) {
                        return $missingItemQty;
                    } else {
                        return '0';
                    }
                }

                $data['status'] = 'soldout';
                $data['item'] = $item['item']->name;
                $data['itemId'] = $item['item']->id;

                // $data['itemQty'] = '0';
                // if (number_format($missingItemQty) > 0) {
                //     $data['itemQty'] = $missingItemQty;
                // } else {
                //     $data['itemQty'] = '0';
                // }

                $data['itemQty'] = $missingItemQty; // most likely a string




                return response($data);
            }

            $cartArray[] = [
                'price_data' => [
                    'currency' => 'EUR',
                    'unit_amount' => $item['price'] / $item['qty'],
                    'product_data' => [
                        'name' => $item['item']->name,
                    ],
                ],

                'quantity' => $item['qty'],
            ];
        }


        try {
            Stripe::setApiKey(env('STRIPE_KEY'));
            $currency_code = 'EUR';
            $amount = $request->amount;



            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [$cartArray],

                'shipping_address_collection' => [
                    'allowed_countries' => ['US', 'CA', 'LT', 'DE', 'PL'],
                ],
                'shipping_options' => [
                    [
                        'shipping_rate_data' => [
                            'type' => 'fixed_amount',
                            'fixed_amount' => [
                                'amount' => 399,
                                'currency' => 'EUR',
                            ],
                            'display_name' => 'LP express shipping',
                            // Delivers between 5-7 business days
                            'delivery_estimate' => [
                                'minimum' => [
                                    'unit' => 'business_day',
                                    'value' => 14,
                                ],
                                'maximum' => [
                                    'unit' => 'business_day',
                                    'value' => 30,
                                ],
                            ]
                        ]
                    ],
                ],

                'phone_number_collection' => [
                    'enabled' => true,
                ],


                'customer_email' => $request->email,
                'mode' => 'payment',
                'payment_intent_data' => [
                    'capture_method' => 'manual',
                    'metadata' => [
                        "terminal_code" => $request->terminal_code,
                    ],
                ],



                'success_url' => route('stripe-success'),
                'cancel_url' => url('/cart/checkout'),
            ]);

            $stripe_session = $session['id'];

            session()->put('stripe_payment_intent', $session['payment_intent']);

            $data['status'] = 'success';
            $data['stripeSession'] = $stripe_session;

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
