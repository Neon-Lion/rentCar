<?php

namespace App\Controller;
use App\Entity\Cars;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Form\AddCarFormType;
use App\Form\EditCarFormType;
use App\Form\DeleteCarFormType;

class HomeController extends AbstractController
{
    /**
     * @Route("rentCar/home", name="home")
     */
    public function index(Request $request): Response
    {
        $cars = $this->getDoctrine()->getRepository(Cars::class)->findAll();

        $addForm = $this->createForm(AddCarFormType::class, $cars, [
            'action' => $this->generateUrl('home'),
            // 'action' => $this->redirectToRoute('add'),
            'method' => 'POST'
        ]);

        $deleteForm = $this->createForm(DeleteCarFormType::class, $cars, [
            'action' => $this->generateUrl('home'),
            // 'action' => $this->redirectToRoute('add'),
            'method' => 'POST'
        ]);

        $addForm->handleRequest($request);
        $deleteForm->handleRequest($request);

        if($addForm->isSubmitted() && $addForm->isValid())
        {
            $brand        = $addForm['brand']->getData();
            $model        = $addForm['model']->getData();
            $manufacturer = $addForm['manufacturer']->getData();
            $year         = $addForm['year']->getData();

            $car = new Cars();
            $car->setBrand($brand);
            $car->setModel($model);
            $car->setManufacturer($manufacturer);
            $car->setYear($year);

            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            $this->addFlash('success', 'Car was added successfully!');

            return $this->redirectToRoute('home');
        }

        if($deleteForm->isSubmitted() && $deleteForm->isValid())
        {
            $id  = $_POST['deletedCar'];
            $em  = $this->getDoctrine()->getManager();
            $car = $em->getRepository(Cars::class)->find($id);
            $em->remove($car);
            $em->flush();

            $this->addFlash('success', 'Car was deleted successfully!');

            return $this->redirectToRoute('home');
        }

        $brands        = array();
        $manufacturers = array();
        $years         = array();
        
        // Array of brands
        foreach($cars as $car)  array_push($brands, $car->getBrand());
        $brands = array_unique($brands);

        // Array of manufacturers
        foreach($cars as $car) array_push($manufacturers, $car->getManufacturer());
        $manufacturers = array_unique($manufacturers);

        // Array of years
        foreach($cars as $car) array_push($years, $car->getYear());
        $years = array_unique($years);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'HomeController',
            'cars'            => $cars,
            'brands'          => $brands,
            'manufacturers'   => $manufacturers,
            'years'           => $years,
            'addForm_data'    => $addForm->createView(),
            'deleteForm_data' => $deleteForm->createView()
        ]);
    }

    /**
     * @Route("rentCar/home/edit/{id}",methods={"GET", "POST"})
     */
    public function edit($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $editedCar = $em->getRepository(Cars::class)->find($id);
        if (!$editedCar) { throw $this->createNotFoundException('No car found for id ' . $id); }

        $brand        = $_POST['brand'];
        $model        = $_POST['model'];
        $manufacturer = $_POST['manufacturer'];
        $year         = $_POST['year'];

        // Modify the object
        $editedCar->setBrand($brand);
        $editedCar->setModel($model);
        $editedCar->setManufacturer($manufacturer);
        $editedCar->setYear($year);

        // Flushes all changes to the database
        $em->flush();

        $this->addFlash('success', 'Car was edited successfully!');

        return $this->redirectToRoute('home');
    }
}