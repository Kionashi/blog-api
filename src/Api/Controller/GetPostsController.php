<?php

namespace App\Api\Controller;

use App\Business\Exception\PostNotFoundException;
use App\Business\Service\GetPostsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetPostsController extends AbstractController
{
    public function __construct(private GetPostsService $getPostsService)
    {
    }

    #[Route('/posts', name: 'get_posts', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        try {
            $posts = $this->getPostsService->__invoke();

            return new JsonResponse(
                $posts,
                JsonResponse::HTTP_OK
            );
        } catch (PostNotFoundException $exception) {
            return new JsonResponse($exception->getMessage(), JsonResponse::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            return new JsonResponse('There was an unespected error', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
