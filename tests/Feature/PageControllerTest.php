<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_can_be_resolved_by_slug(): void
    {
        $page = Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => 'content'
        ]);

        $response = $this->get('/page/'.$page->slug);

        $response->assertStatus(200);
        $response->assertSee('content');
    }
}
