<?php

namespace FireGento\WebapiMetrics\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Class LoggingRouteInterface
 */
interface LoggingRouteInterface extends ExtensibleDataInterface
{
    const KEY_ENTITY_ID = 'entity_id';
    const KEY_ROUTE_NAME = 'route_name';
    const KEY_METHOD_TYPE = 'method_type';

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $entityId
     * @return self
     */
    public function setEntityId(int $entityId);

    /**
     * @return string
     */
    public function getRouteName(): string;

    /**
     * @param string $routeName
     * @return self
     */
    public function setRouteName(string $routeName);

    /**
     * @return string
     */
    public function getMethodType(): string;

    /**
     * @param string $methodType
     * @return self
     */
    public function setMethodType(string $methodType);

    /**
     * @return \Magento\Framework\Api\ExtensionAttributesInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param \Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes);
}
