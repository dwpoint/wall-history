<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Post;
use app\models\BdModel;

class RegulationsController extends SiteController
{


    public function actionPravilo() {
        if (Yii::$app->request->isAjax){
          var_dump(Yii::$app->request->post());
          return 'данные получены';
        }
        $model = new Post();
        $ip = Yii::$app->request->userIP;
        $last_post_guest = BdModel::find()->asArray()->where(['ip' => $ip])->orderBy(['time' => SORT_DESC])->one();
        $last_time_post = (int)$last_post_guest['time'];
            if ($model->load(Yii::$app->request->post())) {
                $model->ip = $ip;
                $model->time = time();
                if ($model->time-$last_time_post >= 60) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Данные приняты');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка');
                }
                }else{
                    Yii::$app->session->setFlash('error', 'Оставлять сообщение можно только 1 раз в минуту');
                }
            };

        $posts = BdModel::find()->orderBy(['time' => SORT_DESC])->all();

        return $this->render('pravilo', compact('model', 'posts'));
    }

    public function actionRule() {
        $g = 'hello';
        return $this->render('rule', compact('g'));
    }


}
?>