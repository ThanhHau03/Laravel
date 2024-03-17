<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnAvatarToStudentsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('students', 'avatar')) {
            Schema::table('students', function (Blueprint $table) {
               $table->string('avatar')->nullable()->after('status');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('students', 'avatar')) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropColumn('avatar');
            });
        }
    }
}
