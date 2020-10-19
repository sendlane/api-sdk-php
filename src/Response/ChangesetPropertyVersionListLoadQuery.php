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
use MerchantAPI\Model\ChangesetPropertyVersion;
use MerchantAPI\RequestInterface;
use MerchantAPI\Http\HttpResponse;

/**
 * API Response for ChangesetPropertyVersionList_Load_Query.
 *
 * @package MerchantAPI\Response
 * @see https://docs.miva.com/json-api/functions/changesetpropertyversionlist_load_query
 */
class ChangesetPropertyVersionListLoadQuery extends ListQueryResponse
{
    /** @var \MerchantAPI\Collection|\MerchantAPI\Model\ChangesetPropertyVersion[] */
    protected $changesetPropertyVersions = [];

    /**
     * @inheritDoc
     */
    public function __construct(RequestInterface $request, HttpResponse $response, array $data)
    {
        parent::__construct($request, $response, $data);
        $this->changesetPropertyVersions = new \MerchantAPI\Collection();

        if (!$this->isSuccess()) {
            return;
        }

        if (isset($data['data']['data'])) {
            foreach ($data['data']['data'] as $result) {
              $this->changesetPropertyVersions[] = new ChangesetPropertyVersion($result);
            }
        }
    }

    /**
     * Get changesetPropertyVersions.
     *
     * @return \MerchantAPI\Collection|\MerchantAPI\Model\ChangesetPropertyVersion[]
     */
    public function getChangesetPropertyVersions()
    {
        return $this->changesetPropertyVersions;
    }
}