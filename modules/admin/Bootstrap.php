<?php

namespace lo\modules\email\modules\admin;

use lo\modules\email\adapters\EmailSettings;
use lo\modules\email\adapters\EmailSettingsInterface;
use lo\modules\email\modules\admin\services\Mailing;
use lo\modules\email\modules\admin\services\MailingInterface;
use lo\modules\email\repositories\EmailItemRepository;
use lo\modules\email\repositories\EmailItemRepositoryInterface;
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

        Yii::$container->setSingleton(EmailItemRepositoryInterface::class, EmailItemRepository::class);

        Yii::$container->setSingleton(MailingInterface::class, function () use ($app) {
            return new Mailing(
                $app->params['adminEmail']
            );
        });
    }

}