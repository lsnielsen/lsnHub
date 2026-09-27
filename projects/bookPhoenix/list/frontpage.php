
<?php
	include "styling.php";
	include "../includes/data.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Readers list</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<div class="ledger-archive">
    <h3 class="ledger-title">
    	The Sales Log
    </h3>

    <div class="ledger-row ledger-header">
        <span class="col-date">
	  Date
	</span>
        <span class="col-qty">
	  Qty
	</span>
        <span class="col-note">
	  Note
	</span>
        <span class="col-income">
	  Income
	</span>
    </div>


<?php foreach ($sales as $row): ?>
    <div class="ledger-row">
        <span class="col-date">
            <?php 
            $date = new DateTime($row['dato']);
            echo $date->format('F j, Y'); 
            ?>
        </span>
        <span class="col-qty"><?php echo $row['amount']; ?></span>
        <span class="col-note"><?php echo $row['buyer']; ?></span>
        <span class="col-income"><?php echo $row['price']; ?></span>
    </div>
<?php endforeach; ?>


</div>

    <a href="/bookPhoenix/controller/frontpage.php" class="back-btn">
       &larr; Return to Ledger
    </a>
</div>

</body>
</html>


