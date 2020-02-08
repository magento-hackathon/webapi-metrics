<?php

namespace FireGento\WebapiMetrics\Observer;


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
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var Http $request */
        $request = $observer->getData('request');
        /** @var Response $response */
        $response = $observer->getData('response');
    }
}