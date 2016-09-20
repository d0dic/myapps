<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topscore".
 *
 * @property integer $id
 * @property string $user
 * @property integer $game
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
            [['user', 'game', 'created'], 'integer'],
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
            'game' => 'Game',
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
    public function getPlay()
    {
        return $this->hasOne(Game::className(), ['id' => 'game'])
            ->orderBy(['score' => SORT_DESC]);
    }
}
