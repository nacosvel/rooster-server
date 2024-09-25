<?php

namespace Nacosvel\RoosterServer;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Fluent;
use Nacosvel\RoosterServer\Contracts\CapsuleManagerInterface;

class CapsuleManager extends Manager implements CapsuleManagerInterface
{
    public function config(string $key = null, $default = null)
    {
        try {
            $config = $this->getContainer()->get('config');
        } catch (\Throwable $exception) {
            $config = new Fluent();
        }

        if (is_null($key)) {
            return $config;
        }

        if ($config->offsetExists($key)) {
            return $config->get($key, $default);
        }

        return value($default);
    }

    /**
     * Register a connection with the manager.
     *
     * @param array  $config
     * @param string $name
     * @param array  $schema
     *
     * @return void
     */
    public function registerConnection(array $config, string $name = 'default', array $schema = []): void
    {
        $connections = $this->container['config']['database.connections'];

        $connections[$name] = $config;

        $this->container['config']['database.default']     = $name;
        $this->container['config']['database.connections'] = $connections;
        foreach ($schema as $key => $value) {
            $this->container['config'][$key] = $value;
        }
    }

}
