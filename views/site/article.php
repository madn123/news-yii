<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $article[0]['title'];
?>

<div class="art_title">
    <h1><?= $article[0]['title']; ?></h1>
</div>

<a class="btn btn-outline-info" href="<?= Url::to(['site/edit', 'id' => $article['0']['id']])?>" role="button">Редактировать новость</a>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'status')->hiddenInput(['value' => $article[0]['id']])->label(false); ?>
    <?= Html::submitButton('Принять новость', ['class' => 'btn btn-outline-success']) ?>
<?php ActiveForm::end() ?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'hidden')->hiddenInput(['value' => $article[0]['id']])->label(false); ?>
    <?= Html::submitButton('Удалить новость', ['class' => 'btn btn-outline-danger']) ?>
<?php ActiveForm::end() ?>

<hr>

<div class="art_text">
    <p><?= $article[0]['content']; ?></p>
    <i>Источник: <span class="badge badge-warning"><?= $article[0]['sources']['name']; ?></span></i>
</div>
<hr>
<a class="btn btn-primary btn-primary btn-block" href="<?= Url::to(['site/'])?>" role="button">Назад</a>
<hr>