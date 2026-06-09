<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // modify this to your own needs
        SitemapGenerator::create(config('app.url').'/united-states/any-land')
        ->hasCrawled(function (Url $url) {
             if ($url->segment(1) === 'contact') {
                 $url->setPriority(0.9)
                 ->setLastModificationDate(Carbon::create('2016', '1', '1'));
             }

             return $url;
         })
        ->writeToFile(public_path('sitemap.xml'));

    }
}