<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "puzzle".
 *
 * @property integer $id
 * @property string $name
 * @property integer $active
 * @property integer $created
 */
class Puzzle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'puzzle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'active', 'created'], 'required'],
            [['active', 'created'], 'integer'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'active' => 'Active',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPieces()
    {
        return $this->hasMany(Piece::className(), ['puzzle' => 'id']);
    }
}
