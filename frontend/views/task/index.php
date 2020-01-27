<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Project', ['project/create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'creator_id',
            [
                'attribute' => 'creator',
                'value' => function ($model) {
                    return $model->creator->username;
                },
                'format' => 'raw'
            ],
            'executor_id',
            [
                'attribute' => 'executor',
                'value' => function ($model) {
                    return $model->executor->username;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['task/view', 'id' => $model->id]);
                },
                'format' => 'raw'
            ],
            'content:ntext',
            //'status',
            //'started_at',
            //'finished_at',
            //'created_at',
            //'updated_at',
            //'priority_id',
            //'is_template',
            [
                'attribute' => 'project',
                'value' => function ($model) {
                    if ($model->project->name) {
                        return Html::a($model->project->name, ['project/view', 'id' => $model->project_id]);
                    }

                    return 'Проекта нет';
                },
                'format' => 'raw'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
