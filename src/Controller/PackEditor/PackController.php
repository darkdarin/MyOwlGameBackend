<?php

namespace App\Controller\PackEditor;

use App\Controller\ApiController;
use App\Entity\Pack;
use App\Entity\Round;
use App\Repository\PackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/pack', name: 'packedit:pack:')]
class PackController extends ApiController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(PackRepository $packRepository): JsonResponse
    {
        return $this->json($packRepository->findAll());
    }

    #[Route('/{pack}', name: 'get', methods: ['GET'])]
    public function get(Pack $pack): JsonResponse
    {
        return $this->json($pack);
    }

    #[Route('/{pack}/rounds', name: 'rounds', methods: ['GET'])]
    public function rounds(Pack $pack): JsonResponse
    {
        return $this->json($pack->getRounds());
    }

    #[Route('/{pack}/rounds', name: 'addRound', methods: ['PUT'])]
    public function addRound(Pack $pack, Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): JsonResponse
    {
        $round = $serializer->deserialize($request->getContent(), Round::class, 'json');

        $pack->addRound($round);

        $entityManager->persist($round);
        $entityManager->flush();

        return $this->json($round);
    }
}