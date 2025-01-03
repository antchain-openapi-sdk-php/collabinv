<?php

// This file is auto-generated, don't edit it. Thanks.

namespace AntChain\COLLABINV;

use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Exception\TeaUnableRetryError;
use AlibabaCloud\Tea\Request;
use AlibabaCloud\Tea\RpcUtils\RpcUtils;
use AlibabaCloud\Tea\Tea;
use AlibabaCloud\Tea\Utils\Utils;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use AntChain\COLLABINV\Models\BatchqueryModelCommonscoreRequest;
use AntChain\COLLABINV\Models\BatchqueryModelCommonscoreResponse;
use AntChain\COLLABINV\Models\ExecModelSampletaskRequest;
use AntChain\COLLABINV\Models\ExecModelSampletaskResponse;
use AntChain\COLLABINV\Models\PushModelSamplefileRequest;
use AntChain\COLLABINV\Models\PushModelSamplefileResponse;
use AntChain\COLLABINV\Models\QueryLocationInternalRequest;
use AntChain\COLLABINV\Models\QueryLocationInternalResponse;
use AntChain\COLLABINV\Models\QueryLocationTradeRequest;
use AntChain\COLLABINV\Models\QueryLocationTradeResponse;
use AntChain\COLLABINV\Models\QueryModelCommonscoreRequest;
use AntChain\COLLABINV\Models\QueryModelCommonscoreResponse;
use AntChain\COLLABINV\Models\QueryModelFeaturesetRequest;
use AntChain\COLLABINV\Models\QueryModelFeaturesetResponse;
use AntChain\COLLABINV\Models\QueryModelMultiscoreRequest;
use AntChain\COLLABINV\Models\QueryModelMultiscoreResponse;
use AntChain\COLLABINV\Models\QueryModelSampletaskRequest;
use AntChain\COLLABINV\Models\QueryModelSampletaskResponse;
use AntChain\COLLABINV\Models\QueryModelStatsRequest;
use AntChain\COLLABINV\Models\QueryModelStatsResponse;
use AntChain\COLLABINV\Models\SubmitModelInstanceRequest;
use AntChain\COLLABINV\Models\SubmitModelInstanceResponse;
use AntChain\Util\UtilClient;
use Exception;

class Client
{
    protected $_endpoint;

    protected $_regionId;

    protected $_accessKeyId;

    protected $_accessKeySecret;

    protected $_protocol;

    protected $_userAgent;

    protected $_readTimeout;

    protected $_connectTimeout;

    protected $_httpProxy;

    protected $_httpsProxy;

    protected $_socks5Proxy;

    protected $_socks5NetWork;

    protected $_noProxy;

    protected $_maxIdleConns;

    protected $_securityToken;

    protected $_maxIdleTimeMillis;

    protected $_keepAliveDurationMillis;

    protected $_maxRequests;

    protected $_maxRequestsPerHost;

    /**
     * Init client with Config.
     *
     * @param config config contains the necessary information to create a client
     * @param mixed $config
     */
    public function __construct($config)
    {
        if (Utils::isUnset($config)) {
            throw new TeaError([
                'code'    => 'ParameterMissing',
                'message' => "'config' can not be unset",
            ]);
        }
        $this->_accessKeyId             = $config->accessKeyId;
        $this->_accessKeySecret         = $config->accessKeySecret;
        $this->_securityToken           = $config->securityToken;
        $this->_endpoint                = $config->endpoint;
        $this->_protocol                = $config->protocol;
        $this->_userAgent               = $config->userAgent;
        $this->_readTimeout             = Utils::defaultNumber($config->readTimeout, 20000);
        $this->_connectTimeout          = Utils::defaultNumber($config->connectTimeout, 20000);
        $this->_httpProxy               = $config->httpProxy;
        $this->_httpsProxy              = $config->httpsProxy;
        $this->_noProxy                 = $config->noProxy;
        $this->_socks5Proxy             = $config->socks5Proxy;
        $this->_socks5NetWork           = $config->socks5NetWork;
        $this->_maxIdleConns            = Utils::defaultNumber($config->maxIdleConns, 60000);
        $this->_maxIdleTimeMillis       = Utils::defaultNumber($config->maxIdleTimeMillis, 5);
        $this->_keepAliveDurationMillis = Utils::defaultNumber($config->keepAliveDurationMillis, 5000);
        $this->_maxRequests             = Utils::defaultNumber($config->maxRequests, 100);
        $this->_maxRequestsPerHost      = Utils::defaultNumber($config->maxRequestsPerHost, 100);
    }

