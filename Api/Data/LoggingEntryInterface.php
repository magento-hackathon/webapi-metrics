<?php

namespace FireGento\WebapiMetrics\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Class LoggingEntryInterface
 */
interface LoggingEntryInterface extends ExtensibleDataInterface
{
    public const KEY_ENTITY_ID   = 'entity_id';
    public const KEY_ROUTE_ID    = 'route_id';
    public const KEY_STATUS_CODE = 'status_code';
    public const KEY_SIZE        = 'size';
    public const KEY_EXECUTED_AT = 'executed_at';
    public const KEY_ROUTE_NAME  = 'route_name';
    public const KEY_METHOD_TYPE = 'method_type';

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $entityId
     *
     * @return int
     */
    public function setEntityId(int $entityId);

    /**
     * @return int
     */
    public function getRouteId();

    /**
     * @param $routeId
     *
     * @return self
     */
    public function setRouteId($routeId);

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @param int $statusCode
     *
     * @return self
     */
    public function setStatusCode(int $statusCode);

    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @param int $size
     *
     * @return self
     */
    public function setSize(int $size);

    /**
     * @return string
     */
    public function getExecutedAt();

    /**
     * @param string $executedAt
     *
     * @return self
     */
    public function setExecutedAt(string $executedAt);

    /**
     * @return \Magento\Framework\Api\ExtensionAttributesInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param \Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes);

    /**
     * @return mixed
     */
    public function getRouteName();

    /**
     * @param string $route
     *
     * @return mixed
     */
    public function setRouteName(string $route);

    /**
     * @return mixed
     */
    public function getMethodType();

    /**
     * @param string $methodType
     *
     * @return mixed
     */
    public function setMethodType(string $methodType);
}
