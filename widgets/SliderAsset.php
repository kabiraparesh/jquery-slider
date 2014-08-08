<?php

namespace claudejanz\jquerySlider\widgets;

use yii\web\AssetBundle;

/**
 * Class SliderBasicAsset
 *
 * @author Claude Janz <claudejanz@gmail.com>
 *
 */
class SliderAsset extends AssetBundle {

    public $sourcePath = '@vendor/claudejanz/jquery-slider/js';
    public $js = [
        'jssor.slider.mini.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
