<?php

namespace App\Controller\PackEditor;

use App\Entity\Round;
use App\Entity\Theme;
use App\Repository\RoundRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/round', name: 'packedit:round:')]
class RoundController extends AbstractController
{
    #[Route('/{round}', name: 'get', methods: ['GET'])]
    public function get(Round $round): JsonResponse
    {
        return $this->json($round);
    }

    #[Route('/{id}', name: 'update', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function update(int $id): JsonResponse
    {

    }

    #[Route('/{round}', name: 'delete', requirements: ['round' => '\d+'], methods: ['DELETE'])]
    public function delete(Round $round, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($round);
        $entityManager->flush();

        return $this->json(['status' => 'ok']);
    }

    #[Route('/{round}/themes', name: 'themes', methods: ['GET'])]
    public function themes(Round $round): JsonResponse
    {
        return $this->json($round->getThemes());
    }

    #[Route('/{round}/themes', name: 'addTheme', methods: ['PUT'])]
    public function addTheme(Round $round, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $theme = $serializer->deserialize($request->getContent(), Theme::class, 'json');

        $round->addTheme($theme);

        $entityManager->persist($theme);
        $entityManager->flush();

        return $this->json($theme);
    }
}