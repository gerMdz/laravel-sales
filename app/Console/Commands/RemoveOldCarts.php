<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;

class RemoveOldCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carts:remove-old {--days=7 : Los días después de los cuales los carts serán removidos }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old carts from a given set of days.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $deadline = now()->subDay($this->option('days'));
        $counter = Cart::whereDate('updated_at', '<=', $deadline)->delete();

        $this->info("Realizado. Se removieron {$counter} carts" );
    }
}
