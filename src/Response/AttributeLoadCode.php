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
use MerchantAPI\Model\ProductAttribute;
use MerchantAPI\RequestInterface;
use MerchantAPI\Http\HttpResponse;

/**
 * API Response for Attribute_Load_Code.
 *
 * @package MerchantAPI\Response
 * @see https://docs.miva.com/json-api/functions/attribute_load_code
 */
class AttributeLoadCode extends Response
{
    /** @var \MerchantAPI\Model\ProductAttribute */
    protected $productAttribute;

    /**
     * @inheritDoc
     */
    public function __construct(RequestInterface $request, HttpResponse $response, array $data)
    {
        parent::__construct($request, $response, $data);

        if (!$this->isSuccess()) {
            return;
        }

        $this->productAttribute = new ProductAttribute($this->data['data']);
    }

    /**
     * Get productAttribute.
     *
     * @return \MerchantAPI\Model\ProductAttribute|null
     */
    public function getProductAttribute()
    {
        return $this->productAttribute;
    }
}