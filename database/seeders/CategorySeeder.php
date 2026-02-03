<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'Biblical Studies & Theology',
            'Christian Living & Discipleship',
            'Christian Ethics & Morality',
            'Testimonies & Personal Journeys',
            'Church & Ministry',
            'Christian Philosophy & Apologetics',
            'Christian Culture & Media',
            'End Times & Prophecy',
            'Mental Health & Well-being',
            'Encouragement & Inspirational Messages',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
