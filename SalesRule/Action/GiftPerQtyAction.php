<?php

namespace C4B\FreeProduct\SalesRule\Action;

use C4B\FreeProduct\SalesRule\GiftQuantity;

use Magento\Framework\DataObject;
use Magento\Quote\Model\Quote;
use Magento\SalesRule\Model\Rule;

/**
 * Adds a gift for every X units of a matching cart item.
 * Ex. Every 10 units of A add 1 B.
 *
 * @package    C4B_FreeProduct
 * @license    http://opensource.org/licenses/osl-3.0.php
 */
class GiftPerQtyAction extends AbstractGiftAction
{
    const ACTION = 'add_gift_per_qty';

    /**
     * @inheritDoc
     */
    protected function getAppliedRuleStorage(Quote\Item $item): DataObject
    {
        return $item;
    }

    /**
     * @inheritDoc
     */
    protected function getGiftQty(Quote\Item $item, Rule $rule, $qty): float
    {
        return GiftQuantity::forPerQty(
            (float) $qty,
            (float) $rule->getData(self::RULE_DATA_KEY_PER_QTY),
            (float) $rule->getDiscountAmount()
        );
    }
}
