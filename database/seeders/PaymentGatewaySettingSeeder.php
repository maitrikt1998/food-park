<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_gateway_settings = $payment_gateway_settings = array(
            array(
                "id" => 1,
                "key" => "paypal_logo",
                "value" => "/uploads/media_67ae0167f229a.png",
                "created_at" => "2025-02-13 14:27:52",
                "updated_at" => "2025-02-13 14:27:52",
            ),
            array(
                "id" => 2,
                "key" => "paypal_status",
                "value" => "1",
                "created_at" => "2025-02-13 14:27:52",
                "updated_at" => "2025-02-13 14:27:52",
            ),
            array(
                "id" => 3,
                "key" => "paypal_account_mode",
                "value" => "sandbox",
                "created_at" => "2025-02-13 14:27:52",
                "updated_at" => "2025-02-13 14:27:52",
            ),
            array(
                "id" => 4,
                "key" => "paypal_country",
                "value" => "US",
                "created_at" => "2025-02-13 14:27:52",
                "updated_at" => "2025-02-13 14:27:52",
            ),
            array(
                "id" => 5,
                "key" => "paypal_currency",
                "value" => "USD",
                "created_at" => "2025-02-13 14:27:52",
                "updated_at" => "2025-02-13 14:27:52",
            ),
            array(
                "id" => 6,
                "key" => "paypal_rate",
                "value" => "1",
                "created_at" => "2025-02-13 14:27:52",
                "updated_at" => "2025-02-13 14:27:52",
            ),
            array(
                "id" => 7,
                "key" => "paypal_api_key",
                "value" => "AXKWbVAW2EAMWyirIF9x-x9-lck2xdydVYIsAosS7EGvfMX-lWKI-C3FMSjuRlsffB_h9m30xOD5u3Vl",
                "created_at" => "2025-02-13 14:27:52",
                "updated_at" => "2025-02-13 14:27:52",
            ),
            array(
                "id" => 8,
                "key" => "paypal_secret_key",
                "value" => "EFuQHnO8GoUsnA-M-wEyoZKphMJelSS2uPocxIG7QR2B76yk4lG_Hw0osp1EfhCKTGYR47Yq85bhmCrp",
                "created_at" => "2025-02-13 14:27:52",
                "updated_at" => "2025-02-13 14:27:52",
            ),
            array(
                "id" => 9,
                "key" => "stripe_logo",
                "value" => "/uploads/media_67ae01bfbda9f.png",
                "created_at" => "2025-02-13 14:29:19",
                "updated_at" => "2025-02-13 14:29:19",
            ),
            array(
                "id" => 10,
                "key" => "stripe_status",
                "value" => "1",
                "created_at" => "2025-02-13 14:29:19",
                "updated_at" => "2025-02-13 14:29:19",
            ),
            array(
                "id" => 11,
                "key" => "stripe_country",
                "value" => "US",
                "created_at" => "2025-02-13 14:29:19",
                "updated_at" => "2025-02-13 14:29:19",
            ),
            array(
                "id" => 12,
                "key" => "stripe_currency",
                "value" => "USD",
                "created_at" => "2025-02-13 14:29:19",
                "updated_at" => "2025-02-13 14:29:19",
            ),
            array(
                "id" => 13,
                "key" => "stripe_rate",
                "value" => "1",
                "created_at" => "2025-02-13 14:29:19",
                "updated_at" => "2025-02-13 14:29:19",
            ),
            array(
                "id" => 14,
                "key" => "stripe_api_key",
                "value" => "pk_test_51QkljPAIMOjtKASmQRpFZafDzZzDQeQUi4i6Mc20cNOR5WSJKUdj92frAWsE68XeqpsrbaDKLe1XWtQEpZ2W3QKA00Zv2DHN3J",
                "created_at" => "2025-02-13 14:29:19",
                "updated_at" => "2025-02-13 14:29:19",
            ),
            array(
                "id" => 15,
                "key" => "stripe_secret_key",
                "value" => "sk_test_51QkljPAIMOjtKASmDy5hvDSzHoZDa2Qs9zoxWtEz4vLlhijb0h82Y1SFc3duYKZXU7fayuLfpYvtD6rpzjQWBfrc00GucUk1p8",
                "created_at" => "2025-02-13 14:29:19",
                "updated_at" => "2025-02-13 14:29:19",
            ),
        );

        \DB::table('payment_gateway_settings')->insert($payment_gateway_settings);
    }
}
