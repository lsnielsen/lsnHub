
<?php

   include "../includes/data.php";

   $dates = [];
   foreach ($sales as $sale) {
      $dates[] = $sale['dato'];
   }

   $daysSince = null;
   if (!empty($dates)) {
      $minDato = min($dates);
      $maxDato = max($dates);       
    
      $today = new DateTime();
      $lastSaleDate = new DateTime($maxDato);
      $firstSaleDate = new DateTime($minDato);      
      $daysSince = $today->diff($lastSaleDate)->days;
      $totalDays = $today->diff($firstSaleDate)->days;      
   }

   $salesByDay = [];
   $lastMonthSales = 0;
   $currentYearMonth = date('Y-m');
   $revenue = 0;
   $totalSale = 0;

   foreach ($sales as $sale) {
     $totalSale += $sale['amount'];
     $revenue += $sale['price'];
     $date = $sale['dato'];
     $amount = $sale['amount'];

     if (!isset($salesByDay[$date])) {
        $salesByDay[$date] = 0;
     }
     $salesByDay[$date] += $amount;

     $saleYearMonth = date('Y-m', strtotime($sale['dato']));
     if ($saleYearMonth === $currentYearMonth) {
        $lastMonthSales += $sale['amount'];
     }
   }

   arsort($salesByDay);
   $bestDayDate = key($salesByDay);
   $bestDayTotal = current($salesByDay);

?>


