<?php

namespace FireGento\WebapiMetrics\Model\Data;

use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

/**
 * Class LoggingRoute
 */
class LoggingRoute extends AbstractExtensibleObject implements LoggingRouteInterface
{
    /**
     * Get Entity ID
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->_get(LoggingRouteInterface::KEY_ENTITY_ID);
    }

    /**
     * Set Entity ID
     *
     * @param int $entityId
     * @return self
     */
    public function setEntityId($entityId)
    {
        return $this->setData(LoggingRouteInterface::KEY_ENTITY_ID, $entityId);
    }

    /**
     * Get route name
     *
     * @return string
     */
    public function getRouteName()
    {
        return $this->_get(LoggingRouteInterface::KEY_ROUTE_NAME);
    }

    /**
     * Set route name
     *
     * @param string $routeName
     * @return self
     */
    public function setRouteName($routeName)
    {
        return $this->setData(LoggingRouteInterface::KEY_ROUTE_NAME, $routeName);
    }

    /**
     * Get method type
     *
     * @return string
     */
    public function getMethodType()
    {
        return $this->_get(LoggingRouteInterface::KEY_METHOD_TYPE);
    }

    /**
     * Set method type
     *
     * @param string $methodType
     * @return self
     */
    public function setMethodType(string $methodType)
    {
        return $this->setData(LoggingRouteInterface::KEY_METHOD_TYPE, $methodType);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingRouteExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \FireGento\WebapiMetrics\Api\Data\LoggingRouteExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
