<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = \App\Models\User::where('username', 'admin')->first();

if ($user) {
    echo "Username: " . $user->username . "\n";
    echo "Password hash: " . $user->password . "\n";
    echo "Role: " . $user->role . "\n";
    
    // Test password
    if (password_verify('admin123', $user->password)) {
        echo "Password verification: SUCCESS\n";
    } else {
        echo "Password verification: FAILED\n";
    }
} else {
    echo "User not found\n";
}
