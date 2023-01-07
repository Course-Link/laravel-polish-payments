<?php

namespace CourseLink\Payments\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Omnipay\Common\Message\AbstractResponse;

class PurchaseCompleted
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public AbstractResponse $response,
    )
    {
    }
}