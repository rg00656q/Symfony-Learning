<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createFormBuilder()
            ->add('email')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
            ])
            ->add('Register', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success float-end'
                ]
            ])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = new User();
            $user->setEmail($form->getData()['email']);
            $user->setPassword(
                $passwordHasher->hashPassword($user, $form->getData()['password'])
            );
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('app_login'));
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}