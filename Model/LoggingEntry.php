<?php
declare(strict_types = 1);
namespace FireGento\WebapiMetrics\Model;

use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * Class LoggingEntry
 */
class LoggingEntry extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var LoggingEntryInterfaceFactory
     */
    protected $loggingentryDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'firegento_webapimetrics_loggingentry';

    /**
     * @param \Magento\Framework\Model\Context                                     $context
     * @param \Magento\Framework\Registry                                          $registry
     * @param LoggingEntryInterfaceFactory                                         $loggingentryDataFactory
     * @param DataObjectHelper                                                     $dataObjectHelper
     * @param \FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry            $resource
     * @param \FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry\Collection $resourceCollection
     * @param array                                                                $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        LoggingEntryInterfaceFactory $loggingentryDataFactory,
        DataObjectHelper $dataObjectHelper,
        \FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry $resource,
        \FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry\Collection $resourceCollection,
        array $data = []
    ) {
        $this->loggingentryDataFactory = $loggingentryDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve loggingentry model with loggingentry data
     *
     * @return LoggingEntryInterface
     */
    public function getDataModel()
    {
        $loggingentryData = $this->getData();
        $loggingentryDataObject = $this->loggingentryDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $loggingentryDataObject,
            $loggingentryData,
            LoggingEntryInterface::class
        );

        return $loggingentryDataObject;
    }
}
