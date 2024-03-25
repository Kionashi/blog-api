<?php

namespace App\Data\Repository;

use App\Data\Entity\Post;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    /** @return Post[] */
    public function findAll(): array
    {
        $response = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/posts');

        if (200 !== $response->getStatusCode()) {
            throw new \Exception();
        }
        $result = [];

        foreach ($response->toArray() as $value) {
            $result[] = new Post(
                id: $value['id'],
                authorId: $value['userId'],
                title: $value['title'],
                body: $value['body'],
            );
        }

        return $result;
    }

    public function findById(int $id): ?Post
    {
        $response = $this->client->request('GET', sprintf('https://jsonplaceholder.typicode.com/posts/%s', $id));

        if (200 !== $response->getStatusCode()) {
            throw new \Exception();
        }

        $result = $response->getContent();

        if ('{}' === $result) {
            return null;
        }

        $result = json_decode($result, true);

        $post = new Post(
            id: $result['id'],
            authorId: $result['userId'],
            title: $result['title'],
            body: $result['body'],
        );

        return $post;
    }

    public function persist(Post $post): void
    {
        // Store a new Post
    }
}
