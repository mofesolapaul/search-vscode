<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\SearchType;
use App\Model\SearchData;
use App\UseCase\PerformCodeSearchUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private PerformCodeSearchUseCase $useCase;

    public function __construct(PerformCodeSearchUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    #[Route('/search', name: 'api_search', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $response = $this->useCase->execute($data);

            return new JsonResponse($response);
        }

        return new JsonResponse('Invalid data', Response::HTTP_BAD_REQUEST);
    }
}
