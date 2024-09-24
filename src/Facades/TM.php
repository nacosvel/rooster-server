<?php

namespace Nacosvel\RoosterServer\Facades;

use Nacosvel\Facades\Facade;
use Nacosvel\RoosterServer\Contracts\TransactionManagerInterface;
use Nacosvel\RoosterServer\TransactionManager;
use RuntimeException;
use function Nacosvel\Container\Interop\application;

class TM extends Facade
{
    const ACTION_START            = 1;
    const ACTION_END              = 2;
    const ACTION_PREPARE          = 4;
    const ACTION_PREPARE_COMMIT   = 8;
    const ACTION_PREPARE_ROLLBACK = 16;
    const ACTION_COMMIT           = 32;
    const ACTION_ROLLBACK         = 64;

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        if (false === application()->getContainer()->has(TransactionManagerInterface::class)) {
            application()->bind(TransactionManagerInterface::class, function () {
                return new TransactionManager();
            });
        }
        return TransactionManagerInterface::class;
    }

    /**
     * Get a resolved facade instance.
     *
     * @return TransactionManagerInterface
     */
    protected static function getFacadeInstance(): TransactionManagerInterface
    {
        return application(TransactionManagerInterface::class);
    }

}
