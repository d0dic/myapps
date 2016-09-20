<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topscore".
 *
 * @property integer $id
 * @property string $user
 * @property integer $form
 * @property integer $created
 */
class Topscore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topscore';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'form', 'created'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'form' => 'Form',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuery()
    {
        return $this->hasOne(Form::className(), ['id' => 'form'])
            ->orderBy(['score' => SORT_DESC]);
    }
}
