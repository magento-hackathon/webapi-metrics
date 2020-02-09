<?php

namespace FireGento\WebapiMetrics\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface LoggingEntrySearchResultsInterface
 */
interface LoggingEntrySearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get LoggingEntry list.
     *
     * @return \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface[]
     */
    public function getItems();

    /**
     * Set executed_at list.
     *
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
