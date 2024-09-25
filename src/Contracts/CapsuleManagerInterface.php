<?php

namespace Nacosvel\RoosterServer\Contracts;

interface CapsuleManagerInterface
{
    public function config(string $key = null, $default = null);

    /**
     * Register a connection with the manager.
     *
     * @param array  $config
     * @param string $name
     * @param array  $schema
     *
     * @return void
     */
    public function registerConnection(array $config, string $name = 'default', array $schema = []): void;

}
