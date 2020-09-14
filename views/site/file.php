<?php

/* @var $this yii\web\View */
/* @var $page models\Page */

echo $this->render('file/'.$page->file->file, ['page' => $page]);