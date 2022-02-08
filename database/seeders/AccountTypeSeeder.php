<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\AccountType;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $accountTypes = [
      0 => ["type" => "personal savings", "slug"  => "personal-savings"],
      1 => ["type" => "personal other", "slug"  => "personal-other"],
      2 => ["type" => "current joint", "slug"  => "current-joint"],
      3 => ["type" => "current other", "slug"  => "current-other"],
    ];

    public function run()
    {
      $bs = AccountType::factory()->count(count($this->accountTypes))->state(new Sequence(
          fn ($sequence) => [
            "type" => $this->accountTypes[$sequence->index]["type"],
            "slug" => $this->accountTypes[$sequence->index]["slug"]
          ]
        ))->create();
    }
}