    /**
     * Encapsulate the request and invoke the network.
     *
     * @param string         $version
     * @param string         $action   api name
     * @param string         $protocol http or https
     * @param string         $method   e.g. GET
     * @param string         $pathname pathname of every api
     * @param mixed[]        $request  which contains request params
     * @param string[]       $headers
     * @param RuntimeOptions $runtime  which controls some details of call api, such as retry times
     *
     * @throws TeaError
     * @throws Exception
     * @throws TeaUnableRetryError
     *
     * @return array the response
     */
    public function doRequest($version, $action, $protocol, $method, $pathname, $request, $headers, $runtime)
    {
        $runtime->validate();
        $_runtime = [
            'timeouted'          => 'retry',
            'readTimeout'        => Utils::defaultNumber($runtime->readTimeout, $this->_readTimeout),
            'connectTimeout'     => Utils::defaultNumber($runtime->connectTimeout, $this->_connectTimeout),
            'httpProxy'          => Utils::defaultString($runtime->httpProxy, $this->_httpProxy),
            'httpsProxy'         => Utils::defaultString($runtime->httpsProxy, $this->_httpsProxy),
            'noProxy'            => Utils::defaultString($runtime->noProxy, $this->_noProxy),
            'maxIdleConns'       => Utils::defaultNumber($runtime->maxIdleConns, $this->_maxIdleConns),
            'maxIdleTimeMillis'  => $this->_maxIdleTimeMillis,
            'keepAliveDuration'  => $this->_keepAliveDurationMillis,
            'maxRequests'        => $this->_maxRequests,
            'maxRequestsPerHost' => $this->_maxRequestsPerHost,
            'retry'              => [
                'retryable'   => $runtime->autoretry,
                'maxAttempts' => Utils::defaultNumber($runtime->maxAttempts, 3),
            ],
            'backoff' => [
                'policy' => Utils::defaultString($runtime->backoffPolicy, 'no'),
                'period' => Utils::defaultNumber($runtime->backoffPeriod, 1),
            ],
            'ignoreSSL' => $runtime->ignoreSSL,
            // 特征集信息
        ];
        $_lastRequest   = null;
        $_lastException = null;
        $_now           = time();
        $_retryTimes    = 0;
        while (Tea::allowRetry(@$_runtime['retry'], $_retryTimes, $_now)) {
            if ($_retryTimes > 0) {
                $_backoffTime = Tea::getBackoffTime(@$_runtime['backoff'], $_retryTimes);
                if ($_backoffTime > 0) {
                    Tea::sleep($_backoffTime);
                }
            }
            $_retryTimes = $_retryTimes + 1;

            try {
                $_request           = new Request();
                $_request->protocol = Utils::defaultString($this->_protocol, $protocol);
                $_request->method   = $method;
                $_request->pathname = $pathname;
                $_request->query    = [
                    'method'           => $action,
                    'version'          => $version,
                    'sign_type'        => 'HmacSHA1',
                    'req_time'         => UtilClient::getTimestamp(),
                    'req_msg_id'       => UtilClient::getNonce(),
                    'access_key'       => $this->_accessKeyId,
                    'base_sdk_version' => 'TeaSDK-2.0',
                    'sdk_version'      => '1.0.12',
                    '_prod_code'       => 'COLLABINV',
                    '_prod_channel'    => 'default',
                ];
                if (!Utils::empty_($this->_securityToken)) {
                    $_request->query['security_token'] = $this->_securityToken;
                }
                $_request->headers = Tea::merge([
                    'host'       => Utils::defaultString($this->_endpoint, 'openapi.antchain.antgroup.com'),
                    'user-agent' => Utils::getUserAgent($this->_userAgent),
                ], $headers);
                $tmp                               = Utils::anyifyMapValue(RpcUtils::query($request));
                $_request->body                    = Utils::toFormString($tmp);
                $_request->headers['content-type'] = 'application/x-www-form-urlencoded';
                $signedParam                       = Tea::merge($_request->query, RpcUtils::query($request));
                $_request->query['sign']           = UtilClient::getSignature($signedParam, $this->_accessKeySecret);
                $_lastRequest                      = $_request;
                $_response                         = Tea::send($_request, $_runtime);
                $raw                               = Utils::readAsString($_response->body);
                $obj                               = Utils::parseJSON($raw);
                $res                               = Utils::assertAsMap($obj);
                $resp                              = Utils::assertAsMap(@$res['response']);
                if (UtilClient::hasError($raw, $this->_accessKeySecret)) {
                    throw new TeaError([
                        'message' => @$resp['result_msg'],
                        'data'    => $resp,
                        'code'    => @$resp['result_code'],
                    ]);
                }

                return $resp;
            } catch (Exception $e) {
                if (!($e instanceof TeaError)) {
                    $e = new TeaError([], $e->getMessage(), $e->getCode(), $e);
                }
                if (Tea::isRetryable($e)) {
                    $_lastException = $e;

                    continue;
                }

                throw $e;
            }
        }

        throw new TeaUnableRetryError($_lastRequest, $_lastException);
    }

