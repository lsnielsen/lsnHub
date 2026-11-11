
<!DOCTYPE html>
<html lang="da">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alle Ture - Elcykel Pendling</title>
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
      margin: 2.5rem auto;
      padding: 0 1.5rem;
    }

    /* Filter Knapper */
    .filter-container {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
      margin-bottom: 1.5rem;
      background: var(--card-bg);
      padding: 1rem;
      border-radius: 12px;
      border: 1px solid var(--border-color);
    }

    .filter-btn {
      background-color: #f3f4f6;
      border: 1px solid var(--border-color);
      color: var(--text-dark);
      padding: 0.5rem 1rem;
      border-radius: 8px;
      font-weight: 500;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .filter-btn:hover {
      background-color: #e5e7eb;
    }

    .filter-btn.active {
      background-color: var(--primary);
      color: white;
      border-color: var(--primary);
    }

    /* Tabel Styling */
    .table-card {
      background: var(--card-bg);
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
      border: 1px solid var(--border-color);
    }

    .table-responsive {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    th, td {
      padding: 0.85rem 1rem;
      border-bottom: 1px solid var(--border-color);
    }

    th {
      color: var(--text-muted);
      font-weight: 600;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover td {
      background-color: #f9fafb;
    }

    .badge {
      display: inline-block;
      padding: 0.2rem 0.5rem;
      border-radius: 6px;
      font-size: 0.8rem;
      font-weight: 500;
      background-color: #e5e7eb;
      color: #374151;
    }

    .empty-msg {
      text-align: center;
      padding: 2rem;
      color: var(--text-muted);
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
</head>
<body>

  <header>
    <a href="biking.php" class="back-link">← Tilbage til Oversigt</a>
    <h1>📋 Alle Cykelture</h1>
    <p>Oversigt over dine pendlerture og øvrige ruter</p>
  </header>

  <main>

    <!-- Sorterings-/filter-knapper -->
    <div class="filter-container">
      <button class="filter-btn active" onclick="setFilter('all', this)">Alle ture</button>
      <button class="filter-btn" onclick="setFilter('work', this)">🏢 Til/fra arbejde</button>
      <button class="filter-btn" onclick="setFilter('struer', this)">🌉 Holstebro ↔ Struer</button>
      <button class="filter-btn" onclick="setFilter('other', this)">🚴 Øvrige ruter</button>
    </div>

    <!-- Tabel-container -->
    <div class="table-card">
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Dato</th>
              <th>Rute</th>
              <th>Distance</th>
              <th>Tid</th>
              <th>Batteri</th>
              <th>Bemærkning</th>
            </tr>
          </thead>
          <tbody id="tripsTableBody">
            <!-- Indhold genereres dynamisk via Rust API / Dummy JS -->
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <footer>
    <p>&copy; <?php echo date('Y'); ?> Mine Webapplikationer</p>
  </footer>

  <script>
    // Global tilstands-variabel til opbevaring af ture fra API
    let allTrips = [];
    let currentFilter = 'all';

    // RUST API SETUP:
    // Sæt til true for at bruge dummy-data lokalt, eller false når dit Rust API er kørende.
    const USE_DUMMY_DATA = true; 
    const RUST_API_URL = 'http://localhost:8080/api/trips'; // Udskift med din Rust API port/endpoint

    document.addEventListener('DOMContentLoaded', () => {
      fetchTrips();
    });

    async function fetchTrips() {
      if (USE_DUMMY_DATA) {
        // Dummy data der matcher det forventede JSON-format fra Rust API'et
        allTrips = [
          { id: 1, date: '2026-11-11', type: 'work',   route: 'Hjem → Arbejde',     distance: 14.8, duration: '37 min', battery: '25%', note: 'Morgenpendling' },
          { id: 2, date: '2026-11-10', type: 'work',   route: 'Arbejde → Hjem',     distance: 14.9, duration: '39 min', battery: '28%', note: 'Modvind' },
          { id: 3, date: '2026-11-08', type: 'struer', route: 'Holstebro → Struer', distance: 16.5, duration: '42 min', battery: '32%', note: 'Weekendtur' },
          { id: 4, date: '2026-11-08', type: 'struer', route: 'Struer → Holstebro', distance: 16.4, duration: '40 min', battery: '30%', note: 'Retur' },
          { id: 5, date: '2026-11-06', type: 'work',   route: 'Hjem → Arbejde',     distance: 14.8, duration: '36 min', battery: '24%', note: 'Godt vejr' },
          { id: 6, date: '2026-11-02', type: 'other',  route: 'Holstebro Omegn',    distance: 22.1, duration: '58 min', battery: '45%', note: 'Aftentur' }
        ];
        renderTable();
      } else {
        try {
          const response = await fetch(RUST_API_URL);
          if (!response.ok) throw new Error('Netværksfejl ved hentning af ture');
          allTrips = await response.json();
          renderTable();
        } catch (error) {
          console.error('Fejl ved hentning fra Rust API:', error);
          document.getElementById('tripsTableBody').innerHTML = 
            `<tr><td colspan="6" class="empty-msg">Kunne ikke hente data fra API. Fejl: ${error.message}</td></tr>`;
        }
      }
    }

    function setFilter(category, btn) {
      currentFilter = category;
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      renderTable();
    }

    function renderTable() {
      const tbody = document.getElementById('tripsTableBody');
      tbody.innerHTML = '';

      const filtered = allTrips.filter(trip => {
        if (currentFilter === 'all') return true;
        return trip.type === currentFilter;
      });

      if (filtered.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" class="empty-msg">Ingen ture fundet i denne kategori.</td></tr>';
        return;
      }

      filtered.forEach(trip => {
        const row = document.createElement('tr');
        
        // Formater dato til DD-MM-YYYY
        const dateObj = new Date(trip.date);
        const formattedDate = dateObj.toLocaleDateString('da-DK', {
          day: '2-digit',
          month: '2-digit',
          year: 'numeric'
        });

        row.innerHTML = `
          <td>${formattedDate}</td>
          <td><strong>${escapeHtml(trip.route)}</strong></td>
          <td>${trip.distance.toString().replace('.', ',')} km</td>
          <td>${escapeHtml(trip.duration)}</td>
          <td><span class="badge">🔋 ${escapeHtml(trip.battery)}</span></td>
          <td>${escapeHtml(trip.note || '')}</td>
        `;
        tbody.appendChild(row);
      });
    }

    function escapeHtml(str) {
      if (!str) return '';
      return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
    }
  </script>

</body>
</html>


