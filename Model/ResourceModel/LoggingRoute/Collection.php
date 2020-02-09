<?php
declare(strict_types=1);

namespace FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute;

use FireGento\WebapiMetrics\Model\LoggingRoute;
use FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute as LoggingRouteResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(LoggingRoute::class, LoggingRouteResource::class);
    }
}
