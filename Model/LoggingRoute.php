<?php
declare(strict_types=1);

namespace FireGento\WebapiMetrics\Model;

use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterfaceFactory;
use FireGento\WebapiMetrics\Model\ResourceModel\LoggingRoute\Collection;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

/**
 * Class LoggingRoute
 */
class LoggingRoute extends AbstractModel
{
    /**
     * @var LoggingRouteInterfaceFactory
     */
    protected $loggingRouteDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'firegento_webapimetrics_loggingroute';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param LoggingRouteInterfaceFactory $loggingRouteDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\LoggingRoute $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        LoggingRouteInterfaceFactory $loggingRouteDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\LoggingRoute $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->loggingRouteDataFactory = $loggingRouteDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * Retrieve logging route model with logging route data
     *
     * @return LoggingRouteInterface
     */
    public function getDataModel()
    {
        $loggingRouteData = $this->getData();
        $loggingRouteDataObject = $this->loggingRouteDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $loggingRouteDataObject,
            $loggingRouteData,
            LoggingRouteInterface::class
        );

        return $loggingRouteDataObject;
    }
}
