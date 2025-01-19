<?php

namespace Primecorecz\Links\Commands;

use Illuminate\Console\Command;

class LinksCommand extends Command
{
    public $signature = 'links';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
