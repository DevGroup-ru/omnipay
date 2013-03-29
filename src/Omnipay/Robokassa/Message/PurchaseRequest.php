<?php

namespace Omnipay\Robokassa\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * Robokassa Purchase Request
 */


class PurchaseRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://auth.robokassa.ru/Merchant/Index.aspx';
    protected $testEndpoint = 'http://test.robokassa.ru/Index.aspx';

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

    public function getIncCurrLabel()
    {
        return $this->getParameter('IncCurrLabel');
    }

    public function setIncCurrLabel($value)
    {
        return $this->setParameter('IncCurrLabel', $value);
    }

    public function getOutSum()
    {
        return $this->getParameter('OutSum');
    }

    public function setOutSum($value)
    {
        return $this->setParameter('OutSum', $value);
    }

    public function getInvId()
    {
        return $this->getParameter('InvId');
    }

    public function setInvId($value)
    {
        return $this->setParameter('InvId', $value);
    }

    public function getData()
    {
        

        $data = array();
        $data['MrchLogin'] = $this->getMerchantLogin();

        $data['InvId'] = $this->getTransactionId();
        $data['OutSum'] = $this->getAmount();
        $data['Desc'] = $this->getDescription();

        $data['SignatureValue'] = md5(
            $data['MrchLogin'].":"
            .$data['OutSum'].":"
            .$data['InvId'].":"
            .$this->getMerchantPass1()
        );
        $data['Culture'] = 'ru';

        return $data;
    }



    public function send()
    {
        return $this->response = new PurchaseResponse($this, $this->getData(), $this->getEndpoint());
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
