<?php

namespace App\Controller;

use App\Form\PostForm;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/post/crear', name: 'post_create')]
    public function create(): Response
    {
        $form = $this->createForm(PostForm::class);
        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
