<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Business\Service\GetPostsService;
use App\Business\Dto\GetPostsOutDto;
use App\Business\Exception\InvalidPostResponseException;
use App\Data\Entity\Post;
use App\Data\Repository\PostRepository;
use Exception;

class GetPostsServiceTest extends TestCase
{
    public function testSuccess()
    {
        $posts = [
            0 => new Post(
                id: 1,
                authorId: 1,
                title: "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
                body: "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
            ),
            1 => new Post(
                id: 2,
                authorId: 1,
                title: "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
                body: "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
            ),
            3 => new Post(
                id: 3,
                authorId: 1,
                title: "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
                body: "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
            ),
            4 => new Post(
                id: 4,
                authorId: 1,
                title: "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
                body: "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
            ),
        ];
        $postRepositoryMock = $this->createMock(PostRepository::class);
        $postRepositoryMock->method('findAll')->willReturn($posts);

        $getPostsService = new GetPostsService($postRepositoryMock);

        $expected = new GetPostsOutDto(
            posts: $posts,
            total: count($posts)
        );

        $actual = $getPostsService();

        $this->assertEquals($expected, $actual);
    }

    public function testInvalidResponseException()
    {
        $postRepositoryMock = $this->createMock(PostRepository::class);
        $postRepositoryMock->method('findAll')->willThrowException(new Exception());

        $this->expectException(InvalidPostResponseException::class);

        $getPostsService = new GetPostsService($postRepositoryMock);
        $getPostsService();
    }
}
