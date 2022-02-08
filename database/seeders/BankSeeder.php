<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $banks = [
      0 => ["name" => "access bank", "slug"  => "access"],
      1 => ["name" => "citibank nigeria ltd", "slug"  => "citibank"],
      2 => ["name" => "diamond bank plc", "slug"  => "diamond"],
      3 => ["name" => "ecobank nigeria plc", "slug"  => "ecobank"],
      4 => ["name" => "fidelity bank plc", "slug"  => "fidelity"],
      5 => ["name" => "first bank of nigeria ltd", "slug"  => "fbn"],
      6 => ["name" => "first city monument bank plc", "slug"  => "fcmb"],
      7 => ["name" => "gauranty trust bank plc", "slug"  => "gtbank"],
      8 => ["name" => "heritage bank plc", "slug"  => "heritage"],
      9 => ["name" => "keystone bank ltd", "slug"  => "keystone"],
      10 => ["name" => "providus bank ltd", "slug"  => "providus"],
      11 => ["name" => "polaris bank ltd", "slug"  => "polaris"],
      12 => ["name" => "stanbic bank plc", "slug"  => "stanbic"],
      13 => ["name" => "standard chartered bank nigeria ltd", "slug"  => "scb"],
      14 => ["name" => "sterling bank plc", "slug"  => "sterling"],
      15 => ["name" => "suntrust bank nigeria ltd", "slug"  => "suntrust"],
    ];

    public function run()
    {
        $bs = Bank::factory()->count(count($this->banks))->state(new Sequence(
          fn ($sequence) => [
            "name" => $this->banks[$sequence->index]["name"],
            "slug" => $this->banks[$sequence->index]["slug"]
        ]
        ))->create();
    }
}
