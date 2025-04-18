<?php
date_default_timezone_set('Asia/Manila');

function recordTechnicalPerformance($operation_name,$category =  "system"){
    $start_time =  microtime(true);
    include ('../databaseconn/connection.php');
  
    
         $end_time = microtime(true);
        $execution_time = ($end_time - $start_time) * 1000;
      
            $insert = "INSERT INTO `performance_metrics`(`metric_name`, `metric_value`,`metric_date`, `category`) VALUES (:metric_name, :metric_value,:metric_date,:category)";
            $stmt = $conn->prepare($insert);
            $stmt->execute([
                'metric_name' => $operation_name,
                'metric_value' => $execution_time,
                'metric_date' => date('Y-m-d H:i:s'),
                'category' => $category
            ]);
       
     }
    

?>