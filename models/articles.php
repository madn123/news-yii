<?php


namespace app\models;


use yii\db\ActiveRecord;

class articles extends ActiveRecord
{
    public function getSources(){
        return $this->hasOne(sources::className(), ['id' => 'source_id']);
    }
}