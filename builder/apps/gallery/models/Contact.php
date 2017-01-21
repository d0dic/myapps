<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property string $user
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property integer $created
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'fname', 'lname', 'email', 'created'], 'required'],
            [['fname', 'lname'], 'string', 'max' => 16],
            [['email'], 'string', 'max' => 64],
            [['user', 'created'], 'integer'],
            [['email'], 'email'],
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
            'fname' => 'Name',
            'lname' => 'Lastname',
            'email' => 'Email',
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
}
