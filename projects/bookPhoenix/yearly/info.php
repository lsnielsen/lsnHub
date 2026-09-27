



<div class="journal-container">
    <a href="/bookPhoenix/controller/frontpage.php" class="back-flag">
       Back Home
    </a>
    
    <h1>Yearly Chronicles</h1>

    <div class="ledger-archive">
        <div class="ledger-row ledger-header">
            <span class="col-year">Year</span>
            <span class="col-qty">Readers</span>
            <span class="col-sum">Harvest</span>
        </div>

    	<?php foreach ($yearlyData as $row): ?>
    	  <div class="ledger-row">
            <span class="col-year">
              <?php echo $row['year']; ?>
            </span>
            <span class="col-qty">
              <?php echo $row['totalBooks']; ?>
            </span>
            <span class="col-sum">
              DKK <?php echo number_format($row['totalIncome'], 2, ',', '.'); ?>
            </span>
          </div>
	<?php endforeach; ?>


    </div>

    <p style="text-align: center; font-style: italic; color: #aaa; margin-top: 40px; font-size: 0.8rem;">
        "Every year is a new chapter written."
    </p>
</div>


