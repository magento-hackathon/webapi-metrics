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
     * Set loggingentry_id
     *
     * @param string $entityId
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(LoggingEntryInterface::KEY_ENTITY_ID, $entityId);
    }

    /**
     * @return int
     */
    public function getRouteId(): int
    {
        return $this->_get(LoggingEntryInterface::KEY_ROUTE_ID);
    }

    /**
     * @param $routeId
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
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface
     */
    public function setExecutedAt($executedAt)
    {
        return $this->setData(LoggingEntryInterface::KEY_EXECUTED_AT, $executedAt);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->_get(LoggingEntryInterface::KEY_STATUS_CODE);
    }

    /**
     * @param int $statusCode
     * @return self
     */
    public function setStatusCode(int $statusCode)
    {
        return $this->setData(LoggingEntryInterface::KEY_STATUS_CODE, $statusCode);
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->_get(LoggingEntryInterface::KEY_SIZE);
    }

    /**
     * @param int $size
     * @return self
     */
    public function setSize(int $size)
    {
        return $this->setData(LoggingEntryInterface::KEY_SIZE, $size);
    }

    /**
     * @return mixed|null
     */
    public function getRouteName()
    {
        return $this->_get(LoggingEntryInterface::KEY_ROUTE_NAME);
    }

    /**
     * @param string $route
     *
     * @return \FireGento\WebapiMetrics\Model\Data\LoggingEntry|mixed
     */
    public function setRouteName(string $route)
    {
        return $this->setData(LoggingEntryInterface::KEY_ROUTE_NAME, $route);
    }

    /**
     * @return mixed|void
     */
    public function getMethodType()
    {
        return $this->_get(LoggingEntryInterface::KEY_METHOD_TYPE);
    }

    /**
     * @param string $methodType
     *
     * @return mixed|void
     */
    public function setMethodType(string $methodType)
    {
        return $this->setData(LoggingEntryInterface::KEY_METHOD_TYPE, $methodType);
    }
}
