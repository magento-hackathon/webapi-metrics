<?php


namespace FireGento\WebapiMetrics\Model\Data;

use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;

class LoggingEntry extends \Magento\Framework\Api\AbstractExtensibleObject implements LoggingEntryInterface
{

    /**
     * Get loggingentry_id
     * @return int
     */
    public function getLoggingentryId()
    {
        return $this->_get(LoggingEntryInterface::KEY_LOGGINGENTRY_ID);
    }

    /**
     * Set loggingentry_id
     * @param string $loggingentryId
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface
     */
    public function setLoggingentryId($loggingentryId)
    {
        return $this->setData(LoggingEntryInterface::KEY_LOGGINGENTRY_ID, $loggingentryId);
    }

    /**
     * Get executed_at
     * @return string|null
     */
    public function getExecutedAt()
    {
        return $this->_get(LoggingEntryInterface::KEY_EXECUTED_AT);
    }

    /**
     * Set executed_at
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
}
