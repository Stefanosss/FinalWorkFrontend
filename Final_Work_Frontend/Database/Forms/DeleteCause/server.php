<?php
/**
 * Created by PhpStorm.
 * User: dries
 * Date: 16/04/2018
 * Time: 17:56
 * Logica komt van hier: https://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database
 */
include_once './Database/DAO/CauseDB.php';

//Delete user
if (isset($_POST['delete_cause']) && isset($_POST['delete_idCause'])) {
    CauseDB::deleteCauseById($_POST['delete_idCause']);
}

?>