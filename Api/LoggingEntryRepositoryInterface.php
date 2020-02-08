<?php


namespace FireGento\WebapiMetrics\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LoggingEntryRepositoryInterface
{

    /**
     * Save LoggingEntry
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface $loggingEntry
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface $loggingEntry
    );

    /**
     * Retrieve LoggingEntry
     * @param string $loggingentryId
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($loggingentryId);

    /**
     * Retrieve LoggingEntry matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntrySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete LoggingEntry
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface $loggingEntry
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface $loggingEntry
    );

    /**
     * Delete LoggingEntry by ID
     * @param string $loggingentryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($loggingentryId);
}
