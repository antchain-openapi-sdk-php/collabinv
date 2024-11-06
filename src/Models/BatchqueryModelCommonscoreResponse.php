<?php

// This file is auto-generated, don't edit it. Thanks.

namespace AntChain\COLLABINV\Models;

use AlibabaCloud\Tea\Model;

class BatchqueryModelCommonscoreResponse extends Model
{
    // 请求唯一ID，用于链路跟踪和问题排查
    /**
     * @var string
     */
    public $reqMsgId;

    // 结果码，一般OK表示调用成功
    /**
     * @var string
     */
    public $resultCode;

    // 异常信息的文本描述
    /**
     * @var string
     */
    public $resultMsg;

    // 分数
    /**
     * @var string[]
     */
    public $scores;

    // 意向
    /**
     * @var string[]
     */
    public $ratings;

    // 流水号
    /**
     * @var string
     */
    public $transNo;
    protected $_name = [
        'reqMsgId'   => 'req_msg_id',
        'resultCode' => 'result_code',
        'resultMsg'  => 'result_msg',
        'scores'     => 'scores',
        'ratings'    => 'ratings',
        'transNo'    => 'trans_no',
    ];

    public function validate()
    {
    }

    public function toMap()
    {
        $res = [];
        if (null !== $this->reqMsgId) {
            $res['req_msg_id'] = $this->reqMsgId;
        }
        if (null !== $this->resultCode) {
            $res['result_code'] = $this->resultCode;
        }
        if (null !== $this->resultMsg) {
            $res['result_msg'] = $this->resultMsg;
        }
        if (null !== $this->scores) {
            $res['scores'] = $this->scores;
        }
        if (null !== $this->ratings) {
            $res['ratings'] = $this->ratings;
        }
        if (null !== $this->transNo) {
            $res['trans_no'] = $this->transNo;
        }

        return $res;
    }

    /**
     * @param array $map
     *
     * @return BatchqueryModelCommonscoreResponse
     */
    public static function fromMap($map = [])
    {
        $model = new self();
        if (isset($map['req_msg_id'])) {
            $model->reqMsgId = $map['req_msg_id'];
        }
        if (isset($map['result_code'])) {
            $model->resultCode = $map['result_code'];
        }
        if (isset($map['result_msg'])) {
            $model->resultMsg = $map['result_msg'];
        }
        if (isset($map['scores'])) {
            if (!empty($map['scores'])) {
                $model->scores = $map['scores'];
            }
        }
        if (isset($map['ratings'])) {
            if (!empty($map['ratings'])) {
                $model->ratings = $map['ratings'];
            }
        }
        if (isset($map['trans_no'])) {
            $model->transNo = $map['trans_no'];
        }

        return $model;
    }
}