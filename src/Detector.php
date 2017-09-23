<?php
namespace martyn911\adblock\detector;

use martyn911\adblock\detector\FuckAdblockAsset;
use martyn911\adblock\detector\AdblockDetectorAsset;

Class Detector extends \yii\base\Widget {

    // Displays the debug in the console
    public $debug = false;

    // At launch, check if AdBlock is enabled
    // Uses the method fuckAdBlock.check()
    public $checkOnLoad = false;

    // At the end of the check, is that it removes all events added ?
    public $resetOnEnd = false;

    // The number of milliseconds between each check
    public $loopCheckTime = 50;

    // The number of negative checks after which there is considered that AdBlock is not enabled
    // Time (ms) = 50*(5-1) = 200ms (per default)
    public $loopMaxNumber = 5;

    // CSS class used by the bait caught AdBlock
    public $baitClass = 'pub_300x250 pub_300x250m pub_728x90 text-ad textAd text_ad text_ads text-ads text-ad-links';

    // CSS style used to hide the bait of the users
    public $baitStyle = 'width: 1px !important; height: 1px !important; position: absolute !important; left: -10000px !important; top: -1000px !important;';

    // Function called if AdBlock is detected
    public $callback_detected = 'adBlockDetected';

    // Function called if AdBlock is not detected
    public $callback_not_detected = 'adBlockNotDetected';

    public function init(){
        $this->debug = $this->debug ? 'true' : 'false';
        $this->checkOnLoad = $this->checkOnLoad ? 'true' : 'false';
        $this->resetOnEnd = $this->resetOnEnd ? 'true' : 'false';
    }

    public function run()
    {
        $js = 'if(typeof fuckAdBlock === "undefined") {
                    ' . $this->callback_detected . '();
            } else {
                    fuckAdBlock.setOption({
                    debug: ' . $this->debug . ',
                    checkOnLoad: ' . $this->checkOnLoad . ',
                    resetOnEnd: ' . $this->resetOnEnd . ',
                    loopCheckTime: ' . $this->loopCheckTime . ',
                    loopMaxNumber: ' . $this->loopMaxNumber . ',
                    baitClass: "' . $this->baitClass . '",
                    baitStyle: "' . $this->baitStyle . '",
                });';
        if($this->callback_detected){
            $js .= "\n" . 'fuckAdBlock.onDetected("' . $this->callback_detected . '");';
        }

        if($this->callback_not_detected){
            $js .= "\n" . 'fuckAdBlock.onNotDetected("' . $this->callback_not_detected . '");';
        }

        $js .= "\n" . 'fuckAdBlock.check();';
        $js .= "\n" . '}';


        $view = $this->getView();
        /**
         * Register this assets with a View
         */
        FuckAdblockAsset::register($view);
        AdblockDetectorAsset::register($view);
        $view->registerJs($js);
    }

}