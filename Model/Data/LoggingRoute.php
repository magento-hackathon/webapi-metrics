<?php
declare(strict_types = 1);
namespace FireGento\WebapiMetrics\Model\Data;

use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

class LoggingRoute extends AbstractExtensibleObject implements LoggingRouteInterface
{
    /**
     * Get Entity ID
     *
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->_get(LoggingRouteInterface::KEY_ENTITY_ID);
    }

    /**
     * Set Entity ID
     *
     * @param int $entityId
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(LoggingRouteInterface::KEY_ENTITY_ID, $entityId);
    }

    /**
     * Get route_name
     *
     * @return string|null
     */
    public function getRouteName() : string
    {
        return $this->_get(LoggingRouteInterface::KEY_ROUTE_NAME);
    }

    /**
     * Set route_name
     *
     * @param string $routeName
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface
     */
    public function setRouteName($routeName)
    {
        return $this->setData(LoggingRouteInterface::KEY_ROUTE_NAME, $routeName);
    }

    /**
     * @return string
     */
    public function getMethodType() : string
    {
        return $this->_get(LoggingRouteInterface::KEY_METHOD_TYPE);
    }

    /**
     * @param string $methodType
     *
     * @return self
     */
    public function setMethodType(string $methodType)
    {
        return $this->setData(LoggingRouteInterface::KEY_METHOD_TYPE, $methodType);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAttributes()
    {
        $extensionAttributes = $this->_getExtensionAttributes();
        if (null === $extensionAttributes) {
            $extensionAttributes = $this->extensionFactory->create(LoggingRouteInterface::class);
            $this->setExtensionAttributes($extensionAttributes);
        }

        return $extensionAttributes;
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(\Magento\Framework\Api\ExtensionAttributesInterface $extensionAttributes)
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
