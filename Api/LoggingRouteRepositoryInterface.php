<?php

namespace FireGento\WebapiMetrics\Api;

/**
 * Interface LoggingRouteRepositoryInterface
 */
interface LoggingRouteRepositoryInterface
{
    /**
     * Save LoggingRoute
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface $loggingRoute
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface $loggingRoute
    );

    /**
     * Retrieve LoggingRoute
     *
     * @param string $loggingrouteId
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($loggingrouteId);

    /**
     * Retrieve LoggingRoute matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete LoggingRoute
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface $loggingRoute
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface $loggingRoute
    );

    /**
     * Delete LoggingRoute by ID
     *
     * @param string $loggingrouteId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($loggingrouteId);
}
