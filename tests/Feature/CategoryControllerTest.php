<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Facades\Tests\Setup\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testGuestCannotCreateCategory()
    {
       $this->get('category/create')->assertRedirect('login');
    }

    public function testUserWithoutPermissionCannotCreateCategory()
    {
        $this->signIn();

        $this->get('category/create')->assertStatus(403);
    }

    public function testUserWithPermissionCanCreateCategory()
    {
        $this->withoutExceptionHandling();

        // create a user and give him permission to add new categories
        UserFactory::admin()->givePermTo(
            $user = $this->signIn(),
            User::ADD_CATEGORIES
        );

        $this->get('category/create')
            ->assertOk()
            ->assertViewIs('category.create');
        
        $category = factory(Category::class)->make();
        
        $this->post(
            'category',
            $category->only('title')
        )->assertRedirect('/posts');

        $this->assertDatabaseHas('categories', $category->toArray());

        $this->get('/posts')
            ->assertSee($category->title);
    }
}
