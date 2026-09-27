
<?php

// An array of inspiring quotes for writers
$quotes = [
    "Be kind to unkind people, they need it the most",
    "Hvor er NIELSEN? Din barret sejler",
    "You never know how strong you are, until being strong is the only choice you have",
    "Joo, men nu er du jo et godt stykke inde på kandidat studiet, så mon ikke liige vi skal prøve at spise brød til?",
     "For at få success, havde man også brug for held",
     "Sleep will not help, if it is your soul that is tired",
     "Som otte-årig var jeg involveret i en voldsom trafik ulykke"
];

// Pick one random quote from the list
$random_quote = $quotes[array_rand($quotes)];

?>


<style>

.quote-section {
    margin-top: 40px;
    padding: 20px;
    background: #fffdf5; /* Slightly different paper hue */
    border-left: 3px solid var(--sage);
    font-family: 'Merriweather', serif;
    font-style: italic;
    font-size: 0.95rem;
    color: #5d6d7e;
    line-height: 1.5;
    position: relative;
}

/* Adding a small decorative quote mark */
.quote-section::before {
    content: "“";
    position: absolute;
    top: -10px;
    left: 10px;
    font-size: 3rem;
    color: #efebe0;
    font-family: serif;
}

</style>

