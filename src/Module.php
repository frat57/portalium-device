<?php

namespace portalium\device;

class Module extends \portalium\base\Module
{
    public $apiRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'pluralize'=>false,
            'controller' => [
                'device/devices',
                'device/projects',
                'device/properties',
                'device/datas',
                'device/variables',
                'device/appprojects',
            ]
        ],
    ];

    public static function moduleInit()
    {
        self::registerTranslation('device','@portalium/device/messages',[
            'device' => 'device.php',
        ]);
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('device', $message, $params);
    }
}
