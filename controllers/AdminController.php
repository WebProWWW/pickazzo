<?php


namespace controllers;

use yii\web\Controller;

/**
 * Class AdminController
 * @package controllers
 */
class AdminController extends Controller
{
    public $layout = 'admin';

    public function actionIndex()
    {
        return $this->render('index');
    }
}