<?php
/*
 * This file is part of the MerchantAPI package.
 *
 * (c) Miva Inc <https://www.miva.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MerchantAPI\Request;

use MerchantAPI\ListQuery\ListQueryRequest;
use MerchantAPI\Http\HttpResponse;
use MerchantAPI\Model\Customer;
use MerchantAPI\Model\CustomerCreditHistory;
use MerchantAPI\BaseClient;

/**
 * Handles API Request CustomerCreditHistoryList_Load_Query.
 *
 * Scope: Store
 *
 * @package MerchantAPI\Request
 * @see https://docs.miva.com/json-api/functions/customercredithistorylist_load_query
 */
class CustomerCreditHistoryListLoadQuery extends ListQueryRequest
{
    /** @var string The request scope */
    protected $scope = self::REQUEST_SCOPE_STORE;

    /** @var string The API function name */
    protected $function = 'CustomerCreditHistoryList_Load_Query';

    /** @var array Requests available search fields */
    protected $availableSearchFields = [
        'user_name',
        'order_id',
        'txref',
        'descrip',
        'amount',
        'dtstamp',
        'id',
    ];

    /** @var array Requests available sort fields */
    protected $availableSortFields = [
        'user_name',
        'order_id',
        'txref',
        'descrip',
        'amount',
        'dtstamp',
        'id',
    ];

    /** @var array Requests available on demand columns */
    protected $availableOnDemandColumns = [
        'source',
    ];

    /** @var int */
    protected $customerId;

    /** @var string */
    protected $editCustomer;

    /** @var string */
    protected $customerLogin;

    /**
     * Constructor.
     *
     * @param \MerchantAPI\Model\Customer
     */
    public function __construct(BaseClient $client = null, Customer $customer = null)
    {
        parent::__construct($client);
        if ($customer) {
            if ($customer->getId()) {
                $this->setCustomerId($customer->getId());
            } else if ($customer->getLogin()) {
                $this->setEditCustomer($customer->getLogin());
            }
        }
    }

    /**
     * Get Customer_ID.
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Get Edit_Customer.
     *
     * @return string
     */
    public function getEditCustomer()
    {
        return $this->editCustomer;
    }

    /**
     * Get Customer_Login.
     *
     * @return string
     */
    public function getCustomerLogin()
    {
        return $this->customerLogin;
    }

    /**
     * Set Customer_ID.
     *
     * @param int
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Set Edit_Customer.
     *
     * @param string
     * @return $this
     */
    public function setEditCustomer($editCustomer)
    {
        $this->editCustomer = $editCustomer;

        return $this;
    }

    /**
     * Set Customer_Login.
     *
     * @param string
     * @return $this
     */
    public function setCustomerLogin($customerLogin)
    {
        $this->customerLogin = $customerLogin;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $data = parent::toArray();

        if ($this->getCustomerId()) {
            $data['Customer_ID'] = $this->getCustomerId();
        } else if ($this->getEditCustomer()) {
            $data['Edit_Customer'] = $this->getEditCustomer();
        } else if ($this->getCustomerLogin()) {
            $data['Customer_Login'] = $this->getCustomerLogin();
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function createResponse(HttpResponse $httpResponse, array $data)
    {
        return new \MerchantAPI\Response\CustomerCreditHistoryListLoadQuery($this, $httpResponse, $data);
    }
}