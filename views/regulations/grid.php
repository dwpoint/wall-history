<?php
use yii\grid\GridView;
?>
<div class="row">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'text'
            ],
            [
                'attribute' => 'text',
                'format' => 'text'
            ],
            [
                'attribute' => 'time',
                'label' => 'Время',
                'format' => ['date', 'php:Y-m-d']
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>