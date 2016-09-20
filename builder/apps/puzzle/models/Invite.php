<?php

namespace app\models;

use Yii;
use yii\web\Response;

/**
 * This is the model class for table "invite".
 *
 * @property integer $id
 * @property integer $user
 * @property integer $friend
 * @property integer $created
 */
class Invite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'friend', 'created'], 'required'],
            [['user', 'friend', 'created'], 'integer'],
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
            'friend' => 'Friend',
            'created' => 'Created',
        ];
    }

    /**
     * @return array
     */
    public static function getInvited(){

        if (Yii::$app->user->isGuest){
            return json_encode([]);
        }

        $invited = self::find()->select(['friend'])->where(
            ['user' => Yii::$app->user->id])->all(); $data = [];

        foreach($invited as $user){
            array_push($data, $user->friend);
        }

        return json_encode($data);
    }
}
