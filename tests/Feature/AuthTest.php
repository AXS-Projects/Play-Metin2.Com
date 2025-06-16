<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login_requires_credentials(): void
    {
        $response = $this->post('/metin2/login', []);

        $response->assertSessionHasErrors(['login', 'password']);
    }

    public function test_register_page_is_accessible(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
