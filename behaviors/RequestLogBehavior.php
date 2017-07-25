<?php

namespace rinatk\mylogger\behaviors;

use rinatk\mylogger\models\MyLogger;
use Yii;
use yii\base\Application;
use yii\web\Application as WebApp;
use yii\base\Behavior;

/**
 * Description of LogBehavior
 *
 * @author rinat
 */
class RequestLogBehavior extends Behavior {

    /**
     * @inheritdoc
     */
    public function events() {
        return [Application::EVENT_AFTER_REQUEST => 'afterRequest'];
    }

    /**
     * 
     * @param type $event
     */
    public function afterRequest($event) {
        $isWebApp = \Yii::$app instanceof \yii\web\Application;
        if(!$isWebApp) {
            return true;
        }

        $log = new MyLogger();
        
        $log->agent = Yii::$app->request->userAgent;
        $log->ip = Yii::$app->request->userIP;
        $log->url = Yii::$app->request->getUrl();
        $matches = null;
        $returnValue = preg_match('/debug\\/default\\/toolbar/', $log->url, $matches);
        if($matches) {
            return true;
        }
        $log->request_method = Yii::$app->request->method;
        
        if (!\Yii::$app->user->isGuest) {
            $log->user_id = \Yii::$app->user->id;
        }
        
        $log->status = filter_input(INPUT_SERVER, 'REDIRECT_STATUS');
        //$log->status = $_SERVER['REDIRECT_STATUS'];
        $remote_ip = Yii::$app->request->userIP;
        
        
        $params = [];
        if(\Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
        }
        if(\Yii::$app->request->isGet) {
            $params = Yii::$app->request->get();
        }
        
        $geo_data_ip = Yii::$app->ipgeobase->getLocation($remote_ip);
        
        $log->country = isset($geo_data_ip['country'])?$geo_data_ip['country']:null;
        $log->city = isset($geo_data_ip['city'])?$geo_data_ip['city']:null;
        $log->lat = isset($geo_data_ip['lat'])?$geo_data_ip['lat']:null;
        $log->lng = isset($geo_data_ip['lng'])?$geo_data_ip['lng']:null;
        $log->ip = $remote_ip;
        $log->params = json_encode($params);
        if(!$log->save()) {
        
        }
    }

}
