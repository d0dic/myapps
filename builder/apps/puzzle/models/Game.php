<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property string $user
 * @property string $token
 * @property integer $puzzle
 * @property string $data
 * @property double $score
 * @property integer $finished
 * @property integer $created
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'puzzle', 'finished', 'created'], 'integer'],
            [['data'], 'string'],
            [['score'], 'number'],
            [['token'], 'string', 'max' => 32],
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
            'token' => 'Token',
            'puzzle' => 'Puzzle',
            'data' => 'Data',
            'score' => 'Score',
            'finished' => 'Finished',
            'created' => 'Created',
        ];
    }
}
