<?php

use app\helper\IpHelper;
use app\models\Post;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var $model Post
 * @var $this View
 */
$this->title = "View";
?>
<div class="row">

    <?php
        $ipHelper = new IpHelper();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'text',
            [
                'label' => 'ip',
                'value' => IpHelper::hide($model->ip),
            ],
        ],
    ]); ?>
</div>


