
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('device_type_id');
            $table->foreign('device_type_id')->references('id')->on('device_types')->onDelete('cascade');

            $table->unsignedBigInteger('device_brand_id');
            $table->foreign('device_brand_id')->references('id')->on('device_brands')->onDelete('cascade');

            $table->unsignedBigInteger('device_model_id');
            $table->foreign('device_model_id')->references('id')->on('device_models')->onDelete('cascade');

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
