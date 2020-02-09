<?php


namespace FireGento\WebapiMetrics\Api\Data;

interface LoggingRouteSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get LoggingRoute list.
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface[]
     */
    public function getItems();

    /**
     * Set route_name list.
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items);
}
