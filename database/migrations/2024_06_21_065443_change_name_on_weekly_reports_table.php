<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameOnWeeklyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            // 作業時間の入力欄を追加する
            $table->date('work_day6')->nullable();
            $table->time('start_time6')->nullable(); 
            $table->time('end_time6')->nullable();
            $table->date('work_day7')->nullable();
            $table->time('start_time7')->nullable(); 
            $table->time('end_time7')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_reports', function (Blueprint $table) {
            // 作業時間の入力欄を削除する
            $table->dropColumn('work_day6');
            $table->dropColumn('start_time6');
            $table->dropColumn('end_time6');
            $table->dropColumn('work_day7');
            $table->dropColumn('start_time7');
            $table->dropColumn('end_time7');
        });
    }
}
