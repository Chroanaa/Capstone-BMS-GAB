<?php
  function formatDocumentName($documentName) {
    return ucwords(str_replace('_', ' ', $documentName));
}
function getProcessingTimeStats() {
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    try {
        // Get average processing times by day for the last 7 days
        $query = "SELECT 
                    DATE(metric_date) as day, 
                    AVG(metric_value) as avg_time,
                    MIN(metric_value) as min_time,
                    MAX(metric_value) as max_time
                  FROM performance_metrics 
                  WHERE metric_name = 'approval_processing_time'
                  AND metric_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                  GROUP BY DATE(metric_date)
                  ORDER BY day";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function getDocumentVolumeStats() {
    include '../databaseconn/connection.php';

    $conn = $GLOBALS['conn'];
    try {
        // Get document request volumes by type for the current month
        $query = "SELECT 
                    documents_requested as doc_type, 
                    COUNT(*) as count 
                  FROM document_requested
                  WHERE MONTH(timestamp) = MONTH(CURDATE()) 
                  AND YEAR(timestamp) = YEAR(CURDATE())
                  GROUP BY documents_requested";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $user_docs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $query = "SELECT 
                    documents_requested as doc_type, 
                    COUNT(*) as count 
                  FROM document_requested_for_others
                  WHERE MONTH(time_Created) = MONTH(CURDATE()) 
                  AND YEAR(time_Created) = YEAR(CURDATE())
                  GROUP BY documents_requested";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $others_docs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Combine results
        $docs = [];
        foreach($user_docs as $doc) {
            $docs[$doc['doc_type']] = ($docs[$doc['doc_type']] ?? 0) + $doc['count'];
        }
        foreach($others_docs as $doc) {
            $docs[$doc['doc_type']] = ($docs[$doc['doc_type']] ?? 0) + $doc['count'];
        }
        
        $result = [];
        foreach($docs as $type => $count) {
            $result[] = ['doc_type' => formatDocumentName($type), 'count' => $count];
        }
        
        return $result;
    } catch (PDOException $e) {
        return [];
    }
}
?>