<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $client = User::where('email', 'customer@savior.test')->first();
        $staff = User::where('email', 'staff@savior.test')->first();
        $admin = User::where('email', 'admin@savior.test')->first();

        $project = Project::updateOrCreate(
            ['name' => 'Konsultasi Pajak PT Contoh'],
            [
                'description' => 'Proyek konsultasi perpajakan untuk klien contoh.',
                'client_id' => $client->id,
            ]
        );

        $project->members()->syncWithoutDetaching([$staff->id, $admin->id]);
    }
}