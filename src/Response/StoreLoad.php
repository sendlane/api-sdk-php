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
use MerchantAPI\Model\Store;
use MerchantAPI\RequestInterface;
use MerchantAPI\Http\HttpResponse;

/**
 * API Response for Store_Load.
 *
 * @package MerchantAPI\Response
 * @see https://docs.miva.com/json-api/functions/store_load
 */
class StoreLoad extends Response
{
    /** @var \MerchantAPI\Model\Store */
    protected $store;

    /**
     * @inheritDoc
     */
    public function __construct(RequestInterface $request, HttpResponse $response, array $data)
    {
        parent::__construct($request, $response, $data);

        if (!$this->isSuccess()) {
            return;
        }

        $this->store = new Store($this->data['data']);
    }

    /**
     * Get store.
     *
     * @return \MerchantAPI\Model\Store|null
     */
    public function getStore()
    {
        return $this->store;
    }
}