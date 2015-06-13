<?php

namespace ivan\simpleforum\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ivan\simpleforum\models\Thread;

/**
 * ThreadSearch represents the model behind the search form about `app\modules\forum\models\Thread`.
 */
class ThreadSearch extends Thread
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'forum_id', 'is_locked', 'view_count', 'created'], 'integer'],
            [['subject'], 'safe'],
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
        $query = Thread::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'forum_id' => $this->forum_id,
            'is_locked' => $this->is_locked,
            'view_count' => $this->view_count,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject]);

        return $dataProvider;
    }
}
