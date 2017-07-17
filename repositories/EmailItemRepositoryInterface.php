<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 004 04.11.16
 * Time: 10:19
 */

namespace lo\modules\email\repositories;

use lo\modules\email\modules\admin\dto\MessageEventDto;

/**
 * Class EmailItemRepository
 * @package lo\modules\email\repositories
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
interface EmailItemRepositoryInterface
{
    /**
     * @param $id
     * @return object
     * @throws \InvalidArgumentException
     */
    public function find($id);

    /**
     * @param $item
     */
    public function add($item);

    /**
     * @param $item
     */
    public function save($item);

    /**
     * @param $item
     */
    public function unsubscribe($item);

    /**
     * @param $item
     */
    public function unsubscribeAuto($item);

    /**
     * @param $item
     * @param $msg
     * @return mixed
     */
    public function unsubscribeBounce($item, MessageEventDto $msg);

    /**
     * @param $item
     * @param $msg
     * @return mixed
     */
    public function subscribeOpen($item, MessageEventDto $msg);

    /**
     * @param $item
     * @return string
     */
    public function getEmail($item);

    /**
     * @param $email
     * @return string
     */
    public function getHash($email);

    /**
     * @param $cat_id
     * @param $session
     * @return object
     */
    public function findByGroupSession($cat_id, $session);

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email);

    /**
     * @param $email
     * @return mixed
     */
    public function findBySubscribeEmail($email);

    /**
     * @param $hash
     * @return mixed
     */
    public function findByHash($hash);

    /**
     * @param array $data
     * @return object
     */
    public function addEmail(array $data);

}