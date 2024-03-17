<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->after('name');
            $table->string('country')->nullable()->after('address');
            $table->string('district')->nullable()->after('country');
            $table->string('town')->nullable()->after('city');
            $table->string('road_house')->nullable()->after('town');
            $table->string('postcode')->nullable()->after('road_house');
            $table->string('mobile')->nullable()->after('postcode');
            $table->boolean('status')->default(false)->after('postcode');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('district');
            $table->dropColumn('town');
            $table->dropColumn('road_house');
            $table->dropColumn('postcode');
            $table->dropColumn('mobile');
            $table->dropColumn('status');            
        });
    }
};
