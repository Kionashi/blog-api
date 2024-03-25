<?php

namespace App\Data\Repository;

use App\Data\Entity\Author;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AuthorRepository
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    public function findById(int $id): ?Author
    {
        $response = $this->client->request('GET', sprintf('https://jsonplaceholder.typicode.com/users/%s', $id));

        if (200 !== $response->getStatusCode()) {
            throw new \Exception();
        }

        $result = $response->getContent();

        if ('{}' === $result) {
            return null;
        }
        $result = json_decode($result, true);

        $author = new Author(
            id: $result['id'],
            name: $result['name'],
            username: $result['username'],
            email: $result['email'],
            phone: $result['phone'],
        );

        return $author;
    }
}
