<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'parent project',
                'value' => function ($model) {
                    if ($model->parent_id) {
                        return Html::a($model->parent->name, ['project/view', 'id' => $model->parent_id]);
                    }

                    return 'Родительского проекта нет';
                },
                'format' => 'raw'
            ],
            'creator_id',
            'name',
            'content:ntext',
            'priority_id',
            'status',
            'started_at',
            'finished_at',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h2>Задачи</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'creator_id',
            'executor_id',
            'name',
            'content:ntext',
            //'status',
            //'started_at',
            //'finished_at',
            //'created_at',
            //'updated_at',
            //'priority_id',
            //'is_template',
            //'project_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{task/view} {task/update} {task/delete}',
                'buttons' => [
                    'task/view' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $url);
                    },
                    'task/update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            $url);
                    },
                    'task/delete' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            $url);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
<?= \frontend\widgets\chat\Chat::widget(['project_id' => $model->id]) ?>
