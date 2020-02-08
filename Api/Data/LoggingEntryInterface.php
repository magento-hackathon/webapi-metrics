<?php

namespace FireGento\WebapiMetrics\Api\Data;


/**
 * Class LoggingEntryInterface
 * @package FireGento\WebapiMetrics\Api\Data
 */
interface LoggingEntryInterface
{

    const KEY_LOGGINGENTRY_ID = 'entity_id';
    const KEY_ROUTE_ID = 'route_id';
    const KEY_STATUS_CODE = 'status_code';
    const KEY_SIZE = 'size';
    CONST KEY_EXECUTED_AT = 'executed_at';

    /**
     * @return int
     */
    public function getLoggingentryId(): int;

    /**
     * @return int
     */
    public function getRouteId(): int;

    /**
     * @param $routeId
     * @return self
     */
    public function setRouteId($routeId);

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * @param int $statusCode
     * @return self
     */
    public function setStatusCode(int $statusCode);

    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @param int $size
     * @return self
     */
    public function setSize(int $size);

    /**
     * @return string
     */
    public function getExecutedAt(): string;

    /**
     * @param string $executedAt
     * @return self
     */
    public function setExecutedAt(string $executedAt);

}