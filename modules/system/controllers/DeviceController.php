<?php

namespace app\modules\system\controllers;

use app\components\Url;
use app\models\system\Device;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ContactController implements the CRUD actions for Contact model.
 */
class DeviceController extends Controller {
    /**
     * @inheritDoc
     */
    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'actions' => $this->actions(),
                    'roles' => ['@'],
                ],
            ],
        ];

        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'delete' => ['POST'],
            ],
        ];

        return $behaviors;
    }

    /**
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id): Response {
        $this->findModel($id)->delete();

        return $this->redirect(Url::to(['/system/profile/index']));
    }

    /**
     * @param int $id ID
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Device {
        if (($model = Device::findOne(['id' => $id])) !== null && $model->user_id == Yii::$app->user->id) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('system.crud', 'The requested page does not exist.'));
    }
}
