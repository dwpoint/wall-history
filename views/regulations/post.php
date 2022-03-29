<?php
/**
 * @var $this View
 * @var $model Post
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$ip = $model->ip;
if (str_contains($ip, '.') === true) {
    $array_ip = explode('.', $ip);
    $ip = $array_ip[0] . '.' . $array_ip[1] . '.' . str_repeat('*', strlen($array_ip[2])) . '.' . str_repeat('*', strlen($array_ip[3]));
} elseif (str_contains($ip, ':') === true) {
    $array_ip = explode(':', $ip);
    $ip = $array_ip[0] . ':' . $array_ip[1] . ':' . $array_ip[2] . ':' . $array_ip[3] . ':****:****:****:****';
}

?>

<div class="card">
    <div class="card-body">
        <h5 class='card-title'><?= Html::encode($model->name); ?></h5>
        <p class='card-text'><?= HtmlPurifier::process($model->text, [
                'HTML.AllowedElements' => array('b', 'i', 's'),
            ]); ?></p>
        <p class='card-text'><small
                    class='text-muted'><?= Yii::$app->formatter->format($model->time, 'relativeTime');; ?> | <?=
                Html::encode($ip);


                ?></small></p>
    </div>
</div>