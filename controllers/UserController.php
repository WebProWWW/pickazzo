<?php


namespace controllers;

use models\User;
use models\Login;
use models\Registr;

use Yii;
use yii\console\Request;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class UserController
 * @package site\controllers
 *
 * @property Request $validRequest
 */
class UserController extends Controller
{
    private $_valid_request;

    public function actionCreateOrder()
    {
        $req = $this->validRequest;
        Yii::$app->response->format = Response::FORMAT_JSON;
//        $login = new Login();
//        if ($login->load($req->post()) and $login->login()) {
//            return [
//                'success' => true,
//            ];
//        }
//        return [
//            'success' => false,
//            'errors' => ActiveForm::validate($login),
//        ];
        return [
            'success' => true,
            'user' => Yii::$app->user->identity,
        ];
    }

    /**
     * @return array
     */
    public function actionLogin()
    {
        $req = $this->validRequest;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $login = new Login();
        if ($login->load($req->post()) and $login->login()) {
            return [
                'success' => true,
            ];
        }
        return [
            'success' => false,
            'errors' => ActiveForm::validate($login),
        ];
    }

    /**
     * @return array
     */
    public function actionRegistr()
    {
        $req = $this->validRequest;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $registr = new Registr();
        if ($registr->load($req->post()) and $registr->create()) {
            return [
                'success' => true,
            ];
        }
        return [
            'success' => false,
            'errors' => ActiveForm::validate($registr),
        ];
    }

    /**
     * @param $token
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionVerifyEmail($token)
    {
        if (User::confirmEmail($token)) {
            Yii::$app->session->setFlash('is-email-confirm', true);
            return $this->goHome();
        }
        throw new NotFoundHttpException();
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * @return Request|yii\web\Request
     * @throws NotFoundHttpException
     */
    public function getValidRequest()
    {
        if ($this->_valid_request === null) {
            $this->_valid_request = Yii::$app->request;
        }
        if (YII_ENV_PROD and !$this->_valid_request->isAjax) {
            throw new NotFoundHttpException();
        }
        return $this->_valid_request;
    }
}