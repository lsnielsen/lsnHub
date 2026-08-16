

<?php

// 1. STATISKE DATA FOR ABONNEMENTER
$abonnementer = [
    [
        'id' => 'yousee',
        'navn' => 'YouSee',
        'kategori' => 'Internet & Telefoni',
        'original_beloeb' => 320,
        'interval' => 'mdr', // mdr, hver_2_mdr, kvartal, halvaar, aar
        'interval_tekst' => 'Månedligt',
        'hjemmeside' => 'https://login.yousee.dk',
        'beskrivelse' => 'Hurtigt bredbåndsinternet til boligen',
        'betalingsmetode' => 'Betalingsservice'
    ],
    [
        'id' => 'callme',
        'navn' => 'Callme',
        'kategori' => 'Internet & Telefoni',
        'original_beloeb' => 100,
        'interval' => 'mdr',
        'interval_tekst' => 'Månedligt',
        'hjemmeside' => 'https://www.callme.dk/selvbetjening',
        'beskrivelse' => 'Mobilabonnement med fri tale og data',
        'betalingsmetode' => 'Kreditkort'
    ],
    [
        'id' => 'google-ai',
        'navn' => 'Google AI',
        'kategori' => 'Software & AI',
        'original_beloeb' => 800,
        'interval' => 'aar',
        'interval_tekst' => 'Årligt (800 kr./år)',
        'hjemmeside' => 'https://one.google.com',
        'beskrivelse' => 'Gemini Advanced AI model & Google One lagerplads',
        'betalingsmetode' => 'Kreditkort'
    ],
    [
        'id' => 'vestforsyning',
        'navn' => 'Vestforsyning',
        'kategori' => 'Forsyning & Energi',
        'original_beloeb' => 1900,
        'interval' => 'kvartal',
        'interval_tekst' => 'Kvartalsvist (1.900 kr./kvartal)',
        'hjemmeside' => 'https://www.vestforsyning.dk',
        'beskrivelse' => 'Fjernvarme i Holstebro området',
        'betalingsmetode' => 'Betalingsservice'
    ],
    [
        'id' => 'dansk-forsyning',
        'navn' => 'Dansk Forsyning',
        'kategori' => 'Forsyning & Energi',
        'original_beloeb' => 850,
        'interval' => 'kvartal',
        'interval_tekst' => 'Kvartalsvist (850 kr./kvartal)',
        'hjemmeside' => 'https://danskelforsyning.dk',
        'beskrivelse' => 'Elforbrug og transportafgifter',
        'betalingsmetode' => 'Betalingsservice'
    ],
    [
        'id' => 'holstebro-musikskole',
        'navn' => 'Holstebro Musikskole',
        'kategori' => 'Fritid & Uddannelse',
        'original_beloeb' => 2100,
        'interval' => 'hver_2_mdr',
        'interval_tekst' => 'Hver 2. måned (2.100 kr.)',
        'hjemmeside' => 'https://holstebromusikskole.dk',
        'beskrivelse' => 'Musikundervisning og sæsonkontingent',
        'betalingsmetode' => 'Betalingsservice'
    ],
    [
        'id' => 'jyllandsposten',
        'navn' => 'Jyllands-Posten',
        'kategori' => 'Nyheder & Medier',
        'original_beloeb' => 1800,
        'interval' => 'aar',
        'interval_tekst' => 'Årligt (1.800 kr./år)',
        'hjemmeside' => 'https://jyllands-posten.dk/selvbetjening/abonnement/oversigt',
        'beskrivelse' => 'Digitalt avisabonnement og nyhedsoverblik',
        'betalingsmetode' => 'Kreditkort'
    ],
    [
        'id' => 'berlingske',
        'navn' => 'Berlingske',
        'kategori' => 'Nyheder & Medier',
        'original_beloeb' => 179,
        'interval' => 'mdr',
        'interval_tekst' => 'Månedligt',
        'hjemmeside' => 'https://www.berlingske.dk/abonnement',
        'beskrivelse' => 'Digital adgang til nyheder og analyser (vejledende pris)',
        'betalingsmetode' => 'Kreditkort'
    ],
    [
        'id' => 'liberal-alliance',
        'navn' => 'Liberal Alliance',
        'kategori' => 'Medlemskaber & Foreninger',
        'original_beloeb' => 400,
        'interval' => 'aar',
        'interval_tekst' => 'Årligt (400 kr./år)',
        'hjemmeside' => 'https://liberalalliance.membersite.dk/Home/MyInvoices',
        'beskrivelse' => 'Årligt partikontingent og medlemskab',
        'betalingsmetode' => 'Kreditkort'
    ],
    [
        'id' => 'pinsekirke-holstebro',
        'navn' => 'Pinsekirke Holstebro',
        'kategori' => 'Medlemskaber & Foreninger',
        'original_beloeb' => 100,
        'interval' => 'mdr',
        'interval_tekst' => 'Månedligt',
        'hjemmeside' => 'https://pinsekirken-holstebro.dk',
        'beskrivelse' => 'Fast månedligt bidrag og kirkekontingent',
        'betalingsmetode' => 'Bankoverførsel'
    ],
    [
        'id' => 'bodyfit',
        'navn' => 'Bodyfit',
        'kategori' => 'Sundhed & Træning',
        'original_beloeb' => 180,
        'interval' => 'mdr',
        'interval_tekst' => 'Månedligt',
        'hjemmeside' => 'https://bodyfit.dk',
        'beskrivelse' => 'Fitnesscenter medlemskab og træning',
        'betalingsmetode' => 'Betalingsservice'
    ],
    [
        'id' => 'andelsbolig',
        'navn' => 'Andelsbolig',
        'kategori' => 'Bolig & Husleje',
        'original_beloeb' => 2200,
        'interval' => 'mdr',
        'interval_tekst' => 'Månedligt',
        'hjemmeside' => 'https://www.prosedo.dk',
        'beskrivelse' => 'Månedlig boligafgift og fællesudgifter til forening',
        'betalingsmetode' => 'Betalingsservice'
    ],
    [
        'id' => 'vestjysk-forsikring',
        'navn' => 'Vestjysk Forsikring',
        'kategori' => 'Forsikring',
        'original_beloeb' => 3500,
        'interval' => 'aar',
        'interval_tekst' => 'Årligt (3.500 kr./år)',
        'hjemmeside' => 'https://www.vestjyskforsikring.dk',
        'beskrivelse' => 'Indbo-, ulykke- og familieforsikring',
        'betalingsmetode' => 'Betalingsservice'
    ],
    [
        'id' => 'viaplay',
        'navn' => 'Viaplay',
        'kategori' => 'Streaming & Underholdning',
        'original_beloeb' => 160,
        'interval' => 'mdr',
        'interval_tekst' => 'Månedligt',
        'hjemmeside' => 'https://viaplay.dk/account',
        'beskrivelse' => 'Film, serier og underholdning',
        'betalingsmetode' => 'Kreditkort'
    ]
];

