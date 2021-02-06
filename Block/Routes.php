<?php
declare(strict_types=1);

namespace FireGento\WebapiMetrics\Block;

use FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface;
use FireGento\WebapiMetrics\Api\LoggingRouteRepositoryInterface;
use FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry;
use Magento\Backend\Block\Dashboard\AbstractDashboard;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Dashboard\Data;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Reports\Model\ResourceModel\Order\CollectionFactory;

/**
 * Class Routes
 */
class Routes extends AbstractDashboard
{
    /**
     * Api URL
     */
    private const API_URL = 'https://image-charts.com/chart';

    /**
     * @var string
     */
    protected $_template = 'FireGento_WebapiMetrics::dashboard/metrics.phtml';

    /**
     * @var \FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry
     */
    private LoggingEntry $loggingEntryResource;

    /**
     * @var array
     */
    private $statistics;

    /**
     * Routes constructor.
     *
     * @param Context $context
     * @param \Magento\Reports\Model\ResourceModel\Order\CollectionFactory $collectionFactory
     * @param \FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry $loggingEntryResource
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        LoggingEntry $loggingEntryResource,
        array $data = []
    ) {
        parent::__construct($context, $collectionFactory, $data);

        $this->loggingEntryResource = $loggingEntryResource;
    }

    public function getStatistics()
    {
        if ($this->statistics === null) {
            $this->statistics = $this->loggingEntryResource->getRequestCountStatisticByMethodAndRoute();
        }

        return $this->statistics;
    }

    public function hasStatistics(): bool
    {
        return count($this->getStatistics()) > 0;
    }

    /**
     * Get chart url
     *
     * @return string
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     * @throws LocalizedException
     */
    public function getChartUrl()
    {
        $chd = [];
        $chdl = [];

        $results = $this->getStatistics();

        foreach ($results as $result) {
            $chd[] = $result['count'];
            $chdl[] = $result['method'] . ': ' . $result['route'];
        }

        $params = [
            'cht' => 'bhg',
            'chtt' => 'WebApi Metrics',
            'chs' => '700x150',
            'chd' => 't:' . implode('|', $chd),
            'chdl' => implode('|', $chdl),
            'chma' => '0,0,10,10',
            'chan' => '8000,easeOutBack',
            'chco' => 'fdb45c,27c9c2,1869b7,4F6F26,F6011D,E3521A',
            'chds' => '0,120',
            'chm' => 'N,000000,0,,10|N,000000,1,,10|N,000000,2,,10',
            'chxs' => '0,000000,0,0,_',
            'chxt' => 'y',
            'chbh' => 'a',
        ];

        $p = [];
        foreach ($params as $name => $value) {
            $p[] = $name . '=' . urlencode($value);
        }
        return self::API_URL . '?' . implode('&', $p);
    }
}
