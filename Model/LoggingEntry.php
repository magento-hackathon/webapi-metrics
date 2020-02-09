<?php
declare(strict_types=1);

namespace FireGento\WebapiMetrics\Model;

use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterfaceFactory;
use FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry\Collection;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

/**
 * Class LoggingEntry
 */
class LoggingEntry extends AbstractModel
{
    /**
     * @var LoggingEntryInterfaceFactory
     */
    protected $loggingEntryDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'firegento_webapimetrics_loggingentry';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param LoggingEntryInterfaceFactory $loggingEntryDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\LoggingEntry $resource
     * @param Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        LoggingEntryInterfaceFactory $loggingEntryDataFactory,
        DataObjectHelper $dataObjectHelper,
        ResourceModel\LoggingEntry $resource,
        Collection $resourceCollection,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->loggingEntryDataFactory = $loggingEntryDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * Retrieve logging entry model with logging entry data
     *
     * @return LoggingEntryInterface
     */
    public function getDataModel()
    {
        $loggingEntryData = $this->getData();
        $loggingEntryDataObject = $this->loggingEntryDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $loggingEntryDataObject,
            $loggingEntryData,
            LoggingEntryInterface::class
        );

        return $loggingEntryDataObject;
    }
}
