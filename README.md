# yii2-adblock-detector

Yii2 AdBlock Detector

Расширение для определения включен ли AdBlock у посетителя.

## Install
composer require --prefer-dist martyn911/yii2-adblock-detector

## Example usage :
```php
use martyn911\adblock\detector\Detector;
```
```php
echo Detector::widget();
```

### Options:
```php
echo Detector::widget([
    'timeout' => 200, //Число миллисекунд, в конце которых считается, что AdBlock не включен
    'callback_detected' => 'adBlockDetected', //js функция, которая выполняется если adblock включен
    'callback_not_detected' => 'adBlockNotDetected', //js функция, которая выполняется если adblock не включен. Можно отключить - false
]);
```