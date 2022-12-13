<?php

namespace backend\modules\v1;

/**
 * Module module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\v1\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;

        // custom initialization code goes here
    }
}
