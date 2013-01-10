<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @category   ZendService
 * @package    ZendService_Apple
 * @subpackage Apns
 */

namespace ZendService\Apple\Apns\Response;

use ZendService\Apple\Exception;

/**
 * Apple Push Notification Client
 * This class allows the ability to send out
 * messages through apple push notification service
 *
 * @category   ZendService
 * @package    ZendService_Apple
 * @subpackage Apns
 */
class Feedback
{
    /**
     * APNS Token
     * @var string
     */
    protected $token;

    /**
     * Time
     * @var int
     */
    protected $time;

    /**
     * Constructor
     *
     * @param string $rawResponse
     * @return Feedback
     */
    public function __construct($rawResponse = null)
    {
        if ($rawResponse !== null) {
            $this->parseRawResponse($rawResponse);
        }
    }

    /**
     * Get Token
     * 
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set Token
     *
     * @return Feedback
     */
    public function setToken($token)
    {
        if (!is_scalar($token)) {
            throw new Exception\InvalidArgumentException('Token must be a scalar value');
        }
        $this->token = $token;
        return $this;
    }

    /**
     * Get Time
     *
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set Time
     *
     * @param int $time
     * @return Feedback
     */
    public function setTime($time)
    {
        $this->time = (int) $time;
        return $this;
    }

    /**
     * Parse Raw Response
     *
     * @return Feedback
     */
    public function parseRawResponse($rawResponse)
    {
       if (strlen($rawResponse) < 38) {
            throw new Exception\RuntimeException('Response was of invalid length');
       }
       $token = unpack('Ntime/ntokenLength/H*token', $token);
       $this->setTime($token['time']);
       $this->setToken($token['token']);
       return $this;
    }

}