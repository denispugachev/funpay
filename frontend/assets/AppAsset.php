<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    /** @inheritdoc */
    public $basePath = '@webroot';

    /** @inheritdoc */
    public $baseUrl = '@web';

    /** @inheritdoc */
    public $depends = [
        '\yii\web\JqueryAsset',
        '\yii\bootstrap\BootstrapAsset',
    ];
}
