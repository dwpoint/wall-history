<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;
use yii\data\ActiveDataProvider;


class RegulationsController extends Controller
{

    public static function tableName()
    {
        return 'post';
    }

    public function actionIndex()
    {
        if (Yii::$app->request->isAjax) {
            var_dump(Yii::$app->request->post());
            return 'Пост опубликован';
        }
        $model = new Post();
        $ip = Yii::$app->request->userIP;
        $last_post_guest = Post::find()->asArray()->where(['ip' => $ip])->orderBy(['time' => SORT_DESC])->one();
        $last_time_post = (int)$last_post_guest['time'];
        if ($model->load(Yii::$app->request->post())) {
            $model->ip = $ip;
            $model->time = time();
            if ($model->time - $last_time_post >= 60) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Данные приняты');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Оставлять сообщение можно только 1 раз в минуту');
            }
        };


        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy(['time' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);


        return $this->render('index', compact('model', 'dataProvider'));
    }

    public function actionRule()
    {
        return $this->render('rule');
    }
    public function actionGrid()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy(['time' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('grid', compact('dataProvider'));
    }
    public function actionView()
    {
        $request = Yii::$app->request;
        $id = $request->get('id', 1);
        $model = Post::find()->where(['id' => $id])->one(); // запрос на выборку записи
        return $this->render('view', [
            'model' => $model // возвращаем данные в представление
        ]);
    }


}

