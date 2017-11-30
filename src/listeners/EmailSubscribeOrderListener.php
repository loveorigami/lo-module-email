<?php

namespace lo\modules\email\listeners;

use lo\core\interfaces\IEmailSubscribeEvent;
use lo\modules\email\repositories\EmailItemRepository;

/**
 * Class EmailSubscribeOrderListener
 * @package lo\modules\email\listeners
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailSubscribeOrderListener
{
    private $repository;

    public function __construct(EmailItemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $event
     */
    public function handle(IEmailSubscribeEvent $event)
    {
        $repository = $this->repository;
        $item = $repository->findByEmail($event->getEmail());

        if (!$item) {
            $repository->addEmail([
                'cat_id' => $repository::CATEGORY_ORDER,
                'email' => $event->getEmail(),
                'name' => $event->getName(),
            ]);
        }
    }
}