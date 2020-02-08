<?php


namespace FireGento\WebapiMetrics\Model\ResourceModel;

class LoggingEntry extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('fg_webapimetrics_logging_entry', 'entity_id');
    }
}
