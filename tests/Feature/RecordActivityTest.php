<?php

namespace Tests\Feature;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\PostFactory;
use Facades\Tests\Setup\UserFactory;
use Tests\TestCase;

class RecordActivityTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCreatingPostRecordsActivity()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $this->assertCount(1, $post->activity);

        $this->assertEquals(
            'create_post',
            $post->activity->last()->info
        );
    }

    public function testUpdatingPostRecordsActivity()
    {
        $this->withoutExceptionHandling();

        $post = PostFactory::ownedBy($this->signIn())->create();

        $post->body = $this->faker->text;
        $post->img = null;

        $this->patch(
            $post->path(),
            $post->attributesToArray(),
            $this->setReferer($post->path())
        )->assertRedirect($post->path());

        $this->assertCount(2, $post->activity);

        $this->assertEquals(
            'update_post',
            $post->activity->last()->info
        );

        tap($post->activities()->first(), function ($activity) use ($post) {
            $this->get($post->path())
                ->assertSee($activity->info)
                ->assertSee($activity->owner->name);
        });
    }

    public function testAddingMemberToPostRecordActivity()
    {
        $this->withoutExceptionHandling();

        $post = PostFactory::ownedBy($this->signIn())->create();

        $anotherUser = UserFactory::create();

        $post->invite($anotherUser);
        
        tap(
            $post->activities->last(),
            function ($activity) use ($post) {
                $this->assertEquals(
                    $activity->owner->name,
                    $post->owner->name
                );

                $this->assertEquals(
                    'add_member',
                    $activity->info
                );
        });
    }

    public function testAddingPostCategoryRecordsActivity()
    {
        $post = PostFactory::ownedBy($this->signIn())->create();

        $category = factory(Category::class)->create();

        $post->addCategory($category->id);

        $this->assertEquals(
            'create_post_category',
            $post->activities->last()->info
        );
    }

    public function testCreatingCommentRecordsActivity()
    {
        [$post, $comment] = PostFactory::withComments()
            ->ownedBy(UserFactory::create())
            ->createBoth('make');

        $user = $this->signIn();

        $this->post(
                $post->path() . '/comments',
                $comment->only('body'),
                $this->setReferer($post->path())
            )->assertRedirect($post->path());

        tap($post->activities->last(), function ($activity) use ($post, $user) {
            $this->assertNotEquals(
                $post->owner->id, 
                $activity->owner->id
            );
            $this->assertEquals($activity->owner->name, $user->name);
            $this->assertEquals('create_comment', $activity->info);
        });
    }
}
