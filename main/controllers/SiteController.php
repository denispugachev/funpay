<?php

namespace main\controllers;

use yii\web\Controller;
use yii\web\ErrorAction;

/**
 * Site controller.
 */
class SiteController extends Controller
{
    /** @inheritdoc */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className(),
            ],
        ];
    }

    /**
     * Displays index page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        die('123');
        return $this->render('index');
    }
}
