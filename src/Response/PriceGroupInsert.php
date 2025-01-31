<?php
/*
 * This file is part of the MerchantAPI package.
 *
 * (c) Miva Inc <https://www.miva.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MerchantAPI\Response;

use MerchantAPI\Response;

/**
 * API Response for PriceGroup_Insert.
 *
 * @package MerchantAPI\Response
 * @see https://docs.miva.com/json-api/functions/pricegroup_insert
 */
class PriceGroupInsert extends Response
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }

        return null;
    }
}