<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\repositories\EmailItemRepositoryInterface;

class SendService
{
    private $emailRepository;

    public function __construct(
        EmailItemRepositoryInterface $emailRepository
    )
    {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param $cat_id
     * @param $tpl
     * @param $session
     * @return bool|string
     */
    public function sendEmail($cat_id, $tol, $session)
    {
        $item = $this->emailRepository->findByGroupSession($cat_id, $session);
        if (!$item) return false;

        return $this->emailRepository->getEmail($item);
    }

}