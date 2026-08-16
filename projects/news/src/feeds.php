<?php
/**
 * Global Nyhedsoversigt - PHP Feeds Definition
 * Inkluderer kilder fra Danmark, Sverige, Europa, USA, Latinamerika, Brasilien, Afrika, Asien m.fl.
 * Sprog: Dansk, Engelsk, Spansk, Fransk, Svensk, Italiensk, Hollandsk, Portugisisk
 */

return [
    // --- DANMARK (DA) ---
    [
        'id' => 'dr-nyheder',
        'name' => 'DR Nyheder',
        'country' => 'Danmark',
        'country_code' => 'DK',
        'flag' => '🇩🇰',
        'region' => 'danmark',
        'language' => 'da',
        'language_name' => 'Dansk',
        'category' => 'top',
        'url' => 'https://www.dr.dk/nyheder',
        'feed_url' => 'https://www.dr.dk/nyheder/service/feeds/allenyheder',
        'description' => 'Danmarks Radio – seneste nyt fra indland og udland'
    ],
    [
        'id' => 'dr-udland',
        'name' => 'DR Udland',
        'country' => 'Danmark',
        'country_code' => 'DK',
        'flag' => '🇩🇰',
        'region' => 'danmark',
        'language' => 'da',
        'language_name' => 'Dansk',
        'category' => 'world',
        'url' => 'https://www.dr.dk/nyheder/udland',
        'feed_url' => 'https://www.dr.dk/nyheder/service/feeds/udland',
        'description' => 'DRs udenrigsredaktion'
    ],
    [
        'id' => 'tv2-nyheder',
        'name' => 'TV 2 Nyheder',
        'country' => 'Danmark',
        'country_code' => 'DK',
        'flag' => '🇩🇰',
        'region' => 'danmark',
        'language' => 'da',
        'language_name' => 'Dansk',
        'category' => 'top',
        'url' => 'https://nyheder.tv2.dk',
        'feed_url' => 'https://feeds.tv2.dk/nyheder/rss',
        'description' => 'TV 2 Danmarks seneste tophistorier'
    ],
    [
        'id' => 'berlingske',
        'name' => 'Berlingske',
        'country' => 'Danmark',
        'country_code' => 'DK',
        'flag' => '🇩🇰',
        'region' => 'danmark',
        'language' => 'da',
        'language_name' => 'Dansk',
        'category' => 'politics',
        'url' => 'https://www.berlingske.dk',
        'feed_url' => 'https://www.berlingske.dk/rss',
        'description' => 'Berlingske politik og udland'
    ],

    // --- SVERIGE (SV) ---
    [
        'id' => 'svt-nyheter',
        'name' => 'SVT Nyheter',
        'country' => 'Sverige',
        'country_code' => 'SE',
        'flag' => '🇸🇪',
        'region' => 'norden',
        'language' => 'sv',
        'language_name' => 'Svensk',
        'category' => 'top',
        'url' => 'https://www.svt.se/nyheter',
        'feed_url' => 'https://www.svt.se/nyheter/rss.xml',
        'description' => 'Sveriges Television nyhetsflöde'
    ],
    [
        'id' => 'svt-utrikes',
        'name' => 'SVT Utrikes',
        'country' => 'Sverige',
        'country_code' => 'SE',
        'flag' => '🇸🇪',
        'region' => 'norden',
        'language' => 'sv',
        'language_name' => 'Svensk',
        'category' => 'world',
        'url' => 'https://www.svt.se/nyheter/utrikes',
        'feed_url' => 'https://www.svt.se/nyheter/utrikes/rss.xml',
        'description' => 'Internationella nyheter från SVT'
    ],

    // --- ENGELSK / GLOBAL / USA / UK (EN) ---
    [
        'id' => 'bbc-world',
        'name' => 'BBC News (World)',
        'country' => 'Storbritannien / Global',
        'country_code' => 'GB',
        'flag' => '🇬🇧',
        'region' => 'globalt',
        'language' => 'en',
        'language_name' => 'Engelsk',
        'category' => 'world',
        'url' => 'https://www.bbc.com/news/world',
        'feed_url' => 'https://feeds.bbci.co.uk/news/world/rss.xml',
        'description' => 'Global flagship coverage from BBC'
    ],
    [
        'id' => 'the-guardian',
        'name' => 'The Guardian',
        'country' => 'Storbritannien / Global',
        'country_code' => 'GB',
        'flag' => '🌍',
        'region' => 'globalt',
        'language' => 'en',
        'language_name' => 'Engelsk',
        'category' => 'top',
        'url' => 'https://www.theguardian.com/world',
        'feed_url' => 'https://www.theguardian.com/world/rss',
        'description' => 'International reporting from The Guardian'
    ],
    [
        'id' => 'cnn-world',
        'name' => 'CNN International',
        'country' => 'USA',
        'country_code' => 'US',
        'flag' => '🇺🇸',
        'region' => 'usa',
        'language' => 'en',
        'language_name' => 'Engelsk',
        'category' => 'world',
        'url' => 'https://edition.cnn.com/world',
        'feed_url' => 'http://rss.cnn.com/rss/edition_world.rss',
        'description' => 'CNN World Breaking News'
    ],
    [
        'id' => 'politico-eu',
        'name' => 'Politico Europe',
        'country' => 'EU / Bruxelles',
        'country_code' => 'EU',
        'flag' => '🇪🇺',
        'region' => 'europa',
        'language' => 'en',
        'language_name' => 'Engelsk',
        'category' => 'politics',
        'url' => 'https://www.politico.eu',
        'feed_url' => 'https://www.politico.eu/feed/',
        'description' => 'European policy and diplomacy'
    ],

    // --- SPANSK (ES) ---
    [
        'id' => 'el-pais',
        'name' => 'El País',
        'country' => 'Spanien / Global',
        'country_code' => 'ES',
        'flag' => '🇪🇸',
        'region' => 'europa',
        'language' => 'es',
        'language_name' => 'Spansk',
        'category' => 'top',
        'url' => 'https://elpais.com',
        'feed_url' => 'https://feeds.elpais.com/mrss-s/pages/ep/site/elpais.com/portada',
        'description' => 'El periódico global de referencia en español'
    ],
    [
        'id' => 'bbc-mundo',
        'name' => 'BBC Mundo',
        'country' => 'Latinamerika / Verden',
        'country_code' => 'LA',
        'flag' => '🌎',
        'region' => 'latinamerika',
        'language' => 'es',
        'language_name' => 'Spansk',
        'category' => 'world',
        'url' => 'https://www.bbc.com/mundo',
        'feed_url' => 'https://feeds.bbci.co.uk/mundo/rss.xml',
        'description' => 'Noticias de América Latina y el mundo'
    ],

    // --- FRANSK (FR) ---
    [
        'id' => 'le-monde',
        'name' => 'Le Monde',
        'country' => 'Frankrig',
        'country_code' => 'FR',
        'flag' => '🇫🇷',
        'region' => 'europa',
        'language' => 'fr',
        'language_name' => 'Fransk',
        'category' => 'top',
        'url' => 'https://www.lemonde.fr',
        'feed_url' => 'https://www.lemonde.fr/rss/une.xml',
        'description' => 'L\'actualité française et internationale en continu'
    ],
    [
        'id' => 'france-24-fr',
        'name' => 'France 24',
        'country' => 'Frankrig / Verden',
        'country_code' => 'FR',
        'flag' => '🇫🇷',
        'region' => 'europa',
        'language' => 'fr',
        'language_name' => 'Fransk',
        'category' => 'world',
        'url' => 'https://www.france24.com/fr',
        'feed_url' => 'https://www.france24.com/fr/rss',
        'description' => 'L\'information internationale en direct'
    ],

    // --- ITALIENSK (IT) ---
    [
        'id' => 'corriere-della-sera',
        'name' => 'Corriere della Sera',
        'country' => 'Italien',
        'country_code' => 'IT',
        'flag' => '🇮🇹',
        'region' => 'europa',
        'language' => 'it',
        'language_name' => 'Italiensk',
        'category' => 'top',
        'url' => 'https://www.corriere.it',
        'feed_url' => 'https://xml2.corriereobjects.it/rss/homepage.xml',
        'description' => 'Politica, esteri, economia e cronaca'
    ],

    // --- HOLLANDSK (NL) ---
    [
        'id' => 'nos-nieuws',
        'name' => 'NOS Nieuws',
        'country' => 'Holland',
        'country_code' => 'NL',
        'flag' => '🇳🇱',
        'region' => 'europa',
        'language' => 'nl',
        'language_name' => 'Hollandsk',
        'category' => 'top',
        'url' => 'https://nos.nl',
        'feed_url' => 'https://feeds.nos.nl/nosnieuwsalgemeen',
        'description' => 'Het laatste nieuws uit Nederland en de wereld'
    ],

    // --- BRASILIEN (PT) ---
    [
        'id' => 'g1-globo',
        'name' => 'G1 Globo',
        'country' => 'Brasilien',
        'country_code' => 'BR',
        'flag' => '🇧🇷',
        'region' => 'latinamerika',
        'language' => 'pt',
        'language_name' => 'Portugisisk (Brasilien)',
        'category' => 'top',
        'url' => 'https://g1.globo.com',
        'feed_url' => 'https://g1.globo.com/rss/g1/',
        'description' => 'O portal de notícias da Globo'
    ],

    // --- AFRIKA (EN / FR) ---
    [
        'id' => 'bbc-africa',
        'name' => 'BBC News Africa',
        'country' => 'Afrika',
        'country_code' => 'AF',
        'flag' => '🌍',
        'region' => 'afrika',
        'language' => 'en',
        'language_name' => 'Engelsk',
        'category' => 'world',
        'url' => 'https://www.bbc.com/news/world/africa',
        'feed_url' => 'https://feeds.bbci.co.uk/news/world/africa/rss.xml',
        'description' => 'News, culture and politics from across Africa'
    ],

    // --- ASIEN & JAPAN & KINA (EN) ---
    [
        'id' => 'nhk-world',
        'name' => 'NHK World Japan',
        'country' => 'Japan',
        'country_code' => 'JP',
        'flag' => '🇯🇵',
        'region' => 'asien',
        'language' => 'en',
        'language_name' => 'Engelsk',
        'category' => 'top',
        'url' => 'https://www3.nhk.or.jp/nhkworld/en/news/',
        'feed_url' => 'https://www3.nhk.or.jp/rss/news/cat0.xml',
        'description' => 'Latest news and updates from Japan and East Asia'
    ]
];
