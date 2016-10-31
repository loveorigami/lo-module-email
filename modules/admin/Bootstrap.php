<?php

namespace lo\modules\email\modules\admin;

use lo\modules\email\adapters\EmailSettings;
use lo\modules\email\adapters\EmailSettingsInterface;
use Yii;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package lo\modules\email\modules\admin
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        Yii::$container->setSingleton(EmailSettingsInterface::class, [
            'class' => EmailSettings::class,
            'cachingDuration' => 6000,
        ]);
    }

}