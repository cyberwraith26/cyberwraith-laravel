<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('paystack_customer_code')->nullable()->after('remember_token');
            $table->string('paystack_subscription_code')->nullable()->after('paystack_customer_code');
            $table->string('paystack_email_token')->nullable()->after('paystack_subscription_code');
            $table->string('subscription_status')->nullable()->after('paystack_email_token'); // active, cancelled, non-renewing
            $table->timestamp('subscription_ends_at')->nullable()->after('subscription_status');
            $table->timestamp('current_period_end')->nullable()->after('subscription_ends_at');
            $table->string('subscription_plan')->nullable()->after('current_period_end'); // pro, agency
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'paystack_customer_code',
                'paystack_subscription_code',
                'paystack_email_token',
                'subscription_status',
                'subscription_ends_at',
                'current_period_end',
                'subscription_plan',
            ]);
        });
    }
};
