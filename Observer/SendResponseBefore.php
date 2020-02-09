<?php
declare(strict_types = 1);
namespace FireGento\WebapiMetrics\Observer;

use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingEntryInterfaceFactory;
use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterfaceFactory;
use FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface;
use FireGento\WebapiMetrics\Api\LoggingRouteRepositoryInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Webapi\Rest\Response;
use Magento\Webapi\Controller\Rest\InputParamsResolver;
use Psr\Log\LoggerInterface;

/**
 * Class SendResponseBefore
 */
class SendResponseBefore implements ObserverInterface
{
    /**
     * @var LoggingRouteRepositoryInterface
     */
    private $loggingRouteRepository;

    /**
     * @var LoggingEntryRepositoryInterface
     */
    private $loggingEntryRepository;

    /**
     * @var LoggingRouteInterfaceFactory
     */
    private $loggingRouteInterfaceFactory;

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
     * SendResponseBefore constructor.
     *
     * @param LoggingRouteInterfaceFactory    $loggingRouteInterfaceFactory
     * @param LoggingEntryInterfaceFactory    $loggingEntryInterfaceFactory
     * @param LoggingRouteRepositoryInterface $loggingRouteRepository
     * @param LoggingEntryRepositoryInterface $loggingEntryRepository
     * @param InputParamsResolver             $inputParamsResolver
     * @param LoggerInterface                 $logger
     */
    public function __construct(
        LoggingRouteInterfaceFactory $loggingRouteInterfaceFactory,
        LoggingEntryInterfaceFactory $loggingEntryInterfaceFactory,
        LoggingRouteRepositoryInterface $loggingRouteRepository,
        LoggingEntryRepositoryInterface $loggingEntryRepository,
        InputParamsResolver $inputParamsResolver,
        LoggerInterface $logger
    ) {
        $this->loggingRouteRepository = $loggingRouteRepository;
        $this->loggingEntryRepository = $loggingEntryRepository;
        $this->loggingRouteInterfaceFactory = $loggingRouteInterfaceFactory;
        $this->inputParamsResolver = $inputParamsResolver;
        $this->loggingEntryInterfaceFactory = $loggingEntryInterfaceFactory;
        $this->logger = $logger;
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
            // with params e.g. V1/directory/countries/:countryId
            $routePath = $this->inputParamsResolver->getRoute()->getRoutePath();
            /** @var LoggingRouteInterface $route */
            $route = $this->saveLoggingRoute($request->getMethod(), $routePath);
            $this->eventIdToLog = $route->getEntityId();
            $this->responseToLog = $response;
        } catch (\Exception $exception) {
            $route = $this->saveLoggingRoute($request->getMethod(), $request->getPathInfo());
            $this->saveLoggingEntry($route->getEntityId(), 404, '');
            $this->logger->error($exception->getMessage());
        }
    }

    /**
     * Save logging route
     *
     * @param string $method
     * @param string $routePath
     *
     * @return LoggingRouteInterface
     * @throws LocalizedException
     */
    protected function saveLoggingRoute(string $method, string $routePath) : LoggingRouteInterface
    {
        /** @var LoggingRouteInterface $loggingRoute */
        $loggingRoute = $this->loggingRouteInterfaceFactory->create();
        $loggingRoute->setRouteName($routePath);
        $loggingRoute->setMethodType($method);

        return $this->loggingRouteRepository->save($loggingRoute);
    }

    /**
     * Save logging entry
     *
     * @param int $routeId
     * @param int $statusCode
     * @param string $body
     *
     * @return LoggingEntryInterface
     * @throws LocalizedException
     */
    protected function saveLoggingEntry(int $routeId, int $statusCode, string $body) : LoggingEntryInterface
    {
        /** @var LoggingEntryInterface $loggingEntry */
        $loggingEntry = $this->loggingEntryInterfaceFactory->create();
        $loggingEntry->setRouteId($routeId);
        $loggingEntry->setStatusCode($statusCode);
        $loggingEntry->setSize(strlen($body));

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
