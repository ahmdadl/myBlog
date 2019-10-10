<?php declare(strict_types = 1);

namespace Tests\Setup;

use App\Comment;
use App\Post;
use App\Task;
use App\User;

class PostFactory
{
    private $ownedTo;
    private $commentsCount;
    private $tasksCount;

    public function ownedBy(User $user) : PostFactory
    {
        $this->ownedTo = $user;

        return $this;
    }

    public function withComments(int $count = 1) : PostFactory
    {
        $this->commentsCount = $count;

        return $this;
    }

    public function WithTasks(int $count = 1) : PostFactory
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function create(
        string $methodName = 'create',
        int $num = null
    ) {
        return factory(Post::class, $num)->{$methodName}([
            'userId' => $this->ownedTo ?? factory(User::class)->create()->id
        ]);
    }

    public function createBoth(
        $commentType = 'create',
        $postType = 'create'
    ) : array {
        $post = $this->create($postType);

        $comment = factory(Comment::class)->$commentType([
            'postId' => $post->id,
            'userId' => $post->owner->id
        ]);

        return [$post, $comment];
    }

    public function createBothTasks(
        string $taskType = 'create',
        string $postType = 'create'
    ) : array {
        $post = $this->create($postType);

        $task = factory(Task::class)->$taskType([
            'postId' => $post->id
        ]);

        return [$post, $task];
    }
}