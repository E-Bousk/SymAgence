<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @route("/", name="home")
     * @param PropertyRepository $repo
     * @return Response
     */
    public function index(PropertyRepository $repo): Response
    {
        $properties = $repo->findLastest();

        return $this->render('pages/home.html.twig', compact('properties'));
    }
}