    /**
     * Description: 基于交易数据的定位信息协查
     * Summary: 定位协查.
     *
     * @param QueryLocationInternalRequest $request
     *
     * @return QueryLocationInternalResponse
     */
    public function queryLocationInternal($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->queryLocationInternalEx($request, $headers, $runtime);
    }

    /**
     * Description: 基于交易数据的定位信息协查
     * Summary: 定位协查.
     *
     * @param QueryLocationInternalRequest $request
     * @param string[]                     $headers
     * @param RuntimeOptions               $runtime
     *
     * @return QueryLocationInternalResponse
     */
    public function queryLocationInternalEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return QueryLocationInternalResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.location.internal.query', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 基于交易数据的定位信息协查对外接口
     * Summary: 定位协查对外接口.
     *
     * @param QueryLocationTradeRequest $request
     *
     * @return QueryLocationTradeResponse
     */
    public function queryLocationTrade($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->queryLocationTradeEx($request, $headers, $runtime);
    }

    /**
     * Description: 基于交易数据的定位信息协查对外接口
     * Summary: 定位协查对外接口.
     *
     * @param QueryLocationTradeRequest $request
     * @param string[]                  $headers
     * @param RuntimeOptions            $runtime
     *
     * @return QueryLocationTradeResponse
     */
    public function queryLocationTradeEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return QueryLocationTradeResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.location.trade.query', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 样本文件摘要
     * Summary: 样本文件摘要
     *
     * @param PushModelSamplefileRequest $request
     *
     * @return PushModelSamplefileResponse
     */
    public function pushModelSamplefile($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->pushModelSamplefileEx($request, $headers, $runtime);
    }

    /**
     * Description: 样本文件摘要
     * Summary: 样本文件摘要
     *
     * @param PushModelSamplefileRequest $request
     * @param string[]                   $headers
     * @param RuntimeOptions             $runtime
     *
     * @return PushModelSamplefileResponse
     */
    public function pushModelSamplefileEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return PushModelSamplefileResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.samplefile.push', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 样本任务执行
     * Summary: 样本任务执行.
     *
     * @param ExecModelSampletaskRequest $request
     *
     * @return ExecModelSampletaskResponse
     */
    public function execModelSampletask($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->execModelSampletaskEx($request, $headers, $runtime);
    }

    /**
     * Description: 样本任务执行
     * Summary: 样本任务执行.
     *
     * @param ExecModelSampletaskRequest $request
     * @param string[]                   $headers
     * @param RuntimeOptions             $runtime
     *
     * @return ExecModelSampletaskResponse
     */
    public function execModelSampletaskEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return ExecModelSampletaskResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.sampletask.exec', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 任务状态查询
     * Summary: 任务状态查询.
     *
     * @param QueryModelSampletaskRequest $request
     *
     * @return QueryModelSampletaskResponse
     */
    public function queryModelSampletask($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->queryModelSampletaskEx($request, $headers, $runtime);
    }

