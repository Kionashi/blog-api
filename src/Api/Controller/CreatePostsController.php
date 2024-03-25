<?php

namespace App\Api\Controller;

use App\Api\Request\CreatePostsRequest;
use App\Business\Service\CreatePostsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class CreatePostsController extends AbstractController
{
    public function __construct(private CreatePostsService $createPostsService)
    {
    }

    #[Route('/posts', name: 'create_posts', format: 'json', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] CreatePostsRequest $request): JsonResponse
    {
        try {
            $title = $request->title;
            $authorId = $request->authorId;
            $body = $request->body;
            $this->createPostsService->__invoke(
                authorId: $authorId,
                title: $title,
                body: $body
            );

            return new JsonResponse([], JsonResponse::HTTP_CREATED);
        } catch (\JsonException $exception) {
            return new JsonResponse($exception->getMessage(), JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
