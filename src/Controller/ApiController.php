<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, JWTTokenManagerInterface $jwt ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(!isset($data['email']) || !isset($data['password'])) {
            return $this->json([
                'error' => 'Email et mot de passe sont requis'
            ], Response::HTTP_BAD_REQUEST);     //400
        }

        $user = $em->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if(!$user) {
            return $this->json([
                'error' => 'Utilisateur non trouvé'
            ], Response::HTTP_UNAUTHORIZED);    //401
        }

        if(!$passwordHasher->isPasswordValid($user, $data['password'])) {
            return $this->json([
                'error' => 'Mot de passe invalide'
            ], Response::HTTP_UNAUTHORIZED);    //401
        }

        if(!$user->getApiAccess()) {
            return $this->json([
                'error' => 'Accès API non autorisé pour cet utilisateur'
            ], Response::HTTP_FORBIDDEN);       //403
        }

        $token = $jwt->create($user);

        return $this->json([
            'token' => $token,
            'user' => [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
                'apiAccess' => $user->getApiAccess()
            ]
        ], Response::HTTP_OK);          //200
    }
}
