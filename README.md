Yii2 AdBlock Detector

use martyn911\adblock\detector\Detector;

    <?php Detector::widget([
        'debug' => true,
        'callback_not_detected' => false
    ]) ?>