    /**
     * Description: 任务状态查询
     * Summary: 任务状态查询.
     *
     * @param QueryModelSampletaskRequest $request
     * @param string[]                    $headers
     * @param RuntimeOptions              $runtime
     *
     * @return QueryModelSampletaskResponse
     */
    public function queryModelSampletaskEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return QueryModelSampletaskResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.sampletask.query', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 特征集查询
     * Summary: 特征集查询.
     *
     * @param QueryModelFeaturesetRequest $request
     *
     * @return QueryModelFeaturesetResponse
     */
    public function queryModelFeatureset($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->queryModelFeaturesetEx($request, $headers, $runtime);
    }

    /**
     * Description: 特征集查询
     * Summary: 特征集查询.
     *
     * @param QueryModelFeaturesetRequest $request
     * @param string[]                    $headers
     * @param RuntimeOptions              $runtime
     *
     * @return QueryModelFeaturesetResponse
     */
    public function queryModelFeaturesetEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return QueryModelFeaturesetResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.featureset.query', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 模型保存
     * Summary: 模型保存.
     *
     * @param SubmitModelInstanceRequest $request
     *
     * @return SubmitModelInstanceResponse
     */
    public function submitModelInstance($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->submitModelInstanceEx($request, $headers, $runtime);
    }

    /**
     * Description: 模型保存
     * Summary: 模型保存.
     *
     * @param SubmitModelInstanceRequest $request
     * @param string[]                   $headers
     * @param RuntimeOptions             $runtime
     *
     * @return SubmitModelInstanceResponse
     */
    public function submitModelInstanceEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return SubmitModelInstanceResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.instance.submit', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 模型调用统计查询
     * Summary: 模型调用统计查询.
     *
     * @param QueryModelStatsRequest $request
     *
     * @return QueryModelStatsResponse
     */
    public function queryModelStats($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->queryModelStatsEx($request, $headers, $runtime);
    }

    /**
     * Description: 模型调用统计查询
     * Summary: 模型调用统计查询.
     *
     * @param QueryModelStatsRequest $request
     * @param string[]               $headers
     * @param RuntimeOptions         $runtime
     *
     * @return QueryModelStatsResponse
     */
    public function queryModelStatsEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return QueryModelStatsResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.stats.query', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 通用查询
     * Summary: 通用查询.
     *
     * @param QueryModelCommonscoreRequest $request
     *
     * @return QueryModelCommonscoreResponse
     */
    public function queryModelCommonscore($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->queryModelCommonscoreEx($request, $headers, $runtime);
    }

    /**
     * Description: 通用查询
     * Summary: 通用查询.
     *
     * @param QueryModelCommonscoreRequest $request
     * @param string[]                     $headers
     * @param RuntimeOptions               $runtime
     *
     * @return QueryModelCommonscoreResponse
     */
    public function queryModelCommonscoreEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return QueryModelCommonscoreResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.commonscore.query', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 通用查询批次，仅针对外部使用PIR场景
     * Summary: 通用查询批次
     *
     * @param BatchqueryModelCommonscoreRequest $request
     *
     * @return BatchqueryModelCommonscoreResponse
     */
    public function batchqueryModelCommonscore($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->batchqueryModelCommonscoreEx($request, $headers, $runtime);
    }

    /**
     * Description: 通用查询批次，仅针对外部使用PIR场景
     * Summary: 通用查询批次
     *
     * @param BatchqueryModelCommonscoreRequest $request
     * @param string[]                          $headers
     * @param RuntimeOptions                    $runtime
     *
     * @return BatchqueryModelCommonscoreResponse
     */
    public function batchqueryModelCommonscoreEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return BatchqueryModelCommonscoreResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.commonscore.batchquery', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 多模型预测值
     * Summary: 多模型预测值
     *
     * @param QueryModelMultiscoreRequest $request
     *
     * @return QueryModelMultiscoreResponse
     */
    public function queryModelMultiscore($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->queryModelMultiscoreEx($request, $headers, $runtime);
    }

    /**
     * Description: 多模型预测值
     * Summary: 多模型预测值
     *
     * @param QueryModelMultiscoreRequest $request
     * @param string[]                    $headers
     * @param RuntimeOptions              $runtime
     *
     * @return QueryModelMultiscoreResponse
     */
    public function queryModelMultiscoreEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return QueryModelMultiscoreResponse::fromMap($this->doRequest('1.0', 'antchain.zkcollabinv.model.multiscore.query', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }
}
