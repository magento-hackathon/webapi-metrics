<?php

namespace FireGento\WebapiMetrics\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface LoggingEntryInterface
 */
interface LoggingEntryInterface extends ExtensibleDataInterface
{
    public const KEY_ENTITY_ID = 'entity_id';
    public const KEY_ROUTE = 'route';
    public const KEY_STATUS_CODE = 'status_code';
    public const KEY_SIZE = 'size';
    public const KEY_CREATED_AT = 'created_at';
    public const KEY_EXECUTION_TIME_MS = 'execution_time';
    public const KEY_METHOD = 'method';

    /**
     * Get Entity ID
     *
     * @return int
     */
    public function getEntityId();

    /**
     * Set Entity ID
     *
     * @param int $entityId
     * @return int
     */
    public function setEntityId(int $entityId);

    /**
     * Get status code
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Set status code
     *
     * @param int $statusCode
     * @return self
     */
    public function setStatusCode(int $statusCode);

    /**
     * Get size
     *
     * @return int
     */
    public function getSize(): int;

    /**
     * Set size
     *
     * @param int $size
     * @return self
     */
    public function setSize(int $size);

    /**
     * Set execution time in milliseconds
     *
     * @param int $executionTimeMs
     * @return self
     */
    public function setExecutionTimeMs(int $executionTimeMs);

    /**
     * Get execution time in milliseconds
     *
     * @return int
     */
    public function getExecutionTimeMs();

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set created at
     *
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt(string $createdAt);

    /**
     * Get route name
     *
     * @return string
     */
    public function getRoute();

    /**
     * Set route name
     *
     * @param string $route
     * @return self
     */
    public function setRoute(string $route);

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod();

    /**
     * Set method
     *
     * @param string $method
     * @return mixed
     */
    public function setMethod(string $method);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface $extensionAttributes
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface
     */
    public function setExtensionAttributes(
        \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface $extensionAttributes
    );
}
