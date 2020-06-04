<?php

namespace portalium\device;

class Module extends \portalium\base\Module
{
    public $apiRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'device/devices',
                'device/project',
                'device/properties',
                'device/data',
                'device/variable',
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
