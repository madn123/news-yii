<?php

namespace app\controllers;

use app\models\articles;
use app\models\deleteForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = articles::find()->with('sources')->where(['hidden' => 0]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $articles = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $count = articles::find()->where(['hidden' => 0])->count();
        $deleted = articles::find()->where(['hidden' => 1])->count();
        $accepted = articles::find()->where(['status' => 1])->count();
        $unchecked = articles::find()->where(['status' => 0])->count();
        $unchecked = $unchecked - $deleted;

        return $this->render('index', compact(['articles', 'item', 'pages', 'count', 'accepted', 'unchecked']));
    }

    public function actionArticle()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('articles');
            if ($post['status']){
                $query = articles::findOne($post['status']);
                $query->status = 1;
                $query->save();
                $this->redirect(Yii::$app->getHomeUrl());
            }
            else{
                $query = articles::findOne($post['hidden']);
                $query->hidden = 1;
                $query->save();
                $this->redirect(Yii::$app->getHomeUrl());
            }
        }

        $model = new articles();
        $id = Yii::$app->request->get('id');
        $article = articles::find()->asArray()->with('sources')->where(['id' => $id])->all();

        return $this->render('article', compact(['article', 'model']));
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionEdit()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('articles');
            $query = articles::findOne($post['id']);
            $query->title = $post['title'];
            $query->content = $post['content'];
            $query->save();
            $this->redirect(Yii::$app->getHomeUrl());
        }
        $model = new articles();
        $id = Yii::$app->request->get('id');
        $article = articles::find()->asArray()->with('sources')->where(['id' => $id])->all();
        return $this->render('edit', compact(['article', 'model']));
    }

}
