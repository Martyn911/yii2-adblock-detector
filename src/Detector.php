<?php
namespace martyn911\adblock\detector;

use yii\web\View;
use martyn911\adblock\detector\AdblockDetectorAsset;

Class Detector extends \yii\base\Widget {

    // The number of milliseconds at the end of which it is considered that AdBlock is not enabled
    public $timeout = 200;

    // Function called if AdBlock is detected
    public $callback_detected = 'adBlockDetected';

    // Function called if AdBlock is not detected
    public $callback_not_detected = 'adBlockNotDetected';

    public function run()
    {
        $js = 'if(typeof FuckAdBlock === "undefined") {
                    ' . $this->callback_detected . '();
            } else {
                fuckAdBlock.options.set({
                    timeout: ' . $this->timeout . ',
                });';
        if($this->callback_detected){
            $js .= "\n" . 'fuckAdBlock.on(true, ' . $this->callback_detected . ');';
        }

        if($this->callback_not_detected){
            $js .= "\n" . 'fuckAdBlock.on(false, ' . $this->callback_not_detected . ');';
        }

        $js .= "\n" . '}';


        $view = $this->getView();
        /**
         * Register this assets with a View
         */
        AdblockDetectorAsset::register($view);
        $view->registerJs($js);
    }

}