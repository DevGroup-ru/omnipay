<?php

namespace Omnipay\Robokassa;

use Omnipay\Common\AbstractGateway;
use Omnipay\Robokassa\Message\CompletePurchaseRequest;
use Omnipay\Robokassa\Message\PurchaseRequest;

/**
 * Robokassa Gateway
 * Simple implementation
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Robokassa';
    }

    public function getDefaultParameters()
    {
        return array(
            'MerchantLogin' => '',
            'MerchantPass1' => '',
            'MerchantPass2' => '',
            'testMode' => false,
        );
    }

    public function getMerchantLogin()
    {
        return $this->getParameter('MerchantLogin');
    }

    public function setMerchantLogin($value)
    {
        return $this->setParameter('MerchantLogin', $value);
    }

    public function getMerchantPass1()
    {
        return $this->getParameter('MerchantPass1');
    }

    public function setMerchantPass1($value)
    {
        return $this->setParameter('MerchantPass1', $value);
    }

    public function getMerchantPass2()
    {
        return $this->getParameter('MerchantPass2');
    }

    public function setMerchantPass2($value)
    {
        return $this->setParameter('MerchantPass2', $value);
    }

    /**
     * authorize and immediately capture an amount on the customer's card
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Robokassa\Message\PurchaseRequest', $parameters);
    }

    /**
     * handle return from off-site gateways after purchase
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Robokassa\Message\CompletePurchaseRequest', $parameters);
    }
}
