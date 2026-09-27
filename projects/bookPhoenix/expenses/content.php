

<?php


$grand_total = 0;
foreach ($expenses as $expense) {
    $grand_total += $expense[2];
}
?>

<body>

<div class="journal-container">
    <header class="ledger-header">
        <h1>Production & Sales Expenses</h1>
        <p class="subtitle">A transparent ledger of the investments made to bring the story to light</p>

        <div class="total-investment-card">
            <span class="total-label">Total Investment</span>
            <span class="total-amount">
	      <?php echo number_format($grand_total, 2, ',', '.'); ?>
	      dkk
	    </span>
        </div>
    </header>

    <table class="ledger-table">
        <thead>
            <tr>
                <th>ID / Ref</th>
                <th>Date</th>
                <th class="text-right">Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($expenses as $expense): ?>
                <tr>
                    <td><span class="category-tag">#<?php echo $expense[0]; ?></span></td>
		    <td class="item-description">
		        <?php echo date('d.m.Y', strtotime($expense[1])); ?>
		    </td>
                    <td class="item-cost text-right">
		      <?php echo number_format($expense[2], 2, ',', '.'); ?>
		      dkk
		    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="action-area">
        <a href="frontpage.php" class="back-home-btn">
            <span class="btn-icon">←</span> Return to Frontpage
        </a>
    </div>
</div>

</body>




