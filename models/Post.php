<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\captcha\CaptchaAction;

class Post extends ActiveRecord
{
    /*public $name;
    public $text;*/
    public $captcha;

    public function attributeLabels()
    {
        return [
            'name' => 'Автор',
            'text' => 'Сообщение',
            'captcha' => 'Код с картинки:',
        ];
    }

    public function rules()
    {
        return [
            [['name', 'text', 'captcha'], 'required'],
            ['name', 'string', 'length' => [2, 15]],
            ['text', 'string', 'length' => [30, 1000]],
            ['captcha', 'trim'],
            /*['name', 'MyRule'],*/
            ['captcha', 'captcha']
        ];
    }

    /*public function MyRule($attr){
        if (!in_array($this->$attr, ['hello'])){
            $this->addError($attr, 'Ошибка');
        }
    }*/
}

?>