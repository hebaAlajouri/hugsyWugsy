<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrdersAddDefaultPaymentMethod extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->default('cash')->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->change(); // removes default but keeps the column
        });
    }
}
