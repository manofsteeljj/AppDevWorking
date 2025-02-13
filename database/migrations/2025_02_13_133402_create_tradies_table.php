<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tradies', function (Blueprint $table) {
            $table->id('tradie_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('birthdate');
            $table->string('address');
            $table->string('contact_number');
            $table->string('occupation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tradies');
    }
};
