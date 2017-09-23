<?php
namespace martyn911\adblock\detector;

use yii\web\AssetBundle;
class FuckAdblockAsset extends AssetBundle
{
    public $sourcePath = '@bower/fuckadblock';
    public $js = [
        'fuckadblock.js'
    ];
}