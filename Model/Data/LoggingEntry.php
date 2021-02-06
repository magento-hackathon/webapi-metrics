<?php

namespace FireGento\WebapiMetrics\Model\Data;

use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class LoggingEntry
 */
class LoggingEntry extends AbstractExtensibleModel implements LoggingEntryInterface
{
    /**
     * {@inheritDoc}
     */
    public function getStatusCode(): int
    {
        return $this->_getData(self::KEY_STATUS_CODE);
    }

    /**
     * {@inheritDoc}
     */
    public function setStatusCode(int $statusCode)
    {
        return $this->setData(self::KEY_STATUS_CODE, $statusCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getSize(): int
    {
        return $this->_getData(self::KEY_SIZE);
    }

    /**
     * {@inheritDoc}
     */
    public function setSize(int $size)
    {
        return $this->setData(self::KEY_SIZE, $size);
    }

    /**
     * {@inheritDoc}
     */
    public function setExecutionTimeMs(int $executionTimeMs)
    {
        return $this->setData(self::KEY_EXECUTION_TIME_MS, $executionTimeMs);
    }

    /**
     * {@inheritDoc}
     */
    public function getExecutionTimeMs()
    {
        return $this->_getData(self::KEY_EXECUTION_TIME_MS);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->_getData(self::KEY_CREATED_AT);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(string $createdAt)
    {
        return $this->setData(self::KEY_CREATED_AT, $createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getRoute()
    {
        return $this->_getData(self::KEY_ROUTE);
    }

    /**
     * {@inheritDoc}
     */
    public function setRoute(string $route)
    {
        return $this->setData(self::KEY_ROUTE, $route);
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod()
    {
        return $this->_getData(self::KEY_METHOD);
    }

    /**
     * {@inheritDoc}
     */
    public function setMethod(string $method)
    {
        return $this->setData(self::KEY_METHOD, $method);
    }

    /**
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface $extensionAttributes
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface
     */
    public function setExtensionAttributes(LoggingEntryExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
