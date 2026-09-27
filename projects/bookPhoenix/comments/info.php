
    <h1>Reader Reflections</h1>
    <p class="subtitle">Echoes of the story from those who journeyed through its pages</p>

    <div class="comments-stream">
        <?php foreach ($theCommentsArray as $note): ?>
            <div class="note-entry <?php echo $note['fav'] ? 'is-favorite' : ''; ?>">
                
                <?php if ($note['fav']): ?>
                    <span class="favorite-star">★</span>
                <?php endif; ?>

                <p class="comment-text">"<?php echo $note['text']; ?>"</p>
                
                <div class="note-meta">
                    <span class="reader-name">— <?php echo $note['name']; ?></span>
                    <span class="note-date"><?php echo $note['date']; ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="action-area">
    	 <a href="/bookPhoenix/controller/frontpage.php" class="back-home-btn">
            <span class="btn-icon">←</span>
	    Back Home
    	 </a>
    </div>


