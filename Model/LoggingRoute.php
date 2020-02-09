<?php
declare(strict_types = 1);
namespace FireGento\WebapiMetrics\Model;

use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * Class LoggingRoute
 */
class LoggingRoute extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var LoggingRouteInterfaceFactory
     */
    protected $loggingrouteDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'firegento_webapimetrics_loggingroute';

    /**
     * @param \Magento\Framework\Model\Context                                     $context
     * @param \Magento\Framework\Registry                                          $registry
     * @param LoggingRouteInterfaceFactory                                         $loggingrouteDataFactory
     * @param DataObjectHelper                                                     $dataObjectHelper
     * @param \FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute            $resource
     * @param \FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute\Collection $resourceCollection
     * @param array                                                                $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        LoggingRouteInterfaceFactory $loggingrouteDataFactory,
        DataObjectHelper $dataObjectHelper,
        \FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute $resource,
        \FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute\Collection $resourceCollection,
        array $data = []
    ) {
        $this->loggingrouteDataFactory = $loggingrouteDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve loggingroute model with loggingroute data
     *
     * @return LoggingRouteInterface
     */
    public function getDataModel()
    {
        $loggingrouteData = $this->getData();
        $loggingrouteDataObject = $this->loggingrouteDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $loggingrouteDataObject,
            $loggingrouteData,
            LoggingRouteInterface::class
        );

        return $loggingrouteDataObject;
    }
}
