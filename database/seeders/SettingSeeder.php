<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $settings = array(
            array(
                "id" => 1,
                "key" => "site_name",
                "value" => "site test",
                "created_at" => "2025-02-13 14:23:07",
                "updated_at" => "2025-02-13 14:23:07",
            ),
            array(
                "id" => 2,
                "key" => "site_default_currency",
                "value" => "USD",
                "created_at" => "2025-02-13 14:23:07",
                "updated_at" => "2025-02-13 14:23:07",
            ),
            array(
                "id" => 3,
                "key" => "site_currency_icon",
                "value" => "$",
                "created_at" => "2025-02-13 14:23:07",
                "updated_at" => "2025-02-13 14:23:07",
            ),
            array(
                "id" => 4,
                "key" => "site_currency_icon_position",
                "value" => "right",
                "created_at" => "2025-02-13 14:23:07",
                "updated_at" => "2025-02-13 14:23:07",
            ),
            array(
                "id" => 5,
                "key" => "pusher_app_id",
                "value" => "1941726",
                "created_at" => "2025-02-13 14:24:09",
                "updated_at" => "2025-02-13 17:10:58",
            ),
            array(
                "id" => 6,
                "key" => "pusher_key",
                "value" => "279342d73011222f4f67",
                "created_at" => "2025-02-13 14:24:09",
                "updated_at" => "2025-02-13 17:10:58",
            ),
            array(
                "id" => 7,
                "key" => "pusher_secret",
                "value" => "c6e5f8327b80510662e0",
                "created_at" => "2025-02-13 14:24:09",
                "updated_at" => "2025-02-13 17:10:58",
            ),
            array(
                "id" => 8,
                "key" => "pusher_cluster",
                "value" => "mt1",
                "created_at" => "2025-02-13 14:24:09",
                "updated_at" => "2025-02-13 17:10:58",
            ),
            array(
                "id" => 9,
                "key" => "mail_driver",
                "value" => "smtp",
                "created_at" => "2025-02-24 17:36:27",
                "updated_at" => "2025-02-24 17:39:10",
            ),
            array(
                "id" => 10,
                "key" => "mail_host",
                "value" => "sandbox.smtp.mailtrap.io",
                "created_at" => "2025-02-24 17:36:27",
                "updated_at" => "2025-02-24 17:39:10",
            ),
            array(
                "id" => 11,
                "key" => "mail_port",
                "value" => "2525",
                "created_at" => "2025-02-24 17:36:27",
                "updated_at" => "2025-02-24 17:39:10",
            ),
            array(
                "id" => 12,
                "key" => "mail_username",
                "value" => "3d13d1abfaddcf",
                "created_at" => "2025-02-24 17:36:27",
                "updated_at" => "2025-02-24 17:39:10",
            ),
            array(
                "id" => 13,
                "key" => "mail_password",
                "value" => "d4e648c27b10da",
                "created_at" => "2025-02-24 17:36:27",
                "updated_at" => "2025-02-24 17:39:10",
            ),
            array(
                "id" => 14,
                "key" => "mail_encryption",
                "value" => "tls",
                "created_at" => "2025-02-24 17:36:27",
                "updated_at" => "2025-02-24 17:39:10",
            ),
            array(
                "id" => 15,
                "key" => "mail_from_address",
                "value" => "foodpark@example.com",
                "created_at" => "2025-02-24 17:36:27",
                "updated_at" => "2025-02-24 17:39:10",
            ),
            array(
                "id" => 16,
                "key" => "mail_receive_address",
                "value" => "spport.foodpark@example.com",
                "created_at" => "2025-02-24 17:36:27",
                "updated_at" => "2025-02-24 17:39:10",
            ),
            array(
                "id" => 17,
                "key" => "logo",
                "value" => "/uploads/media_67c305bb34485.png",
                "created_at" => "2025-03-01 13:03:55",
                "updated_at" => "2025-03-01 13:03:55",
            ),
            array(
                "id" => 18,
                "key" => "footer_logo",
                "value" => "/uploads/media_67c305bb3e870.png",
                "created_at" => "2025-03-01 13:03:55",
                "updated_at" => "2025-03-01 13:03:55",
            ),
            array(
                "id" => 19,
                "key" => "breadcumb",
                "value" => "/uploads/media_67c305bb44867.jpg",
                "created_at" => "2025-03-01 13:03:55",
                "updated_at" => "2025-03-01 13:03:55",
            ),
            array(
                "id" => 20,
                "key" => "site_email",
                "value" => "Unifood1@gmail.com",
                "created_at" => "2025-03-01 13:48:10",
                "updated_at" => "2025-03-01 13:54:27",
            ),
            array(
                "id" => 21,
                "key" => "site_phone",
                "value" => "+98487452145214",
                "created_at" => "2025-03-01 13:48:10",
                "updated_at" => "2025-03-01 13:54:27",
            ),
            array(
                "id" => 22,
                "key" => "site_color",
                "value" => "#f86f03",
                "created_at" => "2025-03-01 14:18:08",
                "updated_at" => "2025-03-01 14:21:52",
            ),
            array(
                "id" => 23,
                "key" => "seo_title",
                "value" => "Food Park Web",
                "created_at" => "2025-03-01 14:41:29",
                "updated_at" => "2025-03-01 14:42:58",
            ),
            array(
                "id" => 24,
                "key" => "seo_description",
                "value" => "Food Park Website",
                "created_at" => "2025-03-01 14:41:29",
                "updated_at" => "2025-03-01 14:41:53",
            ),
            array(
                "id" => 25,
                "key" => "seo_keyword",
                "value" => "foodpark",
                "created_at" => "2025-03-01 14:41:29",
                "updated_at" => "2025-03-01 14:41:53",
            ),
        );

        \DB::table('settings')->insert($settings);
    }
}
