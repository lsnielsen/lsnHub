

<!-- Dit HTML-link (Jeg har tilføjet et span omkring > for at kunne animere pilen) -->
<a href="../frontpage.php" class="btn-back" title="Tilbage til Forside">
  <span>&gt;</span>
</a>

<style>
.btn-back {
  /* Fast placering i nederste venstre hjørne */
  position: fixed;
  bottom: 30px;       /* Flyttet lidt højere op fra bunden */
  left: 30px;         /* Flyttet lidt længere ind fra kanten */
  z-index: 9999;      /* Ligger altid øverst */
  
  /* Gør linket til en stor, rund knap-boks */
  display: inline-flex;
  align-items: center;
  justify-content: center;
  
  /* Størrelse og form (Gjort markant større) */
  width: 70px;
  height: 70px;
  border-radius: 50%;
  
  /* Farver og synlighed */
  background-color: #0066ff; /* Kraftig blå farve */
  color: #ffffff;
  text-decoration: none;
  font-family: sans-serif;
  font-size: 36px;          /* Gjort selve pilen større og tydeligere */
  font-weight: bold;
  
  /* Kraftig skygge for maksimal synlighed (høj kontrast) */
  box-shadow: 0 8px 24px rgba(0, 102, 255, 0.4), 0 4px 8px rgba(0, 0, 0, 0.2);
  
  /* Glidende overgange */
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

/* Effekt når musen føres over (Hover) */
.btn-back:hover {
  background-color: #0052cc; /* Mørkere blå */
  transform: scale(1.12) translateY(-5px); /* Knappen bliver større og løfter sig */
  box-shadow: 0 12px 30px rgba(0, 102, 255, 0.6), 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* Lille animation der får pilen til at bevæge sig let, så den fanger øjet */
.btn-back span {
  display: inline-block;
  transition: transform 0.3s ease;
}

.btn-back:hover span {
  transform: translateX(4px); /* Pilen skubber sig lidt mod højre ved hover */
}
</style>


