<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Student;

class CreateStudentsTable extends Migration
{
   
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('course');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
