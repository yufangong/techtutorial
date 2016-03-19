<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tutorials;

/**
 * TutorialsSearch represents the model behind the search form about `\frontend\models\Tutorials`.
 */
class TutorialsSearch extends Tutorials
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'title', 'author', 'created_at', 'category', 'file', 'content'], 'safe'],
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
        $query = Tutorials::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
    
    //
    public function searchCate($cate)
    {
       $query = Tutorials::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['like', '_id', ''])
            ->andFilterWhere(['like', 'title', ''])
            ->andFilterWhere(['like', 'author', ''])
            ->andFilterWhere(['like', 'created_at', ''])
            ->andFilterWhere(['like', 'category', $cate])
            ->andFilterWhere(['like', 'file', ''])
            ->andFilterWhere(['like', 'content', '']);
        
        return $dataProvider;

        
    }
}
