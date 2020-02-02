<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'creator_id')->textInput() ?>

    <?= $form->field($model, 'executor_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'project_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \common\models\Project::find()
                ->asArray()
                ->all(),
            'id',
            'name'
        ),
        ['prompt' => '- Сделай выбор -']
    ) ?>

    <?= $form->field($model, 'priority_id')
        ->dropDownList(
            \yii\helpers\ArrayHelper::map(
                \common\models\Priority::find()
                    ->where(['type' => \common\models\Priority::TYPE_TASK])
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

    <?= $form->field($model, 'is_template')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
