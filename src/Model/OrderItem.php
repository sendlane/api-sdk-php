<?php
/*
 * This file is part of the MerchantAPI package.
 *
 * (c) Miva Inc <https://www.miva.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MerchantAPI\Model;

use MerchantAPI\Collection;

/**
 * Data model for OrderItem.
 *
 * @package MerchantAPI\Model
 */
class OrderItem extends \MerchantAPI\Model
{
    /** @var int ORDER_ITEM_STATUS_PENDING */
    const ORDER_ITEM_STATUS_PENDING = 0;

    /** @var int ORDER_ITEM_STATUS_PROCESSING */
    const ORDER_ITEM_STATUS_PROCESSING = 100;

    /** @var int ORDER_ITEM_STATUS_SHIPPED */
    const ORDER_ITEM_STATUS_SHIPPED = 200;

    /** @var int ORDER_ITEM_STATUS_PARTIALLY_SHIPPED */
    const ORDER_ITEM_STATUS_PARTIALLY_SHIPPED = 201;

    /** @var int ORDER_ITEM_STATUS_GIFT_CERT_NOT_REDEEMED */
    const ORDER_ITEM_STATUS_GIFT_CERT_NOT_REDEEMED = 210;

    /** @var int ORDER_ITEM_STATUS_GIFT_CERT_REDEEMED */
    const ORDER_ITEM_STATUS_GIFT_CERT_REDEEMED = 211;

    /** @var int ORDER_ITEM_STATUS_DIGITAL_NOT_DOWNLOADED */
    const ORDER_ITEM_STATUS_DIGITAL_NOT_DOWNLOADED = 220;

    /** @var int ORDER_ITEM_STATUS_DIGITAL_DOWNLOADED */
    const ORDER_ITEM_STATUS_DIGITAL_DOWNLOADED = 221;

    /** @var int ORDER_ITEM_STATUS_CANCELLED */
    const ORDER_ITEM_STATUS_CANCELLED = 300;

    /** @var int ORDER_ITEM_STATUS_BACKORDERED */
    const ORDER_ITEM_STATUS_BACKORDERED = 400;

    /** @var int ORDER_ITEM_STATUS_RMA_ISSUED */
    const ORDER_ITEM_STATUS_RMA_ISSUED = 500;

    /** @var int ORDER_ITEM_STATUS_RETURNED */
    const ORDER_ITEM_STATUS_RETURNED = 600;

    /**
     * Constructor.
     *
     * @param array $data
     * @throws \InvalidArgumentException
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);

        $this->setField('discounts', new Collection());
        $this->setField('options', new Collection());

        if (isset($data['shipment'])) {
            if ($data['shipment'] instanceof OrderShipment) {
                $this->setField('shipment', $data['shipment']);
            } else if (is_array($data['shipment'])) {
                $this->setField('shipment', new OrderShipment($data['shipment']));
            } else {
                throw new \InvalidArgumentException(sprintf('Expected OrderShipment or an array but got %s',
                    is_object($data['shipment']) ?
                        get_class($data['shipment']) : gettype($data['shipment'])));
            }
        }

        if (isset($data['discounts']) && is_array($data['discounts'])) {
            $discounts = new Collection();

            foreach($data['discounts'] as $e) {
                if ($e instanceof OrderItemDiscount) {
                    $discounts[] = $e;
                } else if (is_array($e)) {
                    $discounts[] = new OrderItemDiscount($e);
                } else {
                    throw new \InvalidArgumentException(sprintf('Expected array of OrderItemDiscount or an array of arrays but got %s',
                        is_object($e) ? get_class($e) : gettype($e)));
                }
            }

            $this->setField('discounts', $discounts);
        }

        if (isset($data['options']) && is_array($data['options'])) {
            $options = new Collection();

            foreach($data['options'] as $e) {
                if ($e instanceof OrderItemOption) {
                    $options[] = $e;
                } else if (is_array($e)) {
                    $options[] = new OrderItemOption($e);
                } else {
                    throw new \InvalidArgumentException(sprintf('Expected array of OrderItemOption or an array of arrays but got %s',
                        is_object($e) ? get_class($e) : gettype($e)));
                }
            }

            $this->setField('options', $options);
        }

        if (isset($data['subscription'])) {
            if ($data['subscription'] instanceof OrderItemSubscription) {
                $this->setField('subscription', $data['subscription']);
            } else if (is_array($data['subscription'])) {
                $this->setField('subscription', new OrderItemSubscription($data['subscription']));
            } else {
                throw new \InvalidArgumentException(sprintf('Expected OrderItemSubscription or an array but got %s',
                    is_object($data['subscription']) ?
                        get_class($data['subscription']) : gettype($data['subscription'])));
            }
        }
    }

    /**
     * Clone.
     *
     * @return void
     */
    public function __clone()
    {
        if (isset($data['shipment'])) {
            if ($this->data['shipment'] instanceof OrderShipment) {
                $this->data['shipment'] = clone $this->data['shipment'];
            }
        }

        if (isset($this->data['discounts']) && is_array($this->data['discounts'])) {
            if ($this->data['discounts'] instanceof Collection) {
                $this->data['discounts'] = clone $this->data['discounts'];
            } else {
                foreach($this->data['discounts'] as $i => $e) {
                    if ($e instanceof OrderItemDiscount) {
                        $this->data['discounts'][$i] = clone $this->data['discounts'][$i];
                    }
                }
            }
        }

        if (isset($this->data['options']) && is_array($this->data['options'])) {
            if ($this->data['options'] instanceof Collection) {
                $this->data['options'] = clone $this->data['options'];
            } else {
                foreach($this->data['options'] as $i => $e) {
                    if ($e instanceof OrderItemOption) {
                        $this->data['options'][$i] = clone $this->data['options'][$i];
                    }
                }
            }
        }

        if (isset($data['subscription'])) {
            if ($this->data['subscription'] instanceof OrderItemSubscription) {
                $this->data['subscription'] = clone $this->data['subscription'];
            }
        }
    }

