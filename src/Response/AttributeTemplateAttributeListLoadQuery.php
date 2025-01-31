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

use MerchantAPI\ListQuery\ListQueryResponse;
use MerchantAPI\Model\AttributeTemplateAttribute;
use MerchantAPI\RequestInterface;
use MerchantAPI\Http\HttpResponse;

/**
 * API Response for AttributeTemplateAttributeList_Load_Query.
 *
 * @package MerchantAPI\Response
 * @see https://docs.miva.com/json-api/functions/attributetemplateattributelist_load_query
 */
class AttributeTemplateAttributeListLoadQuery extends ListQueryResponse
{
    /** @var \MerchantAPI\Collection|\MerchantAPI\Model\AttributeTemplateAttribute[] */
    protected $attributeTemplateAttributes = [];

    /**
     * @inheritDoc
     */
    public function __construct(RequestInterface $request, HttpResponse $response, array $data)
    {
        parent::__construct($request, $response, $data);
        $this->attributeTemplateAttributes = new \MerchantAPI\Collection();

        if (!$this->isSuccess()) {
            return;
        }

        if (isset($data['data']['data'])) {
            foreach ($data['data']['data'] as $result) {
              $this->attributeTemplateAttributes[] = new AttributeTemplateAttribute($result);
            }
        }
    }

    /**
     * Get attributeTemplateAttributes.
     *
     * @return \MerchantAPI\Collection|\MerchantAPI\Model\AttributeTemplateAttribute[]
     */
    public function getAttributeTemplateAttributes()
    {
        return $this->attributeTemplateAttributes;
    }
}