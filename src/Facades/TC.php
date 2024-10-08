<?php

namespace Nacosvel\RoosterServer\Facades;

use Nacosvel\Facades\Facade;
use Nacosvel\RoosterServer\Contracts\TransactionCoordinatorInterface;
use Nacosvel\RoosterServer\TransactionCoordinator;
use RuntimeException;
use function Nacosvel\Container\Interop\application;

/**
 * @method static string commit()
 * @method static string rollback()
 *
 * @see TransactionCoordinator
 */
class TC extends Facade
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
        if (false === application()->getContainer()->has(TransactionCoordinatorInterface::class)) {
            application()->bind(TransactionCoordinatorInterface::class, function () {
                return new TransactionCoordinator();
            });
        }
        return TransactionCoordinatorInterface::class;
    }

    /**
     * Get a resolved facade instance.
     *
     * @return TransactionCoordinatorInterface
     */
    protected static function getFacadeInstance(): TransactionCoordinatorInterface
    {
        return application(TransactionCoordinatorInterface::class);
    }

}
