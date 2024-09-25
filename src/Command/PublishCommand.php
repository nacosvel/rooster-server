<?php

namespace Nacosvel\RoosterServer\Command;

use Nacosvel\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;

class PublishCommand extends Command
{
    /**
     * @var string|null The default command name
     */
    protected static $defaultName = 'rooster-server:publish-database-config';

    /**
     * @var string|null The default command description
     */
    protected static $defaultDescription = 'Publish the rooster-server database files to path.';

    protected function handle(): int
    {
        $path = realpath('./') . '/' . $this->argument('path');

        is_dir($path) || mkdir($path, 0777, true);

        foreach (glob(__DIR__ . '/../../config/*.php') as $file) {
            $target = $path . '/' . basename($file);
            if (file_exists($target)) {
                $this->error(sprintf('%s already exists.', $target));
                continue;
            }
            copy($file, $target);
            $this->info(sprintf('%s publish successfully.', $target));
        }

        return self::SUCCESS;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['path', InputArgument::OPTIONAL, 'The relative path given with respect to the current file path.', 'config'],
        ];
    }

}
