<?php


namespace FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \FireGento\WebapiMetrics\Model\LoggingEntry::class,
            \FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry::class
        );
    }

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
