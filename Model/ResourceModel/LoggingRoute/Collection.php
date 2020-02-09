<?php


namespace FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(
            \FireGento\WebapiMetrics\Model\LoggingRoute::class,
            \FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute::class
        );
    }
}
