

    <style>
        :root { --paper: #fdfcf0; --ink: #2c3e50; --coffee: #7d5a50; }

        body { background: #f4f1ea; font-family: 'Open Sans', sans-serif; display: flex; justify-content: center; padding: 60px 20px; }

        .journal-container {
            position: relative;
            background: var(--paper);
            padding: 50px 40px;
            max-width: 450px;
            width: 100%;
            border: 1px solid #e0dbc1;
            box-shadow: 0 1px 1px rgba(0,0,0,0.05), 0 10px 0 -5px var(--paper), 0 10px 1px -4px rgba(0,0,0,0.1), 0 20px 0 -10px var(--paper), 0 20px 1px -9px rgba(0,0,0,0.1), 0 30px 20px rgba(0,0,0,0.05);
        }

        h1 { font-family: 'Merriweather', serif; font-style: italic; color: var(--coffee); text-align: center; margin-bottom: 30px; }
        .ledger-archive { margin: 0 auto; max-width: 80%; }
        
        .ledger-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px dashed #d1ccc0;
            font-size: 0.95rem;
        }

        .ledger-header { 
            text-transform: uppercase; 
            font-size: 0.7rem; 
            letter-spacing: 1px; 
            color: #888; 
            border-bottom: 1px solid #d1ccc0; 
        }

        .col-year { width: 30%; font-family: 'Merriweather', serif; font-weight: bold; }
        .col-qty  { width: 30%; text-align: center; color: var(--ink); }
        .col-sum  { width: 40%; text-align: right; color: var(--coffee); }

        /* The Bookmark (Home Button) */
        .back-flag {
            position: absolute; top: 20px; right: -20px;
            background: #d4a373; color: white; padding: 12px 6px 18px;
            text-decoration: none; font-size: 0.7rem; writing-mode: vertical-rl;
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 50% 88%, 0% 100%);
        }
    </style>



