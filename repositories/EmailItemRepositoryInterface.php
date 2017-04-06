<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 004 04.11.16
 * Time: 10:19
 */
namespace lo\modules\email\repositories;

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
     * @return string
     */
    public function getEmail($item);

    /**
     * @param $item
     * @return string
     */
    public function getHash($item);

    /**
     * @param $cat_id
     * @param $session
     * @return object
     */
    public function findByGroupSession($cat_id, $session);

    /**
     * @param array $data
     * @return object
     */
    public function addEmail(array $data);

}