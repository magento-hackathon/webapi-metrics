<?php

namespace FireGento\WebapiMetrics\Model\Data;

use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

/**
 * Class LoggingEntry
 */
class LoggingEntry extends AbstractExtensibleObject implements LoggingEntryInterface
{
    /**
     * Get entity_id
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->_get(LoggingEntryInterface::KEY_ENTITY_ID);
    }

    /**
     * Set entity_id
     *
     * @param string $entityId
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(LoggingEntryInterface::KEY_ENTITY_ID, $entityId);
    }

    /**
     * Get route ID
     *
     * @return int
     */
    public function getRouteId()
    {
        return $this->_get(LoggingEntryInterface::KEY_ROUTE_ID);
    }

    /**
     * Set route ID
     *
     * @param int $routeId
     * @return self
     */
    public function setRouteId($routeId)
    {
        return $this->setData(LoggingEntryInterface::KEY_ROUTE_ID, $routeId);
    }

    /**
     * Get executed_at
     *
     * @return string|null
     */
    public function getExecutedAt()
    {
        return $this->_get(LoggingEntryInterface::KEY_EXECUTED_AT);
    }

    /**
     * Set executed_at
     *
     * @param string $executedAt
     * @return self
     */
    public function setExecutedAt($executedAt)
    {
        return $this->setData(LoggingEntryInterface::KEY_EXECUTED_AT, $executedAt);
    }

    /**
     * Get status code
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->_get(LoggingEntryInterface::KEY_STATUS_CODE);
    }

    /**
     * Set status code
     *
     * @param int $statusCode
     * @return self
     */
    public function setStatusCode(int $statusCode)
    {
        return $this->setData(LoggingEntryInterface::KEY_STATUS_CODE, $statusCode);
    }

    /**
     * Get size
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->_get(LoggingEntryInterface::KEY_SIZE);
    }

    /**
     * Set size
     *
     * @param int $size
     * @return self
     */
    public function setSize(int $size)
    {
        return $this->setData(LoggingEntryInterface::KEY_SIZE, $size);
    }

    /**
     * Get route name
     *
     * @return mixed
     */
    public function getRouteName()
    {
        return $this->_get(LoggingEntryInterface::KEY_ROUTE_NAME);
    }

    /**
     * Set route name
     *
     * @param string|null $route
     * @return mixed
     */
    public function setRouteName($route)
    {
        return $this->setData(LoggingEntryInterface::KEY_ROUTE_NAME, $route);
    }

    /**
     * Get method type
     *
     * @return mixed
     */
    public function getMethodType()
    {
        return $this->_get(LoggingEntryInterface::KEY_METHOD_TYPE);
    }

    /**
     * Set method type
     *
     * @param string|null $methodType
     * @return mixed
     */
    public function setMethodType($methodType)
    {
        return $this->setData(LoggingEntryInterface::KEY_METHOD_TYPE, $methodType);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
