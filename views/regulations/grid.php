<?php

use app\helper\IpHelper;
use app\models\Post;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\web\View;

/**
 * @var $dataProvider ActiveDataProvider;
 * @var $this View
 */

$this->title = "GridView";
?>
<div class="row">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'text:ntext',
            [
                'attribute' => 'time',
                'label' => 'Время',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'label' => 'ip',
                'value' => function (Post $model) {
                    return IpHelper::hide($model->ip);
                }
            ],
            [
                'class' => \yii\grid\ActionColumn::class,
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>