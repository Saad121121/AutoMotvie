
use Illuminate\Database\Migrations\Migration;
<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sell_my_cars', function (Blueprint $table) {
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::table('sell_my_cars', function (Blueprint $table) {
        $table->dropColumn('upload_image');
    });
    }
};

