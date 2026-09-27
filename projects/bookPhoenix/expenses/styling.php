

<style>

/* --- Master Sanctuary Layout --- */
.journal-container {
    position: relative;
    background: #fdfcf0; /* Signature cream paper */
    max-width: 650px;    /* Narrows the page to match your other sections */
    margin: 40px auto;   /* Centers the journal sheet on the screen */
    padding: 50px 40px;
    box-sizing: border-box;
    
    /* Triple-stacked paper shadow effect */
    box-shadow: 
        0 1px 1px rgba(0,0,0,0.05), 
        0 10px 0 -5px #fdfcf0, 
        0 10px 1px -4px rgba(0,0,0,0.1), 
        0 20px 0 -10px #fdfcf0, 
        0 20px 1px -9px rgba(0,0,0,0.1), 
        0 30px 20px rgba(0,0,0,0.05);
}

/* --- Header & Title --- */
.ledger-header {
    text-align: center;
    margin-bottom: 40px;
    padding-bottom: 25px;
    border-bottom: 1px dashed #d1ccc0; /* Soft spine-line break */
}

.ledger-header h1 {
    font-family: 'Merriweather', serif;
    font-style: italic;
    color: #7d5a50; /* Ink Coffee Brown */
    font-size: 1.8rem;
    margin: 0 0 10px 0;
}

.subtitle {
    font-family: 'Open Sans', sans-serif;
    color: #8a7a75;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0 0 25px 0;
}

/* --- Archival Investment Stamp --- */
.total-investment-card {
    display: inline-block;
    background: rgba(125, 90, 80, 0.02);
    border: 2px solid #7d5a50; /* Crisp ink border */
    padding: 12px 35px;
    border-radius: 2px;
    box-shadow: 0 4px 10px rgba(125, 90, 80, 0.04);
}

.total-label {
    display: block;
    font-family: 'Open Sans', sans-serif;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #8a7a75;
    margin-bottom: 2px;
}

.total-amount {
    display: block;
    font-family: 'Merriweather', serif;
    font-size: 1.6rem;
    font-weight: bold;
    color: #7d5a50;
}

/* --- Elegant Ledger Table --- */
.ledger-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 45px;
    font-family: 'Open Sans', sans-serif;
}

.ledger-table th {
    font-family: 'Merriweather', serif;
    font-style: italic;
    color: #7d5a50;
    text-align: left;
    padding: 10px 8px;
    border-bottom: 2px solid #d1ccc0;
    font-size: 1rem;
}

.ledger-table td {
    padding: 14px 8px;
    border-bottom: 1px solid #eee;
    color: #555;
    font-size: 0.9rem;
}

.text-right {
    text-align: right !important;
}

/* Reference IDs */
.category-tag {
    font-family: 'Open Sans', sans-serif;
    color: #a39171; /* Distressed brass/gold tone */
    font-weight: 600;
    font-size: 0.85rem;
}

.item-description {
    color: #444;
}

.item-cost {
    font-family: 'Merriweather', serif;
    font-weight: bold;
    color: #333;
}

/* Row interaction */
.ledger-table tbody tr:hover {
    background-color: rgba(212, 163, 115, 0.04); /* Subtle parchment hover tint */
}

/* --- Closing Navigation Area --- */
.action-area {
    text-align: center;
    margin-top: 30px;
}

.back-home-btn {
    display: inline-block;
    text-decoration: none;
    color: #7d5a50;
    font-family: 'Merriweather', serif;
    font-size: 0.85rem;
    font-style: italic;
    border: 2px solid #7d5a50;
    padding: 10px 25px;
    border-radius: 2px;
    background: transparent;
    transition: all 0.3s ease;
    letter-spacing: 0.5px;
}

.back-home-btn:hover {
    background: #7d5a50;
    color: #fdfcf0;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(125, 90, 80, 0.15);
}

.btn-icon {
    margin-right: 6px;
    font-style: normal;
}

</style>


