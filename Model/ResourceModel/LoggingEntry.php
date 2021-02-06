<?php
declare(strict_types=1);

namespace FireGento\WebapiMetrics\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class LoggingEntry
 */
class LoggingEntry extends AbstractDb
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

    /**
     * @return array
     */
    public function getRequestCountStatisticByMethodAndRoute()
    {
        $select = $this->getConnection()->select()
            ->from($this->getMainTable(), ['method', 'route', 'count' => new \Zend_Db_Expr('COUNT(*)')])
            ->group(['method', 'route']);

        return $this->getConnection()->fetchAll($select);
    }
}
