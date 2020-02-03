<?php
/**
 * Created by PhpStorm.
 * User: Kholmanov Andrey
 * Date: 02.02.2020
 * Time: 14:53
 */

namespace frontend\modules\api\controllers;


use common\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;
}