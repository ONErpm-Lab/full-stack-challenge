<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\ApiToken;

class GenerateApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-api-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate api token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $domain = $this->ask('For which domain?');
        if (!$domain) {
            $this->error('domain is required');
            return 1;
        }

        $token = ApiToken::randomToken();
        ApiToken::create([
            'domain' => $domain,
            'token' => $token,
        ]);

        $this->info('API key generated successfully!');

        $this->line('Usage: Authorization: Bearer <token>');

        $this->table(
            ['domain', 'token'],
            [['domain' => $domain, 'token' => $token]],
        );

        return 0;
    }
}
