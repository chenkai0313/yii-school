<?php
namespace mobile\controllers;

use mobile\models\FronBanner;
use mobile\models\FronCompetitionAssortResult;
use mobile\models\FronCompetitionAssortTags;
use Yii;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use mobile\models\FronArticle;
use mobile\models\FronReprint;

/**
 * Site controller
 */
class NewsController extends Controller
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
     * 新闻
     */
    public function actionIndex()
    {
        $this->layout = false;

        $this->getView()->title = "新闻动态-重点新闻";

        //重点新闻-banner
        $newsBanner = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','4'])
            ->andWhere(['=','fron_article.top','1'])
            ->orderBy(['id'=>SORT_DESC])
            ->one();

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
            ->andWhere(['=','cid','4'])
            ->all();
        $pageNum=ceil(count($newsCount)/4);//计算出总页数
        //重点新闻
        $news = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->andWhere(['=','cid','4'])
            ->offset($offset)
            ->limit(4)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('news',['news'=>$news, 'newsBanner'=>$newsBanner, 'pageNum'=>$pageNum,]);

    }

    /**
     * 创业资讯
     */
    public function actionInformation()
    {
        $this->layout = false;

        $this->getView()->title = "新闻动态-创业资讯";

        //创业资讯-banner
        $newsBanner = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','19'])
            ->andWhere(['=','fron_article.top','1'])
            ->orderBy(['id'=>SORT_DESC])
            ->one();

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
            ->andWhere(['=','cid','19'])
            ->all();
        $pageNum=ceil(count($newsCount)/4);//计算出总页数

        //创业资讯
        $information = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->andWhere(['=','cid','19'])
            ->offset($offset)
            ->limit(4)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('information',['information'=>$information, 'newsBanner'=>$newsBanner, 'pageNum'=>$pageNum,]);

    }

    /**
     * 浙文速递
     */
    public function actionReprint()
    {
        $this->layout = false;
        $this->getView()->title = "新闻动态-浙文速递";

        //浙文速递-banner
        $newsBanner = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','4'])
            ->andWhere(['=','fron_article.top','1'])
            ->orderBy(['id'=>SORT_DESC])
            ->one();

        //当前页码
        if(empty($_GET['cupg'])){
            $_GET['cupg'] = '1';//给加个分页的当前页码
            $offset = $_GET['cupg']-1;
        }else{
            $offset = ($_GET['cupg']-1) * 4;
        }
        //总数
        $newsCount = FronReprint::find()->all();
        $pageNum = ceil(count($newsCount)/4);//计算出总页数

        //浙文速递
        $reprint = FronReprint::find()
            ->orderBy(['id'=>SORT_DESC])
            ->offset($offset)
            ->limit(4)
            ->all();

        return $this->render('reprint',['reprint'=>$reprint, 'newsBanner'=>$newsBanner, 'pageNum'=>$pageNum,]);

    }

    //新闻详细
    public function actionDetail()
    {
        $this->layout = false;
        $this->getView()->title = "新闻动态 - 详细内容";
        if(isset($_GET['id'])){
        //进来浏览次数+1
        $model = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->where(['{{%fron_article}}.id'=>$_GET['id']])
            ->one();

            $model->clicked = $model['clicked']+1;
            //保存赋值的数据到数据库
            $model->save();

        }else{
            $this->redirect('news/index');
        }

        //推荐阅读
        $recommend = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->where(['{{%fron_article}}.rec'=>1])
            ->limit(2)
            ->all();

        return $this->render('detail',['model'=>$model, 'recommend'=>$recommend]);
    }

    //这个是新增的创业赛事
    public function actionVenture()
    {
        $this->layout = false;

        $this->getView()->title = "创业赛事";

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
            ->andWhere(['=','cid','54'])
            ->all();
        $pageNum=ceil(count($newsCount)/4);//计算出总页数

        //全部比赛
        $VentureAll = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->andWhere(['=','cid','54'])
            ->offset($offset)
            ->limit(5)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('competition_assort',['VentureAll'=>$VentureAll, 'pageNum'=>$pageNum,]);
    }

    //这个是新增的创业赛事内容
    public function actionVenture_info()
    {
        $this->layout = false;
        $this->getView()->title = "创业赛事 - 详细内容";
        if(isset($_GET['id'])){
            //进来浏览次数+1
            $model = FronArticle::find()
                ->joinWith('fronFiles')
                ->joinWith('fronCategorys')
                ->joinWith('fronCompetitionAssortTag')
                ->where(['{{%fron_article}}.id'=>$_GET['id']])
                ->one();
            $model->clicked = $model['clicked']+1;

            //保存赋值的数据到数据库
            $model->save();

            //历年成绩标题
            $modelTitel = FronCompetitionAssortTags::find()
                ->joinWith('fronCompetitionAssortResults')
                ->where(['{{%fron_competition_assort_tags}}.aid'=>$_GET['id']])
                ->asArray()
                ->all();
        }else{
            $this->redirect('news/venture');
        }

        //推荐阅读
        $recommend = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->where(['{{%fron_article}}.rec'=>1])
            ->limit(2)
            ->all();

        if(!empty($modelTitel)){
            return $this->render('competition_assort_detail',['model'=>$model, 'recommend'=>$recommend,'modelTitel'=>$modelTitel]);
        }else{
            return $this->render('competition_assort_detail',['model'=>$model, 'recommend'=>$recommend]);
        }

    }

    //创业大赛
    public function actionVenture_competition(){
        $this->layout = false;

        $this->getView()->title = "创业大赛-全部比赛";

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
            ->andWhere(['=','cid','9'])
            ->all();
        $pageNum=ceil(count($newsCount)/4);//计算出总页数

        //全部比赛
        $VentureAll = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->andWhere(['=','cid','9'])
            ->offset($offset)
            ->limit(3)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('venture_competition',['VentureAll'=>$VentureAll, 'pageNum'=>$pageNum,]);
    }

    //正在进行
    public function actionVenture_start(){
        $this->layout = false;

        $this->getView()->title = "创业大赛-正在进行";

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
            ->andWhere(['=','cid','9'])
            ->all();
        $pageNum = ceil(count($newsCount)/4);//计算出总页数

        //正在进行
        $VentureAll = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->joinWith('fronCompetitions')
            ->andWhere(['=','{{%fron_article}}.cid','9'])
            ->andWhere(['=','{{%fron_competition}}.status','0'])
            ->offset($offset)
            ->limit(3)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('venture_start',['VentureAll' => $VentureAll, 'pageNum' => $pageNum,]);
    }

    //已经结束
    public function actionVenture_end(){
        $this->layout = false;

        $this->getView()->title = "创业大赛-已经结束";

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
            ->andWhere(['=','cid','9'])
            ->all();
        $pageNum = ceil(count($newsCount)/4);//计算出总页数

        //已经结束
        $VentureAll = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCategorys')
            ->joinWith('fronCompetitions')
            ->andWhere(['=','{{%fron_article}}.cid','9'])
            ->andWhere(['=','{{%fron_competition}}.status','1'])
            ->offset($offset)
            ->limit(3)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('venture_end',['VentureAll'=>$VentureAll, 'pageNum' => $pageNum,]);
    }

    //最新文章-干货速递
    public function actionInfo(){
        $this->layout = false;
        $this->getView()->title = "创业干货-干货速递";

        //最新文章-banner
        $banner = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','13'])
            ->andWhere(['=','fron_article.rec','1'])
            ->orderBy(['id'=>SORT_DESC])
            ->one();

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
            ->andWhere(['=','cid','13'])
            ->all();
        $pageNum = ceil(count($newsCount)/4);//计算出总页数

        //最新文章-干货速递
        $model = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCompetitions')
            ->andWhere(['=','cid','13'])
            ->offset($offset)
            ->limit(4)
            ->orderBy(['id'=>SORT_DESC])
            ->all();
        return $this->render('info',['model'=>$model, 'banner'=>$banner, 'pageNum'=>$pageNum,]);
    }


    //最新文章-合作媒体
    public function actionMedia(){
        $this->layout = false;
        $this->getView()->title = "创业干货-合作媒体";

        //最新文章-banner
        $banner = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','28'])
            ->andWhere(['=','fron_article.top','1'])
            ->orderBy(['id'=>SORT_DESC])
            ->one();

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
            ->andWhere(['=','cid','28'])
            ->all();
        $pageNum = ceil(count($newsCount)/4);//计算出总页数

        //最新文章-合作媒体
        $model = FronArticle::find()
            ->joinWith('fronFiles')
            ->joinWith('fronCompetitions')
            ->andWhere(['=','cid','28'])
            ->offset($offset)
            ->limit(4)
            ->orderBy(['id'=>SORT_DESC])
            ->all();

        return $this->render('info_media',['model'=>$model, 'banner'=>$banner, 'pageNum'=>$pageNum,]);
    }

}
