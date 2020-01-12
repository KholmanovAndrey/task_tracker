<?php
/**
 * Created by PhpStorm.
 * User: Kholmanov
 * Date: 12.01.2020
 * Time: 10:35
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли
        $admin = $auth->createRole('admin');
        $user = $auth->createRole('user');

        // запишем их в БД
        $auth->add($admin);
        $auth->add($user);

        // Создаем разрешения
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $createTask = $auth->createPermission('createTask');
        $createTask->description = 'Создание задачи';

        $updateTask = $auth->createPermission('updateTask');
        $updateTask->description = 'Редактирование задачи';

        $deleteTask = $auth->createPermission('deleteTask');
        $deleteTask->description = 'Удаление задачи';

        // Запишем эти разрешения в БД
        $auth->add($viewAdminPage);
        $auth->add($createTask);
        $auth->add($updateTask);
        $auth->add($deleteTask);

        // Теперь добавим наследования. Для роли user мы добавим разрешение createTask, updateTask, deleteTask
        // а для админа добавим наследование от роли user и еще добавим собственное разрешение viewAdminPage

        // Роли User присваиваем разрешение:
        $auth->addChild($user, $createTask);
        $auth->addChild($user, $updateTask);
        $auth->addChild($user, $deleteTask);

        // админ наследует роль User. Он же админ, должен уметь всё!
        $auth->addChild($admin, $user);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $viewAdminPage);
    }
}