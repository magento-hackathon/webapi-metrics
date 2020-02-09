<?php
declare(strict_types = 1);
namespace FireGento\WebapiMetrics\Model\ResourceModel;

class LoggingRoute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('fg_webapimetrics_logging_routes', 'entity_id');
    }
}
