<?php

namespace backend\modules\cms\controllers;

use backend\modules\cms\models\FronCompetitionJoin;
use Yii;
use backend\modules\cms\models\Organize;
use backend\modules\cms\models\OrganizeExtension;
use backend\modules\cms\models\OrganizeSearch;
use yii\web\NotFoundHttpException;

/**
 * OrganizeController implements the CRUD actions for FronOrganize model.
 */
class OrganizeController extends \getpu\user\controllers\AccessController
{
    /**
     * Lists all FronOrganize models.
     * @return mixed
     * @meta 创业组织
     */
    public function actionIndex()
    {
        $searchModel = new OrganizeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new FronOrganize model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @meta [创业组织] 添加文章
     */
    public function actionCreate()
    {
        $model = new Organize;
        $exten = new OrganizeExtension;
        $join  = new FronCompetitionJoin;
        $load = $model->load(Yii::$app->request->post()) && $exten->load(Yii::$app->request->post());
        if($load && $model->save()){
            $exten->aid = $model->id;
            $join->aid  = $model->id;
            $exten->save();
            $join->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'exten' => $exten,
                'join'  => $join,
            ]);
        }
    }

    /**
     * Updates an existing FronOrganize model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @meta [创业组织] 更新文章
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $exten = OrganizeExtension::findOne($model->id);
        $join  = FronCompetitionJoin::findOne($model->id);
        $load = $model->load(Yii::$app->request->post())
                && $exten->load(Yii::$app->request->post())
                && $join->load(Yii::$app->request->post());
        if ($load && $model->save() && $exten->save() && $join->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'exten' => $exten,
                'join'  => $join,
            ]);
        }
    }

    /**
     * Deletes an existing FronOrganize model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @meta [创业组织] 删除文章
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        OrganizeExtension::findOne($id)->delete();
        FronCompetitionJoin::findOne($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FronOrganize model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FronOrganize the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organize::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
