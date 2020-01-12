<?php
/**
 * Created by PhpStorm.
 * User: Kholmanov
 * Date: 12.01.2020
 * Time: 10:55
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class UserController extends Controller
{
    public function actionInit()
    {
        // созданем пользователя Admin
        $user = User::find()->where(['username' => 'admin'])->one();
        if (empty($user)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@task-tracker.local';
            $user->status = 10;
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'User with name "Admin" created.';

                $adminRole = Yii::$app->authManager->getRole('admin');
                Yii::$app->authManager->assign($adminRole, $user->id);
            } else {
                echo 'User with name "Admin" don\'t created.';
            }
        } else {
            echo 'User with name "Admin" already exist.';
        }
    }

    public function actionCreate($name, $role = 'user')
    {
        // созданем пользователя Admin
        $user = User::find()->where(['username' => $name])->one();
        if (empty($user)) {
            $user = new User();
            $user->username = $name;
            $user->email = "{$name}@task-tracker.local";
            $user->status = 10;
            $user->setPassword($name);
            $user->generateAuthKey();
            if ($user->save()) {
                echo "User with name \"{$name}\" created.";

                $role = Yii::$app->authManager->getRole($role);
                Yii::$app->authManager->assign($role, $user->id);
            } else {
                echo "User with name \"{$name}\" don't created.";
            }
        } else {
            echo "User with name \"{$name}\" already exist.";
        }
    }
}