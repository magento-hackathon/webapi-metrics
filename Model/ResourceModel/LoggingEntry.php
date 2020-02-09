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
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \Magento\Framework\Model\AbstractModel $object
     *
     * @return \Magento\Framework\DB\Select
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $field = $this->getConnection()->quoteIdentifier(sprintf('%s.%s', $this->getMainTable(), $field));
        $select = $this->getConnection()
            ->select()
            ->from($this->getMainTable())
            ->where($field . '=?', $value)
            ->join(
                'fg_webapimetrics_logging_routes',
                'fg_webapimetrics_logging_entry.route_id = fg_webapimetrics_logging_routes.entity_id'
            );

        return $select;
    }
}
