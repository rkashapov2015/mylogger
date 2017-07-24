<?php

namespace rinatk\mylogger\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $ip
 * @property string $agent
 * @property string $url
 * @property string $lat
 * @property string $lng
 * @property string $country
 * @property string $city
 * @property integer $status
 * @property string $params
 * @property string $request_method
 * @property string $created_at
 */
class MyLogger extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mylogger';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['created_at'], 'safe'],
            [['ip', 'agent', 'url', 'country', 'city', 'request_method'], 'string', 'max' => 255],
            [['params'],'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ip' => 'Ip',
            'agent' => 'Agent',
            'url' => 'Url',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'country' => 'Country',
            'city' => 'City',
            'status' => 'Status',
            'request_method' => 'Request Method',
            'created_at' => 'Created At',
        ];
    }
}
