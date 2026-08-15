

<!DOCTYPE html>
<html lang="da">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mine Værktøjer & Programmer</title>
  <style>
    /* Nulstilling og basisstil */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f7f6;
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Header */
    header {
      background-color: #1e293b;
      color: #ffffff;
      padding: 2rem 1rem;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    header h1 {
      font-size: 2.2rem;
      margin-bottom: 0.5rem;
    }

    header p {
      color: #94a3b8;
      font-size: 1.05rem;
    }

    /* Hovedindhold */
    main {
      flex: 1;
      max-width: 1000px;
      width: 100%;
      margin: 2rem auto;
      padding: 0 1rem;
    }

    /* Grid-layout til kort */
    .app-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    /* Enkelt app-kort */
    .app-card {
      background: #ffffff;
      border-radius: 12px;
      padding: 1.8rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      border: 1px solid #e2e8f0;
      text-decoration: none;
      color: inherit;
    }

    .app-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    .card-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #0f172a;
      margin-bottom: 0.5rem;
    }

    .card-description {
      font-size: 0.95rem;
      color: #64748b;
      line-height: 1.5;
      margin-bottom: 1.5rem;
    }

    .card-button {
      background-color: #2563eb;
      color: #ffffff;
      padding: 0.6rem 1.2rem;
      border-radius: 6px;
      font-weight: 500;
      text-align: center;
      transition: background-color 0.2s ease;
    }

    .app-card:hover .card-button {
      background-color: #1d4ed8;
    }

    /* Style for 'Kommende program' (placeholder) */
    .app-card.disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    .app-card.disabled:hover {
      transform: none;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .app-card.disabled .card-button {
      background-color: #94a3b8;
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 1.5rem;
      color: #64748b;
      font-size: 0.9rem;
      border-top: 1px solid #e2e8f0;
      background-color: #ffffff;
    }
  </style>
</head>
<body>

  <header>
    <h1>🚀 Mine Værktøjer</h1>
    <p>Vælg et program for at komme i gang</p>
  </header>

  <main>
    <div class="app-grid">
      
      <a href="abonnementer/index.php" class="app-card">
        <div>
          <div class="card-icon">📅</div>
          <div class="card-title">Abonnementsstyring</div>
          <div class="card-description">
            Få det fulde overblik over dine faste månedlige udgifter, abonnementer og forfaldsdatoer.
          </div>
        </div>
        <div class="card-button">Åbn Program →</div>
      </a>

      <a href="tilbud/index.php" class="app-card">
        <div>
          <div class="card-icon">🏷️</div>
          <div class="card-title">Tilbud & Rabatter</div>
          <div class="card-description">
            Hold øje med gode tilbud, samlet besparelse og tilbudsaviser på dine foretrukne varer.
          </div>
        </div>
        <div class="card-button">Åbn Program →</div>
      </a>

      <div class="app-card disabled">
        <div>
          <div class="card-icon">➕</div>
          <div class="card-title">Nyt Projekt</div>
          <div class="card-description">
            Pladsholder til dit næste program eller værktøj. Kan nemt tilføjes direkte i HTML-koden.
          </div>
        </div>
        <div class="card-button">Kommer snart</div>
      </div>

    </div>
  </main>

  <footer>
    <p>&copy; <?php echo date('Y'); ?> Mine Webapplikationer</p>
  </footer>

</body>
</html>


