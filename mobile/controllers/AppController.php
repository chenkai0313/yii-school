<?php
namespace mobile\controllers;

use mobile\models\FronComment;
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
use mobile\models\FronBanner;
use mobile\models\FronVideos;

/**
 * Site controller
 */
class AppController extends Controller
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
     * 首页
     */
    public function actionIndex()
    {
        $this->layout = false;

        $this->getView()->title = "浙江大学创新创业学院网";

        //banner
        $banner = FronBanner::find()
                ->joinWith('categorys')
                ->joinWith('fronFiles')
                ->andWhere(['=','fron_banner.tid','13'])
                ->orderBy(['sort'=>SORT_DESC])
                ->all();

        //公告
        $news = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','top','1'])
            ->limit(6)
            ->all();

        //创业导师
        $teacher = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','20'])
            ->one();

        //在线课程
        $course = FronVideos::find()
            ->joinWith('fronFiles')
            ->orderBy(['id'=>SORT_DESC])
            ->limit(6)
            ->all();


        $zcjk_changeTop = $this->actionSpace('16','top','1');//创业空间-众创空间(置顶)
        $ykj_changeTop = $this->actionSpace('17','top','1');//创业空间-元空间(置顶)
        $zjxz_changeTop = $this->actionSpace('18','top','1');//创业空间-紫金小镇(置顶)
        $lzkjy_changeTop = $this->actionSpace('30','top','1');//创业空间-良渚科技园(置顶)
        $hzzckj_changeTop = $this->actionSpace('31','top','1');//创业空间-杭州众创空间(置顶)
        $zcjk_change = $this->actionSpace('16','rec','1');//创业空间-众创空间(推荐)
        $ykj_change = $this->actionSpace('17','rec','1');//创业空间-元空间(推荐)
        $zjxz_change = $this->actionSpace('18','rec','1');//创业空间-紫金小镇(推荐)
        $lzkjy_change = $this->actionSpace('30','rec','1');//创业空间-良渚科技园(推荐)
        $hzzckj_change = $this->actionSpace('31','rec','1');//创业空间-杭州众创空间(推荐)

        //新闻动态
        $newsTrends = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','4'])
            ->andWhere(['=','top','1'])
            ->limit(4)
            ->all();
//        return $this->render(
//            'index',['banner'=>$banner,
//                'news'=>$news,
//                'teacher'=>$teacher,
//                'course'=>$course ,
//                'zcjk_changeTop'=>$zcjk_changeTop,
//                'ykj_changeTop'=>$ykj_changeTop,
//                'zjxz_changeTop'=>$zjxz_changeTop,
//                'lzkjy_changeTop'=>$lzkjy_changeTop,
//                'hzzckj_changeTop'=>$hzzckj_changeTop,
//                'zcjk_change'=>$zcjk_change,
//                'ykj_change'=>$ykj_change,
//                'zjxz_change'=>$zjxz_change,
//                'lzkjy_change'=>$lzkjy_change,
//                'hzzckj_change'=>$hzzckj_change,
//                'newsTrends'=>$newsTrends]
//        );


        //以上的代码都不用了
        //以下的代码是新的

        $newsIndex = FronArticle::find()->joinWith('fronFiles')->andWhere(['=','cid','4'])->orderBy(['id'=>SORT_DESC])->limit(3)->all();//新闻动态
        $noticeIndex = FronArticle::find()->joinWith('fronFiles')->andWhere(['=','cid','38'])->orderBy(['id'=>SORT_DESC])->limit(3)->all();//最新公告
        $partnerIndex = FronArticle::find()->joinWith('fronFiles')->andWhere(['=','cid','39'])->orderBy(['id'=>SORT_DESC])->limit(3)->all();//伙伴消息
        $matchIndex = FronArticle::find()->joinWith('fronFiles')->andWhere(['=','cid','9'])->orderBy(['id'=>SORT_DESC])->limit(3)->all();//创业大赛

        return $this->render(
            'index',['banner'=>$banner,
            'news'=>$news,
            'teacher'=>$teacher,
            'course'=>$course ,
            'zcjk_changeTop'=>$zcjk_changeTop,
            'ykj_changeTop'=>$ykj_changeTop,
            'zjxz_changeTop'=>$zjxz_changeTop,
            'lzkjy_changeTop'=>$lzkjy_changeTop,
            'hzzckj_changeTop'=>$hzzckj_changeTop,
            'zcjk_change'=>$zcjk_change,
            'ykj_change'=>$ykj_change,
            'zjxz_change'=>$zjxz_change,
            'lzkjy_change'=>$lzkjy_change,
            'hzzckj_change'=>$hzzckj_change,
            'newsTrends'=>$newsTrends,
            'newsIndex'=>$newsIndex,
            'noticeIndex'=>$noticeIndex,
            'partnerIndex'=>$partnerIndex,
            'matchIndex'=>$matchIndex]
        );
    }

    //创业空间
    public function actionSpace($cidVal,$type,$typeVal)
    {
        $change = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid',$cidVal])
            ->andWhere(['=',$type,$typeVal])
            ->asArray()
            ->orderBy(['id'=>SORT_DESC])
            ->all();
        return $change;
    }

    //创业课程
    public function actionLesson()
    {
        $this->layout = false;
        $this->getView()->title = "创业干货-创业课程";

        //创业干货-创业课程-BANNER
        $modelBanner = FronVideos::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','rec','1'])
            ->limit(3)
            ->all();

        //创业干货-创业课程-最新课程
        $data = FronVideos::find()
            ->joinWith('fronFiles');
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 4]);
        $model = $data->offset($pages->offset)->limit($pages->limit)->orderBy(['id'=>SORT_DESC])->all();

        //创业干货-创业课程-最多观看s
        $modelNew = FronVideos::find()
            ->joinWith('fronFiles')
            ->orderBy(['clicked'=>SORT_DESC])
            ->limit(4)
            ->all();
