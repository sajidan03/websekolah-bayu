<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Login Process ===\n\n";

// Get user from database
$user = \App\Models\User::where('username', 'admin')->first();

if (!$user) {
    echo "ERROR: User not found in database!\n";
    exit(1);
}

echo "1. User found in database:\n";
echo "   - Username: " . $user->username . "\n";
echo "   - Role: " . $user->role . "\n";
echo "   - Password: " . $user->password . "\n\n";

// Test password verification
$password = 'admin123';
$verified = password_verify($password, $user->password);
echo "2. Password verification test:\n";
echo "   - Input password: $password\n";
echo "   - Verified: " . ($verified ? "YES" : "NO") . "\n\n";

// Test Laravel's attempt
echo "3. Testing Auth::attempt():\n";
$credentials = [
    'username' => 'admin',
    'password' => 'admin123',
];

// Note: Auth::attempt won't work in CLI without session
// But we can check if credentials would work
$userFromAuth = \Illuminate\Support\Facades\Auth::getProvider()->retrieveByCredentials($credentials);

if ($userFromAuth) {
    echo "   - User retrieved by credentials: YES\n";
    echo "   - Username: " . $userFromAuth->username . "\n";
    
    $loginSuccess = \Illuminate\Support\Facades\Auth::getProvider()->validateCredentials($userFromAuth, $credentials);
    echo "   - Credentials valid: " . ($loginSuccess ? "YES" : "NO") . "\n";
} else {
    echo "   - User retrieved by credentials: NO\n";
}

echo "\n=== Test Complete ===\n";
