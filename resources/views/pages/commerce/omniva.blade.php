@extends('layouts.app')

@section('extra-header')

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="../src/omniva-map.css">
<script src="../src/omniva-map.js" defer></script>

@endsection

@section('content')
<span class="rounded bg-black text-sm p-2.5 text-white w-full block font-semibold uppercase gray-300 hover:bg-gray-800 duration-200 transition hidden"></span>
<div>
    <form action="{{route('omniva.test')}}" method="post">
        @csrf
        <div>
            <label class="hidden"><input type="radio" name="terminalId" id="map-test" checked>OmnivaMap - <span>ON</span></label>
            <!-- <label><input type="radio" name="terminalId" id="map-test-off">OmnivaMap - <span>OFF</span></label> -->
        </div>

        <button>Submit</button>
    </form>
    <!-- <hr>
<div id="secondary"></div>
<hr> -->
    <!-- <div>PostCode:
    <input type="text" name="postcode" id="postcode">
</div> -->

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
                    modal_header: "Omniva pa??tomatai"
                }
            });
            $('input[type="radio"][name="terminalId"]').on('click', function(e) {
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
            ["Alytaus NORFA Topoli?? pa??tomatas (naujas!)", "54.396616", "24.028241", "88895", "Alytus", "Topoli?? g. 1, Alytus", "Pa??tomat?? rasite lauke prie sienos i?? parkavimo aik??tel??s pus??s"],
            ["Alytaus PC ARENA pa??tomatas", "54.409792", "24.014968", "88854", "Alytus", "Naujoji g. 7E, Alytus", "Pa??tomat?? rasite lauke, prie pagrindinio ????jimo sienos de??iniojo kampo"],
            ["Alytaus RIMI Pulko pa??tomatas", "54.387953", "24.043778", "88855", "Alytus", "Pulko g. 53A, Alytus", "Pa??tomat?? rasite lauke, prie ????jimo ?? prekybos centr??, kair??je pus??je"],
            ["Anyk????i?? NORFA Vilniaus g. pa??tomatas", "55.522864", "25.098652", "88800", "Anyk????iai", "Vilniaus g. 22, Anyk????iai", "Pa??tomat?? rasite lauke, prie ????jimo i?? Kudirkos g. de??in??je pus??je"],
            ["Bir???? NORFA pa??tomatas", "56.194351", "24.769201", "88866", "Bir??ai", "Respublikos g. 2E, Bir??ai", "Pa??tomat?? rasite prie pagrindinio parduotuv??s ????jimo, kair??je pus??je"],
            ["Druskinink?? IKI ??iurlionio pa??tomatas", "54.011307", "23.990209", "88865", "Druskininkai", "??iurlionio g. 107, Druskininkai", "Pa??tomat?? rasite lauke, prie de??iniosios prekybos centro sienos"],
            ["Ei??i??ki?? NORFA pa??tomatas (naujas!)", "54.171456", "24.997282", "88896", "Ei??i??k??s", "Vilniaus g. 19, Ei??i??k??s", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Elektr??n?? MAXIMA pa??tomatas (naujas!)", "54.785283", "24.658095", "88853", "Elektr??nai", "Rungos g. 4, Elektr??nai", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Garg??d?? NORFA pa??tomatas", "55.712518", "21.380646", "88801", "Garg??dai", "Klaip??dos g. 41, Garg??dai", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Garliavos NORFA pa??tomatas", "54.829127", "23.873354", "88876", "Kaunas", "Atgimimo g. 1, Jonu??i?? k., Kauno raj. (Garliava)", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Ignalinos NORFA pa??tomatas", "55.342599", "26.170579", "88802", "Ignalina", "Taikos g. 20, Ignalina", "Pa??tomat?? rasite lauke, kair??je ????jimo ?? prekybos centr?? pus??je, u?? kampo"],
            ["Jonavos NORFA ??eimi?? pa??tomatas (naujas!)", "55.084468", "24.273708", "88897", "Jonava", "??eimi?? g. 26A, Jonava ", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Jonavos RIMI pa??tomatas", "55.073180", "24.276370", "88867", "Jonava", "Vasario 16-osios g. 4, Jonava", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo pus??je"],
            ["Joni??kio NORFA pa??tomatas (naujas!)", "56.228109", "23.604877", "88803", "Joni??kis", "Vilniaus g. 47B, Joni??kis", "Pa??tomat?? rasite lauke, kair??je ????jimo ?? prekybos centr?? pus??je, u?? kampo prie sienos"],
            ["Jurbarko MAXIMA CENTRO pa??tomatas", "55.077400", "22.767105", "88864", "Jurbarkas", "Dariaus ir Gir??no g. 66, Jurbarkas", "Pa??tomat?? rasite lauke, prie ????jimo ?? parduotuv??, de??in??je pus??je"],
            ["Kai??iadori?? RIMI pa??tomatas", "54.856120", "24.443715", "88804", "Kai??iadorys", "Gedimino g. 115A, Kai??iadorys", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Kauno EXPRESS MARKET Vytauto pa??tomatas (naujas!)", "54.888035", "23.928545", "77749", "Kaunas", "Vytauto pr. 11, Kaunas", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Kauno IKI Girstu??io pa??tomatas", "54.905754", "23.974659", "88875", "Kaunas", "Kovo 11-osios g. 22, Kaunas", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Kauno IKI Ramu??i?? pa??tomatas (naujas!)", "54.954106", "24.031702", "88898", "Kaunas", "Centrin?? g. 56, Ramu??iai", "Pa??tomat?? rasite lauke prie sienos i?? Plento g. pus??s"],
            ["Kauno IKI Sukil??li?? pa??tomatas", "54.925103", "23.929296", "88829", "Kaunas", "Sukil??li?? pr. 84, Kaunas", "Pa??tomat?? rasite lauke, de??in??je ????jimo ?? prekybos centr?? pus??je, prie kampo"],
            ["Kauno IKI Varni?? pa??tomatas (naujas!)", "54.914537", "23.896816", "77700", "Kaunas", "Varni?? g. 38A, Kaunas", "Pa??tomat?? rasite lauke prie sienos i?? Varni?? g. pus??s"],
            ["Kauno IKI Veiveri?? pa??tomatas", "54.862465", "23.885950", "88830", "Kaunas", "Veiveri?? g. 150A, Kaunas", "Pa??tomat?? rasite lauke, prie sienos i?? Lazdij?? gatv??s pus??s"],
            ["Kauno MAXIMA Masiulio pa??tomatas", "54.885979", "24.005189", "88883", "Kaunas", "T.Masiulio g. 16E, Kaunas", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Kauno MAXIMA Ringaud?? pa??tomatas (naujas!)", "54.888170", "23.799512", "77701", "Kaunas", "G??li?? g. 2B, Ringaudai, Kauno raj.", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Kauno PC AKROPOLIS pa??tomatas", "54.890926", "23.919338", "88863", "Kaunas", "Karaliaus Mindaugo pr. 49, Kaunas", "Pa??tomat?? rasite lauke, 1-ame stov??jimo aik??tel??s auk??te, I-A ????jimas"],
            ["Kauno PC MOLAS pa??tomatas (naujas!)", "54.899461", "23.966459", "77702", "Kaunas", "Bar??ausko g. 66, Kaunas", "Pa??tomat?? rasite lauke prie sienos, kair??je pagrindinio ????jimo ?? prekybos centr?? pus??je"],
            ["Kauno PC RIVER MALL pa??tomatas", "54.903282", "23.898021", "88827", "Kaunas", "Jonavos g. 60, Kaunas", "Pa??tomat?? rasite lauke, prie pagrindinio ????jimo ?? prekybos centr??, de??in??je pus??je"],
            ["Kauno PLC MEGA pa??tomatas", "54.939289", "23.889493", "88881", "Kaunas", "Islandijos pl. 32, Kaunas", "Pa??tomat?? rasite lauke, prie Rimi i??jimo i?? Islandijos pl. pus??s"],
            ["Kauno PM URMAS pa??tomatas (naujas!)", "54.916459", "23.987895", "77703", "Kaunas", "Pramon??s pr. 16, Kaunas", "Pa??tomat?? rasite ??va??iav?? per 1C vartus prie Vakarin??s galerijos esan??io traukinio"],
            ["Kauno RIMI Baltijos pa??tomatas (naujas!)", "54.920636", "23.879736", "77704", "Kaunas", "Baltijos g. 58, Kaunas", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Kauno RIMI Europos pa??tomatas", "54.875631", "23.912434", "88882", "Kaunas", "Europos pr. 43, Kaunas", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Kauno RIMI Juozapavi??iaus pa??tomatas (naujas!)", "54.865108", "23.945435", "77705", "Kaunas", "A.Juozapavi??iaus pr. 11, Kaunas", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Kauno RIMI Kr??v??s pa??tomatas", "54.917362", "23.966171", "88836", "Kaunas", "V.Kr??v??s pr. 43A, Kaunas", "Pa??tomat?? rasite lauke, prie ????jimo ?? prekybos centr??, kair??je pus??je"],
            ["Kauno RIMI Raudondvario pa??tomatas", "54.908863", "23.865946", "88874", "Kaunas", "Raudondvario pl. 94B, Kaunas", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Kauno RIMI Romaini?? pa??tomatas (naujas!)", "54.942779", "23.813154", "77706", "Kaunas", "Romaini?? g. 67C, Kaunas", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Kauno RIMI Savanori?? pa??tomatas", "54.919866", "23.950340", "88884", "Kaunas", "Savanori?? pr. 321, Kaunas", "Pa??tomat?? rasite lauke, kair??je prekybos centro pus??je, prie sienos (netoli taromato)"],
            ["Kauno ??ILAS Balt?? pa??tomatas", "54.929909", "23.884138", "88828", "Kaunas", "Balt?? pr. 18, Kaunas", "Pa??tomat?? rasite lauke, prie ????jimo ?? prekybos centr??, de??in??je pus??je"],
            ["Kauno ??ILAS Baranausko pa??tomatas", "54.909679", "23.956289", "88831", "Kaunas", "Baranausko g. 26, Kaunas", "Pa??tomat?? rasite lauke, prie ????jimo ?? prekybos centr??, kair??je pus??je"],
            ["Kauno ??ILAS Juozapavi??iaus pa??tomatas", "54.875175", "23.935797", "88832", "Kaunas", "Juozapavi??iaus pr. 81A, Kaunas", "Pa??tomat?? rasite lauke, prie ????jimo ?? prekybos centr??, de??in??je pus??je"],
            ["Kauno ??ILAS Vand??iogalos pa??tomatas (naujas!)", "54.945303", "23.882493", "77708", "Kaunas", "Vand??iogalos g. 22, Kaunas", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Kauno ??ILAS ??kirpos pa??tomatas (naujas!)", "54.930214", "23.943344", "77707", "Kaunas", "K.??kirpos g. 17, Kaunas", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Kazl?? R??dos MAXIMA pa??tomatas (naujas!)", "54.751543", "23.493343", "77739", "Kazl?? R??da", "M.Valan??iaus g. 7, Kazl?? R??da", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Kelm??s MAXIMA Vytauto Did??iojo pa??tomatas", "55.630016", "22.930844", "88805", "Kelm??", "Vytauto Did??iojo g. 49, Kelm??", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Klaip??dos HERKAUS GALERIJA pa??tomatas (naujas!)", "55.715246", "21.130175", "77742", "Klaip??da", "H.Manto g. 22, Klaip??da", "Pa??tomat?? rasite laukeprie sienos i?? Ligonin??s g. pus??s"],
            ["Klaip??dos MAXIMA ??ilut??s pl. 68 pa??tomatas", "55.676559", "21.189166", "88885", "Klaip??da", "??ilut??s pl. 68, Klaip??da", "Pa??tomat?? rasite lauke, kair??je prekybos centro pus??je, prie sienos (netoli taromato)"],
            ["Klaip??dos NORFA Tauralaukio pa??tomatas", "55.753584", "21.142858", "88877", "Klaip??da", "Tauralaukio g. 1, Klaip??da", "Pa??tomat?? rasite lauke, prie pastato sienos po stogu"],
            ["Klaip??dos NORFA Vingio pa??tomatas", "55.668081", "21.195697", "88872", "Klaip??da", "Vingio g. 21A, Klaip??da ", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Klaip??dos PC ARENA pa??tomatas", "55.687225", "21.155785", "88837", "Klaip??da", "Taikos pr. 64, Klaip??da", "Pa??tomat?? rasite lauke, prie ????jimo ?? Rimi, kair??je pus??je"],
            ["Klaip??dos PC BIG1 pa??tomatas", "55.664533", "21.177448", "88841", "Klaip??da", "Taikos pr. 139, Klaip??da", "Pa??tomat?? rasite lauke, prie prie sienos, p??s??i??j?? al??joje tarp BIG1 ir BIG2"],
            ["Klaip??dos PC STUDLENDAS pa??tomatas", "55.729055", "21.125150", "88839", "Klaip??da", "H.Manto g. 90, Klaip??da", "Pa??tomat?? rasite lauke, de??in??je ????jimo ?? IKI pus??je, i?? ??iaur??s pr. pus??s"],
            ["Klaip??dos RIMI Slengi?? pa??tomatas (naujas!)", "55.736771", "21.191771", "77710", "Slengiai", "Dangaus g. 34, Slengiai", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Klaip??dos TECHNORAMA pa??tomatas", "55.698207", "21.149172", "88873", "Klaip??da", "Taikos pr. 39, Klaip??da", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Klaip??dos VIADA Priesto??io pa??tomatas", "55.719124", "21.141022", "88838", "Klaip??da", "Priesto??io g. 28, Klaip??da", "Pa??tomat?? rasite lauke, prie ????jimo ?? parduotuv??, de??in??je pus??je"],
            ["Kretingos MAXIMA Rotu????s pa??tomatas", "55.889772", "21.240982", "88806", "Kretinga", "Rotu????s a. 15, Kretinga", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Kretingos NORFA pa??tomatas (naujas!)", "55.892317", "21.232706", "88893", "Kretinga", "??ventosios g. 25H, Kretinga ", "Pa??tomat?? rasite lauke prie sienos i?? parkavimo aik??tel??s pus??s"],
            ["Kupi??kio NORFA Pur??no pa??tomatas (naujas!)", "55.836188", "24.993760", "77740", "Kupi??kis", "A.Pur??no g. 1, Kupi??kis ", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Kur????n?? MAXIMA Vilniaus g. pa??tomatas", "56.000438", "22.949599", "88886", "Kur????nai", "Vilniaus g. 43, Kur????nai", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["K??daini?? MAXIMA Basanavi??iaus 93 pa??tomatas", "55.277651", "23.959059", "88861", "K??dainiai", "J.Basanavi??iaus g. 93, K??dainiai", "Pa??tomat?? rasite lauke, kair??je prekybos centro dalyje, prie sienos, po i??kabomis"],
            ["K??daini?? MAXIMA Dariaus ir Gir??no pa??tomatas (naujas!)", "55.308916", "23.979144", "77709", "K??dainiai", "S.Dariaus ir S.Gir??no g. 50A, K??dainiai", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Lazdij?? NORFA pa??tomatas", "54.238926", "23.511757", "88807", "Lazdijai", "Dz??k?? g. 3, Lazdijai", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Lentvario IKI pa??tomatas (naujas!)", "54.644033", "25.046481", "77731", "Lentvaris", "Gele??inkelio g. 38, Lentvaris", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Marijampol??s MAXIMA Ba??ny??ios pa??tomatas", "54.556047", "23.346449", "88899", "Marijampol??", "Ba??ny??ios g. 38, Marijampol??", "Pa??tomat?? rasite lauke prie sienos i?? Laisv??s g. pus??s"],
            ["Marijampol??s PC ARENA pa??tomatas", "54.560951", "23.354530", "88856", "Marijampol??", "Dariaus ir Gir??no g. 3A, Marijampol??", "Pa??tomat?? rasite lauke, prie ????jimo ?? JYSK kair??je pus??je"],
            ["Ma??eiki?? IKI Ventos pa??tomatas (naujas!)", "56.308940", "22.324078", "77711", "Ma??eikiai", "Ventos g. 10B, Ma??eikiai", "Pa??tomat?? rasite lauke, de??in??je ????jimo ?? prekybos centr?? pus??je, u?? kampo prie sienos"],
            ["Ma??eiki?? PC EIFELIS pa??tomatas", "56.299740", "22.353653", "88857", "Ma??eikiai", "??emaitijos g. 72, Ma??eikiai", "Pa??tomat?? rasite lauke, prie ????jimo ?? NORFA, kair??je pus??je"],
            ["Mol??t?? NORFA pa??tomatas (naujas!)", "55.224777", "25.405258", "77712", "Mol??tai", "Vilniaus g. 99, Mol??tai", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Naujosios Akmen??s NORFA pa??tomatas (naujas!)", "56.319508", "22.873342", "88808", "Naujoji Akmen??", "Respublikos g. 30, Naujoji Akmen??", "Pa??tomat?? rasite lauke, kair??je ????jimo ?? prekybos centr?? pus??je, u?? kampo prie sienos"],
            ["Pabrad??s NORFA pa??tomatas (naujas!)", "54.979590", "25.755895", "77713", "Pabrad??", "Mol??t?? g. 4A, Pabrad??", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Pakruojo NORFA pa??tomatas (naujas!)", "55.979951", "23.856885", "77714", "Pakruojis", "Statybinink?? g. 2A, Pakruojis", "Pa??tomat?? rasite lauke, prie parduotuv??s sienos"],
            ["Palangos RIMI pa??tomatas", "55.921020", "21.075963", "88870", "Palanga", "Mal??no g. 10, Palanga", "Pa??tomat?? rasite lauke, kair??je ????jimo pus??je, i?? Klaip??dos pl. pus??s"],
            ["Panev????io MAXIMA L??VUO pa??tomatas", "55.729027", "24.324492", "88849", "Panev????ys", "Klaip??dos g. 103, Panev????ys", "Pa??tomat?? rasite lauke, prie ??ejimo ?? Maxima, de??in??je pus??je"],
            ["Panev????io MAXIMA TURGAUS pa??tomatas", "55.728699", "24.370111", "88847", "Panev????ys", "Ukmerg??s g. 23, Panev????ys", "Pa??tomat?? rasite lauke, kair??je ????jimo ?? Maxima pus??je, prie kampo"],
            ["Panev????io NORFA Ber???? pa??tomatas (naujas!)", "55.718296", "24.371654", "77715", "Panev????ys", "Ber???? g. 27, Panev????ys ", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Panev????io NORFA Sm??lyn??s pa??tomatas (naujas!)", "55.744796", "24.369838", "77716", "Panev????ys", "Sm??lyn??s g. 85, Panev????ys", "Pa??tomat?? rasite lauke, prie parduotuv??s sienos"],
            ["Panev????io RIMI pa??tomatas", "55.728561", "24.342098", "88846", "Panev????ys", "Klaip??dos g. 82, Panev????ys", "Pa??tomat?? rasite lauke, prie ????jimo ?? prekybos centr?? kair??je pus??je"],
            ["Pasvalio NORFA pa??tomatas", "56.059471", "24.410913", "88809", "Pasvalys", "E??ero g. 1, Pasvalys", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Plung??s IKI Laisv??s pa??tomatas (naujas!)", "55.908829", "21.857685", "88894", "Plung??", "Laisv??s g. 5, Plung??", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? turg?? pus??je"],
            ["Plung??s NORFA Kalni??ki?? pa??tomatas", "55.904872", "21.844950", "88810", "Plung??", "Kalni??ki?? g. 18, Plung??", "Pa??tomat?? rasite lauke, de??in??je ????jimo ?? prekybos centr?? pus??je, u?? kampo prie sienos"],
            ["Prien?? NORFA pa??tomatas", "54.643128", "23.944950", "88812", "Prienai", "Revuonos g. 66, Prienai", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Radvili??kio IKI pa??tomatas", "55.813206", "23.547457", "88817", "Radvili??kis", "Gedimino g. 31B, Radvili??kis", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Raseini?? MAXIMA Maironio pa??tomatas", "55.386357", "23.126401", "88819", "Raseiniai", "Maironio g. 64, Raseiniai", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Rietavo MAXIMA pa??tomatas (naujas!)", "55.724309", "21.932529", "77717", "Rietavas", "Plung??s g. 2, Rietavas", "Pa??tomat?? rasite lauke prie sienos, galin??je parduotuv??s pastato dalyje"],
            ["Roki??kio NORFA Panev????io g. pa??tomatas", "55.947342", "25.589039", "88821", "Roki??kis", "Panev????io g. 1D, Roki??kis", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Skuodo MAXIMA Mos??d??io pa??tomatas (naujas!)", "56.267776", "21.531389", "77718", "Skuodas", "Mos??d??io g. 2, Skuodas", "Pa??tomat?? rasite lauke prie sienos i?? Mos??d??io g. pus??s"],
            ["Taurag??s NORFA Gedimino pa??tomatas", "55.251360", "22.298812", "88851", "Taurag??", "Gedimino g. 28, Taurag??", "Pa??tomat?? rasite lauke, prie prekybos centro sienos"],
            ["Tel??i?? NORFA Gedimino pa??tomatas", "55.981785", "22.238605", "88868", "Tel??iai", "Gedimino g. 8, Tel??iai", "Pa??tomat?? rasite prie pagrindinio ????jimo, de??in??je pus??je"],
            ["Tel??i?? PC TULP?? pa??tomatas  (naujas!)", "55.983917", "22.249697", "88891", "Tel??iai", "K??stu??io g. 4, Tel??iai", "Pa??tomat?? rasite prie pagrindinio ????jimo, kair??je pus??je"],
            ["Trak?? NORFA pa??tomatas (naujas!)", "54.627344", "24.945533", "77724", "Trakai", "Vilniaus g. 15C, Trakai", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Ukmerg??s IKI Vilniaus g. pa??tomatas", "55.244184", "24.773200", "88892", "Ukmerg??", "Vilniaus g. 62, Ukmerg??", "Pa??tomat?? rasite lauke prie sienos, netoli taromato"],
            ["Ukmerg??s MAXIMA ??iedo pa??tomatas", "55.242752", "24.743786", "88869", "Ukmerg??", "??iedo g. 1, Ukmerg??", "Pa??tomat?? rasite ????jimo ?? parduotuv??, kair??je pus??je"],
            ["Utenos RIMI-SENUKAI pa??tomatas", "55.498111", "25.596356", "88860", "Utena", "J.Basanavi??iaus g. 52, Utena", "Pa??tomat?? rasite lauke, prie prekybos centro sienos i?? autobus?? stoties pus??s"],
            ["Var??nos IKI pa??tomatas", "54.215309", "24.563934", "88834", "Var??na", "Sporto g. 1, Var??na", "Pa??tomat?? rasite lauke, kair??je ????jimo ?? prekybos centr?? pus??je, u?? kampo prie sienos"],
            ["Vilkavi??kio NORFA Nepriklausomyb??s pa??tomatas", "54.658606", "23.030233", "88835", "Vilkavi??kis", "Nepriklausomyb??s g. 61, Vilkavi??kis", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus CUP pa??tomatas", "54.694023", "25.276537", "88871", "Vilnius", "Up??s g. 9,  Vilnius", "Pa??tomat?? rasite kair??je 3-ojo aukt??o ????jimo pus??je, ??alia automobili?? stov??jimo aik??tel??s"],
            ["Vilniaus IKI Bajor?? pa??tomatas (naujas!)", "54.754746", "25.261674", "77744", "Vilnius", "Bajor?? kel. 4, Vilnius", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Vilniaus IKI Buivydi??ki?? g. pa??tomatas (naujas!)", "54.713529", "25.238532", "77725", "Vilnius", "Buivydi??ki?? g. 17, Vilnius", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je, u?? taromato"],
            ["Vilniaus IKI Didlaukio pa??tomatas", "54.728806", "25.269791", "88850", "Vilnius", "Didlaukio g. 80A, Vilnius", "Pa??tomat?? rasite lauke, parkinge i?? Baltupio g. pus??s, prie sienos"],
            ["Vilniaus IKI Jeruzal??s pa??tomatas", "54.743055", "25.278166", "88862", "Vilnius", "Jeruzal??s g. 17, Vilnius", "Pa??tomat?? rasite lauke, u?? kampo prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus IKI Saul??tekio pa??tomatas (naujas!)", "54.725016", "25.342257", "77748", "Vilnius", "Saul??tekio al. 43, Vilnius ", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je, po laiptais"],
            ["Vilniaus IKI Stanevi??iaus pa??tomatas (naujas!)", "54.723732", "25.255186", "77727", "Vilnius", "S.Stanevi??iaus g. 23, Vilnius", "Pa??tomat?? rasite lauke prie sienos, de??in??je pagrindinio ????jimo ?? parduotuv?? pus??je"],
            ["Vilniaus IKI ??e??kin??s pa??tomatas", "54.715581", "25.245704", "88852", "Vilnius", "??e??kin??s g. 32, Vilnius", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus MAXIMA Antakalnio pa??tomatas (naujas!)", "54.715310", "25.316520", "77728", "Vilnius", "Antakalnio g. 75A, Vilnius", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Vilniaus MAXIMA Architekt?? pa??tomatas (naujas!)", "54.683020", "25.213188", "77729", "Vilnius", "Architekt?? g. 152, Vilnius", "Pa??tomat?? rasite lauke prie sienos, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["Vilniaus MAXIMA Grigi??ki?? pa??tomatas", "54.670192", "25.098794", "88888", "Vilnius", "Kovo 11-osios g. 38B, Grigi??k??s", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus MAXIMA Grybo pa??tomatas", "54.703717", "25.315933", "88887", "Vilnius", "V. Grybo g. 21, Vilnius", "Pa??tomat?? rasite lauke, prie sienos de??in??je pastato pus??je, prie taromato"],
            ["Vilniaus MAXIMA K??stu??io pa??tomatas (naujas!)", "54.693457", "25.251060", "77730", "Vilnius", "K??stu??io g. 37, Vilnius ", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Vilniaus MAXIMA Naugarduko pa??tomatas (naujas!)", "54.669109", "25.258908", "77732", "Vilnius", "Naugarduko g. 84, Vilnius", "Pa??tomat?? rasite lauke prie sienos i?? Naugarduko g. pus??s"],
            ["Vilniaus MAXIMA Pilait??s pa??tomatas (naujas!)", "54.709891", "25.188744", "77733", "Vilnius", "Pilait??s pr. 31, Vilnius", "Pa??tomat?? rasite lauke prie sienos i?? Pilait??s pr. pus??s"],
            ["Vilniaus MAXIMA Sausio 13-os pa??tomatas (naujas!)", "54.692867", "25.221685", "88822", "Vilnius", "Sausio 13-sios g. 2, Vilnius", "Pa??tomat?? rasite lauke, kair??je ????jimo ?? Maxima pus??je, prie sienos"],
            ["Vilniaus MAXIMA Savanori?? 31 pa??tomatas (naujas!)", "54.673977", "25.247888", "77726", "Vilnius", "Savanori?? pr. 31, Vilnius", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus MAXIMA Taikos 162A pa??tomatas (naujas!)", "54.712398", "25.215338", "77747", "Vilnius", "Taikos g. 162A, Vilnius", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Vilniaus MAXIMA Tuskul??n?? pa??tomatas", "54.702362", "25.288749", "88813", "Vilnius", "Tuskul??n?? g. 66, Vilnius", "Pa??tomat?? rasite lauke, de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus MAXIMA Vir??uli??ki?? pa??tomatas", "54.709389", "25.222248", "88820", "Vilnius", "Vir??uli??ki?? g. 30, Vilnius", "Pa??tomat?? rasite prie ??va??iavimo ?? stov??jimo aik??tel??"],
            ["Vilniaus MAXIMA ??altkalvi?? pa??tomatas", "54.661525", "25.272317", "88889", "Vilnius", "??altkalvi?? g. 2, Vilnius", "Pa??tomat?? rasite lauke,  prie pastato sienos ??alia taromato"],
            ["Vilniaus NORFA Geni?? pa??tomatas", "54.688179", "25.421732", "88848", "Vilnius", "Geni?? g. 10A, Vilnius", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus NORFA Minsko pa??tomatas", "54.652141", "25.305245", "88878", "Vilnius", "Minsko pl. 3, Vilnius", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus NORFA Mol??t?? pl. pa??tomatas", "54.772007", "25.272299", "88890", "Vilnius", "Mol??t?? pl. 47, Vilnius", "Pa??tomat?? rasite lauke, prie pastato sienos i?? Mol??t?? pl. pus??s"],
            ["Vilniaus NORFA Rygos pa??tomatas (naujas!)", "54.719011", "25.212367", "77734", "Vilnius", "Rygos g. 49, Vilnius", "Pa??tomat?? rasite lauke prie sienos i?? Rygos g. pus??s"],
            ["Vilniaus NORFA ??valg?? pa??tomatas", "54.721530", "25.287830", "88879", "Vilnius", "Kalvarij?? g. 151, Vilnius", "Pa??tomat?? rasite lauke, de??in??je ????jimo ?? prekybos centr?? pus??je, u?? kampo prie sienos"],
            ["Vilniaus PC DOMUS PRO pa??tomatas", "54.740274", "25.225183", "88811", "Vilnius", "Ukmerg??s g.?? 308, Vilnius", "Pa??tomat?? rasite lauke, prie pastato sienos i?? Ukmerg??s g. pus??s"],
            ["Vilniaus PC MANDARINAS pa??tomatas", "54.731491", "25.246227", "88814", "Vilnius", "Ateities g. 91, Vilnius", "Pa??tomat?? rasite lauke, prie ????jimo ?? prekybos centr??"],
            ["Vilniaus RIMI Architekt?? pa??tomatas", "54.673672", "25.213588", "88858", "Vilnius", "Architekt?? g. 19, Vilnius", "Pa??tomat?? rasite lauke, u?? kampo prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus RIMI Fabijoni??ki?? pa??tomatas (naujas!)", "54.720785", "25.244945", "77735", "Vilnius", "Ukmerg??s g. 233, Vilnius", "Pa??tomat?? rasite lauke prie sienos i?? Ukmerg??s g. pus??s"],
            ["Vilniaus RIMI Kareivi?? pa??tomatas (naujas!)", "54.717897", "25.300539", "77736", "Vilnius", "Kareivi?? g. 11A, Vilnius", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? prekybos centr?? pus??je, u?? kampo"],
            ["Vilniaus RIMI Medeinos pa??tomatas (naujas!)", "54.729596", "25.227436", "77737", "Vilnius", "Medeinos g. 8, Vilnius", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Vilniaus RIMI Rygos pa??tomatas", "54.715958", "25.224777", "88859", "Vilnius", "Rygos g. 8, Vilnius", "Pa??tomat?? rasite lauke, u?? kampo prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["Vilniaus RIMI Savanori?? pa??tomatas", "54.675640", "25.257998", "88815", "Vilnius", "Kedr?? g. 4, Vilnius", "Pa??tomat?? rasite lauke, kair??je pagrindinio i??jimo ?? prekybos centr?? pus??je, prie sienos"],
            ["Vilniaus RIMI Vyd??no pa??tomatas", "54.707191", "25.188892", "88823", "Vilnius", "Vyd??no g. 4, Vilnius", "Pa??tomat?? rasite lauke, prie ????jimo ?? prekybos centr??"],
            ["Vilniaus RIMI Zaras?? g. pa??tomatas (naujas!)", "54.680886", "25.311600", "77738", "Vilnius", "Zaras?? g. 5A, Vilnius", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["Vilniaus RIMI ??irm??n?? pa??tomatas", "54.712017", "25.300741", "88816", "Vilnius", "??irm??n?? g. 64, Vilnius", "Pa??tomat?? rasite lauke, prie \"Topo centro\" ????jimo, kair??je pus??je"],
            ["Vilniaus VC ??ALGIRIO 135 pa??tomatas (naujas!)", "54.704816", "25.272422", "77743", "Vilnius", "??algirio g. 135, Vilnius ", "Pa??tomat?? rasite lauke prie sienos, prie ??va??iavimo ?? vidin?? kiem?? i?? ??algirio g. pus??s"],
            ["Vilniaus VIADA Saltoni??ki?? pa??tomatas", "54.699135", "25.260015", "88818", "Vilnius", "Saltoni??ki?? g. 12, Vilnius", "Pa??tomat?? rasite lauke, de??in??je degalin??s pus??je"],
            ["Vilniaus VIADA Saul??tekio pa??tomatas", "54.726292", "25.326769", "88826", "Vilnius", "Nemen??in??s pl. 5, Vilnius", "Pa??tomat?? rasite lauke, galin??je degalin??s pus??je"],
            ["Visagino VIADA pa??tomatas", "55.594598", "26.438796", "88840", "Visaginas", "Statybinink?? g. 1, Visaginas", "Pa??tomat?? rasite lauke, u?? kampo prie sienos de??in??je ????jimo ?? degalin?? pus??je"],
            ["Zaras?? IKI Vytauto pa??tomatas (naujas!)", "55.736384", "26.264755", "88845", "Zarasai", "Vytauto g. 54, Zarasai", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["??ILUT??S PREKYBA Lietuvinink?? 37 pa??tomatas", "55.343229", "21.471249", "88833", "??ilut??", "Lietuvinink?? g. 37, ??ilut??", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["??aki?? NORFA ??auli?? pa??tomatas", "54.960627", "23.031055", "88824", "??akiai", "??auli?? g. 49, ??akiai", "Pa??tomat?? rasite lauke, prie sienos kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["??al??inink?? NORFA pa??tomatas (naujas!)", "54.317769", "25.383816", "77719", "??al??ininkai", "Vilniaus g. 2B, ??al??ininkai", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["??eduvos NORFA pa??tomatas (naujas!)", "55.756241", "23.762468", "77720", "??eduva", "Panev????io g. 33, ??eduva", "Pa??tomat?? rasite lauke prie sienos u?? kampo, de??in??je ????jimo ?? parduotuv?? pus??je"],
            ["??iauli?? MOKI-VE??I pa??tomatas", "55.917301", "23.301418", "88844", "??iauliai", "Pramon??s g. 7, ??iauliai", "Pa??tomat?? rasite lauke, prie stiklin??s vitrinos  kair??je ????jimo ?? prekybos centr?? pus??je"],
            ["??iauli?? NORFA Til????s 13A pa??tomatas (naujas!)", "55.911563", "23.268380", "77721", "??iauliai", "Til????s g. 13A, ??iauliai", "Pa??tomat?? rasite lauke prie sienos i?? parkavimo aik??tel??s pus??s"],
            ["??iauli?? NORFA Valan??iaus pa??tomatas", "55.938897", "23.305095", "88880", "??iauliai", "M.Valan??iaus g. 18, ??iauliai", "Pa??tomat?? rasite lauke, prie sienos de??in??je ????jimo ?? prekybos centr?? pus??je"],
            ["??iauli?? PC ARENA pa??tomatas", "55.906536", "23.258636", "88842", "??iauliai", "Gegu??i?? g. 30, ??iauliai", "Pa??tomat?? rasite lauke, prie ????jimo ?? JYSK de??in??je pus??je"],
            ["??iauli?? PC SAUL??S MIESTAS pa??tomatas (naujas!)", "55.927737", "23.307049", "77741", "??iauliai", "Til????s g. 109, ??iauliai", "Pa??tomat?? rasite lauke prie sienos i?? Autobus?? stoties perono pus??s"],
            ["??iauli?? VIADA Til????s pa??tomatas", "55.944092", "23.331217", "88843", "??iauliai", "Til????s g. 274, ??iauliai", "Pa??tomat?? rasite lauke prie degalin??s"],
            ["??ilal??s NORFA pa??tomatas", "55.490946", "22.188493", "88825", "??ilal??", "Taurag??s g. 1, ??ilal??", "Pa??tomat?? rasite lauke, kair??je ????jimo ?? prekybos centr?? pus??je, u?? kampo prie sienos"],
            ["??ilut??s MAXIMA Mi??ko pa??tomatas (naujas!)", "55.350800", "21.479337", "77746", "??ilut??", "Mi??ko g. 7, ??ilut??", "Pa??tomat?? rasite lauke prie pastato sienos"],
            ["??irvint?? MAXIMA pa??tomatas (naujas!)", "55.038093", "24.955586", "77722", "??irvintos", "I.??einiaus g. 19, ??irvintos", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"],
            ["??ven??ioni?? MAXIMA pa??tomatas (naujas!)", " 55.129970", "26.150541", "77723", "??ven??ionys", "Vilniaus g. 37, ??ven??ionys", "Pa??tomat?? rasite lauke prie sienos, kair??je ????jimo ?? parduotuv?? pus??je"]
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

        .omniva-btn {


            border-radius: 3px;
            background-color: black;
            color: white;
            text-transform: uppercase;
            width: 100%;
            font-weight: 600;
            transition-duration: 0.2s;
            padding: 0.625rem 0.625rem;
            font-size: 0.875rem;

        }

        .omniva-btn:hover {
            background-color: #1e293b;
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
            background-color: #fff;
            position: relative;
            max-width: 500px;
        }

        .omniva-terminals-list .omniva-inner-container {
            position: absolute;
            background: #fff;
            z-index: 100;
            border: 1px solid #aaa;
            border-top: none;
            border-radius: 0 0 4px 4px;
            width: 100%;
        }

        .omniva-terminals-list .omniva-dropdown {
            border: 1px solid #aaa;
            border-radius: 4px;
            word-wrap: normal;
            overflow: hidden;
            height: 33px;
            line-height: 28px;
            width: 100%;
            position: relative;
            cursor: pointer;
            padding: 2px 20px 2px 5px;
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
            background-color: #ff6319;
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

</div>

@endsection