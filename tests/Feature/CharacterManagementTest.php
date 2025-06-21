<?php
namespace Tests\Feature;

use Tests\TestCase;

class CharacterManagementTest extends TestCase
{
    public function test_character_management_requires_authentication(): void
    {
        $response = $this->get('/characters');
        $response->assertRedirect('/');
    }
}
