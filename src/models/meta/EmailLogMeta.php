<?php

namespace lo\modules\email\models\meta;

use Yii;
use lo\core\db\MetaFields;
use lo\core\db\fields;

/**
 * Class EmailLogMeta
 *
 * @package lo\modules\email\models
 * @author  Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailLogMeta extends MetaFields
{
    /**
     * @inheritdoc
     */
    protected function config(): array
    {
        return [
            'id' => [
                'definition' => [
                    'class' => fields\PkField::class,
                    'title' => Yii::t('backend', 'Id'),
                ],
                'params' => [$this->owner, 'id'],
            ],
            'date' => [
                'definition' => [
                    'class' => fields\DateField::class,
                    'title' => Yii::t('backend', 'Date'),
                    'showInGrid' => true,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'date'],
            ],
            'count_sent' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count sent'),
                    'showInGrid' => true,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_sent'],
            ],
            'count_rendered' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count rendered'),
                    'showInGrid' => true,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_rendered'],
            ],
            'count_bounce' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count bounce'),
                    'showInGrid' => true,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_bounce'],
            ],

            'count_injected' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_injected'],
            ],
            'count_rejected' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_rejected'],
            ],
            'count_delivered' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_delivered'],
            ],
            'count_delivered_first' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_delivered_first'],
            ],
            'count_delivered_subsequent' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_delivered_subsequent'],
            ],
            'total_delivery_time_first' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'total_delivery_time_first'],
            ],
            'total_delivery_time_subsequent' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'total_delivery_time_subsequent'],
            ],
            'total_msg_volume' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'total_msg_volume'],
            ],
            'count_policy_rejection' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_policy_rejection'],
            ],
            'count_generation_rejection' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_generation_rejection'],
            ],
            'count_generation_failed' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_generation_failed'],
            ],
            'count_inband_bounce' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_inband_bounce'],
            ],
            'count_outofband_bounce' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_outofband_bounce'],
            ],
            'count_soft_bounce' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_soft_bounce'],
            ],
            'count_hard_bounce' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_hard_bounce'],
            ],
            'count_block_bounce' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_block_bounce'],
            ],
            'count_admin_bounce' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_admin_bounce'],
            ],
            'count_undetermined_bounce' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_undetermined_bounce'],
            ],
            'count_delayed' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_delayed'],
            ],
            'count_delayed_first' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_delayed_first'],
            ],

            'count_unique_rendered' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_unique_rendered'],
            ],
            'count_unique_confirmed_opened' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_unique_confirmed_opened'],
            ],
            'count_clicked' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_clicked'],
            ],
            'count_unique_clicked' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_unique_clicked'],
            ],
            'count_targeted' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_targeted'],
            ],
            'count_accepted' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_accepted'],
            ],
            'count_spam_complaint' => [
                'definition' => [
                    'class' => fields\NumberField::class,
                    'title' => Yii::t('backend', 'Count'),
                    'showInGrid' => false,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'count_spam_complaint'],
            ],
        ];
    }
}
