<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request, UserPasswordHasherInterface $userPasswordHasher,Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();

            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $user->setApiAccess(false);

            $security->login($user,'form_login');

            $entityManager->persist($user);
            $entityManager->flush();


            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/inscription.html.twig', [
            'registrationForm' => $form,
        ]);
    }

     #[Route('/connexion', name: 'app_login')]
      public function login(AuthenticationUtils $authenticationUtils): Response
      {
          if ($this->getUser()) {
              return $this->redirectToRoute('app_home');
          }

          $error = $authenticationUtils->getLastAuthenticationError();

          $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('registration/connexion.html.twig', [
              'last_username' => $lastUsername,
              'error' => $error,
          ]);
      }

      #[Route('/deconnexion', name: 'app_logout')]
      public function logout(): void
      {
          // Cette méthode reste vide - Symfony gère la déconnexion automatiquement
          throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
      }

}
