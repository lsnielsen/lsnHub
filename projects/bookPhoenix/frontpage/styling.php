    <style>
        :root {
            --paper: #fdfcf0;
            --ink: #2c3e50;
            --coffee: #7d5a50;
            --sage: #a3b18a;
        }

        body {
            background-color: #f4f1ea; /* Slightly darker desk color */
            font-family: 'Open Sans', sans-serif;
            color: var(--ink);
            display: flex;
            justify-content: center;
            padding: 60px 20px;
        }

.journal-container {
    position: relative;
    background: var(--paper); /* Your #fdfcf0 color */
    padding: 40px;
    max-width: 450px;
    width: 100%;
    margin: 50px auto;
    border: 1px solid #e0dbc1;

    /* The Triple Page Effect */
    box-shadow: 
        /* The main subtle shadow */
        0 1px 1px rgba(0,0,0,0.05),
        /* The second page (middle) */
        0 10px 0 -5px var(--paper),
        0 10px 1px -4px rgba(0,0,0,0.1),
        /* The third page (bottom) */
        0 20px 0 -10px var(--paper),
        0 20px 1px -9px rgba(0,0,0,0.1),
        /* The final deep shadow for depth */
        0 30px 20px rgba(0,0,0,0.05);
}

        h1 { font-family: 'Merriweather', serif; color: var(--coffee); font-size: 1.8rem; text-align: center; }
        
        .big-stat {
            text-align: center;
            font-family: 'Merriweather', serif;
            font-size: 4rem;
            margin: 20px 0 10px;
            font-weight: 700;
        }

        /* Progress Bar */
        .progress-box { margin-bottom: 40px; }
        .bar-bg { background: #efebe0; height: 8px; border-radius: 4px; overflow: hidden; }
        .bar-fill { background: var(--sage); height: 100%; width: <?php echo $percent; ?>%; transition: width 1s; }

        /* The Recent History "Ledger" */
        .history-section {
            margin-top: 30px;
            border-top: 2px solid var(--coffee);
            padding-top: 20px;
        }

        .history-title {
            font-family: 'Merriweather', serif;
            font-style: italic;
            font-size: 1.1rem;
            margin-bottom: 15px;
            display: block;
        }

        .history-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #d1ccc0;
            font-size: 0.9rem;
            color: #555;
        }

        .amount-tag { font-weight: bold; color: var(--ink); }

        /* Form Styling */
        form { margin-top: 30px; text-align: center; }
        input[type="number"] { padding: 8px; border: 1px solid #d1ccc0; background: transparent; width: 60px; }
        button { 
            background: var(--coffee); color: white; border: none; 
            padding: 9px 18px; cursor: pointer; font-family: 'Merriweather', serif; 
        }

/* This class applies to ALL flags */
.journal-flag {
    position: absolute;
    right: -24px; /* Constant width for all */
    width: 24px;  
    color: white;
    padding: 15px 4px 22px;
    text-decoration: none;
    font-family: 'Merriweather', serif;
    font-size: 0.7rem;
    writing-mode: vertical-rl;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
    clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 50% 88%, 0% 100%);
    transition: all 0.3s ease;
}

.journal-flag:hover {
    right: -30px; /* All flags peek out the same amount */
    padding-bottom: 25px; /* Slight 'stretch' effect when hovering */
}

/* Flag 1: Insights (Leather Tan) */
.flag-insights {
    top: 40px;
    background: #d4a373;
    z-index: 9;
}

/* Flag 2: Ledger (Sage Green) */
.flag-ledger {
    top: 130px; /* 90px gap */
    background: #a3b18a;
    z-index: 8;
}

/* Flag 3: Yearly (Terracotta) */
.flag-yearly {
    top: 220px; /* 90px gap */
    background: #b07d62;
    z-index: 7;
}

/* Flag 4: Comments (Slate Blue) */
.flag-comments {
    top: 290px; /* 90px gap */
    background: #6d8299;
    z-index: 6;
}

/* Flag 5: Picture (Slate Blue) */
.flag-picture {
    top: 400px; /* 90px gap */
    background: #e6e600;
    z-index: 5;
}

/* Flag 6: Picture (Slate Blue) */
.flag-expenses {
    top: 450px; /* 90px gap */
    background: #e600ac;
    z-index: 4;
}

</style>
