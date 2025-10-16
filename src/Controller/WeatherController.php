<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurementRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
//    #[Route('/weather/{id}', name: 'app_weather', requirements: ['id' => '\d+'])]
//    public function city(Location $location, MeasurementRepository $repository): Response
//    {
//        $measurements = $repository->findByLocation($location);
//
//        return $this->render('weather/city.html.twig', [
//            'controller_name' => 'WeatherController',
//            'location' => $location,
//            'measurements' => $measurements,
//        ]);
//    }

    #[Route('/weather/{country}/{city}', name: 'app_weather')]
    public function city(
        #[MapEntity(mapping: ['city' => 'city', 'country' => 'country'])]
        ?Location $location,
        MeasurementRepository $repository): Response
    {
        if (!$location) {
            throw $this->createNotFoundException("City not found.");
        }

        $measurements = $repository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'controller_name' => 'WeatherController',
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}
