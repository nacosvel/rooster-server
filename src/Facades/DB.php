<?php

namespace Nacosvel\RoosterServer\Facades;

use Nacosvel\Facades\Facade;
use Nacosvel\RoosterServer\Contracts\DatabaseManagerInterface;
use RuntimeException;
use function  Nacosvel\Container\Interop\application;
use Nacosvel\RoosterServer\DatabaseManager;

class DB extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        if (false === application()->getContainer()->has(DatabaseManagerInterface::class)) {
            application()->bind(DatabaseManagerInterface::class, function ($app) {
                if (isset($app['db'])) {
                    return new DatabaseManager($app['db']);
                }
                throw new RuntimeException(sprintf('Please bind the instance of %s to the container.', DatabaseManagerInterface::class));
            });
        }
        return DatabaseManagerInterface::class;
    }

    /**
     * Get a resolved facade instance.
     *
     * @return DatabaseManagerInterface
     */
    protected static function getFacadeInstance(): DatabaseManagerInterface
    {
        return application(DatabaseManagerInterface::class);
    }

}
