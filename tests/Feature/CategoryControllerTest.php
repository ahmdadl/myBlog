<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCannotCreateCategory()
    {
       $this->get('category/create')->assertRedirect('login');
    }

    public function testUserWithoutPermissionCannotCreateCategory()
    {
        $this->signIn();

        $this->get('category/create')->assertStatus(403);
    }
}
