<?php
/*
 * This file is part of the MerchantAPI package.
 *
 * (c) Miva Inc <https://www.miva.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * $Id$
 */

namespace MerchantAPI\Response;

use MerchantAPI\Response;
use MerchantAPI\Model\PaymentMethod;
use MerchantAPI\RequestInterface;
use MerchantAPI\Http\HttpResponse;

/**
 * API Response for PaymentMethodList_Load.
 *
 * @package MerchantAPI\Response
 * @see https://docs.miva.com/json-api/functions/paymentmethodlist_load
 */
class PaymentMethodListLoad extends Response
{
    /** @var \MerchantAPI\Collection|\MerchantAPI\Model\PaymentMethod[] */
    protected $paymentMethods = [];

    /**
     * @inheritDoc
     */
    public function __construct(RequestInterface $request, HttpResponse $response, array $data)
    {
        parent::__construct($request, $response, $data);
        $this->paymentMethods = new \MerchantAPI\Collection();

        if (!$this->isSuccess()) {
            return;
        }
        
        if (isset($data['data'])) {
            foreach ($data['data'] as $result) {
              $this->paymentMethods[] = new PaymentMethod($result);
            }
        }
    }

    /**
     * Get paymentMethods.
     *
     * @return \MerchantAPI\Collection|\MerchantAPI\Model\PaymentMethod[]
     */
    public function getPaymentMethods()
    {
        return $this->paymentMethods;
    }
}