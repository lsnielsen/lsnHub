<?php
/**
 * Abonnementsoversigt - PHP / HTML / CSS
 * 
 * Dette program giver et komplet og overskueligt overblik over alle faste abonnementer og udgifter.
 * Koden er 100% selvstændig og kan lægges direkte i din XAMPP/WAMP htdocs-mappe (f.eks. htdocs/abonnementer/index.php).
 */

  include "data.php";
  include "backButton.php";
  include "styling.php";    

?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mine Abonnementer - Komplet Udgiftsoversigt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">

    <!-- Header -->
    <header>
        <div class="header-title">
            <h1>Mine Faste Abonnementer</h1>
            <p>Overskueligt økonomisk overblik over månedlige, kvartalsvise og årlige udgiftsposter</p>
        </div>
        <div class="header-badge">
            <span>📅 Opdateret: <?php echo date('d. M Y'); ?></span>
            <span>•</span>
            <span><?php echo $antalAbonnementer; ?> Abonnementer</span>
        </div>
    </header>

    <!-- Nøgletal / Totalboks -->
    <section class="dashboard-grid">
        <div class="stat-card featured">
            <div class="stat-label">Total pr. måned</div>
            <div class="stat-value"><?php echo formatDkk($totalMaaned); ?></div>
            <div class="stat-sub">Gennemsnitligt fast månedstræk</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total pr. år</div>
            <div class="stat-value"><?php echo formatDkk($totalAar); ?></div>
            <div class="stat-sub">Samlet årlig abonnementsudgift</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total pr. kvartal</div>
            <div class="stat-value"><?php echo formatDkk($totalKvartal); ?></div>
            <div class="stat-sub">Omregnet kvartalsudgift (3 mdr.)</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Gennemsnit pr. dag</div>
            <div class="stat-value"><?php echo formatDkk($totalDag); ?></div>
            <div class="stat-sub">Dagspris for alle tjenester (365 dage)</div>
        </div>
    </section>

    <!-- Kategori Fordeling -->
    <section class="category-section">
        <h2>
            <span>Forbrug fordelt på kategorier</span>
            <span style="font-size: 0.875rem; color: var(--text-muted); font-weight: 500;">pr. måned</span>
        </h2>
        <div class="category-bars">
            <?php foreach ($kategoriTotaler as $katNavn => $katBeloeb): 
                $procent = ($totalMaaned > 0) ? round(($katBeloeb / $totalMaaned) * 100, 1) : 0;
            ?>
                <div class="category-row">
                    <div class="category-meta">
                        <span><strong><?php echo htmlspecialchars($katNavn); ?></strong> (<?php echo $procent; ?>%)</span>
                        <span><?php echo formatDkk($katBeloeb); ?> /mdr.</span>
                    </div>
                    <div class="category-progress-bg">
                        <div class="category-progress-fill" style="width: <?php echo $procent; ?>%;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Hurtigsøgning -->
    <div class="controls-bar">
        <h2 style="font-size: 1.25rem; font-weight: 700;">Alle Abonnementer (<?php echo $antalAbonnementer; ?>)</h2>
        <input type="text" id="searchInput" class="search-input" placeholder="🔍 Søg i abonnementer eller kategorier..." onkeyup="filterCards()">
    </div>

    <!-- Abonnement Grid -->
    <section class="subs-grid" id="subsGrid">
        <?php foreach ($abonnementer as $sub): ?>
            <div class="sub-card" data-name="<?php echo strtolower(htmlspecialchars($sub['navn'])); ?>" data-cat="<?php echo strtolower(htmlspecialchars($sub['kategori'])); ?>">
                <div>
                    <div class="sub-header">
                        <h3 class="sub-title"><?php echo htmlspecialchars($sub['navn']); ?></h3>
                        <span class="badge-category"><?php echo htmlspecialchars($sub['kategori']); ?></span>
                    </div>

                    <p class="sub-desc"><?php echo htmlspecialchars($sub['beskrivelse']); ?></p>

                    <div class="price-box">
                        <div class="price-main">
                            <span class="price-main-amount"><?php echo formatDkk($sub['maanedlig_pris']); ?></span>
                            <span class="price-main-period">/ måned</span>
                        </div>
                        <div class="price-details-grid">
                            <div>
                                <span>Pris pr. år:</span>
                                <strong><?php echo formatDkk($sub['aarlig_pris']); ?></strong>
                            </div>
                            <div>
                                <span>Opkrævning:</span>
                                <strong><?php echo htmlspecialchars($sub['interval_tekst']); ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="payment-method">
                        💳 <span><?php echo htmlspecialchars($sub['betalingsmetode']); ?></span>
                    </div>
                    <?php if (!empty($sub['hjemmeside'])): ?>
                        <a href="<?php echo htmlspecialchars($sub['hjemmeside']); ?>" target="_blank" rel="noopener noreferrer" class="btn-link">
                            Besøg login &rarr;
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Forslags- og Informationsboks -->
    <div class="suggestions-box">
        <h3>💡 Forslag til optimering og datavisning:</h3>
        <ul>
            <li><strong>Opsigelsesfrister:</strong> Tilføj dato for bindingsperiode for at undgå automatisk fornyelse.</li>
            <li><strong>Betalingsgebyr:</strong> Hold øje med betalingsservicegebyr (typisk 6-10 kr./opkrævning) versus gratis kortbetaling.</li>
            <li><strong>Samlerabatter:</strong> Undersøg om internet (YouSee) og mobil (Callme) kan samles for rabat.</li>
            <li><strong>Sæsonpause:</strong> Notér hvis Holstebro Musikskole eller fitness pauseres i sommermånederne.</li>
        </ul>
    </div>

</div>

<script>
    function filterCards() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const cards = document.querySelectorAll('#subsGrid .sub-card');

        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const cat = card.getAttribute('data-cat');
            if (name.includes(input) || cat.includes(input)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>
