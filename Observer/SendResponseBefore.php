<?php

namespace FireGento\WebapiMetrics\Observer;


use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterface;
use FireGento\WebapiMetrics\Api\Data\LoggingRouteInterfaceFactory;
use FireGento\WebapiMetrics\Api\LoggingEntryRepositoryInterface;
use FireGento\WebapiMetrics\Api\LoggingRouteRepositoryInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Webapi\Rest\Response;

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
     * @var \Magento\Webapi\Controller\Rest\InputParamsResolver
     */
    private $inputParamsResolver;

    /**
     * SendResponseBefore constructor.
     * @param LoggingRouteInterfaceFactory $loggingRouteInterfaceFactory
     * @param LoggingRouteRepositoryInterface $loggingRouteRepository
     * @param LoggingEntryRepositoryInterface $loggingEntryRepository
     * @param \Magento\Webapi\Controller\Rest\InputParamsResolver $inputParamsResolver
     */
    public function __construct(
        LoggingRouteInterfaceFactory $loggingRouteInterfaceFactory,
        LoggingRouteRepositoryInterface $loggingRouteRepository,
        LoggingEntryRepositoryInterface $loggingEntryRepository,
        \Magento\Webapi\Controller\Rest\InputParamsResolver $inputParamsResolver
    ) {
        $this->loggingRouteRepository = $loggingRouteRepository;
        $this->loggingEntryRepository = $loggingEntryRepository;
        $this->loggingRouteInterfaceFactory = $loggingRouteInterfaceFactory;
        $this->inputParamsResolver = $inputParamsResolver;
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

        // with params e.g. V1/directory/countries/:countryId
        $routePath = $this->inputParamsResolver->getRoute()->getRoutePath();

        $this->getRouteId($request->getMethod(), $routePath);
    }

    protected function getRouteId(string $method, string $routePath)
    {
        /** @var LoggingRouteInterface $loggingRoute */
        $loggingRoute = $this->loggingRouteInterfaceFactory->create();
        $loggingRoute->setRouteName($routePath);
        $loggingRoute->setMethodType($method);

        $this->loggingRouteRepository->save($loggingRoute);
    }
}