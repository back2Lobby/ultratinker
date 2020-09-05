<?php

namespace Back2Future\UltraTinker\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class UltraTinkerInit extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ultratinker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tinker with super powers';


    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        echo shell_exec("cd vendor/back2future/ultratinker/src/UltraTinker;php -S localhost:8989");
    }
}
