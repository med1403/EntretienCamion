<?php
// src/Controller/CarController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;
use App\Service\CarService;

class CarController extends AbstractController
{
    
      #[Route('/cars', name : 'cars')]
     
      public function index(CarRepository $carRepository, CarService $carService)
      {
          $cars = $carRepository->findAll();
  
          $standardDeviation = null;
          $remainingKilometers = null;
  
          if (!empty($cars)) {
              $standardDeviation = $carService->calculateStandardDeviation($cars);
  
              // Assuming you have a way to determine fuelAvailable
            $fuelAvailable = 100; // Assign a value to the $fuelAvailable variable
            $remainingKilometers = $carService->calculateRemainingKilometers($cars[0], $fuelAvailable);
          }
  
          return $this->render('car/index.html.twig', [
              'cars' => $cars,
              'standardDeviation' => $standardDeviation,
              'remainingKilometers' => $remainingKilometers,
          ]);
      }
  }