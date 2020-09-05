<?php

namespace Back2Future\TinkerPlus\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facade\Hash;
use Symfony\Component\Console\Input\InputArgument;

class TinkerPlusInit extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tinkerplus';

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
        echo shell_exec("cd vendor/back2future/tinkerplus/src/TinkerPlus;php -S localhost:8989");
    }
}
