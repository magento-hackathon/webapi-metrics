<?php
declare(strict_types=1);

namespace FireGento\WebapiMetrics\Block;

use FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface;
use FireGento\WebapiMetrics\Api\LoggingRouteRepositoryInterface;
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
     * Adminhtml dashboard data
     *
     * @var Data
     */
    protected $_dashboardData = null;

    /** @var LoggingEntryRepositoryInterface */
    private $loggingEntryRepository;

    /** @var LoggingRouteRepositoryInterface */
    private $loggingRouteRepository;

    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var FilterBuilder */
    private $filterBuilder;

    /** @var FilterGroupBuilder */
    private $filterGroupBuilder;

    /**
     * Routes constructor.
     *
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param LoggingEntryRepositoryInterface $loggingEntryRepository
     * @param LoggingRouteRepositoryInterface $loggingRouteRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param FilterBuilder $filterBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        LoggingEntryRepositoryInterface $loggingEntryRepository,
        LoggingRouteRepositoryInterface $loggingRouteRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        FilterBuilder $filterBuilder,
        array $data = []
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->loggingEntryRepository = $loggingEntryRepository;
        $this->loggingRouteRepository = $loggingRouteRepository;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->filterBuilder = $filterBuilder;
        parent::__construct($context, $collectionFactory, $data);
    }

    /**
     * Get count
     *
     * @return bool|int
     * @throws LocalizedException
     */
    public function getCount()
    {
        $routes = $this->loggingRouteRepository->getList($this->searchCriteriaBuilder->create())->getItems();

        return (bool)count($routes) > 0;
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
        $routes = $this->loggingRouteRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        $results = [];
        foreach ($routes as $route) {
            $filter = $this->filterBuilder
                ->setField('route_id')
                ->setConditionType('eq')
                ->setValue($route->getEntityId())
                ->create();
            $filterGroup = $this->filterGroupBuilder
                ->addFilter($filter)
                ->create();
            $searchCriteria = $this->searchCriteriaBuilder
                ->setFilterGroups([$filterGroup])
                ->create();
            $entries = $this->loggingEntryRepository->getList($searchCriteria);
            $results[$route->getEntityId()] = [
                'route' => $route,
                'entries' => $entries,
                'count' => $entries->getTotalCount()
            ];
        }

        $chd = [];
        $chdl = [];

        foreach ($results as $result) {
            $chd[] = $result['count'];
            $tmp = $result['route'];
            $chdl[] = $tmp->getMethodType() . ': ' . $tmp->getRouteName();
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
//            'chf' => 'b0,lg,90,EA469EFF,1,03A9F47C,0.4',
        ];

        $p = [];
        foreach ($params as $name => $value) {
            $p[] = $name . '=' . urlencode($value);
        }
        return (string)self::API_URL . '?' . implode('&', $p);
    }
}
