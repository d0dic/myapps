<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Poster;

/**
 * PosterSearch represents the model behind the search form about `app\models\Poster`.
 */
class PosterSearch extends Poster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'user', */'likes', 'shares', 'approved', 'created'], 'integer'],
            [['name', 'user', 'image'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Poster::find();
        $query->joinWith('owner');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            # 'user' => $this->user,
            'likes' => $this->likes,
            'shares' => $this->shares,
            'approved' => $this->approved,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'user.name', $this->user])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
