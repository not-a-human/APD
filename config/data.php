<?php 
    $x = "Close";
    require_once 'config.php';

    $sql = "SELECT * FROM bilik_apd WHERE status = 'PENDING';";
    $result = mysqli_query($db, $sql);
    
    if($result){
        if(mysqli_num_rows($result) == 1){
            $x = "Door Open x123";
        }
    }
    
echo $x; 

?>