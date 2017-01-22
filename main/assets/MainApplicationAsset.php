<?php

namespace main\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class MainApplicationAsset extends AssetBundle
{
    /** @inheritdoc */
    public $basePath = '@webroot';

    /** @inheritdoc */
    public $baseUrl = '@web';

    /** @vinheritdoc */
    public $js = ['js/main.js'];

    /** @inheritdoc */
    public $depends = [
        BootstrapPluginAsset::class
    ];
}
