<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\helpers\HtmlPurifier;
?>



<div class="row">

    <div class="col-lg-6">



                <?php foreach ($posts as $item) {
                    $relate = Yii::$app->formatter->format($item->time, 'relativeTime'); // Время

                    $ip = $item->ip;
                    if (str_contains($ip, '.') === true ){
                        $array_ip = explode('.', $ip);
                        $ip = $array_ip[0] . '.' . $array_ip[1] . '.' . str_repeat('*', strlen ($array_ip[2])) . '.' . str_repeat('*', strlen ($array_ip[3]));
                    }elseif (str_contains($ip, ':') === true){
                        $array_ip = explode(':', $ip);
                        $ip = $array_ip[0] . ':' . $array_ip[1] . ':' . $array_ip[2] . ':' . $array_ip[3] . ':****:****:****:****';
                    } // Маска IP
                    $name = Html::encode($item->name);// Защита от XSS
                    $text = HtmlPurifier::process($item->text, [
                        'HTML.AllowedElements' => array('b', 'i', 's'),
                    ]);



                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo "<h5 class='card-title'>$name</h5>";
                    echo "<p class='card-text'>$text</p>";
                    echo "<p class='card-text'><small class='text-muted'>" . "$relate | $ip</small></p>";
                    echo '</div>';
                    echo '</div>';
                }?>


    </div>


    <div class="col-lg-4">

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'name')->textInput(array('placeholder' => 'Имя'))?>
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

