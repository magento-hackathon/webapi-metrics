<?php

namespace FireGento\WebapiMetrics\Plugin;

use DateTimeInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterfaceFactory;
use FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\Webapi\Rest\Request;
use Magento\Framework\Webapi\Rest\Response;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Webapi\Controller\Rest\InputParamsResolver;
use Psr\Log\LoggerInterface;

class ResponsePlugin
{
    /**
     * @var InputParamsResolver
     */
    private $inputParamsResolver;

    /**
     * @var LoggingEntryInterfaceFactory
     */
    private $loggingEntryInterfaceFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $timezone;

    /**
     * @var \Magento\Framework\Webapi\Rest\Request
     */
    private $request;

    /**
     * @var \Magento\Framework\Webapi\Rest\Response
     */
    private $response;

    /**
     * @var \FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface
     */
    private $loggingEntryRepository;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * ResponsePlugin constructor.
     * @param \FireGento\WebapiMetrics\Api\Data\LoggingEntryInterfaceFactory $loggingEntryInterfaceFactory
     * @param \FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface $loggingEntryRepository
     * @param \Magento\Webapi\Controller\Rest\InputParamsResolver $inputParamsResolver
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
     * @param \Magento\Framework\Webapi\Rest\Request $request
     * @param \Magento\Framework\Webapi\Rest\Response $response
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        LoggingEntryInterfaceFactory $loggingEntryInterfaceFactory,
        LoggingEntryRepositoryInterface $loggingEntryRepository,
        InputParamsResolver $inputParamsResolver,
        LoggerInterface $logger,
        TimezoneInterface $timezone,
        Request $request,
        Response $response,
        StoreManagerInterface $storeManager
    ) {
        $this->inputParamsResolver = $inputParamsResolver;
        $this->loggingEntryInterfaceFactory = $loggingEntryInterfaceFactory;
        $this->logger = $logger;
        $this->timezone = $timezone;
        $this->request = $request;
        $this->response = $response;
        $this->loggingEntryRepository = $loggingEntryRepository;
        $this->storeManager = $storeManager;
    }

    /**
     * Save logging entry
     *
     * @param int $statusCode
     * @param int $size of body (bytes)
     *
     * @return LoggingEntryInterface
     * @throws LocalizedException
     */
    protected function saveLoggingEntry(
        string $method, string $route, int $statusCode, int $size, int $executionTimeMs, string $storeCode
    ) : LoggingEntryInterface
    {
        /** @var LoggingEntryInterface $loggingEntry */
        $loggingEntry = $this->loggingEntryInterfaceFactory->create();
        $loggingEntry->setStoreCode($storeCode);
        $loggingEntry->setMethod($method);
        $loggingEntry->setRoute($route);
        $loggingEntry->setStatusCode($statusCode);
        $loggingEntry->setSize($size);
        $loggingEntry->setExecutionTimeMs($executionTimeMs);
        $loggingEntry->setCreatedAt(
            $this->timezone->date(null, null, false)->format(DateTimeInterface::ATOM)
        );

        return $this->loggingEntryRepository->save($loggingEntry);
    }

    public function afterSendResponse(ResponseInterface $subject, $result)
    {
        try {
            $this->saveLoggingEntry(
                $this->request->getMethod(),
                $this->inputParamsResolver->getRoute()->getRoutePath(),
                $this->response->getStatusCode(),
                strlen($this->response->getBody()),
                (int)((microtime(true) - $this->request->getServerValue('REQUEST_TIME_FLOAT')) * 1000),
                $storeCode = $this->storeManager->getStore()->getCode()
            );
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }

        return $result;
    }
}
