<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Fileupload;

/**
 * FileuploadSearch represents the model behind the search form about `backend\models\Fileupload`.
 */
class FileuploadSearch extends Fileupload {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'filepath', 'filecreate_at', 'create_at'], 'integer'],
            [['filename', 'pid'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Fileupload::find();

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
            'filepath' => $this->filepath,
            'filecreate_at' => $this->filecreate_at,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'filename', $this->filename])
                ->andFilterWhere(['like', 'pid', $this->pid]);


        return $dataProvider;
    }

}
