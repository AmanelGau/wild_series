<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * Affiche la liste des catégories
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('category/index.html.twig', [
            "categories" => $categories
        ]);
    }

    /**
     * Getting programs form a category
     *
     * @Route("/{categoryName}/", requirements={"categoryName"=".+"}, methods={"GET"}, name="show")
     * @return Response
     */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);
        if ($category === null) {
            throw $this->createNotFoundException();
        } else {
             $series = $this->getDoctrine()
                ->getRepository(Program::class)
                ->findBy(["category" => $category->getId()], ["title" => 'DESC'], 3, 0);
            return $this->render('category/show.html.twig', [
                "category" => $category,
                "series" => $series
            ]);
        }
       
    }
}