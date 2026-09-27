<style>

/* The Main Title */
h1 {
    font-family: 'Merriweather', serif;
    font-style: italic;
    font-weight: 700;
    color: #5d433b; /* Deep espresso/ink color */
    text-align: center;
    margin-bottom: 12px;
    font-size: 1.8rem;
    position: relative;
    letter-spacing: -0.5px;
}

/* The Subtle Ornament (A hand-drawn style underline) */
h1::after {
    content: "";
    display: block;
    width: 60px;
    height: 2px;
    background: #d4a373; /* Match your tan flag color */
    margin: 10px auto 0;
    border-radius: 2px;
    opacity: 0.6;
}

/* The Subtitle */
.subtitle {
    font-family: 'Merriweather', serif;
    font-style: italic;
    font-size: 0.9rem;
    color: #8e8d8a; /* Soft, faded ink color */
    text-align: center;
    max-width: 80%;
    margin: 0 auto 40px;
    line-height: 1.5;
    position: relative;
}

/* Decorative 'quotes' around the subtitle for extra coziness */
.subtitle::before, .subtitle::after {
    content: "—";
    padding: 0 10px;
    color: #d1ccc0;
    font-weight: 300;
}


/* --- The Comments Stream --- */
.comments-stream {
    max-width: 45%;
    margin: 40px auto 0;
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.note-entry {
    position: relative;
    padding: 20px;
    background: rgba(255, 255, 255, 0.4); /* Very subtle paper-on-paper look */
    border-left: 3px solid #d1ccc0;
    transition: transform 0.2s ease;
}

.note-entry:hover {
    transform: translateX(5px);
    background: rgba(255, 255, 255, 0.8);
}

/* Style for special 'Favorited' memories */
.note-entry.is-favorite {
    border-left-color: #d4a373; /* Match your tan flag */
    background: #fffdf5;
}

.favorite-star {
    position: absolute;
    top: -10px;
    left: -10px;
    color: #d4a373;
    font-size: 1.2rem;
}

.comment-text {
    font-family: 'Merriweather', serif;
    font-style: italic;
    line-height: 1.6;
    color: var(--ink);
    margin: 0 0 15px 0;
    font-size: 0.95rem;
}

.note-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.75rem;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.reader-name {
    font-weight: 600;
    color: var(--coffee);
}

.note-source {
    font-style: normal;
    opacity: 0.7;
}

/* --- The Add Button at the bottom --- */
.action-area {
    text-align: center;
    margin-top: 50px;
}

.add-note-btn {
    text-decoration: none;
    color: var(--coffee);
    font-family: 'Merriweather', serif;
    font-size: 0.8rem;
    border: 1px dashed var(--coffee);
    padding: 10px 20px;
    transition: all 0.3s ease;
}

.add-note-btn:hover {
    background: var(--coffee);
    color: white;
    border-style: solid;
}

.action-area {
    text-align: center;
    margin-top: 60px;
    padding-bottom: 20px;
}

.back-home-btn {
    display: inline-block;
    text-decoration: none;
    color: #7d5a50; /* Your Coffee brown */
    font-family: 'Merriweather', serif;
    font-size: 0.85rem;
    font-style: italic;
    
    /* The 'Stamp' Border */
    border: 2px solid #7d5a50;
    padding: 12px 30px;
    border-radius: 2px; /* Nearly square for a classic look */
    
    background: transparent;
    transition: all 0.3s ease;
    letter-spacing: 1px;
    position: relative;
}

/* The Hover Effect: Filling the stamp with 'ink' */
.back-home-btn:hover {
    background: #7d5a50;
    color: #fdfcf0; /* Fills with the paper color */
    box-shadow: 0 4px 12px rgba(125, 90, 80, 0.2);
    transform: translateY(-2px);
}

.btn-icon {
    margin-right: 8px;
    font-style: normal;
    font-weight: bold;
}

/* Every second note tilts slightly right */
.note-entry:nth-child(even) {
    transform: rotate(0.5deg);
}

/* Every third note tilts slightly left */
.note-entry:nth-child(3n) {
    transform: rotate(-0.5deg);
}

/* When you hover, they straighten out—like you're picking it up to read */
.note-entry:hover {
    transform: rotate(0deg) scale(1.02);
    z-index: 10;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}

</style>


