<?php

namespace App\Controller;

use App\Entity\Inventor;
use App\Form\RegistrationFormType; // uses RegistrationFormType in /src/Form to build form structure
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

// This Controller handles the creation of new users.
// This Controller could also have a route to edit the current user's information through the same RegistrationFormType

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // Create new Inventor entity instance
        $user = new Inventor();
        // Create new form instance passing the Inventor entity
        $form = $this->createForm(RegistrationFormType::class, $user);
        // Handle request to grab form data
        $form->handleRequest($request);

        // Check if form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            // grab plain password from form
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            // persist the user entity to the database
            $entityManager->persist($user);
            // flush the changes to the database
            $entityManager->flush();

            // redirect user to login page
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
