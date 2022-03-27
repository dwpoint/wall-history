<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Post;
use yii\db\ActiveRecord;

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
        $last_post_guest = post::find()->asArray()->where(['ip' => $ip])->orderBy(['time' => SORT_DESC])->one();
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

        $posts = post::find()->orderBy(['time' => SORT_DESC])->all();

        return $this->render('index', compact('model', 'posts'));
    }

    public function actionRule()
    {
        $g = 'hello';
        return $this->render('rule', compact('g'));
    }


}

?>