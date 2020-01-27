<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'attribute' => 'creator',
                'value' => function ($model) {
                    return $model->creator->username;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['project/view', 'id' => $model->id]);
                },
                'format' => 'raw'
            ],
            'content:ntext',
            'priority_id',
            //'status',
            //'started_at',
            //'finished_at',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
