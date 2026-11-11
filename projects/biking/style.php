

  <!-- Udskift stien herunder, hvis du bruger en fælles CSS-fil fra hovedsiden -->
  <style>
    :root {
      --bg-color: #f4f6f9;
      --card-bg: #ffffff;
      --primary: #10b981;
      --primary-hover: #059669;
      --text-dark: #1f2937;
      --text-muted: #6b7280;
      --border-color: #e5e7eb;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      background-color: var(--bg-color);
      color: var(--text-dark);
      margin: 0;
      padding: 0;
      line-height: 1.6;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background-color: var(--card-bg);
      padding: 2.5rem 1rem;
      text-align: center;
      border-bottom: 1px solid var(--border-color);
      position: relative;
    }

    .back-link {
      position: absolute;
      left: 2rem;
      top: 2rem;
      text-decoration: none;
      color: var(--text-muted);
      font-weight: 500;
      font-size: 0.95rem;
      transition: color 0.2s;
    }

    .back-link:hover {
      color: var(--text-dark);
    }

    header h1 {
      margin: 0 0 0.5rem 0;
      font-size: 2rem;
    }

    header p {
      margin: 0;
      color: var(--text-muted);
    }

    main {
      max-width: 1100px;
      width: 100%;
      margin: 2.5rem auto;
      padding: 0 1.5rem;
      box-sizing: border-box;
      flex: 1;
    }

    .app-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    .app-card {
      background: var(--card-bg);
      border-radius: 12px;
      padding: 1.75rem;
      text-decoration: none;
      color: inherit;
      border: 1px solid var(--border-color);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }

    .app-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
      border-color: var(--primary);
    }

    .card-icon {
      font-size: 2.2rem;
      margin-bottom: 1rem;
    }

    .card-title {
      font-size: 1.25rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .card-description {
      color: var(--text-muted);
      font-size: 0.95rem;
      margin-bottom: 1.5rem;
    }

    .card-button {
      color: var(--primary);
      font-weight: 600;
      font-size: 0.95rem;
    }

    .app-card:hover .card-button {
      color: var(--primary-hover);
    }

    footer {
      text-align: center;
      padding: 2rem;
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    @media (max-width: 600px) {
      .back-link {
        position: static;
        display: inline-block;
        margin-bottom: 1rem;
      }
    }
  </style>



