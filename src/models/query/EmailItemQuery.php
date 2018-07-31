<?php

namespace lo\modules\email\models\query;

use lo\core\db\ActiveQuery;

/**
 * Class EmailItemQuery
 *
 * @package lo\modules\email\models\query
 * @author  Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailItemQuery extends ActiveQuery
{
    /**
     * @return self
     */
    public function notSended(): self
    {
        return $this->andWhere([
            'OR',
            ['date_send' => '0000-00-00'],
            ['date_send' => null],
            ['date_send' => ''],
        ]);
    }
}
