<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

uses(RefreshDatabase::class);


abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
}
