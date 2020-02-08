<?php

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
use Magento\Framework\Webapi\Rest\Response;
use Magento\Webapi\Controller\Rest\InputParamsResolver;

/**
 * Class SendResponseBefore
 * @package FireGento\WebapiMetrics\Observer
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
     * SendResponseBefore constructor.
     * @param LoggingRouteInterfaceFactory $loggingRouteInterfaceFactory
     * @param LoggingEntryInterfaceFactory $loggingEntryInterfaceFactory
     * @param LoggingRouteRepositoryInterface $loggingRouteRepository
     * @param LoggingEntryRepositoryInterface $loggingEntryRepository
     * @param InputParamsResolver $inputParamsResolver
     */
    public function __construct(
        LoggingRouteInterfaceFactory $loggingRouteInterfaceFactory,
        LoggingEntryInterfaceFactory $loggingEntryInterfaceFactory,
        LoggingRouteRepositoryInterface $loggingRouteRepository,
        LoggingEntryRepositoryInterface $loggingEntryRepository,
        InputParamsResolver $inputParamsResolver
    ) {
        $this->loggingRouteRepository = $loggingRouteRepository;
        $this->loggingEntryRepository = $loggingEntryRepository;
        $this->loggingRouteInterfaceFactory = $loggingRouteInterfaceFactory;
        $this->inputParamsResolver = $inputParamsResolver;
        $this->loggingEntryInterfaceFactory = $loggingEntryInterfaceFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var Http $request */
        $request = $observer->getData('request');
        /** @var Response $response */
        $response = $observer->getData('response');

        try {
            // with params e.g. V1/directory/countries/:countryId
            $routePath = $this->inputParamsResolver->getRoute()->getRoutePath();

            /** @var LoggingRouteInterface $route */
            $route = $this->getRouteId($request->getMethod(), $routePath);

            $this->saveLoggingEntry($route->getEntityId(), $response);
        } catch (\Exception $exception) {
            //TODO Add logger exception
        }
    }

    /**
     * @param string $method
     * @param string $routePath
     * @return LoggingRouteInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function getRouteId(string $method, string $routePath)
    {
        /** @var LoggingRouteInterface $loggingRoute */
        $loggingRoute = $this->loggingRouteInterfaceFactory->create();
        $loggingRoute->setRouteName($routePath);
        $loggingRoute->setMethodType($method);

       return $this->loggingRouteRepository->save($loggingRoute);
    }

    protected function saveLoggingEntry(int $routeId, Response $response)
    {
        /** @var LoggingEntryInterface $loggingEntry */
        $loggingEntry = $this->loggingEntryInterfaceFactory->create();
        $loggingEntry->setRouteId($routeId);
        $loggingEntry->setStatusCode($response->getStatusCode());
        $loggingEntry->setSize(0);

        return $this->loggingEntryRepository->save($loggingEntry);
    }
}
