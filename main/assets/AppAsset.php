<?php

namespace main\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
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
