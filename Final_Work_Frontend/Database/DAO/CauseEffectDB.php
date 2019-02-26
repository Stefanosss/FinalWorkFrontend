<?php
/**
 * Created by PhpStorm.
 * User: dries
 * Date: 24/01/2019
 * Time: 22:02
 */

include_once "Models/Cause.php";
include_once "Models/Effect.php";
include_once "Database/DatabaseFactory.php";

class CauseEffectDB
{

    public static function getAllEffectsbyCauseId($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT Effect_idEffect FROM Cause_Effect WHERE Cause_idCause=".$id);
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $databaseRij = EffectDB::getById($databaseRij['Effect_idEffect']);
            $nieuw = self::converteerRijNaarEffect($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function getAllCausesbyEffectId($id) {
        $resultaat = self::getVerbinding()->voerSqlQueryUit("SELECT Cause_idCause FROM Cause_Effect WHERE Effect_idEffect=".$id);
        $resultatenArray = array();
        for ($index = 0; $index < $resultaat->num_rows; $index++) {
            $databaseRij = $resultaat->fetch_array();
            $databaseRij = CauseDB::getById($databaseRij['Cause_idCause']);
            $nieuw = self::converteerRijNaarCause($databaseRij);
            $resultatenArray[$index] = $nieuw;
        }
        return $resultatenArray;
    }

    public static function insert($causeid, $effectId) {
        return self::getVerbinding()->voerSqlQueryUit("INSERT INTO Cause_Effect(Cause_idCause, Effect_idEffect) VALUES ('$causeid','$effectId')");
    }

    public static function updateCause($causeid, $effectId) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE Cause_Effect SET Cause_idCause=".$causeid." WHERE Effect_idEffect=".$effectId);
    }

    public static function updateEffect($effectId, $causeid) {
        return self::getVerbinding()->voerSqlQueryUit("UPDATE Cause_Effect SET Effect_idEffect=".$effectId." WHERE Cause_idCause=".$causeid);
    }


    public static function deleteCauseById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM Cause_Effect WHERE Cause_idCause=".$id);
    }

    public static function deleteEffectById($id) {
        return self::getVerbinding()->voerSqlQueryUit("DELETE FROM Cause_Effect WHERE Effect_idEffect=".$id);
    }

    protected static function converteerRijNaarEffect($databaseRij) {
        return new Effect($databaseRij['idEffect'], $databaseRij['EffectName'], $databaseRij['EffectStatus'], $databaseRij['Error_idError']);
    }

    protected static function converteerRijNaarCause($databaseRij) {
        return new Cause($databaseRij['idCause'], $databaseRij['CauseName']);
    }
}