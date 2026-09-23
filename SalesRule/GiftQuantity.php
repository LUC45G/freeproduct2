<?php

namespace C4B\FreeProduct\SalesRule;

/**
 * Pure calculation of gift quantities for the "Add a Gift (per X qty)" action.
 *
 * Kept free of Magento dependencies so it can be verified in isolation.
 *
 * @package    C4B_FreeProduct
 * @license    http://opensource.org/licenses/osl-3.0.php
 */
class GiftQuantity
{
    /**
     * Gift qty added for every $perQty units of the matched product.
     *
     * @param float $qty     Qty of the matched cart item
     * @param float $perQty  Units of the matched product required per gift (X)
     * @param float $giftQty Gift qty added per threshold (Y)
     * @return float
     */
    public static function forPerQty(float $qty, float $perQty, float $giftQty): float
    {
        return $perQty >= 1 ? floor($qty / $perQty) * $giftQty : 0.0;
    }
}
