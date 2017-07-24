<?php

namespace rinatk\mylogger;


use rinatk\mylogger\behaviors\RequestLogBehavior;
/**
 * Description of Bootstrap
 *
 * @author rinat
 */
class MyLogger implements \yii\base\BootstrapInterface {
    public function bootstrap($app) {
        $app->attachBehavior('mylogger', RequestLogBehavior::className());
    }

}
