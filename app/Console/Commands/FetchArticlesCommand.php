<?php

namespace App\Console\Commands;

use App\Jobs\FetchArticlesFromAllProviders;
use Illuminate\Console\Command;

class FetchArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:fetch
                            {--keyword= : Search keyword}
                            {--category= : Filter by category}
                            {--from= : From date (YYYY-MM-DD)}
                            {--to= : To date (YYYY-MM-DD)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch jobs to fetch articles from all news providers';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Dispatching article fetch jobs...');

        $params = array_filter([
            'keyword' => $this->option('keyword'),
            'category' => $this->option('category'),
            'from' => $this->option('from'),
            'to' => $this->option('to'),
        ]);

        FetchArticlesFromAllProviders::dispatchSync($params);

        $this->info('Jobs dispatched successfully!');
        $this->comment('Check Horizon dashboard to monitor progress.');

        if (! empty($params)) {
            $this->table(
                ['Parameter', 'Value'],
                collect($params)->map(fn ($value, $key) => [$key, $value])->values()
            );
        }

        return self::SUCCESS;
    }
}
