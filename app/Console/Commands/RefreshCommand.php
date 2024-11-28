<?php

namespace app\Console\Commands;
use Illuminate\Console\Command;
class RefreshCommand extends Command
{
    protected $signature = 'shop:refresh';
    protected $description = 'Refresh';

    public function handle():int
    {
        if(app()->isProduction()){
            return self::FAILURE;
        }

        $this->call('migrate:fresh',[
            '--seed' => true
        ]);

        return self::SUCCESS;
    }

}