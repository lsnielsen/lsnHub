<?php

   include __DIR__ . "/../includes/data.php";
   $total_sold = 0;

// 1. Fetch Last 5 Sales for the "Journal"
   $history_query = $con->query("SELECT amount, dato FROM minhistoriesales ORDER BY dato DESC LIMIT 5");
   $history_query = array_slice($sales, -5);

   foreach ($sales as $sale) {
     $total_sold += $sale['amount'];
   }

// 3. Set your Goal (e.g., 1000 copies)
   $goal = 1000;
   $percent = ($total_sold / $goal) * 100;
   if ($percent > 100) $percent = 100;



?>