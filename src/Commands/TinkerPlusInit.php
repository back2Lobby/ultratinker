<?php

namespace Back2Future\TinkerPlus\Commands;

use Illuminate\App\Console\Command;
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
    protected $description = 'TinkerPlus with super powers';


    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function fire()
    {
        $this->info('Tinkerplus Process Started!');
        return shell_exec("pwd");
    }
}
