<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomNames = [
            "Jonas Jonuks", "Tadas Barisas",
            "Matas Kimalaitis", "Marius Trimuliovas",
            "Agne Kordinaitė", "Asta Asta",
            "Iveta Naviraitė", "Gabriela Budrevičienė",
            "Aurimas Adomėnas", "Eugenija Kazlauskaitė",
            "Orestas Vyšniauskas", "Nedas Kubilius",
            "Mantas  Oginskas", "Wilson",
            "Lauryna Andriukaitienė", "Donalda Kazlauskienė",
            "Edita Stanaitytė", "Aliuks Aliuks",
            "The Erikas", "Duminu Duminu",
            "Emilis Pakuckas", "Kaja Baškevičiūtė",
            "Smokeris xd", "Nojka",
            "Edvinas xharasho", "Edvis",
            "Nomeda2002", "Teta220",
        ];

        $formalHeading = [
            "Nu neblogas",
            "patiko",
            "gerulis, sitos firmos man geriausi",
            "Labai patiko :)",
            "Radau sau tinkamiausia",
            "Ir nebrangu ir skanu",
            "Aciu, pabandėm ir patiko",
            "Skanus",
            "Oho, šitas pats tas",
            "Omg baikit, paliksiu savo alga visa",
            "ople, nustebino",
            "Geras, aciu",
            "Patiko, ačiū",
            "Pirksiu dar :)",
            "Visai nieko toks",
            "Man kaip tik",
            "geras, rekomenduoju",
            "Paliko gerą įspudį",
            "neišpirkit, nes imsiu dar :D",
            "Opa",
            "Geruls",
            "aciu",
            "Ačiu, greitai gavau",
            "Retai rašau atsiliepimus",
            "išties neblogas",
            "Toks kokio ir tikėjaus :d"

        ];

        $specificHeading = [
            "Greiciau atejo, nei buciau pats suvaiksciojas iki pardes",
            "Cigonai interete? Man patikti :Dd",
            "Gerai čia sumastė su tom spalvom",
            "rekomenduoju, tik nenusirukytkit xd",
            "Ai kazinau, neblogi visi bet mangas vistiek geriausias",
            "Kokia aš atsilikus 🤦‍♀️ mačiau tokį centriuky ant suoliuko, ir galvoju- kaip keista kad šiais laikais dar muštukus/kandiklius naudoja",
            "Nu grynai, as ir durna jauciausi :D bet jega siti dalykai",
            "Jei megstat saldesni skoni, ne toki astru",
            "rukant vidutiniskai (ne pastoviai, ne kas 30min) uztenka 2-3d",
            "Brolis ruko sita, is tikro skaniau kvepejo negu vape :D",
            "Bent jau as, kai rukau vidutiniskai. Snd surukiau 3 normalias cigaretes, kai buvo yprasta apie 10-13, ziuresiu kiek uzteks sito",
            "Beto, isardzius galima pakraut jei tvarkingai isardai ir pripilt 2ml skyscio, ir toliau veiktu :D",
            "sveiki, gal žinot kur įsigyti elfbar arbūzinį?",
            "Nebandet tabako skonio?",
            "sunku apibudinti, bet nustebau, nes maniau kad slykstokas gali buti. Man dar patiko skonis, jauciasi saldumas ir aromatas 🙂",
            "Nusipirkau dvi - persikų ir bananų, nesuprantu kaip, bet per dieną išrūkiau viską. Bet skonis labai geras :D",
            "kam valgyt vaisius jei sitas yra xd",
            "sunku saika palaikyt kai toks skonis, suss",
            "skaiciavau traukimu skaiciu, tai tiek kiek parasyta :D jkj, neblogas sitas",
            "kas skanu tas nesveika, bet pagarinau ir nebesuku galvos ",
            "Tikrai geras",
            "Skanus!",
            "Wow, patiko",
            "nunese galva xd",
            "Tapau su situ narkomanas lmao",
            "kaip druskos nemegejui, pakanka",
            "zjbs, greit atsiunte",
            "Galetu ir elekronkei sykstis sitas but, zjbs",
            "elekronkei sykstis sitas galetu but, skanu",
            "Mama uzuodus susigunde net :D",
            "tevai uzeja i kambari galvoja,kad saldainiu priedes :p",
            "ulialia, patiko",


            // formalesni kad tikriau
            "Nu neblogas",
            "patiko",
            "gerulis, sitos firmos man geriausi",
            "Labai patiko :)",
            "Radau sau tinkamiausia",
            "Ir nebrangu ir skanu",
            "Aciu, pabandėm ir patiko",
            "Skanus",
            "Oho, šitas pats tas",
            "Omg baikit, paliksiu savo alga visa",
            "ople, nustebino",
            "Geras, aciu",
            "Patiko, ačiū",
            "Pirksiu dar :)",
            "Visai nieko toks",
            "Man kaip tik",
            "geras, rekomenduoju",
            "Paliko gerą įspudį",
            "neišpirkit, nes imsiu dar :D",
            "Opa",
            "Geruls",
            "aciu",
            "Ačiu, greitai gavau",
            "Retai rašau atsiliepimus",
            "išties neblogas",
            "Toks kokio ir tikėjaus :d",
            "geras",
            "geras",
            "geras",
            "geras",
            "Geras",
            "Geras",
            "Ok",
            "Gud",
            "ok",
            "ok",
            "ok",
            "ok",
            "ok",
            "zjbs"
        ];

        $randomDescription = [
            "Tikrai rekomenduosiu draugams",
            "Nemeluosiu, likau maloniai nustebinta",
            "Ar bandet?
Manau neapsimoka. Bet siandien nusipirkau, tai visa diena po truputi vis parukau, ir kvepia nerealiai :D kambarys kvepia situ skoniu, wow 😍",
            "As irgi isgirdau koleges snekant apie situs, bet pabandziau, tai man kazkas tokio, aisku rukau ir cigaretes y tarpus, bet tikrai gerai",
            "Man jos kaip saldaines 🤦‍♀️🤣 Darbe prisipirko net nerūkančios",
            "Aš nusipirkau iš eco dūmo,atlaikė nepilnai parą,tikrai nebuvo virš 400 įtraukimų,bet skanu.. Pirkau blueberry&rasberry.
            Vakar iš royal nusipirkau strawberry&kiwi,skonis nerealus ir pati cigaretė daug smagesnė,žiūrėsiu kiek šita atlaikys. :D
            Žiauru,pinigai į balą,bet užsikabinau.. :D",
            "Vau, del to ir domejausi, kaip sumazinti tarsa, panaudojant vis is naujo ir is naujo, pakraunant vis baterija. Bye😘",
            "Nusipirkau vynuogiu ir liciu,dabar vynuogiu atidariau,isemaiu is dezuciu,ipakavimuose buvau laikius,maniskis klausia kas cia sakau kvepalu meginukai:)))))patikejo:))).tai pirmas ispudis geras,kvapas ir skonis patiko,as vienam parukymui 15 dumu padarydavau su paprasta glamour plona ciigarete,su sia tiek pat darau.",
            "uztenka sociai.ziuresiu kiek laikys.kolkas viskas super:)"
        ];

        $heading = mt_rand(0, (count($formalHeading) + count($specificHeading)) - 2);
        $description = '';

        if ($heading >= count($formalHeading)) {
            $heading = $specificHeading[$heading - count($formalHeading)];
        } else {
            $heading = $formalHeading[$heading];
            $description = $randomDescription[mt_rand(0, count($randomDescription) - 1)];
        }

        $date = mt_rand(1641580469, 1659897269);

        $productsCount = count(Product::all());


        return [
            'name' => $randomNames[rand(0, count($randomNames) - 1)],
            'heading' => $heading,
            'description' => $description,
            'rating' => mt_rand(3, 5),
            'accepted' => 1,
            'user_id' => 1,
            'product_id' => mt_rand(1, $productsCount),
            'created_at' => date("Y-m-d H:i:s", $date),
        ];
    }
}
