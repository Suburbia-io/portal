<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $superAdminEmail = env('SUPER_ADMIN_EMAIL');
        $superAdminName = env('SUPER_ADMIN_NAME');

        if (empty($superAdminEmail) || empty($superAdminName)) {
            return;
        }

        $this->addAdminIfNotExists($superAdminEmail, $superAdminName);
    }

    private function addAdminIfNotExists(string $email, string $name) {
        $user = User::where('email', $email)->first();
        if (empty($user)) {
            User::create([
                'email' => $email,
                'name' => $name,
                'is_admin' => true,
            ]);
        }
    }
}
