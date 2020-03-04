<?php

/* @var $this yii\web\View */
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Главная';
?>

<div class="row">
    <div class="table-header">
        <div class="col-sm">
            <h3>Список доступных новостей <span class="badge badge-primary"><?= $count; ?></span></h3>
        </div>
        <div class="col-sm">
            <div class="checked">
                <p>Проверено новостей: <span class="badge badge-success"><?= $accepted; ?></span></p>
                <p>Не проверено: <span class="badge badge-danger"><?= $unchecked; ?></span></p>
            </div>
        </div>
    </div>
</div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Название</th>
            <th scope="col">Дата парсинга</th>
            <th scope="col">Источник</th>
            <th scope="col">Проверено</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article['id']; ?></td>
                <td>
                    <a href="<?= Url::to(['site/article', 'id' => $article['id']])?>">
                        <?= $article['title']; ?>
                    </a>
                </td>
                <td><?= $article['parsing_date']; ?></td>
                <td><?= $article['sources']['name']; ?></td>
                <td class="td_center">
                    <?php if ($article['status'] == 0): ?>
                        <div class="alert alert-danger" role="alert">Нет</div>
                    <?php else: ?>
                        <div class="alert alert-success" role="alert">Да</div>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <?php
    echo LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