    /**
     * Get order_id.
     *
     * @return int
     */
    public function getOrderId()
    {
        return (int) $this->getField('order_id', 0);
    }

    /**
     * Get line_id.
     *
     * @return int
     */
    public function getLineId()
    {
        return (int) $this->getField('line_id', 0);
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return (int) $this->getField('status', 0);
    }

    /**
     * Get subscrp_id.
     *
     * @return int
     */
    public function getSubscriptionId()
    {
        return (int) $this->getField('subscrp_id', 0);
    }

    /**
     * Get subterm_id.
     *
     * @return int
     */
    public function getSubscriptionTermId()
    {
        return (int) $this->getField('subterm_id', 0);
    }

    /**
     * Get rma_id.
     *
     * @return int
     */
    public function getRmaId()
    {
        return (int) $this->getField('rma_id', 0);
    }

    /**
     * Get rma_code.
     *
     * @return string
     */
    public function getRmaCode()
    {
        return $this->getField('rma_code');
    }

    /**
     * Get rma_dt_issued.
     *
     * @return int
     */
    public function getRmaDataTimeIssued()
    {
        return (int) $this->getField('rma_dt_issued', 0);
    }

    /**
     * Get rma_dt_recvd.
     *
     * @return int
     */
    public function getRmaDateTimeReceived()
    {
        return (int) $this->getField('rma_dt_recvd', 0);
    }

    /**
     * Get dt_instock.
     *
     * @return int
     */
    public function getDateInStock()
    {
        return (int) $this->getField('dt_instock', 0);
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->getField('code');
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->getField('name');
    }

    /**
     * Get sku.
     *
     * @return string
     */
    public function getSku()
    {
        return $this->getField('sku');
    }

    /**
     * Get retail.
     *
     * @return float
     */
    public function getRetail()
    {
        return (float) $this->getField('retail', 0.00);
    }

    /**
     * Get base_price.
     *
     * @return float
     */
    public function getBasePrice()
    {
        return (float) $this->getField('base_price', 0.00);
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return (float) $this->getField('price', 0.00);
    }

    /**
     * Get tax.
     *
     * @return float
     */
    public function getTax()
    {
        return (float) $this->getField('tax', 0.00);
    }

    /**
     * Get formatted_tax.
     *
     * @return string
     */
    public function getFormattedTax()
    {
        return $this->getField('formatted_tax');
    }

