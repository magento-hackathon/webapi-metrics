<?php


namespace FireGento\WebapiMetrics\Model;

use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;
use FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingEntrySearchResultsInterfaceFactory;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry as ResourceLoggingEntry;
use FireGento\WebapiMetrics\Model\ResourceModel\LoggingEntry\CollectionFactory as LoggingEntryCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

/**
 * Class LoggingEntryRepository
 */
class LoggingEntryRepository implements LoggingEntryRepositoryInterface
{
    /**
     * @var ResourceLoggingEntry
     */
    protected $resource;

    /**
     * @var LoggingEntryFactory
     */
    protected $loggingEntryFactory;

    /**
     * @var LoggingEntryCollectionFactory
     */
    protected $loggingEntryCollectionFactory;

    /**
     * @var LoggingEntrySearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var LoggingEntryInterfaceFactory
     */
    protected $dataLoggingEntryFactory;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ResourceLoggingEntry $resource
     * @param LoggingEntryFactory $loggingEntryFactory
     * @param LoggingEntryInterfaceFactory $dataLoggingEntryFactory
     * @param LoggingEntryCollectionFactory $loggingEntryCollectionFactory
     * @param LoggingEntrySearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceLoggingEntry $resource,
        LoggingEntryFactory $loggingEntryFactory,
        LoggingEntryInterfaceFactory $dataLoggingEntryFactory,
        LoggingEntryCollectionFactory $loggingEntryCollectionFactory,
        LoggingEntrySearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->loggingEntryFactory = $loggingEntryFactory;
        $this->loggingEntryCollectionFactory = $loggingEntryCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataLoggingEntryFactory = $dataLoggingEntryFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(LoggingEntryInterface $loggingEntry)
    {
        $loggingEntryData = $this->extensibleDataObjectConverter->toNestedArray(
            $loggingEntry,
            [],
            LoggingEntryInterface::class
        );

        $loggingEntryModel = $this->loggingEntryFactory->create()->setData($loggingEntryData);

        try {
            $this->resource->save($loggingEntryModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the loggingEntry: %1',
                $exception->getMessage()
            ));
        }

        return $loggingEntryModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($loggingEntryId)
    {
        $loggingEntry = $this->loggingEntryFactory->create();
        $this->resource->load($loggingEntry, $loggingEntryId);
        if (!$loggingEntry->getId()) {
            throw new NoSuchEntityException(__('LoggingEntry with id "%1" does not exist.', $loggingEntryId));
        }
        return $loggingEntry->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->loggingEntryCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            LoggingEntryInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        LoggingEntryInterface $loggingEntry
    ) {
        try {
            $loggingEntryModel = $this->loggingEntryFactory->create();
            $this->resource->load($loggingEntryModel, $loggingEntry->getEntityId());
            $this->resource->delete($loggingEntryModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the LoggingEntry: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($loggingEntryId)
    {
        return $this->delete($this->get($loggingEntryId));
    }
}
