<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CustomerType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default(CustomerType::INDIVIDUAL->value);

            // Corporate
            $table->string('company_name')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('tax_office')->nullable();

            // Individual
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('identity_number')->nullable();

            // Contact
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            // Address
            //$table->string('country')->nullable();
            //$table->string('city')->nullable();
            //$table->string('district')->nullable();
            $table->string('address')->nullable();

            // Other
            //$table->string('source')->nullable();
            $table->foreignId('status_id')->nullable()->constrained('customer_statuses')->nullOnDelete();
            $table->foreignId('assigned_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
