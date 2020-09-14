<?php

namespace controllers;

use models\Contrib;
use models\Page;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class SiteController
 * @package site\controllers
 */
class SiteController extends Controller
{
    /**
     * @inheritDoc
     */
    public function actions()
    {
        return [
            'error' => [ 'class' => ErrorAction::class ],
        ];
    }

    /**
     * @param string $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($alias='index')
    {
        if ($page = Page::findByAlias($alias)) {
            ArrayHelper::setValue(Yii::$app->view->params, 'page', $page);
            return $this->render($page->view, ['page' => $page]);
        }
        throw new NotFoundHttpException();
    }

    public function actionContrib()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $contrib = new Contrib();
        if ($contrib->load(Yii::$app->request->post()) and $contrib->send()) {
            return [
                'success' => true,
            ];
        }
        return [
            'success' => false,
            'errors' => ActiveForm::validate($contrib),
        ];
    }

}