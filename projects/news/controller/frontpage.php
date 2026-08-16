<?php
/**
 * Frontpage Controller Mockup / Target for "../controller/frontpage.php"
 */
?>
<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forside & Kontrolpanel</title>
    <style>
        :root {
            --bg: #f8fafc;
            --surface: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #2563eb;
            --border: #e2e8f0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 600px;
            width: 100%;
            background: var(--surface);
            padding: 32px;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            text-align: center;
        }
        h1 { margin-top: 0; font-size: 1.5rem; }
        p { color: var(--muted); line-height: 1.6; }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Velkommen til Systemets Hovedmenu</h1>
        <p>Dette er destinationen for <code>../controller/frontpage.php</code>. Du kan herfra administrere dine systemer eller gå direkte til det globale nyhedsoverblik.</p>
        <a href="../index.php" class="btn">Gå til Global Nyhedsoversigt →</a>
    </div>
</body>
</html>
