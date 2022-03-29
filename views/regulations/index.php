<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;
?>


<div class="row">


    <div class="col-lg-6">

        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'list-wrapper',
                'id' => 'list-wrapper',
            ],
            'layout' => "{pager}\n{items}\n{summary}",
            'itemView' => 'post',
        ]);
        ?>

    </div>



    <div class="col-lg-4">

        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'name')->textInput(array('placeholder' => 'Имя')) ?>
        <?= $form->field($model, 'text')->textarea(array('rows' => 3, 'placeholder' => 'Ваши гениальные мысли, которые запомнит история')) ?>
        <?= $form->field($model, 'captcha')->widget(Captcha::classname(), ['name' => 'das']) ?>
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success', 'id' => 'btn']) ?>
        <?php $form = ActiveForm::end() ?>
    </div>
</div>

<?php
$js = <<<JS
    $('#btn').on('click', function (){
        $.ajax({
            url: 'index.php?r=regulations/pravilo',
            type: 'POST',
            success: function (res){
                console.log(res);
            },
            error: function (){
                alert('Error!');
            }
        });   
    });
JS;

$this->registerJs($js);
?>

