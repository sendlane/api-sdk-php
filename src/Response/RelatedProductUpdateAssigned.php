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
use MerchantAPI\Model\RelatedProduct;
use MerchantAPI\RequestInterface;
use MerchantAPI\Http\HttpResponse;

/**
 * API Response for RelatedProduct_Update_Assigned.
 *
 * @package MerchantAPI\Response
 * @see https://docs.miva.com/json-api/functions/relatedproduct_update_assigned
 */
class RelatedProductUpdateAssigned extends Response
{
    /** @var \MerchantAPI\Collection|\MerchantAPI\Model\RelatedProduct[] */
    protected $relatedProducts = [];

    /**
     * @inheritDoc
     */
    public function __construct(RequestInterface $request, HttpResponse $response, array $data)
    {
        parent::__construct($request, $response, $data);
        $this->relatedProducts = new \MerchantAPI\Collection();

        if (!$this->isSuccess()) {
            return;
        }

        if (isset($data['data'])) {
            foreach ($data['data'] as $result) {
              $this->relatedProducts[] = new RelatedProduct($result);
            }
        }
    }

    /**
     * Get relatedProducts.
     *
     * @return \MerchantAPI\Collection|\MerchantAPI\Model\RelatedProduct[]
     */
    public function getRelatedProducts()
    {
        return $this->relatedProducts;
    }
}