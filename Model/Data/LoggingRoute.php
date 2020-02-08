<?php


namespace FireGento\WebapiMetrics\Model\Data;

use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface;

class LoggingRoute extends \Magento\Framework\Api\AbstractExtensibleObject implements LoggingRouteInterface
{

    /**
     * Get loggingroute_id
     * @return string|null
     */
    public function getLoggingrouteId()
    {
        return $this->_get(LoggingRouteInterface::KEY_LOGGINGROUTE_ID);
    }

    /**
     * Set loggingroute_id
     * @param string $loggingrouteId
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface
     */
    public function setLoggingrouteId($loggingrouteId)
    {
        return $this->setData(LoggingRouteInterface::KEY_LOGGINGROUTE_ID, $loggingrouteId);
    }

    /**
     * Get route_name
     * @return string|null
     */
    public function getRouteName(): string
    {
        return $this->_get(LoggingRouteInterface::KEY_ROUTE_NAME);
    }

    /**
     * Set route_name
     * @param string $routeName
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface
     */
    public function setRouteName($routeName)
    {
        return $this->setData(LoggingRouteInterface::KEY_ROUTE_NAME, $routeName);
    }

    /**
     * @return string
     */
    public function getMethodType(): string
    {
        return $this->_get(LoggingRouteInterface::KEY_METHOD_TYPE);
    }

    /**
     * @param string $methodType
     * @return self
     */
    public function setMethodType(string $methodType)
    {
        return $this->setData(LoggingRouteInterface::KEY_METHOD_TYPE, $methodType);
    }
}
