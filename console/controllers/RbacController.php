<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 27/07/2020 03:51
 */

namespace console\controllers;

use components\Access;
use components\AuthManager;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Class RbacController
 * @package app\console\controllers
 */
class RbacController extends Controller
{
    /**
     * @return string
     */
    public function actionInit()
    {
        $auth = new AuthManager();
        $auth->removeAll();
        try {
            foreach (Access::roles() as $role => $desc) {
                $user = $auth->createRole($role);
                $user->description = $desc;
                $auth->add($user);
            }
        } catch (\Exception $exception) {
            return ExitCode::UNSPECIFIED_ERROR;
        }
        return ExitCode::OK;
    }
}