<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_reports', function (Blueprint $table) {
            $table->integer('name_id'); // 投稿者ID
            $table->string('name'); // 投稿者
            $table->integer('key_number'); // キー番号
            $table->text('post'); // 投稿
            $table->text('concern')->nullable(); // 懸念点
            $table->text('schedule')->nullable(); // 来週の予定
            $table->date('reporting_date'); // 報告日
            $table->date('work_day1')->nullable(); // 出勤日1
            $table->time('start_time1')->nullable(); // 出社時刻1
            $table->time('end_time1')->nullable(); // 退社時刻1
            $table->date('work_day2')->nullable(); // 出勤日2
            $table->time('start_time2')->nullable(); // 出社時刻2
            $table->time('end_time2')->nullable(); // 退社時刻2
            $table->date('work_day3')->nullable(); // 出勤日3
            $table->time('start_time3')->nullable(); // 出社時刻3
            $table->time('end_time3')->nullable(); // 退社時刻3
            $table->date('work_day4')->nullable(); // 出勤日4
            $table->time('start_time4')->nullable(); // 出社時刻4
            $table->time('end_time4')->nullable(); // 退社時刻4
            $table->date('work_day5')->nullable(); // 出勤日5
            $table->time('start_time5')->nullable(); // 出社時刻5
            $table->time('end_time5')->nullable(); // 退社時刻5
            $table->date('first_day'); // 作業期間1
            $table->date('last_day'); // 作業期間2
            $table->primary(['name_id', 'name', 'key_number']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weekly_reports');
    }
}
