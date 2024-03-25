<?php

namespace App\Api\Controller;

use App\Business\Exception\InvalidAuthorResponseException;
use App\Business\Exception\InvalidPostResponseException;
use App\Business\Exception\PostNotFoundException;
use App\Business\Service\FindPostsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class FindPostsController extends AbstractController
{
    public function __construct(private FindPostsService $findPostsService)
    {
    }

    #[Route('/posts/{id}', name: 'find_posts', format: 'json', methods: ['GET'])]
    public function __invoke(int $id): JsonResponse
    {
        try {
            $posts = $this->findPostsService->__invoke($id);

            return new JsonResponse(
                $posts,
                JsonResponse::HTTP_OK
            );
        } catch (PostNotFoundException $exception) {
            return new JsonResponse($exception->getMessage(), JsonResponse::HTTP_NOT_FOUND);
        } catch (InvalidPostResponseException|InvalidAuthorResponseException $exception) {
            return new JsonResponse($exception->getMessage(), JsonResponse::HTTP_BAD_GATEWAY);
        } catch (\Exception $exception) {
            return new JsonResponse('There was an unespected error', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
