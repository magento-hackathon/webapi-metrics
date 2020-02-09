<?php
declare(strict_types = 1);
namespace FireGento\WebapiMetrics\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class LoggingRoute
 */
class LoggingRoute extends AbstractDb
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
