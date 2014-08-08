<?php

namespace claudejanz\jquerySlider\widgets;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\base\Widget;

/**
 * Class SliderBasic
 *
 * @author Claude Janz <claudejanz@gmail.com> 
 */
class SliderWidget extends Widget {

    public $responsive = true;

    /**
     * @var array the HTML attributes for the input tag.
     */
    public $options;

    /**
     * @var array options for datepicker
     */
    public $pluginOptions = [];

   

    public function init() {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        // open tag
        echo Html::beginTag('div', $this->options) . '
                <!-- Slides Container -->';
    }

    public function run() {
        // close tag
        echo Html::endTag('div');
        
        // get id
        $id = $this->options['id'];

        // register Assets
        $view = $this->getView();
        SliderAsset::register($view);

        // plugin init
        $pluginOptions = empty($this->pluginOptions) ? '' : Json::encode($this->pluginOptions);
        $js = "var $id = new \$JssorSlider$('$id', $pluginOptions);";
        $view->registerJs($js . ";\n");
        
        // responsive init
        if ($this->responsive) {
            $js2 = "
            function " . $id . "ScaleSlider() {
                var parentWidth = $id.\$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    $id.\$SetScaleWidth(parentWidth-30);
                else
                    window.setTimeout(" . $id . "ScaleSlider, 30);
            }

            " . $id . "ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', " . $id . "ScaleSlider);
            }";
            $view->registerJs($js2 . ";\n");
        }
    }

}
