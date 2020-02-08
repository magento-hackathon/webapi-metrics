<?php
declare(strict_types = 1);
namespace FireGento\WebapiMetrics\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Reports\Model\ResourceModel\Order\CollectionFactory;

/**
 * Class Routes
 */
class Routes extends \Magento\Backend\Block\Dashboard\AbstractDashboard
{
    /**
     * @var string
     */
    protected $_template = 'FireGento_WebapiMetrics::dashboard/metrics.phtml';

    /**
     * Api URL
     */
    const API_URL = 'https://image-charts.com/chart';

    /**
     * Adminhtml dashboard data
     *
     * @var \Magento\Backend\Helper\Dashboard\Data
     */
    protected $_dashboardData = null;

    /**
     * Routes constructor.
     *
     * @param Context           $context
     * @param CollectionFactory $collectionFactory
     * @param array             $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $collectionFactory, $data);
    }

    /**
     * Get chart url
     *
     * @return string
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function getChartUrl()
    {
        $params = [
            'cht' => 'p3',
            'chs' => '700x100',
            'chd' => 't:60,40',
            'chl' => 'Hello|World',
            'chan' => '',
            'chf'  => 'ps0-0,lg,45,ffeb3b,0.2,f44336,1|ps0-1,lg,45,8bc34a,0.2,009688,1'
        ];

        $p = [];
        foreach ($params as $name => $value) {
            $p[] = $name . '=' . urlencode($value);
        }
        return (string) self::API_URL . '?' . implode('&', $p);
    }
}
