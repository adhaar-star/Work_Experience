<?php
/**
 * Version: 1.0
 * Author: Ultrabytes (harcharan@bytesultra.com)
 * Date: 4/28/2016
 * Time: 5:23 PM
 */

namespace App\Console\Commands;

use App\Models\BuzAlert;
use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Deal;
use App\Models\Event;



class TestCron extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TestCron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing Cron';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

       $this->info("Testing");
           


    }
}

