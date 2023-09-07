<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Reimbursement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $toTruncate = ['users','reimbursements'];

    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();
      
        $this->call(UsersSeeder::class);
        $this->call(ReimbursementSeeder::class);
        
        Model::reguard();
    }
}