<?php

namespace App\Controller;

use App\Form\ContactForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
final class PageController extends AbstractController
{
    #[Route('/contactos-v1', methods: ['GET', 'POST'])]
    public function contactV1(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('email', TextType::class)
            ->add('message', TextareaType::class, [
                'label' => 'Comentario, sugerencia o mensaje'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enviar'
            ])
            // ->setMethod('GET')
            // ->setAction('otra-url')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // getData() contiene los valores enviados
            dd($form->getData(), $request);
        }

        return $this->render('page/contact-V1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contactos-v2', methods: ['GET', 'POST'])]
    public function contactV2(Request $request): Response
    {
        $form = $this->createForm(ContactForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData(), $request);
        }

        return $this->render('page/contact-V2.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contactos-v3', methods: ['GET', 'POST'])]
    public function contactV3(Request $request): Response
    {
        $form = $this->createForm(ContactForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData(), $request);
        }

        return $this->render('page/contact-V3.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
