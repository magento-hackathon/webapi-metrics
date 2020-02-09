<?php

namespace FireGento\WebapiMetrics\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface LoggingRouteSearchResultsInterface
 */
interface LoggingRouteSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get LoggingRoute list.
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface[]
     */
    public function getItems();

    /**
     * Set route_name list.
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
