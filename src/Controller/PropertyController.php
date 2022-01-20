<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repo;

    /**
     * 
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repo, ObjectManager $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /**
     * @route("/biens", name="property.index")
     * @return Response 
     */
    public function index(): Response
    {
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @return Response 
     */
    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'current_menu' => 'properties',
            'property' => $property
        ]);
    }
}

        // $property = new Property;
        // $property->setTitle('Le premier bien')
        //     ->setPrice(200000)
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setDescription('Une description lorem')
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity('Montpellier')
        //     ->setAddress('15 bd Gambetta')
        //     ->setPostalCode(34000)
        // ;

        // $em = $this->getDoctrine()->getManager();
        // $em->persist($property);
        // $em->flush();