<?php
declare(strict_types=1);

namespace FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry;

use FireGento\WebapiMetrics\Model\LoggingEntry;
use FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry as LoggingEntryResource;
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
    protected function _construct()
    {
        $this->_init(LoggingEntry::class, LoggingEntryResource::class);
    }

    /**
     * Init select
     *
     * @return $this
     */
    protected function _initSelect()
    {
        $this->getSelect()
            ->from(['main_table' => $this->getMainTable()])
            ->join(
                'fg_webapimetrics_logging_routes',
                'main_table.route_id = fg_webapimetrics_logging_routes.entity_id',
                ['route_name', 'method_type']
            );

        return $this;
    }
}
