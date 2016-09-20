<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "piece".
 *
 * @property integer $id
 * @property string $image
 * @property integer $number
 * @property integer $puzzle
 * @property integer $created
 */
class Piece extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'piece';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'puzzle', 'created'], 'required'],
            [['number', 'puzzle', 'created'], 'integer'],
            [['image'], 'image', 'extensions' => ['png', 'jpg'], 'maxSize' => 1024*1024,
                'minHeight' => 133, 'maxHeight' => 133, 'minWidth' => 150, 'maxWidth' => 150],
            # [['image'], 'clientValidateImage'],
            [['image'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'number' => 'Number',
            'puzzle' => 'Puzzle',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuzzler()
    {
        return $this->hasOne(Puzzle::className(), ['id' => 'puzzle']);
    }
}
