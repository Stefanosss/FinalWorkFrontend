<?php 

include_once './Database/DAO/CauseDB.php';

//Update CauseName

if (isset($_POST['update_cause']) && isset($_POST['update_causename']) && isset($_POST['causeid'])) {
    $causeName = $_POST['update_causename'];
    $causeId = $_POST['causeid'];
    
    var_dump($causeName);
    var_dump($causeId);
    print("itworks");
    CauseDB::updateCause();
    header('location: index.php');    
    
}else{
    print("camarchepas");
}


?>