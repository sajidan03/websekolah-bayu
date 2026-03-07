<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetAdminPassword extends Command
{
    protected $signature = 'app:reset-admin-password';
    protected $description = 'Reset admin password';

    public function handle()
    {
        $password = bcrypt('admin123');
        
        DB::table('users')->updateOrInsert(
            ['username' => 'admin'],
            [
                'name' => 'Admin',
                'password' => $password,
                'role' => 'admin',
            ]
        );
        
        $this->info('Admin password has been reset!');
        $this->info('Username: admin');
        $this->info('Password: admin123');
        $this->info('Password hash: ' . $password);
    }
}
