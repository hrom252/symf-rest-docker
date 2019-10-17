<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryForm;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Movie controller.
 * @Route("/api", name="api_")
 */
class CategoryController extends AbstractFOSRestController
{
    /**
     * Lists all Categories.
     * @Rest\Get("/categories")
     *
     * @return Response
     */
    public function getCategoryAction()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();

        return $this->handleView($this->view($categories));
    }

    /**
     * Create Category.
     * @Rest\Put("/category")
     *
     * @return Response
     */
    public function putCategoryAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryForm::class, $category);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }

        return $this->handleView($this->view($form->getErrors()));
    }

    /**
     * Create Category.
     * @Rest\Post("/category/{id}")
     *
     * @return Response
     */
    public function postCategoryAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Category $category */
        $category = $this->getDoctrine()->getRepository('App:Category')->find($id);
        $form = $this->createForm(CategoryForm::class, $category);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }

        return $this->handleView($this->view($form->getErrors()));
    }
}
