<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryForm;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/', name:'category_index', methods:['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $entityManager->getRepository(className: Category::class)->findAll()
        ]);
    }

    #[Route('/category/crear', name: 'category_create', methods: ['GET', 'POST'	])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryForm::class);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Categoria creada con éxito');
            return $this->redirectToRoute('category_create');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{id}/editar', name: 'category_edit', methods: ['GET', 'POST'])]
    public function edit(Category $category, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryForm::class, $category);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Category editada con éxito');
            return $this->redirectToRoute('post_edit', ['id' => $category->getId()]);
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
