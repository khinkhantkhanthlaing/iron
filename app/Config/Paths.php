<?php

namespace Config;

/**
 * Paths configuration
 *
 * This file is loaded before the autoloader exists, so it MUST NOT
 * extend any class that requires the autoloader (e.g. BaseConfig).
 */
class Paths
{
    /** Path to the framework system directory. */
    public string $systemDirectory = __DIR__ . '/../../vendor/codeigniter4/framework/system';

    /** Path to the application folder. */
    public string $appDirectory = __DIR__ . '/..';

    /** Path to the writable (logs / cache / session) folder. */
    public string $writableDirectory = __DIR__ . '/../../writable';

    /** Path to the tests directory. */
    public string $testsDirectory = __DIR__ . '/../../tests';

    /** Path to the views directory. */
    public string $viewDirectory = __DIR__ . '/../Views';
}
