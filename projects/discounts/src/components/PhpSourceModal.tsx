import React, { useState } from 'react';
import { X, Copy, Check, FileCode, Download, ExternalLink, Sparkles } from 'lucide-react';

interface PhpSourceModalProps {
  isOpen: boolean;
  onClose: () => void;
}

export const PhpSourceModal: React.FC<PhpSourceModalProps> = ({ isOpen, onClose }) => {
  const [activeTab, setActiveTab] = useState<'guide' | 'index' | 'data' | 'style'>('guide');
  const [copied, setCopied] = useState(false);

  if (!isOpen) return null;

  const files = {
    guide: `🚀 GUIDE: KØR TILBUDSOVERSIGTEN I XAMPP / MAMP / HTDOCS

1. Opret en mappe i din htdocs-mappe:
   - XAMPP (Windows): C:\\xampp\\htdocs\\tilbud\\
   - MAMP (macOS): /Applications/MAMP/htdocs/tilbud/
   - WAMP: C:\\wamp64\\www\\tilbud\\
   - Laragon: C:\\laragon\\www\\tilbud\\

2. Opret følgende 3 filer i mappen:
   - index.php (Kopier fra fanen 'index.php')
   - data.php  (Kopier fra fanen 'data.php')
   - style.css (Kopier fra fanen 'style.css')

3. Start Apache webserveren i dit kontrolpanel (f.eks. XAMPP Control Panel).

4. Åbn din browser og gå til:
   http://localhost/tilbud/index.php

✨ DATAHÅNDTERING & GITHUB:
- Alle data er gemt statisk i et struktureret PHP-array i 'data.php'.
- Ingen SQL database eller opsætning er påkrævet!
- Du kan pushe hele mappen til dit GitHub-repository og trække den direkte ned til dine udviklingsmiljøer.

🛍️ INKLUDEREDE TILBUD:
- Ritter Sport
- Coca Cola
- Chokolade (Marabou & Toms)
- Mathilde Kakaomælk
- Blandede frosne grøntsager
- Protein drinks (Barebells & Arla)
- Murphy Energi Bar
- Æble Juice (Rynkeby & God Morgen)`,

    index: `<?php
require_once 'data.php';

// Hent filtre fra URL parametre
$selected_category = isset($_GET['kategori']) ? $_GET['kategori'] : 'alle';
$selected_store = isset($_GET['butik']) ? $_GET['butik'] : 'alle';
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

// Filtrering af tilbud
$filtered_deals = array_filter($deals, function($deal) use ($selected_category, $selected_store, $search_query) {
    if ($selected_category !== 'alle' && $deal['category'] !== $selected_category) {
        return false;
    }
    if ($selected_store !== 'alle' && strtolower($deal['store']) !== strtolower($selected_store)) {
        return false;
    }
    if ($search_query !== '') {
        $search = mb_strtolower($search_query);
        $name = mb_strtolower($deal['name']);
        $brand = mb_strtolower($deal['brand']);
        $store = mb_strtolower($deal['store']);
        $variant = mb_strtolower($deal['variant'] ?? '');
        if (strpos($name, $search) === false && 
            strpos($brand, $search) === false && 
            strpos($store, $search) === false && 
            strpos($variant, $search) === false) {
            return false;
        }
    }
    return true;
});

// Beregn største besparelse
$max_savings_percent = 0;
foreach ($deals as $d) {
    $savings = calculate_savings($d['original_price'], $d['current_price']);
    if ($savings['percent'] > $max_savings_percent) {
        $max_savings_percent = $savings['percent'];
    }
}
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tilbudsoversigt - Find de bedste rabatter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container header-inner">
        <div class="logo-area">
            <div class="logo-icon">%</div>
            <div class="logo-text">
                <h1>Tilbudsoversigt</h1>
                <p>Hold øje med ugens bedste tilbud på dine favoritvarer</p>
            </div>
        </div>
        <div class="header-badge">
            Spar op til <strong><?php echo $max_savings_percent; ?>%</strong> på dagligvarer i denne uge
        </div>
    </div>
</header>

<main class="container">
    <section class="filter-section">
        <!-- Søgeformular -->
        <form method="GET" action="index.php" class="search-bar">
            <input 
                type="text" 
                name="q" 
                class="search-input" 
                placeholder="Søg efter Ritter Sport, Coca Cola, Mathilde, grøntsager, protein, Murphy bar, æblejuice..." 
                value="<?php echo htmlspecialchars($search_query); ?>"
            >
            <?php if ($selected_category !== 'alle'): ?>
                <input type="hidden" name="kategori" value="<?php echo htmlspecialchars($selected_category); ?>">
            <?php endif; ?>
            <?php if ($selected_store !== 'alle'): ?>
                <input type="hidden" name="butik" value="<?php echo htmlspecialchars($selected_store); ?>">
            <?php endif; ?>
            <button type="submit" class="pill active" style="border: none; cursor: pointer;">Søg</button>
            <?php if ($search_query !== '' || $selected_category !== 'alle' || $selected_store !== 'alle'): ?>
                <a href="index.php" class="pill" style="display: flex; align-items: center;">Nulstil</a>
            <?php endif; ?>
        </form>

        <!-- Kategori faner -->
        <div class="filter-pills">
            <a href="?kategori=alle<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'alle' ? 'active' : ''; ?>">✨ Alle varer</a>
            <a href="?kategori=slik_chokolade<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'slik_chokolade' ? 'active' : ''; ?>">🍫 Slik & Chokolade</a>
            <a href="?kategori=drikkevarer<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'drikkevarer' ? 'active' : ''; ?>">🥤 Sodavand & Cola</a>
            <a href="?kategori=juice<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'juice' ? 'active' : ''; ?>">🍎 Æble Juice</a>
            <a href="?kategori=frost<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'frost' ? 'active' : ''; ?>">🥦 Frost & Grønt</a>
            <a href="?kategori=mejeri<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'mejeri' ? 'active' : ''; ?>">🥛 Kakaomælk & Mejeri</a>
            <a href="?kategori=fitness_energi<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'fitness_energi' ? 'active' : ''; ?>">⚡ Protein & Energi Bar</a>
        </div>
    </section>

    <!-- Tilbudskort Grid -->
    <div class="deals-grid">
        <?php if (empty($filtered_deals)): ?>
            <div class="empty-state">
                <h3>Ingen tilbud fundet</h3>
                <p style="color: var(--text-muted); margin-top: 8px;">Prøv at søge efter noget andet eller nulstil dine filtre.</p>
                <a href="index.php" class="pill active" style="display: inline-block; margin-top: 16px;">Vis alle tilbud</a>
            </div>
        <?php else: ?>
            <?php foreach ($filtered_deals as $deal): ?>
                <?php 
                    $savings = calculate_savings($deal['original_price'], $deal['current_price']); 
                ?>
                <div class="deal-card">
                    <div class="card-img-wrap">
                        <img src="<?php echo htmlspecialchars($deal['image_url']); ?>" alt="<?php echo htmlspecialchars($deal['name']); ?>" loading="lazy">
                        <?php if (!empty($deal['badge'])): ?>
                            <span class="badge-tag"><?php echo htmlspecialchars($deal['badge']); ?></span>
                        <?php endif; ?>
                        <span class="store-tag" style="background-color: <?php echo htmlspecialchars($deal['store_color']); ?>;">
                            <?php echo htmlspecialchars($deal['store']); ?>
                        </span>
                    </div>
                    
                    <div class="card-body">
                        <span class="card-brand"><?php echo htmlspecialchars($deal['brand']); ?></span>
                        <h2 class="card-title"><?php echo htmlspecialchars($deal['name']); ?></h2>
                        <p class="card-variant"><?php echo htmlspecialchars($deal['variant']); ?></p>
                        
                        <div class="price-box">
                            <div class="price-row">
                                <span class="current-price"><?php echo format_dkk($deal['current_price']); ?></span>
                                <span class="savings-badge">Spar <?php echo $savings['percent']; ?>%</span>
                            </div>
                            <div class="original-price-row">
                                <span>Førpris: <strike><?php echo format_dkk($deal['original_price']); ?></strike></span>
                                <span>Spar <?php echo format_dkk($savings['amount']); ?></span>
                            </div>
                        </div>

                        <div class="card-footer-info">
                            <div><strong>Enhedspris:</strong> <?php echo htmlspecialchars($deal['unit_price']); ?></div>
                            <div><strong>Gyldighed:</strong> <?php echo htmlspecialchars($deal['valid_until']); ?> (<?php echo $deal['days_remaining']; ?> dage tilbage)</div>
                            <?php if (!empty($deal['limit_text'])): ?>
                                <div style="color: #b45309;">⚠️ <?php echo htmlspecialchars($deal['limit_text']); ?></div>
                            <?php endif; ?>
                        </div>

                        <a href="<?php echo htmlspecialchars($deal['tilbudsavis_url']); ?>" target="_blank" rel="noopener noreferrer" class="avis-btn">
                            📖 Åbn tilbudsavis &rarr;
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<footer>
    <div class="container footer-inner">
        <p>&copy; <?php echo date('Y'); ?> Tilbudsoversigt &bull; PHP Backend med statiske data</p>
    </div>
</footer>

</body>
</html>`,

    data: `<?php
/**
 * Statiske tilbudsdata til Tilbudsoversigten
 */

$deals = [
    [
        'id' => 'ritter-sport-rema',
        'name' => 'Ritter Sport Chokolade',
        'brand' => 'Ritter Sport',
        'variant' => '100 g plade (Marzipan, Knusper, Alpe-mælk, Nødder)',
        'category' => 'slik_chokolade',
        'category_name' => 'Slik & Chokolade',
        'store' => 'Rema 1000',
        'store_color' => '#00529b',
        'current_price' => 12.00,
        'original_price' => 24.95,
        'unit_price' => '120,00 kr./kg',
        'valid_until' => 'Gælder t.o.m. søndag 30. aug',
        'days_remaining' => 4,
        'limit_text' => 'Maks. 6 stk. pr. kunde',
        'tilbudsavis_url' => 'https://rema1000.dk/avis',
        'image_url' => 'https://images.unsplash.com/photo-1548907040-4baa42d10919?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Spar 52%',
        'description' => 'Klassiske tyske kvalitetschokolader med højt kakaoindhold og knasende fyld.'
    ],
    [
        'id' => 'coca-cola-netto',
        'name' => 'Coca-Cola / Zero / Fanta',
        'brand' => 'Coca-Cola',
        'variant' => '1,5 liter flaske (ekskl. pant)',
        'category' => 'drikkevarer',
        'category_name' => 'Sodavand & Cola',
        'store' => 'Netto',
        'store_color' => '#d97706',
        'current_price' => 10.00,
        'original_price' => 23.95,
        'unit_price' => '6,67 kr./l',
        'valid_until' => 'Gælder t.o.m. mandag 31. aug',
        'days_remaining' => 5,
        'limit_text' => 'Maks. 6 flasker pr. kunde',
        'tilbudsavis_url' => 'https://netto.dk/aviser/',
        'image_url' => 'https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Ugens Superkup',
        'description' => 'Iskold forfriskning. Vælg mellem Original Taste eller sukkerfri Zero Sugar.'
    ],
    [
        'id' => 'coca-cola-ramme-bilka',
        'name' => 'Coca-Cola Dåser (24-pak)',
        'brand' => 'Coca-Cola',
        'variant' => '24 x 33 cl ramme (ekskl. pant)',
        'category' => 'drikkevarer',
        'category_name' => 'Sodavand & Cola',
        'store' => 'Bilka',
        'store_color' => '#0072ce',
        'current_price' => 69.00,
        'original_price' => 119.95,
        'unit_price' => '8,71 kr./l (2,88 kr./dåse)',
        'valid_until' => 'Gælder t.o.m. søndag 30. aug',
        'days_remaining' => 4,
        'limit_text' => 'Maks. 3 rammer pr. kunde',
        'tilbudsavis_url' => 'https://www.bilka.dk/tilbudsavis/',
        'image_url' => 'https://images.unsplash.com/photo-1554866585-cd94860890b7?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Partivare',
        'description' => 'Hel ramme dåser til weekendhygge eller fest.'
    ],
    [
        'id' => 'marabou-chokolade-netto',
        'name' => 'Marabou Premium & Mælkechokolade',
        'brand' => 'Marabou',
        'variant' => '185-200 g (Forskellige varianter)',
        'category' => 'slik_chokolade',
        'category_name' => 'Slik & Chokolade',
        'store' => 'Netto',
        'store_color' => '#d97706',
        'current_price' => 18.00,
        'original_price' => 32.95,
        'unit_price' => '90,00 kr./kg',
        'valid_until' => 'Gælder t.o.m. mandag 31. aug',
        'days_remaining' => 5,
        'limit_text' => 'Maks. 4 plader pr. kunde',
        'tilbudsavis_url' => 'https://netto.dk/aviser/',
        'image_url' => 'https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Populær Favorit',
        'description' => 'Den velkendte svenske chokoladeklassiker med cremet smag.'
    ],
    [
        'id' => 'toms-skildpadder-meny',
        'name' => 'Toms Kæmpe Skildpadder & Guld Barre',
        'brand' => 'Toms Chokolade',
        'variant' => 'Æske med 4 stk. (112 g) eller Guld Barre 3-pak',
        'category' => 'slik_chokolade',
        'category_name' => 'Slik & Chokolade',
        'store' => 'Meny',
        'store_color' => '#ba0c2f',
        'current_price' => 15.00,
        'original_price' => 28.95,
        'unit_price' => '133,93 kr./kg',
        'valid_until' => 'Gælder t.o.m. mandag 31. aug',
        'days_remaining' => 5,
        'limit_text' => 'Frit valg',
        'tilbudsavis_url' => 'https://meny.dk/tilbudsavis',
        'image_url' => 'https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Dansk Klassiker',
        'description' => 'Mørk chokolade fyldt med karamel og romcreme.'
    ],
    [
        'id' => 'mathilde-kakao-netto',
        'name' => 'Mathilde Original Kakaomælk',
        'brand' => 'Mathilde',
        'variant' => '1 liter brik / karton',
        'category' => 'mejeri',
        'category_name' => 'Kakaomælk & Mejeri',
        'store' => 'Netto',
        'store_color' => '#d97706',
        'current_price' => 9.95,
        'original_price' => 19.95,
        'unit_price' => '9,95 kr./l',
        'valid_until' => 'Gælder t.o.m. søndag 30. aug',
        'days_remaining' => 4,
        'limit_text' => 'Maks. 6 stk. pr. kunde',
        'tilbudsavis_url' => 'https://netto.dk/aviser/',
        'image_url' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Halv pris',
        'description' => 'Danmarks favorit kakaomælk siden 1970. Nydes kold eller varm.'
    ],
    [
        'id' => 'mathilde-kakao-coop365',
        'name' => 'Mathilde Kakaomælk Økologisk / Let',
        'brand' => 'Mathilde',
        'variant' => '1 liter brik',
        'category' => 'mejeri',
        'category_name' => 'Kakaomælk & Mejeri',
        'store' => 'Coop 365',
        'store_color' => '#00a352',
        'current_price' => 11.00,
        'original_price' => 21.50,
        'unit_price' => '11,00 kr./l',
        'valid_until' => 'Gælder t.o.m. mandag 31. aug',
        'days_remaining' => 5,
        'limit_text' => 'Økologisk',
        'tilbudsavis_url' => 'https://coop365.coop.dk/tilbudsavis/',
        'image_url' => 'https://images.unsplash.com/photo-1528750997573-59b89d56f4f7?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Øko Tilbud',
        'description' => 'Økologisk variant med samme cremede chokoladesmag.'
    ],
    [
        'id' => 'frosne-groentsager-coop365',
        'name' => 'Blandede Frosne Grøntsager',
        'brand' => '365 Økologi / DLG',
        'variant' => 'Pose med 750 g (Wokmix / Suppegrønt / Ærter)',
        'category' => 'frost',
        'category_name' => 'Frost & Grønt',
        'store' => 'Coop 365',
        'store_color' => '#00a352',
        'current_price' => 10.00,
        'original_price' => 18.95,
        'unit_price' => '13,33 kr./kg',
        'valid_until' => 'Gælder t.o.m. søndag 30. aug',
        'days_remaining' => 4,
        'limit_text' => 'Maks. 6 poser pr. kunde',
        'tilbudsavis_url' => 'https://coop365.coop.dk/tilbudsavis/',
        'image_url' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Sundt & Nemt',
        'description' => 'Lynfrosne sprøde grøntsager fyldt med vitaminer.'
    ],
    [
        'id' => 'barebells-protein-lidl',
        'name' => 'Barebells Protein Milkshake',
        'brand' => 'Barebells',
        'variant' => '330 ml (Chocolate, Vanilla, Strawberry)',
        'category' => 'fitness_energi',
        'category_name' => 'Protein & Energi Bar',
        'store' => 'Lidl',
        'store_color' => '#0050aa',
        'current_price' => 12.00,
        'original_price' => 24.95,
        'unit_price' => '36,36 kr./l (24g protein)',
        'valid_until' => 'Gælder t.o.m. søndag 30. aug',
        'days_remaining' => 4,
        'limit_text' => 'Maks. 8 stk. pr. kunde',
        'tilbudsavis_url' => 'https://www.lidl.dk/tilbudsavis',
        'image_url' => 'https://images.unsplash.com/photo-1579722821273-0f6c7d44362f?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Fitness Hit',
        'description' => '24g protein uden tilsat sukker og laktosefri. Perfekt efter træning.'
    ],
    [
        'id' => 'arla-protein-coop365',
        'name' => 'Arla Protein Drik',
        'brand' => 'Arla Protein',
        'variant' => '500 ml (25g protein, Chokolade & Vanilje)',
        'category' => 'fitness_energi',
        'category_name' => 'Protein & Energi Bar',
        'store' => 'Coop 365',
        'store_color' => '#00a352',
        'current_price' => 12.95,
        'original_price' => 22.95,
        'unit_price' => '25,90 kr./l',
        'valid_until' => 'Gælder t.o.m. mandag 31. aug',
        'days_remaining' => 5,
        'limit_text' => 'Frit valg',
        'tilbudsavis_url' => 'https://coop365.coop.dk/tilbudsavis/',
        'image_url' => 'https://images.unsplash.com/photo-1546483875-ad9014c88eba?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Stærk pris',
        'description' => 'Dansk mælkebaseret proteindrik med masser af protein og god smag.'
    ],
    [
        'id' => 'murphy-energy-bar-rema',
        'name' => "Murphy's Big Energy Flapjack Bar",
        'brand' => "Murphy's Bakery",
        'variant' => '100 g bar (Chokolade, Karamel & Havre)',
        'category' => 'fitness_energi',
        'category_name' => 'Protein & Energi Bar',
        'store' => 'Rema 1000',
        'store_color' => '#00529b',
        'current_price' => 8.00,
        'original_price' => 16.95,
        'unit_price' => '80,00 kr./kg',
        'valid_until' => 'Gælder t.o.m. søndag 30. aug',
        'days_remaining' => 4,
        'limit_text' => 'Maks. 10 stk. pr. kunde',
        'tilbudsavis_url' => 'https://rema1000.dk/avis',
        'image_url' => 'https://images.unsplash.com/photo-1622484216834-315176b6d510?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Spar 53%',
        'description' => 'Saftig og lækker energibar med fuldkornshavre til hurtig og langvarig energi.'
    ],
    [
        'id' => 'rynkeby-aeblejuice-rema',
        'name' => 'Rynkeby 100% Ren Æblejuice / Æblemost',
        'brand' => 'Rynkeby',
        'variant' => '1,75 liter familiekarton',
        'category' => 'juice',
        'category_name' => 'Æble Juice',
        'store' => 'Rema 1000',
        'store_color' => '#00529b',
        'current_price' => 12.00,
        'original_price' => 24.95,
        'unit_price' => '6,86 kr./l',
        'valid_until' => 'Gælder t.o.m. søndag 30. aug',
        'days_remaining' => 4,
        'limit_text' => 'Maks. 4 kartoner pr. kunde',
        'tilbudsavis_url' => 'https://rema1000.dk/avis',
        'image_url' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Super Tilbud',
        'description' => 'Frisk og velsmagende 100% æblejuice presset af modne saftige æbler.'
    ],
    [
        'id' => 'god-morgen-aeblejuice-netto',
        'name' => 'God Morgen Koldpresset Æblejuice',
        'brand' => 'God Morgen',
        'variant' => '850 ml flaske (Cloudy Apple)',
        'category' => 'juice',
        'category_name' => 'Æble Juice',
        'store' => 'Netto',
        'store_color' => '#d97706',
        'current_price' => 14.00,
        'original_price' => 26.95,
        'unit_price' => '16,47 kr./l',
        'valid_until' => 'Gælder t.o.m. mandag 31. aug',
        'days_remaining' => 5,
        'limit_text' => 'Kølevare',
        'tilbudsavis_url' => 'https://netto.dk/aviser/',
        'image_url' => 'https://images.unsplash.com/photo-1568644396922-5c3bfae12521?w=600&auto=format&fit=crop&q=80',
        'badge' => 'Koldpresset',
        'description' => 'Ufiltreret frisk æblejuice fra køledisken med intens frugtsmag.'
    ]
];

function format_dkk($amount) {
    return number_format($amount, 2, ',', '.') . ' kr.';
}

function calculate_savings($original, $current) {
    $amount = $original - $current;
    $percent = round(($amount / $original) * 100);
    return ['amount' => $amount, 'percent' => $percent];
}
`,

    style: `:root {
  --primary: #059669;
  --primary-hover: #047857;
  --bg-main: #f8fafc;
  --bg-card: #ffffff;
  --text-main: #0f172a;
  --text-muted: #64748b;
  --border: #e2e8f0;
  --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --radius: 12px;
}

* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: var(--bg-main); color: var(--text-main); line-height: 1.5; padding-bottom: 60px; }
.container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
header { background: #fff; border-bottom: 1px solid var(--border); padding: 20px 0; position: sticky; top: 0; z-index: 100; }
.header-inner { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; }
.logo-area { display: flex; align-items: center; gap: 12px; }
.logo-icon { background: #ecfdf5; color: var(--primary); width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: bold; }
.logo-text h1 { font-size: 20px; font-weight: 700; color: var(--text-main); }
.logo-text p { font-size: 13px; color: var(--text-muted); }
.header-badge { font-size: 13px; color: var(--text-muted); background: #f1f5f9; padding: 8px 14px; border-radius: 8px; }
.filter-section { margin: 28px 0 20px 0; display: flex; flex-direction: column; gap: 14px; }
.search-bar { display: flex; gap: 10px; }
.search-input { flex: 1; padding: 12px 18px; border: 1px solid var(--border); border-radius: var(--radius); font-size: 15px; background: #fff; outline: none; transition: border-color 0.2s; }
.search-input:focus { border-color: var(--primary); }
.filter-pills { display: flex; gap: 8px; overflow-x: auto; padding-bottom: 4px; }
.pill { padding: 8px 16px; background: #fff; border: 1px solid var(--border); border-radius: 9999px; color: var(--text-main); text-decoration: none; font-size: 14px; font-weight: 500; white-space: nowrap; transition: all 0.2s; }
.pill:hover, .pill.active { background: var(--primary); color: #fff; border-color: var(--primary); }
.deals-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; margin-top: 16px; }
.deal-card { background: var(--bg-card); border-radius: var(--radius); border: 1px solid var(--border); overflow: hidden; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s; }
.deal-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
.card-img-wrap { position: relative; height: 190px; background: #f1f5f9; overflow: hidden; }
.card-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
.badge-tag { position: absolute; top: 12px; left: 12px; background: rgba(15, 23, 42, 0.85); color: #fff; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; backdrop-filter: blur(4px); }
.store-tag { position: absolute; bottom: 12px; left: 12px; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; color: #fff; }
.card-body { padding: 18px; display: flex; flex-direction: column; flex: 1; }
.card-brand { font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); font-weight: 600; }
.card-title { font-size: 17px; font-weight: 700; color: var(--text-main); margin: 4px 0 6px 0; }
.card-variant { font-size: 13px; color: var(--text-muted); margin-bottom: 12px; }
.price-box { background: #f8fafc; border-radius: 8px; padding: 12px; margin-top: auto; border: 1px solid var(--border); }
.price-row { display: flex; justify-content: space-between; align-items: baseline; }
.current-price { font-size: 24px; font-weight: 800; color: #dc2626; }
.savings-badge { background: #fee2e2; color: #b91c1c; padding: 3px 8px; border-radius: 6px; font-size: 13px; font-weight: 700; }
.original-price-row { display: flex; justify-content: space-between; font-size: 12px; color: var(--text-muted); margin-top: 4px; }
.card-footer-info { margin-top: 14px; display: flex; flex-direction: column; gap: 6px; font-size: 12px; color: var(--text-muted); border-top: 1px dashed var(--border); padding-top: 10px; }
.avis-btn { margin-top: 12px; display: inline-flex; align-items: center; justify-content: center; gap: 6px; width: 100%; padding: 10px; background: #f1f5f9; color: var(--text-main); text-decoration: none; font-size: 13px; font-weight: 600; border-radius: 8px; transition: all 0.2s; border: 1px solid var(--border); }
.avis-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }
.empty-state { text-align: center; padding: 60px 20px; background: #fff; border-radius: var(--radius); border: 1px dashed var(--border); grid-column: 1 / -1; }
footer { margin-top: 40px; border-top: 1px solid var(--border); padding: 20px 0; text-align: center; font-size: 13px; color: var(--text-muted); }
`
  };

  const handleCopy = () => {
    navigator.clipboard.writeText(files[activeTab]);
    setCopied(true);
    setTimeout(() => setCopied(false), 2000);
  };

  const handleDownloadZipNotice = () => {
    // Generate blob and download current active file
    const element = document.createElement('a');
    const filename = activeTab === 'guide' ? 'README.md' : activeTab === 'index' ? 'index.php' : activeTab === 'data' ? 'data.php' : 'style.css';
    const file = new Blob([files[activeTab]], { type: 'text/plain;charset=utf-8' });
    element.href = URL.createObjectURL(file);
    element.download = filename;
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
  };

  return (
    <div className="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-3 sm:p-6">
      <div
        className="fixed inset-0 bg-slate-950/75 backdrop-blur-xs transition-opacity"
        onClick={onClose}
      />

      <div className="relative bg-slate-900 rounded-3xl max-w-4xl w-full shadow-2xl border border-slate-800 overflow-hidden z-10 text-white flex flex-col max-h-[90vh]">
        
        {/* Header */}
        <div className="p-4 sm:p-5 border-b border-slate-800 flex items-center justify-between bg-slate-950/60">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-xl bg-emerald-600/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center">
              <FileCode className="w-5 h-5" />
            </div>
            <div>
              <h2 className="text-base sm:text-lg font-bold text-white flex items-center gap-2">
                PHP Backend & Kildekode
                <span className="text-[10px] uppercase font-bold bg-emerald-950 text-emerald-300 border border-emerald-800/80 px-2 py-0.5 rounded-md">
                  Klar til htdocs & GitHub
                </span>
              </h2>
              <p className="text-xs text-slate-400">
                Struktureret til direkte kørsel i XAMPP / MAMP / Laragon localhost
              </p>
            </div>
          </div>
          <button
            onClick={onClose}
            className="p-2 text-slate-400 hover:text-white rounded-xl hover:bg-slate-800 transition-colors"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        {/* Tabs & Copy Actions */}
        <div className="px-4 sm:px-5 py-3 border-b border-slate-800 bg-slate-950/40 flex flex-wrap items-center justify-between gap-3">
          <div className="flex items-center gap-1.5 overflow-x-auto no-scrollbar">
            <button
              onClick={() => setActiveTab('guide')}
              className={`px-3 py-1.5 rounded-lg text-xs font-semibold transition-all ${
                activeTab === 'guide'
                  ? 'bg-emerald-600 text-white'
                  : 'text-slate-400 hover:text-white hover:bg-slate-800'
              }`}
            >
              📖 Htdocs Guide
            </button>
            <button
              onClick={() => setActiveTab('index')}
              className={`px-3 py-1.5 rounded-lg text-xs font-semibold transition-all ${
                activeTab === 'index'
                  ? 'bg-emerald-600 text-white'
                  : 'text-slate-400 hover:text-white hover:bg-slate-800'
              }`}
            >
              index.php
            </button>
            <button
              onClick={() => setActiveTab('data')}
              className={`px-3 py-1.5 rounded-lg text-xs font-semibold transition-all ${
                activeTab === 'data'
                  ? 'bg-emerald-600 text-white'
                  : 'text-slate-400 hover:text-white hover:bg-slate-800'
              }`}
            >
              data.php (statiske data)
            </button>
            <button
              onClick={() => setActiveTab('style')}
              className={`px-3 py-1.5 rounded-lg text-xs font-semibold transition-all ${
                activeTab === 'style'
                  ? 'bg-emerald-600 text-white'
                  : 'text-slate-400 hover:text-white hover:bg-slate-800'
              }`}
            >
              style.css
            </button>
          </div>

          <div className="flex items-center gap-2">
            <button
              onClick={handleDownloadZipNotice}
              className="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 rounded-lg transition-colors"
              title="Download denne fil"
            >
              <Download className="w-3.5 h-3.5" />
              <span>Download fil</span>
            </button>
            <button
              onClick={handleCopy}
              className="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg transition-colors shadow-xs"
            >
              {copied ? (
                <>
                  <Check className="w-3.5 h-3.5" />
                  <span>Kopieret til udklipsholder!</span>
                </>
              ) : (
                <>
                  <Copy className="w-3.5 h-3.5" />
                  <span>Kopier fil-indhold</span>
                </>
              )}
            </button>
          </div>
        </div>

        {/* Code Content Box */}
        <div className="flex-1 overflow-y-auto p-4 sm:p-5 font-mono text-xs text-slate-300 bg-slate-950 selection:bg-emerald-900 selection:text-white">
          <pre className="whitespace-pre-wrap leading-relaxed">{files[activeTab]}</pre>
        </div>

        {/* Footer */}
        <div className="p-4 border-t border-slate-800 bg-slate-950 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-400">
          <div className="flex items-center gap-2">
            <Sparkles className="w-4 h-4 text-emerald-400 shrink-0" />
            <span>Filerne ligger også permanent gemt i projektets <code>/php/</code> mappe.</span>
          </div>
          <button
            onClick={onClose}
            className="px-5 py-2 bg-slate-800 hover:bg-slate-700 text-white font-semibold rounded-xl transition-colors"
          >
            Luk
          </button>
        </div>

      </div>
    </div>
  );
};
