<?php

namespace ArtisanBR\StarterPack\Commands;

use Illuminate\Console\Command;

class StarterPackCommand extends Command
{
    public $signature = 'starter-pack';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
