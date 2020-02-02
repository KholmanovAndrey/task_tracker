<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \common\models\Project::find()->asArray()->all(),
            'id',
            'name'
        ),
        ['prompt' => '- Выбери родительский проект -']
    ) ?>

    <?= $form->field($model, 'creator_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'priority_id')
        ->dropDownList(
            \yii\helpers\ArrayHelper::map(
                    \common\models\Priority::find()
                        ->where(['type' => \common\models\Priority::TYPE_PROJECT])
                        ->asArray()
                        ->all(),
                    'id',
                    'name'
            ),
            ['prompt' => '- Сделай выбор -']
        ) ?>

    <?= $form->field($model, 'status')->dropDownList(
            \common\models\Project::getStatusName()
    ) ?>

    <?= $form->field($model, 'started_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'finished_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
