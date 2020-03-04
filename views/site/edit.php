<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>


<?php $form = ActiveForm::begin(); ?>
    <?= Html::submitButton('Принять изменения', ['class' => 'btn btn-outline-success']) ?>
    <?= $form->field($model, 'id')->hiddenInput(['value' => $article[0]['id']])->label(false); ?>
    <?= $form->field($model, 'title')->textarea(['value' => $article[0]['title'], 'rows' => '2'])->label('Заголовок:'); ?>
    <?= $form->field($model, 'content')->textarea(['value' => $article[0]['content'], 'rows' => '20'])->label('Текст статьи:'); ?>

    <a class="btn btn-primary btn-primary btn-block" href="<?= Url::to(['site/article', 'id' => $article['0']['id']])?>" role="button">Назад</a>
<?php ActiveForm::end() ?>
