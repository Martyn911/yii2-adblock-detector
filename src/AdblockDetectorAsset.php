<?php
namespace martyn911\adblock\detector;

use yii\web\AssetBundle;
class AdblockDetectorAsset extends AssetBundle
{
    // https://fuckadblock.sitexw.fr/beta/
    public $sourcePath = '@vendor/martyn911/yii2-adblock-detector/src';
    public $js = [
        'assets/a-d-block-detector.js'
    ];
}