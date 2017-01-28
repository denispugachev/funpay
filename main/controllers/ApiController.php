<?php

namespace main\controllers;

use common\models\SmsMessage;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

/**
 * API controller.
 */
class ApiController extends Controller
{
    /** @inheritdoc */
    public $enableCsrfValidation = false;

    /** @inheritdoc */
    public function init()
    {
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
    }

    /**
     * Performs parse action for sms message text.
     *
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionParse()
    {
        $smsMessage = new SmsMessage(Yii::$app->getRequest()->post());
        if ($smsMessage->validate()) {
            return $smsMessage->getAttributes();
        } else {
            throw new BadRequestHttpException('Request error', 1);
        }
    }
}
