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
}
