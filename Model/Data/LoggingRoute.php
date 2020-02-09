<?php


namespace FireGento\WebapiMetrics\Model\Data;

use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface;

class LoggingRoute extends \Magento\Framework\Api\AbstractExtensibleObject implements LoggingRouteInterface
{

    /**
     * Get loggingroute_id
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->_get(LoggingRouteInterface::KEY_ENTITY_ID);
    }

    /**
     * Set loggingroute_id
     * @param int $entityId
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(LoggingRouteInterface::KEY_ENTITY_ID, $entityId);
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

    /**
     * @return array|mixed|null
     */
    public function getEntries()
    {
        return $this->_get(LoggingRouteInterface::KEY_ENTRIES);
    }
}
