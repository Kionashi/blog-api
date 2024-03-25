<?php

namespace Tests\Unit;

use App\Business\Dto\FindPostsOutDto;
use PHPUnit\Framework\TestCase;
use App\Business\Service\FindPostsService;
use App\Data\Repository\PostRepository;
use App\Data\Repository\AuthorRepository;
use App\Business\Exception\InvalidPostResponseException;
use App\Business\Exception\PostNotFoundException;
use App\Business\Exception\InvalidAuthorResponseException;
use App\Data\Entity\Author;
use App\Data\Entity\Post;
use Exception;

class FindPostsServiceTest extends TestCase
{
    public function testSuccess()
    {
        $postId = 1;
        $post = new Post(
            id: $postId,
            title: 'Test Post',
            body: 'This is a test post',
            authorId: 2
        );

        $author = new Author(
            id:2,
            name:'Anibal Cardozo',
            username: 'Kionashi',
            email:'cardozo.anibal@gmail.com',
            phone: '123',
        );

        $postRepository = $this->createMock(PostRepository::class);
        $postRepository->method('findById')->with($postId)->willReturn($post);

        $authorRepository = $this->createMock(AuthorRepository::class);
        $authorRepository->method('findById')->with($post->authorId)->willReturn($author);

        $service = new FindPostsService($postRepository, $authorRepository);
        $result = $service->__invoke($postId);

        $this->assertInstanceOf(FindPostsOutDto::class, $result);
        $this->assertEquals($postId, $result->id);
        $this->assertEquals($post->title, $result->title);
        $this->assertEquals($post->body, $result->body);
        $this->assertEquals($author, $result->author);
    }

    public function testPostNotFound()
    {
        $postId = 1;

        $postRepository = $this->createMock(PostRepository::class);
        $postRepository->method('findById')->with($postId)->willReturn(null);

        $this->expectException(PostNotFoundException::class);

        $service = new FindPostsService($postRepository, $this->createMock(AuthorRepository::class));
        $service->__invoke($postId);
    }

    public function testInvalidPostResponse()
    {
        $postId = 1;

        $postRepository = $this->createMock(PostRepository::class);
        $postRepository->method('findById')->will($this->throwException(new Exception()));

        $this->expectException(InvalidPostResponseException::class);

        $service = new FindPostsService($postRepository, $this->createMock(AuthorRepository::class));
        $service->__invoke($postId);
    }

    public function testInvalidAuthorResponse()
    {
        $postId = 1;
        $post = new Post(
            id: $postId,
            authorId: 2, 
            title:'Test Post',
            body:'Body of the message'
        );

        $postRepository = $this->createMock(PostRepository::class);
        $postRepository->method('findById')->with($postId)->willReturn($post);

        $authorRepository = $this->createMock(AuthorRepository::class);
        $authorRepository->method('findById')->will($this->throwException(new Exception()));

        $this->expectException(InvalidAuthorResponseException::class);

        $service = new FindPostsService($postRepository, $authorRepository);
        $service->__invoke($postId);
    }
}
