<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $isSubscribed */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">

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
        <?php if (!$isSubscribed) { ?>
            <?= Html::a('Subscribe', ['subscribe', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } else { ?>
            <?= Html::a('Unsubscribe', ['unsubscribe', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'creator_id',
            'executor_id',
            'name',
            'content:ntext',
            'status',
            'started_at',
            'finished_at',
            'created_at',
            'updated_at',
            'priority_id',
            'is_template',
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
        ],
    ]) ?>

</div>
<?= \frontend\widgets\chat\Chat::widget(['task_id' => $model->id]) ?>