    /**
     * Get weight.
     *
     * @return float
     */
    public function getWeight()
    {
        return (float) $this->getField('weight', 0.00);
    }

    /**
     * Get taxable.
     *
     * @return bool
     */
    public function getTaxable()
    {
        return (bool) $this->getField('taxable', false);
    }

    /**
     * Get upsold.
     *
     * @return bool
     */
    public function getUpsold()
    {
        return (bool) $this->getField('upsold', false);
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return (int) $this->getField('quantity', 0);
    }

    /**
     * Get shipment.
     *
     * @return \MerchantAPI\Model\OrderShipment|null
     */
    public function getShipment()
    {
        return $this->getField('shipment', null);
    }

    /**
     * Get discounts.
     *
     * @return \MerchantAPI\Collection|\MerchantAPI\Model\OrderItemDiscount[]
     */
    public function getDiscounts()
    {
        return $this->getField('discounts', []);
    }

    /**
     * Get options.
     *
     * @return \MerchantAPI\Collection|\MerchantAPI\Model\OrderItemOption[]
     */
    public function getOptions()
    {
        return $this->getField('options', []);
    }

    /**
     * Get subscription.
     *
     * @return \MerchantAPI\Model\OrderItemSubscription|null
     */
    public function getSubscription()
    {
        return $this->getField('subscription', null);
    }

    /**
     * Get total.
     *
     * @return float
     */
    public function getTotal()
    {
        return (float) $this->getField('total', 0.00);
    }

    /**
     * Get tracktype.
     *
     * @return string
     */
    public function getTrackingType()
    {
        return $this->getField('tracktype');
    }

    /**
     * Get tracknum.
     *
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->getField('tracknum');
    }

    /**
     * Get shpmnt_id.
     *
     * @return int
     */
    public function getShipmentId()
    {
        return (int) $this->getField('shpmnt_id', 0);
    }

    /**
     * Set code.
     *
     * @param string
     * @return $this
     */
    public function setCode($code)
    {
        return $this->setField('code', $code);
    }

    /**
     * Set name.
     *
     * @param string
     * @return $this
     */
    public function setName($name)
    {
        return $this->setField('name', $name);
    }

    /**
     * Set sku.
     *
     * @param string
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setField('sku', $sku);
    }

    /**
     * Set price.
     *
     * @param float
     * @return $this
     */
    public function setPrice($price)
    {
        return $this->setField('price', $price);
    }

    /**
     * Set weight.
     *
     * @param float
     * @return $this
     */
    public function setWeight($weight)
    {
        return $this->setField('weight', $weight);
    }

    /**
     * Set taxable.
     *
     * @param bool
     * @return $this
     */
    public function setTaxable($taxable)
    {
        return $this->setField('taxable', $taxable);
    }

    /**
     * Set upsold.
     *
     * @param bool
     * @return $this
     */
    public function setUpsold($upsold)
    {
        return $this->setField('upsold', $upsold);
    }

    /**
     * Set quantity.
     *
     * @param int
     * @return $this
     */
    public function setQuantity($quantity)
    {
        return $this->setField('quantity', $quantity);
    }

    /**
     * Set options.
     *
     * @param array[OrderItemOption]
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setOptions(array $options)
    {
        foreach ($options as &$model) {
            if (is_array($model)) {
                $model = new OrderItemOption($model);
            } else if (!$model instanceof OrderItemOption) {
                throw new \InvalidArgumentException(sprintf('Expected array of OrderItemOption or an array of arrays but got %s',
                    is_object($model) ? get_class($model) : gettype($model)));
            }
        }

        return $this->setField('options', $options);
    }

    /**
     * Set tracktype.
     *
     * @param string
     * @return $this
     */
    public function setTrackingType($trackingType)
    {
        return $this->setField('tracktype', $trackingType);
    }

    /**
     * Set tracknum.
     *
     * @param string
     * @return $this
     */
    public function setTrackingNumber($trackingNumber)
    {
        return $this->setField('tracknum', $trackingNumber);
    }

    /**
     * Add a OrderItemOption.
     *
     * @param OrderItemOption
     * @return $this
     */
    public function addOption(OrderItemOption $model)
    {
        if (!isset($this->data['options'])) {
            $this->data['options'] = [];
        }

        $this->data['options'][] = $model;

        return $this;
    }
}