<?php

// This file is auto-generated, don't edit it. Thanks.

namespace AntChain\COLLABINV\Models;

use AlibabaCloud\Tea\Model;

class QueryIndexresearchBrandRequest extends Model
{
    // OAuth模式下的授权token
    /**
     * @var string
     */
    public $authToken;

    /**
     * @var string
     */
    public $productInstanceId;

    // 品牌编码
    /**
     * @var string
     */
    public $brandCode;

    // 时间月份yyyyMM
    /**
     * @var string
     */
    public $month;

    // test-测试数据。prod-正式数据
    /**
     * @var string
     */
    public $dataType;

    // 时间频次 m-月/d-天
    /**
     * @var string
     */
    public $timeType;
    protected $_name = [
        'authToken'         => 'auth_token',
        'productInstanceId' => 'product_instance_id',
        'brandCode'         => 'brand_code',
        'month'             => 'month',
        'dataType'          => 'data_type',
        'timeType'          => 'time_type',
    ];

    public function validate()
    {
        Model::validateRequired('brandCode', $this->brandCode, true);
        Model::validateRequired('dataType', $this->dataType, true);
        Model::validateRequired('timeType', $this->timeType, true);
    }

    public function toMap()
    {
        $res = [];
        if (null !== $this->authToken) {
            $res['auth_token'] = $this->authToken;
        }
        if (null !== $this->productInstanceId) {
            $res['product_instance_id'] = $this->productInstanceId;
        }
        if (null !== $this->brandCode) {
            $res['brand_code'] = $this->brandCode;
        }
        if (null !== $this->month) {
            $res['month'] = $this->month;
        }
        if (null !== $this->dataType) {
            $res['data_type'] = $this->dataType;
        }
        if (null !== $this->timeType) {
            $res['time_type'] = $this->timeType;
        }

        return $res;
    }

    /**
     * @param array $map
     *
     * @return QueryIndexresearchBrandRequest
     */
    public static function fromMap($map = [])
    {
        $model = new self();
        if (isset($map['auth_token'])) {
            $model->authToken = $map['auth_token'];
        }
        if (isset($map['product_instance_id'])) {
            $model->productInstanceId = $map['product_instance_id'];
        }
        if (isset($map['brand_code'])) {
            $model->brandCode = $map['brand_code'];
        }
        if (isset($map['month'])) {
            $model->month = $map['month'];
        }
        if (isset($map['data_type'])) {
            $model->dataType = $map['data_type'];
        }
        if (isset($map['time_type'])) {
            $model->timeType = $map['time_type'];
        }

        return $model;
    }
}
