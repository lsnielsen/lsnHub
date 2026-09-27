


<?php

$yearlyData = [];
include "../includes/data.php";

foreach ($sales as $sale) {
    // Extract the 4-digit year from the 'dato' string (e.g., "2025")
    $year = date('Y', strtotime($sale['dato']));
    
    // Initialize the year in our tracking array if it doesn't exist yet
    if (!isset($yearlyData[$year])) {
        $yearlyData[$year] = [
            'year'        => $year,
            'totalBooks'  => 0,
            'totalIncome' => 0
        ];
    }
    
    // Accumulate the books and the income for that specific year
    $yearlyData[$year]['totalBooks']  += $sale['amount'];
    $yearlyData[$year]['totalIncome'] += $sale['price'];
}

// Optional: Sort years so the oldest or newest appears first (krsort sorts newest first)
krsort($yearlyData);
?>



