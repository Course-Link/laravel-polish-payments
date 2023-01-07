<?php

namespace CourseLink\Payments\Http\Controllers;

use CourseLink\Payments\Events\NotificationHandled;
use CourseLink\Payments\Events\PurchaseCompleted;
use CourseLink\Payments\GatewayManager;
use Illuminate\Routing\Controller;
use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\NotificationInterface;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function handleNotification(
        string         $gateway,
        GatewayManager $gatewayManager,
    ): Response
    {
        try {
            $gateway = $gatewayManager->gateway($gateway);
        } catch (RuntimeException) {
            return $this->missingMethod();
        }

        if (!$gateway->supportsAcceptNotification()) {
            return $this->missingMethod();
        }

        $notification = $gateway->acceptNotification();

        if (
            $notification->getTransactionStatus() === NotificationInterface::STATUS_COMPLETED &&
            $gateway->supportsCompletePurchase()
        ) {
            $completePurchaseResponse = $gateway->completePurchase($notification->getData())->send();

            PurchaseCompleted::dispatch($completePurchaseResponse);
        }

        NotificationHandled::dispatch(
            $gateway->getName(),
            $notification,
        );

        return $this->successMethod();
    }

    protected function successMethod(): Response
    {
        return new Response('TRUE', 200);
    }

    protected function missingMethod(): Response
    {
        return new Response;
    }
}