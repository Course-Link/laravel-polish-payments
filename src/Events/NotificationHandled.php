<?php

namespace CourseLink\Payments\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Omnipay\Common\Message\NotificationInterface;

class NotificationHandled
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public string                $gateway,
        public NotificationInterface $notification,
    )
    {

    }
}