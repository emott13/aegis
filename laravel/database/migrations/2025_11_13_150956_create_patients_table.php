<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void                                                          // run the migrations
    {
        Schema::create(table: 'patients', callback: function (Blueprint $table): void 
        {
            $table  ->  id              (column: 'patient_id');
            $table  ->  string          (column: 'family_code', length: 20)->nullable();
            $table  ->  string          (column: 'care_group', length: 10);
            $table  ->  date            (column: 'admission_date');
            $table  ->  integer         (column: 'bill_amount')->default(value: 0);

            $table  ->  foreignId       (column: 'user_id')                             // FKID
                    ->  constrained     (table: 'users', column: 'user_id')             // CONSTRAINED
                    ->  onDelete        (action: 'cascade');                            // DELETES related parent--child records

            $table  ->  rememberToken   ();
            $table  ->  timestamps      ();

            // $table  ->  check("care_group IN ('red','blue','green','yellow')");      // not handled by laravel natively, needs controller or form request check instead
            // $table  ->  index(columns: 'care_group');
        });
    }

    public function down(): void                                                        // reverse the migrations
    {
        Schema::dropIfExists(table: 'patients');
    }
};
