<?php
use yii\db\ActiveRecord;
use yii\widgets\DetailView;
?>
<div class="row">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [ // атрибуты модели
            'id', // идентификатор
            [
                'label' => 'name',
                'value' => $model->name,
            ],
            [
                'label' => 'text',
                'value' => $model->text,
            ],
            [
                'label' => 'ip',
                'value' => $model->ip,
            ],
        ],
    ]); ?>
</div>


