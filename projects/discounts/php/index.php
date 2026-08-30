<?php
require_once 'data.php';

// Dynamisk ugenummer
$current_week = (int)date('W');

// Hent filtre fra URL parametre
$selected_category = isset($_GET['kategori']) ? $_GET['kategori'] : 'alle';
$selected_store = isset($_GET['butik']) ? $_GET['butik'] : 'alle';
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

// Filtrering af tilbud
$filtered_deals = array_filter($deals, function($deal) use ($selected_category, $selected_store, $search_query) {
    // Kategori filter
    if ($selected_category !== 'alle' && $deal['category'] !== $selected_category) {
        return false;
    }
    // Butik filter
    if ($selected_store !== 'alle' && strtolower($deal['store']) !== strtolower($selected_store)) {
        return false;
    }
    // Søgning
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
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tilbudsoversigt (Uge <?php echo $current_week; ?>) - Find de bedste rabatter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container header-inner">
        <div class="logo-area">
            <div class="logo-icon">%</div>
            <div class="logo-text">
                <h1>Tilbudsoversigt</h1>
                <span class="week-badge">Uge <?php echo $current_week; ?></span>
            </div>
        </div>
    </div>
</header>

<main class="container">
    <div class="page-intro">
        <h2>Aktuelle tilbud (Uge <?php echo $current_week; ?>)</h2>
        <p>Oversigt over ugens bedste priser i Netto, Rema 1000, Bilka, Lidl, Coop 365 og Meny</p>
    </div>

    <section class="filter-section">
        <!-- Søgeformular -->
        <form method="GET" action="index.php" class="search-bar">
            <input 
                type="text" 
                name="q" 
                class="search-input" 
                placeholder="Søg efter vare, mærke eller butik..." 
                value="<?php echo htmlspecialchars($search_query); ?>"
            >
            <?php if ($selected_category !== 'alle'): ?>
                <input type="hidden" name="kategori" value="<?php echo htmlspecialchars($selected_category); ?>">
            <?php endif; ?>
            <button type="submit" class="pill active" style="border: none; cursor: pointer;">Søg</button>
            <?php if ($search_query !== '' || $selected_category !== 'alle' || $selected_store !== 'alle'): ?>
                <a href="index.php" class="pill" style="display: flex; align-items: center;">Nulstil</a>
            <?php endif; ?>
        </form>

        <!-- Kategori faner -->
        <div class="filter-pills">
            <a href="?kategori=alle<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'alle' ? 'active' : ''; ?>">Alle varer</a>
            <a href="?kategori=slik_chokolade<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'slik_chokolade' ? 'active' : ''; ?>">Slik & Chokolade</a>
            <a href="?kategori=drikkevarer<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'drikkevarer' ? 'active' : ''; ?>">Sodavand & Cola</a>
            <a href="?kategori=juice<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'juice' ? 'active' : ''; ?>">Æble Juice</a>
            <a href="?kategori=frost<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'frost' ? 'active' : ''; ?>">Frost & Grønt</a>
            <a href="?kategori=mejeri<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'mejeri' ? 'active' : ''; ?>">Kakaomælk & Mejeri</a>
            <a href="?kategori=fitness_energi<?php echo $search_query ? '&q='.urlencode($search_query) : ''; ?>" class="pill <?php echo $selected_category === 'fitness_energi' ? 'active' : ''; ?>">Protein & Energi Bar</a>
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
                        <span class="store-tag" style="background-color: <?php echo htmlspecialchars($deal['store_color']); ?>;">
                            <?php echo htmlspecialchars($deal['store']); ?>
                        </span>
                        <span class="discount-badge-top">-<?php echo $savings['percent']; ?>%</span>
                    </div>
                    
                    <div class="card-body">
                        <div class="card-meta">
                            <span class="card-brand"><?php echo htmlspecialchars($deal['brand']); ?></span>
                            <span class="card-unit"><?php echo htmlspecialchars($deal['unit_price']); ?></span>
                        </div>
                        <h2 class="card-title"><?php echo htmlspecialchars($deal['name']); ?></h2>
                        <p class="card-variant"><?php echo htmlspecialchars($deal['variant']); ?></p>
                        
                        <div class="price-box">
                            <div class="price-row">
                                <span class="current-price"><?php echo format_dkk($deal['current_price']); ?></span>
                                <div class="price-savings-col">
                                    <span class="savings-amount">Spar <?php echo format_dkk($savings['amount']); ?></span>
                                    <span class="original-price">Før <?php echo format_dkk($deal['original_price']); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer-info">
                            <div><?php echo htmlspecialchars($deal['valid_until']); ?> (<?php echo $deal['days_remaining']; ?> dage tilbage)</div>
                        </div>

                        <a href="<?php echo htmlspecialchars($deal['tilbudsavis_url']); ?>" target="_blank" rel="noopener noreferrer" class="avis-btn">
                            Åbn tilbudsavis &rarr;
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<footer>
    <div class="container footer-inner">
        <p>&copy; <?php echo date('Y'); ?> Tilbudsoversigt (Uge <?php echo $current_week; ?>) &bull; PHP Backend</p>
    </div>
</footer>

</body>
</html>

