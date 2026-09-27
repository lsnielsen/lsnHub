<style>

.cover-links {
    margin-top: 50px;
    display: flex;
    justify-content: center;
    gap: 30px;
    border-top: 1px solid #eee; /* A very faint line to separate the art */
    padding-top: 20px;
}

.cover-link-item {
    text-decoration: none;
    font-family: 'Merriweather', serif;
    font-style: italic;
    font-size: 0.9rem;
    color: #7d5a50;
    position: relative;
    transition: color 0.3s ease;
}

.cover-link-item:hover {
    color: #d4a373;
}

.cover-link-item:hover::after {
    width: 100%;
}








/* Ensure the page uses the same sanctuary foundation */
.journal-container {
    position: relative;
    background: #fdfcf0; /* The same cream paper */
    padding: 50px 40px;
    /* The identical 'Triple Page' shadow from your Ledger */
    box-shadow: 
        0 1px 1px rgba(0,0,0,0.05), 
        0 10px 0 -5px #fdfcf0, 
        0 10px 1px -4px rgba(0,0,0,0.1), 
        0 20px 0 -10px #fdfcf0, 
        0 20px 1px -9px rgba(0,0,0,0.1), 
        0 30px 20px rgba(0,0,0,0.05);
}

/* Matching the Ledger Title Style */
h1 {
    font-family: 'Merriweather', serif;
    font-style: italic;
    color: #7d5a50; /* Same 'Coffee' brown as your ledger titles */
    text-align: center;
    margin-bottom: 30px;
}
h3 {
    font-family: 'Merriweather', serif;
    font-style: italic;
    color: #7d5a50; /* Same 'Coffee' brown as your ledger titles */
    text-align: center;
    margin-top: 40px;
    margin-bottom: 30px;
}

/* The 'Gallery' Mount - This is what makes it a 'Journal' */
.book-mount {
    margin: 0 auto;
    max-width: 300px;
    padding: 10px;
    background: #fff; /* White photo-border */
    border: 1px solid #d1ccc0; /* Same dashed-line color from ledger rows */
    box-shadow: 2px 4px 8px rgba(0,0,0,0.05);
    transform: rotate(-1.5deg); /* Matches the 'random tilt' of your reader notes */
}

.front-cover-img {
    width: 100%;
    height: auto;
    display: block;
}






/* Adding 'Photo Corners' to match the scrap-book style */
.book-mount::before {
    content: "";
    position: absolute;
    top: -5px;
    left: -5px;
    width: 30px;
    height: 30px;
    border-top: 2px solid #d4a373; /* Match your tan flag */
    border-left: 2px solid #d4a373;
}

.book-mount::after {
    content: "";
    position: absolute;
    bottom: -5px;
    right: -5px;
    width: 30px;
    height: 30px;
    border-bottom: 2px solid #d4a373;
    border-right: 2px solid #d4a373;
}


//Slider css

.gallery-slider {
    position: relative;
    width: 100%;
    max-width: 800px; /* Wider to accommodate both side-by-side */
    height: 400px;    /* Height of your tallest image */
    margin: 50px auto;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.2); /* Subtle paper-well look */
    border-radius: 4px;
}

.slide-content {
    display: flex;
    align-items: center;    /* Keeps everything centered vertically */
    justify-content: space-between; 
    width: 100%;
    height: 100%;
    padding: 20px;
    box-sizing: border-box;
}

/* LANE 1: Forces the image to behave */
.image-box {
    flex: 1;                /* Takes up half the space */
    display: flex;
    justify-content: center;
    max-width: 50%;         /* Strictly half */
    height: 100%;
}

.image-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;    /* Shows the WHOLE image, no matter the size */
    border: 1px solid #d1ccc0;
    box-shadow: 3px 3px 10px rgba(0,0,0,0.1);
}

/* LANE 2: The protected text area */
.text-box {
    flex: 1;                /* Takes up the other half */
    max-width: 45%;         /* Slightly less than half for a gap */
    padding-left: 30px;
    border-left: 1px dashed #d1ccc0; /* A soft divider like a book spine */
}

.caption-text {
    font-family: 'Merriweather', serif;
    font-style: italic;
    font-size: 1.1rem;
    color: #7d5a50;
    line-height: 1.7;
    margin: 0;
}



</style>
