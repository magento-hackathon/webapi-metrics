<?php

namespace FireGento\WebapiMetrics\Api\Data;


/**
 * Class LoggingEntryInterface
 * @package FireGento\WebapiMetrics\Api\Data
 */
interface LoggingEntryInterface
{
    const KEY_ENTITY_ID = 'entity_id';
    const KEY_ROUTE_ID = 'route_id';
    const KEY_STATUS_CODE = 'status_code';
    const KEY_SIZE = 'size';
    CONST KEY_EXECUTED_AT = 'executed_at';

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $entityId
     * @return int
     */
    public function setEntityId(int $entityId);

    /**
     * @return int
     */
    public function getRouteId();

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
    public function getExecutedAt();

    /**
     * @param string $executedAt
     * @return self
     */
    public function setExecutedAt(string $executedAt);

}
