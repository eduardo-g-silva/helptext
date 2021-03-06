<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Cases $model
 */
$copyParams = $model->attributes;

$this->title = Yii::t('app', 'Cases');
?>

<div class="container contact-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- menu buttons -->
                <div class="pull-right">
                    <?= Html::a('<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('app', 'Copy'), ['create', 'id' => $model->id, 'Contact' => $copyParams], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'New'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
                <h3>
                    <?= Yii::t('app', 'Case number: ' . $model->id) ?>
                </h3>
            </div>
            <div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'contact.first_name',
                        'category.case_category',
                        'severity.severity',
                        'start_date',
                        'close_date',
                        [
                            'attribute'=>'state', 
                            'label'=>'State',
                            'format'=>'raw',
                            'value'=>$model->state ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Close</span>',
                        ],                        
                        'outcome.outcome',                        
                        'comments',
                    ],
                ]);
                ?>
                <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'Back to all Cases'), ['index'], ['class' => 'btn btn-success']) ?>
                <div class="pull-right">
                    <?=
                    Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data-confirm' => '' . Yii::t('app', 'Are you sure to delete this case with all the messages?') . '',
                        'data-method' => 'post',
                    ]);
                    ?>
                    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Edit'), [ 'update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                </div>            
            </div>
        </div>
    </div>
</div>

