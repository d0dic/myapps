<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "play".
 *
 * @property integer $id
 * @property string $user
 * @property double $score
 * @property string $questions
 * @property integer $created
 */
class Form extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'created'], 'integer'],
            [['score'], 'number'],
            [['questions'], 'string'],
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
            'score' => 'Score',
            'questions' => 'Questions',
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
    public function getQueries()
    {
        return Question::findAll(json_decode($this->questions));
    }
}
