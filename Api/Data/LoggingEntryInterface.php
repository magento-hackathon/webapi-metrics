<?php

namespace FireGento\WebapiMetrics\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface LoggingEntryInterface
 */
interface LoggingEntryInterface extends ExtensibleDataInterface
{
    public const KEY_ENTITY_ID = 'entity_id';
    public const KEY_ROUTE_ID = 'route_id';
    public const KEY_STATUS_CODE = 'status_code';
    public const KEY_SIZE = 'size';
    public const KEY_EXECUTED_AT = 'executed_at';
    public const KEY_ROUTE_NAME = 'route_name';
    public const KEY_METHOD_TYPE = 'method_type';

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
     * Get route ID
     *
     * @return int
     */
    public function getRouteId();

    /**
     * Set route ID
     *
     * @param int $routeId
     * @return self
     */
    public function setRouteId($routeId);

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
     * Get executed at
     *
     * @return string
     */
    public function getExecutedAt();

    /**
     * Set executed at
     *
     * @param string $executedAt
     * @return self
     */
    public function setExecutedAt(string $executedAt);

    /**
     * Get route name
     *
     * @return mixed
     */
    public function getRouteName();

    /**
     * Set route name
     *
     * @param string $route
     * @return mixed
     */
    public function setRouteName(string $route);

    /**
     * Get method type
     *
     * @return mixed
     */
    public function getMethodType();

    /**
     * Set method type
     *
     * @param string $methodType
     * @return mixed
     */
    public function setMethodType(string $methodType);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \FireGento\WebapiMetrics\Api\Data\LoggingEntryExtensionInterface $extensionAttributes
    );
}