//        if(yii::$app->request->isAjax){
//            $size = 4;//每页数量
//            if(empty($_GET['pages'])){
//                $page = 1;
//            }else{
//                $page = intval($_GET['pages']);
//            }
//            $count = FronVideos::find()->count();//总数
//            $num=ceil($count/$size);//计算出总页数
//            //创业干货-创业课程-最多观看s
//            $modelNew = FronVideos::find()
////                ->joinWith('fronFiles')
//                ->orderBy(['clicked'=>SORT_DESC])
//                ->offset(($page * $size))
//                ->limit($size)
//                ->all();
//            $other = ['other'=>['count'=>$count,'size'=>$size,'pageNum'=>$num]];//每页显示数
//            $data = ['data' =>$modelNew];
//            return $data = Json::encode(array_merge($data,$other));
////            return $this->render('venture_lesson',['model'=>$model,'pages'=>$pages,'modelBanner'=>$modelBanner,'modelNew'=>$modelNew,'num'=>$num,'size'=>$size,'count'=>$count,]);
//        }else{
//
//        }
        return $this->render('venture_lesson',['model'=>$model,'pages'=>$pages,'modelBanner'=>$modelBanner,'modelNew'=>$modelNew]);
    }

    //创业课程-最多观看（点击下一页[新添加功能]）
    public function actionLesson_next()
    {
//        $data = FronVideos::find()
//            ->joinWith('fronFiles')
//            ->all();
//        print_r($data);
//        $modelNew = FronVideos::find()
//            ->joinWith('fronFiles')
//            ->orderBy(['clicked'=>SORT_DESC])
//            ->offset(2)
//            ->limit(2)
//            ->all();
//        print_r($modelNew);



        $size = 4;//每页数量
        if(empty($_GET['pages'])){
            $page = 1;
        }else{
            $page = $_GET['pages']-1;
        }
        //创业干货-创业课程-最多观看
        $pageSize = $page * $size;
        $modelAll = new FronVideos();
        $modelNew = $modelAll->find()->joinWith('fronFiles')->orderBy(['clicked'=>SORT_DESC])->offset($pageSize)->limit($size)->asArray()->all();
        $count = count($modelNew);//总数
        $num=ceil($count/$size);//计算出总页数
        $data = ['data' =>$modelNew];
        $other = ['other'=>['count'=>$count,'size'=>$size,'pageNum'=>$num]];//每页显示数
        return $data = Json::encode(array_merge($data,$other));
    }

    public function actionLesson2_next()
    {
//        $data = FronVideos::find()
//            ->joinWith('fronFiles')
//            ->all();
//        print_r($data);
//        $modelNew = FronVideos::find()
//            ->joinWith('fronFiles')
//            ->orderBy(['clicked'=>SORT_DESC])
//            ->offset(2)
//            ->limit(2)
//            ->all();
//        print_r($modelNew);



        $size = 4;//每页数量
        if(empty($_GET['pages'])){
            $page = 1;
        }else{
            $page = $_GET['pages']-1;
        }
        //创业干货-创业课程-最多观看
        $pageSize = $page * $size;
        $modelAll = new FronVideos();
        $modelNew = $modelAll->find()->joinWith('fronFiles')->orderBy(['id'=>SORT_DESC])->offset($pageSize)->limit($size)->asArray()->all();
        $count = count($modelNew);//总数
        $num=ceil($count/$size);//计算出总页数
        $data = ['data' =>$modelNew];
        $other = ['other'=>['count'=>$count,'size'=>$size,'pageNum'=>$num]];//每页显示数
        return $data = Json::encode(array_merge($data,$other));
    }

        //创业课程-查询
    public function actionLesson_select()
    {
        if(yii::$app->request->isAjax){
            $centent = $_GET['text'];
            $data = FronVideos::find()
                ->joinWith('fronFiles')
                ->asArray()
                ->andwhere([
                    'or',
                    ['like','title',$centent],
                ])
                ->all();
            $data = Json::encode($data);
            return $data;
        }
    }

    //课程详情
    public function actionLesson_detail()
    {
        $this->layout = false;
        $this->getView()->title = "创业课程-详细课程";
        $model = FronVideos::find()
                ->joinWith('fronFiles')
                ->where(['{{%fron_videos}}.id'=>$_GET['id']])
                ->one();

        $modelComment = FronComment::find()
            ->joinWith('fronVideos')
            ->where(['{{%fron_comment}}.review'=>'1'])
            ->where(['{{%fron_videos}}.id'=>$_GET['id']])
            ->asArray()
            ->all();
        return $this->render('Lesson_detail',['model'=>$model,'modelComment'=>$modelComment,]);
    }

    //添加评论
    public function actionLesson_detail_pl()
    {
        if(yii::$app->request->isAjax){
            $msg = new FronComment();
            $msg->cid = $_GET['id'];
            $msg->content = $_GET['text'];
            $msg->review = '0';
            $msg->created_at = time();
            $msg->save();
        }
    }

}
