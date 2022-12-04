<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\BootstrapAsset;

$this->registerCssFile("@web/css/error.css", ['depends' => [BootstrapAsset::class]]);

$this->title = $name;
?>

<section class="container all-error-page-wrap">
    <img src="https://i.imgur.com/qIufhof.png" />

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= nl2br(Html::encode($message)) ?></p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
</section>
