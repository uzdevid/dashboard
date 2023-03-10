<?php

namespace app\models\system\search;

use app\models\system\Action;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ActionSearch represents the model behind the search form of `app\models\system\Action`.
 */
class ActionSearch extends Action {
    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['id'], 'integer'],
            [['path'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Action::find();

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
        ]);

        $query->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
