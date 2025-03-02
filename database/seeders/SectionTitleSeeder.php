<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectionTitle = $section_titles = array(
            array(
                "id" => 1,
                "key" => "why_choose_top_title",
                "value" => "testimonial update",
                "created_at" => NULL,
                "updated_at" => "2025-02-17 08:06:00",
            ),
            array(
                "id" => 2,
                "key" => "why_choose_main_title",
                "value" => "our customar feedbacks update",
                "created_at" => NULL,
                "updated_at" => "2025-02-17 08:06:00",
            ),
            array(
                "id" => 3,
                "key" => "why_choose_sub_title",
                "value" => "Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.",
                "created_at" => NULL,
                "updated_at" => "2025-02-17 08:06:00",
            ),
            array(
                "id" => 4,
                "key" => "daily_offer_top_title",
                "value" => "daily offer update",
                "created_at" => "2025-02-14 13:31:05",
                "updated_at" => "2025-02-14 13:31:05",
            ),
            array(
                "id" => 5,
                "key" => "daily_offer_main_title",
                "value" => "up to 45% off for this day",
                "created_at" => "2025-02-14 13:31:05",
                "updated_at" => "2025-02-14 13:37:16",
            ),
            array(
                "id" => 6,
                "key" => "daily_offer_sub_title",
                "value" => "Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.",
                "created_at" => "2025-02-14 13:31:05",
                "updated_at" => "2025-02-14 13:31:05",
            ),
            array(
                "id" => 7,
                "key" => "chefs_top_title",
                "value" => "our team update",
                "created_at" => "2025-02-15 08:54:44",
                "updated_at" => "2025-02-15 08:54:44",
            ),
            array(
                "id" => 8,
                "key" => "chefs_main_title",
                "value" => "meet our expert chefs",
                "created_at" => "2025-02-15 08:54:44",
                "updated_at" => "2025-02-15 08:54:44",
            ),
            array(
                "id" => 9,
                "key" => "chefs_sub_title",
                "value" => "Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.",
                "created_at" => "2025-02-15 08:54:44",
                "updated_at" => "2025-02-15 08:54:44",
            ),
            array(
                "id" => 10,
                "key" => "testimonial_top_title",
                "value" => "testimonial up",
                "created_at" => "2025-02-17 08:09:22",
                "updated_at" => "2025-02-17 08:09:22",
            ),
            array(
                "id" => 11,
                "key" => "testimonial_main_title",
                "value" => "our customar feedbacks update",
                "created_at" => "2025-02-17 08:09:22",
                "updated_at" => "2025-02-17 08:09:22",
            ),
            array(
                "id" => 12,
                "key" => "testimonial_sub_title",
                "value" => "Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.",
                "created_at" => "2025-02-17 08:09:22",
                "updated_at" => "2025-02-17 08:09:22",
            ),
        );

        \DB::table('section_titles')->insert($sectionTitle);

    }
}
