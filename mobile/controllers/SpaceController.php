<?php
namespace mobile\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use mobile\models\FronArticle;
use mobile\models\FronDownloads;
use frontend\models\SpaceNotice;
/**
 * Site controller
 */
class SpaceController extends Controller
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

    /*
     * 团队风采详细页
     */
    public function actionSpace_info()
    {
        $this->layout = false;
        $this->getView()->title = "团队风采详细";
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

    /**
     * 众创空间
     */
    public function actionSpace_index()
    {
        $this->layout = false;
        $this->getView()->title = "众创空间-基本介绍";
        $model = FronArticle::find()->joinWith('fronCategorys')->andWhere(['=','{{%fron_article}}.id','147'])->asArray()->one();
        $modelImg = FronArticle::find()->joinWith('fronCategorys')->joinWith('fronFiles')->andWhere(['=','{{%fron_article}}.cid','16'])->asArray()->all();
        if(!empty($modelImg)){
            return $this->render('space_index',['model'=>$model,'modelImg'=>$modelImg]);
        }else{
            return $this->render('space_index',['model'=>$model,]);
        }
    }

    //众创空间-最新公告
    public function actionSpace_notice()
    {
        $this->layout = false;
        $this->getView()->title = "众创空间-最新公告";
        //创业空间-最新公告
        $data = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','47']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('space_notice',['model'=>$model,'pages'=>$pages ]);
    }

    //众创空间-文件下载
    public function actionSpace_down()
    {
        $this->layout = false;
        $this->getView()->title = "众创空间-文件下载";
        //创业空间-文件下载
        $data = FronDownloads::find()
            ->joinWith('category')
            ->andWhere(['=','cid','48']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('space_down',['model'=>$model,'pages'=>$pages ]);
    }

    /**
     * 创业元空间
     */
    public function actionIndex()
    {
        $this->layout = false;
        $this->getView()->title = "元空间-基本介绍";
        $model = FronArticle::find()->joinWith('fronCategorys')->andWhere(['=','{{%fron_article}}.id','148'])->asArray()->one();

         // ============================================
     
        //   //最新公告
         $Space = new SpaceNotice;
        $notice = $Space::find()
            ->where(['cid' => 43])
            ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
            ->limit(9)
            ->all();
            // var_dump($notice);
            // exit();
// ================================================
        $modelImg = FronArticle::find()->joinWith('fronCategorys')->joinWith('fronFiles')->andWhere(['=','{{%fron_article}}.cid','17'])->asArray()->all();
        if(!empty($modelImg)){
//            return $this->render('index',['model'=>$model,'modelImg'=>$modelImg]);
            return $this->render('space_index',['model'=>$model,'modelImg'=>$modelImg,'notice'=>$notice]);
        }else{
            return $this->render('space_index',['model'=>$model,]);
        }
    }

    //创业元空间-最新公告
    public function actionFirst_notice()
    {
        $this->layout = false;
        $this->getView()->title = "元空间-最新公告";
        //创业空间-最新公告
        $data = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','17']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('first_notice',['model'=>$model,'pages'=>$pages ]);
    }

    //创业元空间-文件下载
    public function actionFirst_down()
    {
        $this->layout = false;
        $this->getView()->title = "元空间-文件下载";
        //创业空间-文件下载
        $data = FronDownloads::find()
            ->joinWith('category')
            ->andWhere(['=','cid','32']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('first_down',['model'=>$model,'pages'=>$pages ]);
    }

    /**
     * 创业空间-良渚科技园
     */
    public function actionScience_index()
    {
        $this->layout = false;
        $this->getView()->title = "良渚科技园-基本介绍";
        $model = FronArticle::find()->joinWith('fronCategorys')->andWhere(['=','{{%fron_article}}.id','150'])->asArray()->one();
        $modelImg = FronArticle::find()->joinWith('fronCategorys')->joinWith('fronFiles')->andWhere(['=','{{%fron_article}}.cid','30'])->asArray()->all();


            $Space = new SpaceNotice;
        $notice = $Space::find()
            ->where(['cid' => 45])
            ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
            ->limit(9)
            ->all();
        if(!empty($modelImg)){
//            return $this->render('science_index',['model'=>$model,'modelImg'=>$modelImg]);
            return $this->render('space_index',['model'=>$model,'modelImg'=>$modelImg,'notice'=>$notice]);
        }else{
            return $this->render('space_index',['model'=>$model,]);
        }
    }

    //创业空间-良渚科技园-最新公告
    public function actionScience_notice()
    {
        $this->layout = false;
        $this->getView()->title = "良渚科技园-最新公告";
        //良渚科技园-最新公告
        $data = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','30']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('science_notice',['model'=>$model,'pages'=>$pages ]);
    }

    //创业空间-良渚科技园-文件下载
    public function actionScience_down()
    {
        $this->layout = false;
        $this->getView()->title = "良渚科技园-文件下载";
        //创业空间-文件下载
        $data = FronDownloads::find()
            ->joinWith('category')
            ->andWhere(['=','cid','33']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('science_down',['model'=>$model,'pages'=>$pages ]);
    }

    /**
     * 创业空间-杭州众创空间
     */
    public function actionMany_index()
    {
        $this->layout = false;
        $this->getView()->title = "杭州众创空间-基本介绍";
        $model = FronArticle::find()->joinWith('fronCategorys')->andWhere(['=','{{%fron_article}}.id','151'])->asArray()->one();

      $Space = new SpaceNotice;
        $notice = $Space::find()
            ->where(['cid' => 46])
            ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
            ->limit(9)
            ->all();

        $modelImg = FronArticle::find()->joinWith('fronCategorys')->joinWith('fronFiles')->andWhere(['=','{{%fron_article}}.cid','31'])->asArray()->all();
        if(!empty($modelImg)){
//            return $this->render('many_index',['model'=>$model,'modelImg'=>$modelImg]);
            return $this->render('space_index',['model'=>$model,'modelImg'=>$modelImg,'notice'=>$notice]);
        }else{
            return $this->render('space_index',['model'=>$model,]);
        }
    }

    //创业空间-杭州众创空间-最新公告
    public function actionMany_notice()
    {
        $this->layout = false;
        $this->getView()->title = "杭州众创空间-最新公告";
        //杭州众创空间-最新公告
        $data = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','31']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('many_notice',['model'=>$model,'pages'=>$pages ]);
    }

    //创业空间-良渚科技园-文件下载
    public function actionMany_down()
    {
        $this->layout = false;
        $this->getView()->title = "杭州众创空间-文件下载";
        //杭州众创空间-文件下载
        $data = FronDownloads::find()
            ->joinWith('category')
            ->andWhere(['=','cid','33']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('many_down',['model'=>$model,'pages'=>$pages ]);
    }

    /**
     * 创业空间-紫金创业小镇
     */
    public function actionTown_index()
    {
        $this->layout = false;
        $this->getView()->title = "紫金创业小镇-基本介绍";
        $model = FronArticle::find()->joinWith('fronCategorys')->andWhere(['=','{{%fron_article}}.id','149'])->asArray()->one();
        $modelImg = FronArticle::find()->joinWith('fronCategorys')->joinWith('fronFiles')->andWhere(['=','{{%fron_article}}.cid','18'])->asArray()->all();
          $Space = new SpaceNotice;
        $notice = $Space::find()
            ->where(['cid' => 44])
            ->orderBy(['top' => SORT_DESC, 'rec' => SORT_DESC, 'updated_at' => SORT_DESC])
            ->limit(9)
            ->all();
        if(!empty($modelImg)){
//            return $this->render('town_index',['model'=>$model,'modelImg'=>$modelImg]);
            return $this->render('space_index',['model'=>$model,'modelImg'=>$modelImg,'notice'=>$notice]);
        }else{
            return $this->render('space_index',['model'=>$model,]);
        }
    }

    //创业空间-紫金创业小镇-最新公告
    public function actionTown_notice()
    {
        $this->layout = false;
        $this->getView()->title = "紫金创业小镇-最新公告";
        //杭州众创空间-最新公告
        $data = FronArticle::find()
            ->joinWith('fronFiles')
            ->andWhere(['=','cid','18']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);
        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('town_notice',['model'=>$model,'pages'=>$pages ]);
    }

    //创业空间-良渚科技园-文件下载
    public function actionTown_down()
    {
        $this->layout = false;
        $this->getView()->title = "紫金创业小镇-文件下载";
        //杭州众创空间-文件下载
        $data = FronDownloads::find()
            ->joinWith('category')
            ->andWhere(['=','cid','34']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);
        $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('town_down',['model'=>$model,'pages'=>$pages ]);
    }

}
