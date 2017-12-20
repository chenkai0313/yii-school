<?php
namespace mobile\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use mobile\models\FronArticle;

/**
 * Site controller
 */
class GoodController extends Controller
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

    //创业导师
    public function actionTeacher()
    {
        $this->layout = false;
        $this->getView()->title = "校园创业-创业导师";

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
            ->andWhere(['=','cid','40'])
            ->all();
        $pageNum=ceil(count($newsCount)/4);//计算出总页数

        //创业导师
        $teacher = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','40'])
            ->offset($offset)
            ->limit(4)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('good-teacher',['teacher'=>$teacher, 'pageNum'=>$pageNum]);
    }

    //精品活动
    public function actionActive()
    {
        $this->layout = false;
        $this->getView()->title = "创业干货-精品活动";
        //banner
        $banner = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','27'])
            ->orderBy(['id'=>SORT_DESC])
            ->limit(3)
            ->all();

        //最新活动
        $new = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','36'])
            ->andWhere(['=','fron_article.top','1'])
            ->orderBy(['id'=>SORT_DESC])
            ->limit(3)
            ->all();

        $abc = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','37'])
            ->andWhere(['=','fron_article.top','1'])
            ->orderBy(['id'=>SORT_DESC])
            ->limit(3)
            ->all();

        //总裁说
        $ceo = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','36'])
            ->orderBy(['id'=>SORT_DESC])
            ->limit(3)
            ->all();

        //高桌晚宴
        $dinner = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','37'])
            ->orderBy(['id'=>SORT_DESC])
            ->limit(3)
            ->all();

        return $this->render('good_active',['banner'=>$banner,'new'=>$new,'abc'=>$abc,'ceo'=>$ceo, 'dinner'=>$dinner]);
    }

    //活动详细
    public function actionDetail()
    {
        $this->layout = false;

        $this->getView()->title = "创业干货 - 活动详细";
        if(isset($_GET['id'])){
            //进来浏览次数+1
            $model = FronArticle::find()
                ->joinWith('fronFiles')
//                ->joinWith('fronCategorys')
                ->joinWith('fronCompetitionJoins')
                ->where(['{{%fron_article}}.id'=>$_GET['id']])
                ->one();

            $model->clicked = $model['clicked']+1;
            //保存赋值的数据到数据库
            $model->save();

        }else{
            $this->redirect('good/teacher');
        }

        //推荐阅读
        $recommend = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->where(['{{%fron_article}}.rec'=>1])
            ->limit(2)
            ->all();

        return $this->render('active-detail',['model'=>$model, 'recommend'=>$recommend]);
    }



}
