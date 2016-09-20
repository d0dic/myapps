<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "poster".
 *
 * @property integer $id
 * @property string $user
 * @property string $name
 * @property string $image
 * @property integer $likes
 * @property integer $shares
 * @property boolean $approved
 * @property integer $created
 */
class Poster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'name', 'image', 'approved', 'created'], 'required'],
            [['user', 'likes', 'shares', 'created'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['approved'], 'boolean'],
            [['image'], 'string'],
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
            'name' => 'Name',
            'image' => 'Image',
            'likes' => 'Likes',
            'shares' => 'Shares',
            'approved' => 'Approved',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }
}
