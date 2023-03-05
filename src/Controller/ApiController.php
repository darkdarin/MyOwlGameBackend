<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    public function json(mixed $data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        $headers = ['Content-Type: application/json'];
        return parent::json($data, $status, $headers, $context);
    }
}