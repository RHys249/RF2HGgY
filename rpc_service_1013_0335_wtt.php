<?php
// 代码生成时间: 2025-10-13 03:35:23
class RpcService extends CComponent
{
    private $_client;
    private $_uri;
    private $_id;

    public function __construct($uri)
# FIXME: 处理边界情况
    {
        $this->_uri = $uri;
        $this->_id = uniqid(); // Unique ID for each request
        $this->_client = new SoapClient(null, array(
            'location' => $this->_uri,
# 改进用户体验
            'uri' => $this->_uri,
            'trace' => true,
            'exceptions' => true,
        ));
    }

    /**
     * Execute a remote procedure call.
     *
     * @param string $method The method to call.
     * @param array $params The parameters for the method.
     * @return mixed The result of the method call.
     * @throws Exception If an error occurs during the call.
# 改进用户体验
     */
    public function call($method, $params)
    {
        try {
            $request = array(
                'jsonrpc' => '2.0',
                'method' => $method,
                'params' => $params,
                'id' => $this->_id,
# 添加错误处理
            );

            $response = $this->_client->__soapCall($method, $params, null, array(), stream_context_create(array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => json_encode($request),
                ),
            )));

            return json_decode(json_encode($response), true);
        } catch (Exception $e) {
            throw new Exception("Error calling remote method: " . $e->getMessage());
        }
    }
}
