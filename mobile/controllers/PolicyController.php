<?php

namespace mobile\controllers;

use mobile\models\FronBanner;
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

/**
 * Site controller
 */
class PolicyController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
    public function actions() {
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

    //首页点击更多的公告
    public function actionTotal_notice() {
        $this->layout = false;
        $this->getView()->title = "全部公告";

        $data = FronArticle::find()
                ->joinWith('fronFiles')
                ->andWhere(['=', 'cid', '38']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 12]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        if (yii::$app->request->isAjax) {
            $centent = $_GET['text'];
            $data = FronArticle::find()
                    ->asArray()
                    ->andwhere([
                        'or',
                        ['like', 'content', $centent],
                    ])
                    ->all();
            return $this->render('total_notice', ['model' => $model, 'pages' => $pages, 'data' => $data,]);
        }
        return $this->render('total_notice', ['model' => $model, 'pages' => $pages]);
    }

    //政策公告
    public function actionNotice() {
        $this->layout = false;
        $this->getView()->title = "政策信息-政策公告";

        //政策公告
        $data = FronArticle::find()
                ->joinWith('fronFiles')
                ->andWhere(['=', 'cid', '10']);
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => 6]);

        $model = $data->offset($pages->offset)->limit($pages->limit)->all();

        if (yii::$app->request->isAjax) {
            $centent = $_GET['text'];
            $data = FronArticle::find()
                    ->asArray()
                    ->andwhere([
                        'or',
                        ['like', 'content', $centent],
                    ])
                    ->all();
            return $this->render('policy-notice', ['notice' => $model, 'pages' => $pages, 'data' => $data,]);
        }
        return $this->render('policy-notice', ['notice' => $model, 'pages' => $pages]);
    }

    //政策公告搜索
    public function actionNotice_select() {
        if (yii::$app->request->isAjax) {
            $centent = $_GET['text'];
            $data = FronArticle::find()
                    ->asArray()
                    ->andwhere([
                        'or',
                        ['like', 'title', $centent],
                    ])
                    ->all();
            $data = Json::encode($data);
            return $data;
        }
    }

    //公告详情
    public function actionDetail() {
        $this->layout = false;
//        $this->getView()->title = "政策公告 - 公告详情";
        $this->getView()->title = "公告详情";
        //公告详情
        $model = FronArticle::find()
                ->joinWith('fronFiles')
                ->joinWith('fronCategorys')
                ->where(['{{%fron_article}}.id' => $_GET['id']])
                ->one();

        return $this->render('notice_detail', ['model' => $model,]);
    }

    //元空间-详情信息
    public function actionSpace_detail() {
        $this->layout = false;

        return $this->render('/news/detail_2');
    }

    //相关文件
    public function actionFile() {
        $this->layout = false;
        $query = \backend\models\Fileupload::find();
        $pagination = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $query->count(),
        ]);
        $model = \backend\models\Fileupload::find()
                ->orderBy('create_at desc')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->asArray()
                ->all();
        foreach ($model as &$v1) {
            if ($v1['filename']) {
                $content = trim(strip_tags(htmlspecialchars_decode($v1['filename'])));

                $v1['filename'] = mb_strlen($content, 'utf-8') > 40 ? mb_substr($content, 0, 40, 'utf-8') . '...' : $content;
            }
        }





        return $this->render('file', ['model' => $model, 'pagination' => $pagination]);
    }

    //科研转化-最新发布
    public function actionTeacher() {
        $this->layout = false;
        $this->getView()->title = "政策信息-科研成果转化";

        //科研转化-banner
        $teacherBanner = FronBanner::find()
                ->joinWith('rgtCategorys')
                ->joinWith('fronFiles')
                ->andWhere(['=', '{{%fron_banner}}.tid', '41'])
                ->orderBy(['sort' => SORT_DESC])
                ->all();

        //当前页码
        if (empty($_GET['cupg'])) {
            $_GET['cupg'] = '1'; //给加个分页的当前页码
            $offset = $_GET['cupg'] - 1;
        } else {
            $offset = ($_GET['cupg'] - 1) * 4;
        }
        //总数
        $newsCount = FronArticle::find()
                ->andWhere(['=', 'cid', '11'])
                ->all();
        $pageNum = ceil(count($newsCount) / 4); //计算出总页数
        //科研转化-最新发布
        $teacher = FronArticle::find()
                ->joinWith('fronFiles')
                ->andWhere(['=', 'cid', '49'])
                ->offset($offset)
                ->limit(4)
                ->orderBy(['id' => SORT_DESC])
                ->all();

        return $this->render('teacher', ['teacher' => $teacher, 'teacherBanner' => $teacherBanner, 'pageNum' => $pageNum,]);
    }

    //科研转化-成功案例
    public function actionTeacher_ok() {
        $this->layout = false;
        $this->getView()->title = "政策信息-科研成果转化";

        //科研转化-banner
        $teacherBanner = FronBanner::find()
                ->joinWith('rgtCategorys')
                ->joinWith('fronFiles')
                ->asArray()
                ->andWhere(['=', '{{%fron_banner}}.tid', '41'])
                ->orderBy(['sort' => SORT_DESC])
                ->all();

        //当前页码
        if (empty($_GET['cupg'])) {
            $_GET['cupg'] = '1'; //给加个分页的当前页码
            $offset = $_GET['cupg'] - 1;
        } else {
            $offset = ($_GET['cupg'] - 1) * 4;
        }
        //总数
        $newsCount = FronArticle::find()
                ->andWhere(['=', 'cid', '11'])
                ->all();
        $pageNum = ceil(count($newsCount) / 4); //计算出总页数
        //科研转化-成功案例
        $teacher = FronArticle::find()
                ->joinWith('fronFiles')
                ->andWhere(['=', 'cid', '50'])
                ->offset($offset)
                ->limit(4)
                ->orderBy(['id' => SORT_DESC])
                ->all();
        return $this->render('teacher_ok', ['teacher' => $teacher, 'teacherBanner' => $teacherBanner, 'pageNum' => $pageNum,]);
    }

}
