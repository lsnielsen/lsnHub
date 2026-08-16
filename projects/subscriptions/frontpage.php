<?php
/**
 * Abonnementsoversigt - PHP / HTML / CSS
 * 
 * Dette program giver et komplet og overskueligt overblik over alle faste abonnementer og udgifter.
 * Koden er 100% selvstændig og kan lægges direkte i din XAMPP/WAMP htdocs-mappe (f.eks. htdocs/abonnementer/index.php).
 */

  include "data.php";
  include "backButton.php";  

?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mine Abonnementer - Komplet Udgiftsoversigt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --border-color: #e2e8f0;
            --border-radius: 16px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -4px rgba(0,0,0,0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            line-height: 1.5;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Top Header */
        header {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .header-title h1 {
            font-size: 1.875rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.025em;
        }

        .header-title p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-top: 0.25rem;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary-light);
            color: var(--primary-dark);
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Totalbokse / Dashboard */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 640px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .stat-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-card.featured {
            background: linear-gradient(135deg, #0284c7, #0369a1);
            color: #ffffff;
            border: none;
        }

        .stat-card.featured .stat-label {
            color: rgba(255, 255, 255, 0.85);
        }

        .stat-card.featured .stat-value {
            color: #ffffff;
        }

        .stat-card.featured .stat-sub {
            color: rgba(255, 255, 255, 0.75);
        }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .stat-sub {
            font-size: 0.8125rem;
            color: var(--text-muted);
        }

        /* Kategori-analyse bar */
        .category-section {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-sm);
        }

        .category-section h2 {
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-bars {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .category-row {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .category-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .category-progress-bg {
            height: 8px;
            background-color: #f1f5f9;
            border-radius: 9999px;
            overflow: hidden;
        }

        .category-progress-fill {
            height: 100%;
            background-color: var(--primary);
            border-radius: 9999px;
        }

        /* Filter og søgning */
        .controls-bar {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 640px) {
            .controls-bar {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .search-input {
            width: 100%;
            max-width: 320px;
            padding: 0.625rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.95rem;
            background-color: #ffffff;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }

        /* Abonnement Grid */
        .subs-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.25rem;
        }

        @media (min-width: 768px) {
            .subs-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1100px) {
            .subs-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .sub-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: var(--shadow-sm);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }

        .sub-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: #cbd5e1;
        }

        .sub-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .sub-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }

        .badge-category {
            display: inline-block;
            background-color: #f1f5f9;
            color: #475569;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            white-space: nowrap;
        }

        .sub-desc {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 1.25rem;
            min-height: 2.6rem;
        }

        .price-box {
            background-color: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        .price-main {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .price-main-amount {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0284c7;
        }

        .price-main-period {
            font-size: 0.8125rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .price-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            font-size: 0.8125rem;
            border-top: 1px solid var(--border-color);
            padding-top: 0.5rem;
            color: var(--text-muted);
        }

        .price-details-grid div strong {
            color: #1e293b;
            display: block;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.75rem;
            border-top: 1px solid #f1f5f9;
        }

        .payment-method {
            font-size: 0.75rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .btn-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background-color: var(--primary);
            color: #ffffff;
            text-decoration: none;
            font-size: 0.8125rem;
            font-weight: 600;
            padding: 0.5rem 0.875rem;
            border-radius: 8px;
            transition: background-color 0.15s;
        }

        .btn-link:hover {
            background-color: var(--primary-dark);
        }

        /* Forslagsboks */
        .suggestions-box {
            background: #ffffff;
            border: 1px solid #e0f2fe;
            border-left: 4px solid #0284c7;
            border-radius: 12px;
            padding: 1.25rem;
            margin-top: 2.5rem;
        }

        .suggestions-box h3 {
            font-size: 1rem;
            font-weight: 700;
            color: #0369a1;
            margin-bottom: 0.5rem;
        }

        .suggestions-box ul {
            padding-left: 1.25rem;
            font-size: 0.875rem;
            color: #334155;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        /* Print Style */
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .search-input, .btn-link {
                display: none;
            }
            .stat-card {
                box-shadow: none;
                border: 1px solid #ccc;
            }
        }
    </style>
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
