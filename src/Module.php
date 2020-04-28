<?php

namespace portalium\device;

class Module extends \portalium\base\Module
{
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
