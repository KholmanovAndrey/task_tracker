<?php
/**
 * Created by PhpStorm.
 * User: Kholmanov Andrey
 * Date: 26.01.2020
 * Time: 11:33
 */

namespace frontend\widgets\chat;


use yii\web\AssetBundle;
use yii\web\YiiAsset;

class ChatAsset extends AssetBundle
{
    public $sourcePath = (__DIR__ . '/assets');
    public $js = ['js/chat.js'];
    public $css = ['css/chat.css'];

    public $depends = [
        YiiAsset::class
    ];
}