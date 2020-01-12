<?php
/**
 * Created by PhpStorm.
 * User: Kholmanov
 * Date: 12.01.2020
 * Time: 12:56
 */
?>

<div class="user-form">

    <h1>Присвоить роль пользователю <?= $model->username ?></h1>

    <form action="/user/role?id=<?= $model->id ?>" method="post">
        <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
        <input type="hidden" name="id" value="<?= $model->id ?>">
        <select name="role" id="role">
            <option value="0">Выбрать роль</option>
            <?php foreach ($roles as $role) : ?>
                <option value="<?= $role->name ?>"><?= $role->name ?></option>
            <?php endforeach ?>
        </select>
        <button type="submit">Применить</button>
    </form>

</div>
