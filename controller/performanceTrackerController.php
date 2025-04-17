<?php
include '../databaseconn/connection.php';

function recordDocumentProcessingTime($document_id, $request_type = 'user', $action_type) {
    $conn = $GLOBALS['conn'];
    
    try {
        // Get the document request timestamp
        if ($request_type == 'user') {
            $query = "SELECT timestamp, status FROM document_requested WHERE id = :id";
        } else {
            $query = "SELECT time_Created as timestamp, status FROM document_requested_for_others WHERE id = :id";
        }
        
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $document_id]);
        $document = $stmt->fetch();
        
        if ($document) {
            $request_time = new DateTime($document['timestamp']);
            $current_time = new DateTime();
            $processing_time = $current_time->getTimestamp() - $request_time->getTimestamp(); // in seconds
            
            // Record the processing time
            $insertQuery = "INSERT INTO performance_metrics (metric_name, metric_value, category) 
                            VALUES (:metric_name, :metric_value, 'document_processing')";
            $stmt = $conn->prepare($insertQuery);
            $stmt->execute([
                'metric_name' => $action_type . '_processing_time',
                'metric_value' => $processing_time
            ]);
            
           
            
            return true;
        }
        
        return false;
    } catch (PDOException $e) {
        // Log error
        error_log("Performance tracking error: " . $e->getMessage());
        return false;
    }
}

function calculateDailyMetrics() {
    $conn = $GLOBALS['conn'];
    
    try {
        // Calculate average document processing time for today
        $query = "SELECT AVG(metric_value) as avg_time FROM performance_metrics 
                  WHERE DATE(metric_date) = CURDATE() 
                  AND category = 'document_processing'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        
        // Store the aggregated metric
        if ($result && $result['avg_time']) {
            $insertQuery = "INSERT INTO performance_metrics (metric_name, metric_value, category) 
                            VALUES ('daily_avg_processing_time', :avg_time, 'aggregated')";
            $stmt = $conn->prepare($insertQuery);
            $stmt->execute(['avg_time' => $result['avg_time']]);
        }
        
        // Calculate other metrics as needed
        
        return true;
    } catch (PDOException $e) {
        error_log("Calculate daily metrics error: " . $e->getMessage());
        return false;
    }
}
?>