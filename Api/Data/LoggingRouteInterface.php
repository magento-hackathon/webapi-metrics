<?php

namespace FireGento\WebapiMetrics\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface LoggingRouteInterface
 */
interface LoggingRouteInterface extends ExtensibleDataInterface
{
    public const KEY_ENTITY_ID = 'entity_id';
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
     * @return self
     */
    public function setEntityId(int $entityId);

    /**
     * Get route name
     *
     * @return string
     */
    public function getRouteName();

    /**
     * Set route name
     *
     * @param string $routeName
     * @return self
     */
    public function setRouteName(string $routeName);

    /**
     * Get method type
     *
     * @return string
     */
    public function getMethodType();

    /**
     * Set method type
     *
     * @param string $methodType
     * @return self
     */
    public function setMethodType(string $methodType);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingRouteExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \FireGento\WebapiMetrics\Api\Data\LoggingRouteExtensionInterface $extensionAttributes
    );
}
