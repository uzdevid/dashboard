<?php

namespace app\models\system;

use WhichBrowser\Parser;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "device".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $device_id
 * @property string $access_token
 * @property string $type
 * @property string|null $notification_token
 * @property int $last_activity_time
 * @property int $auth_time
 *
 * @property User $user
 *
 * @property string $deviceName
 * @property string $formattedAuthTime
 */
class Device extends ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string {
        return 'device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'auth_time', 'last_activity_time'], 'integer'],
            [['auth_time', 'last_activity_time'], 'safe'],
            [['name', 'device_id', 'notification_token'], 'string', 'max' => 255],
            [['access_token'], 'string', 'max' => 32],
            [['type'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array {
        return [
            'id' => Yii::t('system.model', 'ID'),
            'user_id' => Yii::t('system.model', 'User ID'),
            'name' => Yii::t('system.model', 'Name'),
            'device_id' => Yii::t('system.model', 'Device ID'),
            'access_token' => Yii::t('system.model', 'Access Token'),
            'type' => Yii::t('system.model', 'Type'),
            'notification_token' => Yii::t('system.model', 'Notification Token'),
            'last_activity_time' => Yii::t('system.model', 'Last Activity Time'),
            'auth_time' => Yii::t('system.model', 'Auth Time'),
        ];
    }

    public function behaviors(): array {
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = [
            'class' => TimestampBehavior::class,
            'attributes' => [
                BaseActiveRecord::EVENT_BEFORE_INSERT => ['last_activity_time', 'auth_time'],
                'value' => time(),
            ]
        ];

        return $behaviors;
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @throws Exception
     */
    public function beforeSave($insert): bool {
        if ($insert) {
            $this->device_id = Yii::$app->security->generateRandomString();
            $this->access_token = Yii::$app->security->generateRandomString();
            $this->type = 'web';
            $this->auth_time = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }

    public function getDeviceName(): string {
        if ($this->type != 'web') {
            return $this->name;
        }

        $parser = new Parser($this->name);
        return "{$parser->os->toString()} {$parser->browser->toString()}";
    }

    /**
     * @throws InvalidConfigException
     */
    public function getFormattedAuthTime(): ?string {
        return Yii::$app->formatter->asDatetime($this->auth_time);
    }
}
