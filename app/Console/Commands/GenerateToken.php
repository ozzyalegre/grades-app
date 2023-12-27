<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:generate {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a token for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        $user = User::find($userId);

        if (!$user) {
            $this->error('User not found!');
            return;
        }

        $token = $user->createToken('token-name')->plainTextToken;

        $this->info("Token for user {$user->name} (ID: {$user->id}):");
        $this->line($token);
    }
}
