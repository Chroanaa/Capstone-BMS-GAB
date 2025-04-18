<?php
$id = $_GET['id'];
include './performanceTrackerController.php';
function deleteResident($id){
    include '../databaseconn/connection.php';
    $conn = $GLOBALS['conn'];
    $credsConn = $GLOBALS['User_conn'];
    
    try {
        recordTechnicalPerformance('delete_resident_start', 'delete_resident');
        $stmt = $conn->prepare("DELETE FROM user_info WHERE creds_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $stmt1 = $conn->prepare("DELETE FROM document_requested WHERE user_id = :id");
        $stmt1->bindParam(':id', $id);
        $stmt1->execute();
        
        $stmt2 = $conn->prepare("DELETE FROM document_requested_for_others WHERE user_requestor_id = :id");
        $stmt2->bindParam(':id', $id);
        $stmt2->execute();
        
        $stmt3 = $conn->prepare("DELETE FROM requested_for_others_info WHERE requestor_id = :id");
        $stmt3->bindParam(':id', $id);
        $stmt3->execute();
        
        $stmt4 = $credsConn->prepare("DELETE FROM user_creds WHERE id = :id");
        $stmt4->bindParam(':id', $id);
        $stmt4->execute();
        recordTechnicalPerformance('delete_resident_end', 'delete_resident');
        
        header('Location: ../views/AdminAllResidents.php?status=success');
    } catch (Exception $e) {
    
        header('Location: ../views/AdminAllResidents.php?status=error');
    }
}

if(isset($id)){
    deleteResident($id);
}
?>