<?php
declare(strict_types = 1);
namespace FireGento\WebapiMetrics\Observer;

use Exception;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterfaceFactory;
use FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\Webapi\Rest\Response;
use Magento\Webapi\Controller\Rest\InputParamsResolver;
use Psr\Log\LoggerInterface;

/**
 * Class SendResponseBefore
 */
class SendResponseBefore implements ObserverInterface
{
    /**
     * @var LoggingEntryRepositoryInterface
     */
    private $loggingEntryRepository;

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
     * @var int
     */
    private $eventIdToLog;

    /**
     * @var Response
     */
    private $responseToLog;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private TimezoneInterface $timezone;

    /**
     * SendResponseBefore constructor.
     *
     * @param LoggingEntryInterfaceFactory $loggingEntryInterfaceFactory
     * @param LoggingEntryRepositoryInterface $loggingEntryRepository
     * @param InputParamsResolver $inputParamsResolver
     * @param LoggerInterface $logger
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
     */
    public function __construct(
        LoggingEntryInterfaceFactory $loggingEntryInterfaceFactory,
        LoggingEntryRepositoryInterface $loggingEntryRepository,
        InputParamsResolver $inputParamsResolver,
        LoggerInterface $logger,
        TimezoneInterface $timezone
    ) {
        $this->loggingEntryRepository = $loggingEntryRepository;
        $this->inputParamsResolver = $inputParamsResolver;
        $this->loggingEntryInterfaceFactory = $loggingEntryInterfaceFactory;
        $this->logger = $logger;
        $this->timezone = $timezone;
    }

    /**
     * Execute
     *
     * @param Observer $observer
     *
     * @return void
     * @throws LocalizedException
     */
    public function execute(Observer $observer) : void
    {
        /** @var Http $request */
        $request = $observer->getData('request');
        /** @var Response $response */
        $response = $observer->getData('response');

        try {
            $this->saveLoggingEntry(
                $request->getMethod(),
                $this->inputParamsResolver->getRoute()->getRoutePath(),
                $response->getStatusCode(),
                strlen($response->getBody()),
                0
            );
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
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
        string $method, string $route, int $statusCode, int $size, int $executionTimeMs
    ) : LoggingEntryInterface
    {
        /** @var LoggingEntryInterface $loggingEntry */
        $loggingEntry = $this->loggingEntryInterfaceFactory->create();
        $loggingEntry->setMethod($method);
        $loggingEntry->setRoute($route);
        $loggingEntry->setStatusCode($statusCode);
        $loggingEntry->setSize($size);
        $loggingEntry->setExecutionTimeMs($executionTimeMs);
        $loggingEntry->setCreatedAt(
            $this->timezone->date(null, null, false)->format(\DateTimeInterface::ATOM)
        );

        return $this->loggingEntryRepository->save($loggingEntry);
    }

    /**
     * Log on __destruct
     *
     * @throws LocalizedException
     */
    public function __destruct()
    {
        if ($this->responseToLog instanceof Response) {
            $this->saveLoggingEntry(
                $this->eventIdToLog,
                $this->responseToLog->getStatusCode(),
                $this->responseToLog->getBody()
            );
        }
    }
}
