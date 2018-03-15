<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerUserDefaultCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared('
        CREATE TRIGGER trg_User_Default_Category AFTER INSERT ON `users` FOR EACH ROW
            BEGIN
                INSERT INTO categories (`userId`, `name`, `created_at`, `updated_at`) 
                VALUES (NEW.id, \'Default\', now(), now());
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::unprepared('DROP TRIGGER trg_User_Default_Category');
    }
}
