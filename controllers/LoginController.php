<?php

namespace app\controllers;

use app\models\system\form\LoginForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class LoginController extends Controller {

    public $layout = 'simple';

    /**
     * @return string
     */
    public function actionIndex(): string {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->goBack();
        }

        $this->view->title = Yii::t('system.content', 'Login');
        $this->view->params['layouts']['fields'] = [
            'email' => $this->renderFile('@app/views/layouts/fields/email.php'),
            'password' => $this->renderFile('@app/views/layouts/fields/password.php'),
            'rememberMe' => $this->renderFile('@app/views/layouts/fields/rememberMe.php'),
        ];
        return $this->render('index', ['model' => $model]);
    }

    /**
     * @return Response
     */
    public function actionOut(): Response {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
