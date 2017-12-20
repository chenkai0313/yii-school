<?php
namespace mobile\controllers;

use mobile\models\FronBanner;
use Yii;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use mobile\models\FronArticle;
/**
 * Site controller
 */
class CampusController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * 创业团队-创业先锋
     */
    public function actionTeam()
    {
        $this->layout = false;
        $this->getView()->title = "校园创业-创业团队";

        //创业团队-banner
        $newsBanner = FronBanner::find()
            ->joinWith('categorys')
            ->joinWith('fronFiles')
            ->andWhere(['=','fron_banner.tid','17'])
            ->orderBy(['sort'=>SORT_DESC])
            ->all();

        //创业团队-创业先锋
        $van = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','20'])
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        //创业团队-人才招募
        $job = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','21'])
            ->orderBy(['id'=>SORT_DESC])
            ->limit(7)
            ->all();

        //创业团队-人才招募总数
        $jobAll = FronArticle::find()->andWhere(['=','cid','21'])->all();
        $jobNum=ceil(count($jobAll)/'7');//计算出总页数

        //创业团队-项目展示
        $projectShow = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','22'])
            ->orderBy(['id'=>SORT_DESC])
            ->limit(3)
            ->all();
        //创业团队-项目展示总数
        $projectAll = FronArticle::find()->andWhere(['=','cid','22'])->all();
        $projectNum=ceil(count($projectAll)/'3');//计算出总页数

        return $this->render('venture_team',['van'=>$van, 'job'=>$job,'jobNum'=>$jobNum, 'projectShow'=>$projectShow,'projectNum'=>$projectNum, 'newsBanner'=>$newsBanner,]);
    }

    //创业团队-人才招募-下一页
    public function actionTeam_ajax()
    {
        if(yii::$app->request->isAjax){
            $job = FronArticle::find()
                ->joinWith('fronFiles')
                ->andWhere(['=','cid','21'])
                ->orderBy(['id'=>SORT_DESC])
                ->offset($_GET['id']+6)
                ->limit(7)
                ->all();
            $data = Json::encode($job);
            return $data;
        }
    }
    //创业团队-人才招募-上一页
    public function actionTeam_ajaxprev()
    {
        if(yii::$app->request->isAjax){
            $job = FronArticle::find()
                ->joinWith('fronFiles')
                ->andWhere(['=','cid','21'])
                ->orderBy(['id'=>SORT_DESC])
                ->offset($_GET['id']-6)
                ->limit(7)
                ->all();
            $data = Json::encode($job);
            return $data;
        }
    }

    //创业团队-项目展示-下一页
    public function actionTeam_ajaxproject()
    {
        if(yii::$app->request->isAjax){
            //当前页码
            $offset = ($_GET['id']) * 3;
            $data = FronArticle::find()
                ->joinWith('fronFiles')
                ->andWhere(['=','cid','22'])
                ->asArray()
                ->orderBy(['id'=>SORT_DESC])
                ->offset($offset)
                ->limit(3)
                ->all();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }
    //创业团队-项目展示-上一页
    public function actionTeam_ajaxprojectprev()
    {
        if(yii::$app->request->isAjax){
            $offset = ($_GET['id']-1) * 3;
            $data = FronArticle::find()
                ->joinWith('fronFiles')
                ->andWhere(['=','cid','22'])
                ->asArray()
                ->orderBy(['id'=>SORT_DESC])
                ->offset($offset)
                ->limit(3)
                ->all();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }

    //创业组织
    public function actionOrg()
    {
        $this->layout = false;
        $this->getView()->title = "校园创业-创业组织";

        //当前页码
        if(empty($_GET['cupg'])){
            $_GET['cupg'] = '1';//给加个分页的当前页码
            $offset = $_GET['cupg']-1;
        }else{
            $offset = ($_GET['cupg']-1) * 4;
        }
        //总数
        $newsCount = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->andWhere(['=','cid','42'])
            ->all();
        $pageNum=ceil(count($newsCount)/4);//计算出总页数

        //创业组织
        $org = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('category')
            ->andWhere(['=','cid','42'])
            ->offset($offset)
            ->limit(4)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('venture_org',['org'=>$org, 'pageNum'=>$pageNum]);
    }

    //投资公司
    public function actionInvest(){
        $this->layout = false;
        $this->getView()->title = "校园创业-投资公司";

        //当前页码
        if(empty($_GET['cupg'])){
            $_GET['cupg'] = '1';//给加个分页的当前页码
            $offset = $_GET['cupg']-1;
        }else{
            $offset = ($_GET['cupg']-1) * 4;
        }
        //总数
        $newsCount = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->andWhere(['=','cid','41'])
            ->all();
        $pageNum=ceil(count($newsCount)/8);//计算出总页数

        //投资公司
        $model = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','41'])
            ->offset($offset)
            ->limit(8)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('invest',['model'=>$model, 'pageNum'=>$pageNum]);

    }

}
