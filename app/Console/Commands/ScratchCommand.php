<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Enums\CategoryType;
use Aliziodev\LaravelTaxonomy\Facades\Taxonomy;

class ScratchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scratch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Blank command used for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {

    }
}
