<?php
/**
 * Created by PhpStorm.
 * User: Kholmanov
 * Date: 15.01.2020
 * Time: 19:40
 */

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\web\Controller;

class ChatController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}