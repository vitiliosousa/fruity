<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Criar usuário administrador para desenvolvimento.
     *
     * AVISO: Esta senha é fraca e deve ser alterada em produção!
     * Use este seeder apenas em ambiente de desenvolvimento/teste.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✓ Usuário admin criado/atualizado com sucesso!');
        $this->command->warn('⚠ Email: admin@example.com | Senha: password123');
        $this->command->warn('⚠ ALTERE ESTA SENHA EM PRODUÇÃO!');
    }
}
