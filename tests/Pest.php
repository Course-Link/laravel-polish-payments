<?php

use CourseLink\Payments\GatewayManager;
use CourseLink\Payments\Tests\TestCase;

uses(TestCase::class)->in('.');

function getGatewayManager(): GatewayManager
{
    return resolve(GatewayManager::class);
}