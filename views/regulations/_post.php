<?php
/**
 * @var $this View
 * @var $model Post
 */

use app\models\Post;
use yii\base\View;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;


?>

<div class="card">
    <div class="card-body">
        <h5 class='card-title'><?= Html::encode($model->name); ?></h5>
        <p class='card-text'>
            <?= HtmlPurifier::process($model->text, ['HTML.AllowedElements' => array('b', 'i', 's'),]); ?>
        </p>
        <p class='card-text'><small class='text-muted'>
                <?= Yii::$app->formatter->format($model->time, 'relativeTime'); ?> |
                <?= app\helper\IpHelper::hide($model->ip); ?>
            </small></p>
    </div>
</div>