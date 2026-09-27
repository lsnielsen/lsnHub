
<?php
	include "styling.php";
	include "database.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reader Insights</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<div class="stats-paper">
    <h2>
       Observations from the Journey
    </h2>

    <div class="stat-row">
        <span class="stat-label">
	   Total Number of Orders
	</span>
        <span class="stat-value">
	   <?php
	      echo $totalSale;
	   ?>
	</span>
    </div>

    <div class="stat-row">
        <span class="stat-label">
	   Total days since the journey began
	</span>
        <span class="stat-value">
	   <?php
	      echo $totalDays;
	   ?>
	</span>
    </div>

    <div class="stat-row">
        <span class="stat-label">
	   Days since the last reader arrived
	</span>
        <span class="stat-value">
	   <?php
	      echo $daysSince;
	   ?>
	</span>
    </div>

    <div class="stat-row">
        <span class="stat-label">
	   Readers found this month
	</span>
        <span class="stat-value">
	   <?php
	      echo $lastMonthSales;
	   ?>
	</span>
    </div>

    <div class="stat-row">
        <span class="stat-label">
	   Total Revenue
	</span>
        <span class="stat-value">
	   <?php
	      echo round($revenue, 1) . " dkk";
	   ?>
	</span>
    </div>

    <div class="stat-row">
        <span class="stat-label">Most Fruitful Day</span>
        <span class="stat-value">
            <?php
	       echo $bestDayTotal ? date("d. F Y", strtotime($bestDayDate)) : "TBD";
	    ?>
        </span>
    </div>

    <a href="/bookPhoenix/controller/frontpage.php" class="back-btn">
       &larr; Return to Ledger
    </a>
</div>

</body>
</html>


