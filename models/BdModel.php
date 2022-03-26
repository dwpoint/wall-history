<?php
namespace app\models;
use yii\db\ActiveRecord;

class BdModel extends ActiveRecord{
    public static function tableName(){
        return 'post';
    }
}

?>