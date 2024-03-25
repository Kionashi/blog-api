<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Business\Service\CreatePostsService;
use App\Data\Entity\Post;
use App\Data\Repository\PostRepository;

class CreatePostsServiceTest extends TestCase
{
    public function testSuccess()
    {
        $postRepository = $this->createMock(PostRepository::class);
        $postRepository->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Post::class));

        $service = new CreatePostsService($postRepository);
        $service(1, 'Test Post', 'This is a test post');

        $this->addToAssertionCount(1);
    }

    public function testErrorCreatingPostException()
    {
        $postRepository = $this->createMock(PostRepository::class);
        $postRepository->expects($this->once())
            ->method('persist')
            ->willThrowException(new \Exception());

        $this->expectException(\App\Business\Exception\ErrorCreatingPostException::class);

        $service = new CreatePostsService($postRepository);
        $service(1, 'Test Post', 'This is a test post');
    }
}
