<?php

/*
 * This file is part of the Omnipay package.
 *
 * (c) Adrian Macneil <adrian@adrianmacneil.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omnipay\Robokassa\Message;

use Omnipay\Common\Exception\InvalidResponseException;

/**
 * 2Checkout Complete Purchase Request
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        $orderNo = $this->httpRequest->request->get('InvId');
        $amount = $this->httpRequest->request->get('OutSum');

        $key = md5(
            $amount . ":"
            . $orderNo . ":"
            . $this->getMerchantPass1()
            );
        if (strtolower($this->httpRequest->request->get('SignatureValue')) !== $key) {
            var_dump($this->httpRequest->request->all());
            die();
            throw new InvalidResponseException('Invalid signature:'.$key." ".$amount . ":"
            . $orderNo . ":"
            . $this->getMerchantPass1());
        }

        return $this->httpRequest->request->all();
    }

    public function send()
    {
        return $this->response = new CompletePurchaseResponse($this, $this->getData());
    }
}
