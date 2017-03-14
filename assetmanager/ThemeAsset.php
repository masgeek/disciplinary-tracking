<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/3/2017
 * Time: 3:19 PM
 */

namespace app\assetmanager;


use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap/bootstrap-theme.min.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];
}