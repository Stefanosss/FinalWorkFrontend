<?php
/**
 * Created by PhpStorm.
 * User: Dries
 * Date: 20/02/2019
 * Time: 21:33
 */

include_once "Models/Cause.php";
include_once "Models/Effect.php";
include_once "Models/Cluster.php";
include_once "Database/DatabaseFactory.php";

class ClusterDB
{
    private static function getVerbinding() {
        return DatabaseFactory::getDatabase();
    }

    public static function getAll() {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Cluster");
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarCluster($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getById($id) {
        $resultatenArray = array();
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT * FROM Cluster WHERE idCluster=" .$id);
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $nieuw = self::converteerRijNaarCluster($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function insert($causeid, $array) {
        $string = self::arrayToClusterEffects($array);
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO Cluster(idCluster, Cause_idCause,Cluster_Effects) VALUES (null ,'$causeid','$string')");
    }


    public static function arrayToClusterEffects($array){
        sort($array);
        $string = "|";
        foreach ($array as $a){
            $string .= "". $a . "|";
        }
        return $string;
    }

    public static function updateClusterCause($idCluster,$causeid) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE Cluster SET Cause_idCause=".$causeid." WHERE idCluster=".$idCluster);
    }

    public static function updateClusterEffect($idCluster,$array) {
        $string = self::arrayToClusterEffects($array);
        return self::getVerbinding()->voerSqlQueryUit("UPDATE Cluster SET Cluster_Effects=".$string." WHERE idCluster=".$idCluster);
    }

    public static function deleteById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM Cluster WHERE idCluster=".$id);
    }



    protected static function converteerRijNaarCluster($databaseRij) {
        return new Cluster($databaseRij['idCluster'], $databaseRij['Cause_idCause'], $databaseRij['Cluster_Effects']);
    }
}