// 2. BEREGNINGS-FUNKTIONER I PHP
function beregnMaanedligPris($beloeb, $interval) {
    switch ($interval) {
        case 'mdr': return $beloeb;
        case 'hver_2_mdr': return ($beloeb * 6) / 12;
        case 'kvartal': return ($beloeb * 4) / 12;
        case 'halvaar': return ($beloeb * 2) / 12;
        case 'aar': return $beloeb / 12;
        default: return $beloeb;
    }
}

function beregnAarligPris($beloeb, $interval) {
    switch ($interval) {
        case 'mdr': return $beloeb * 12;
        case 'hver_2_mdr': return $beloeb * 6;
        case 'kvartal': return $beloeb * 4;
        case 'halvaar': return $beloeb * 2;
        case 'aar': return $beloeb;
        default: return $beloeb * 12;
    }
}

function formatDkk($beloeb) {
    return number_format($beloeb, ($beloeb == floor($beloeb)) ? 0 : 2, ',', '.') . ' kr.';
}


// 3. STATISTIK OG TOTALER
$totalMaaned = 0;
$totalAar = 0;
$kategoriTotaler = [];

foreach ($abonnementer as &$item) {
    $item['maanedlig_pris'] = beregnMaanedligPris($item['original_beloeb'], $item['interval']);
    $item['aarlig_pris'] = beregnAarligPris($item['original_beloeb'], $item['interval']);
    $item['dags_pris'] = $item['aarlig_pris'] / 365;

    $totalMaaned += $item['maanedlig_pris'];
    $totalAar += $item['aarlig_pris'];

    $kat = $item['kategori'];
    if (!isset($kategoriTotaler[$kat])) {
        $kategoriTotaler[$kat] = 0;
    }
    $kategoriTotaler[$kat] += $item['maanedlig_pris'];
}
unset($item);

$totalKvartal = $totalMaaned * 3;
$totalDag = $totalAar / 365;
$antalAbonnementer = count($abonnementer);

// Sorter kategorier efter størst forbrug
arsort($kategoriTotaler);


?>


