<?php 

include_once './Database/DAO/UserDB.php';

//Update CauseName

if (isset($_POST['update_user']) && isset($_POST['update_username']) && isset($_POST['userId']) && isset($_POST['update_password']) && isset($_POST['adminOrNot'])) {
    
    $username = $_POST['update_username'];
    $userid = $_POST['userId'];
    $password = $_POST['update_password'];
    $adminornot = $_POST['adminOrNot'];
    
    //var_dump($causeName);
    //var_dump($causeId);
    //print("itworks");
    UserDB::updateUser();
    header('location: index.php');    
    
}else{
    print("camarchepas");
}


?>