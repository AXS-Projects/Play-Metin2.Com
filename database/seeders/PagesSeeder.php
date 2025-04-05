<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesSeeder extends Seeder
{
    public function run()
    {
        Page::updateOrCreate(['title' => 'Privacy Policy'], [
            'content' => 'Your privacy policy text here...'
        ]);

        Page::updateOrCreate(['title' => 'Terms of Service'], [
            'content' => 'Your terms of service text here...'
        ]);
    }
}

