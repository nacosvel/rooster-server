<?php

namespace Nacosvel\RoosterServer\Command;

use Nacosvel\Console\Command\Command;

class SeederCommand extends Command
{
    /**
     * @var string|null The default command name
     */
    protected static $defaultName = 'rooster-server:seeder-database';

    /**
     * @var string|null The default command description
     */
    protected static $defaultDescription = 'Seed the rooster-server default files to the database connection.';

    protected function handle(): int
    {
        $this->info('@todo');
        return self::SUCCESS;
    }

}
