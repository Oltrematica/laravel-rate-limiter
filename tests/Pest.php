<?php

declare(strict_types=1);

use Oltrematica\RateLimiter\Tests\TestCase;
use Oltrematica\RateLimiter\Tests\UnitTestCase;

uses(TestCase::class)->in(__DIR__.'/Feature');

/**
 * it loads UnitTestCase for the Unit tests
 * This TestCase doesn't load any service provider
 */
uses(UnitTestCase::class)->in(__DIR__.'/Unit');
