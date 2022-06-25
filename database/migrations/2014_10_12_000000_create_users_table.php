<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users'))
        {
            Schema::create('users', function (Blueprint $table) {
                $table->uuid('id')->default(DB::raw('(gen_random_uuid())'));
                $table->primary('id');
                $table->string('username',30)->unique();
                $table->string('email')->unique()->nullable(true);;
                $table->string('namalengkap',50)->nullable(true);
                // $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->uuid('role_id')->nullable(true);
                $table->enum('status',[1,2,3])->default(1);
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('users');
    }
};
