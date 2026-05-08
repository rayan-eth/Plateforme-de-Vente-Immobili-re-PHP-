<?php

namespace App\Controller;

use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ListingRepository $listingRepository, Request $request): Response
    {
        $location = $request->query->get('location');
        $minPrice = $request->query->get('min_price');
        $maxPrice = $request->query->get('max_price');

        if ($location || $minPrice || $maxPrice) {
            $listings = $listingRepository->findBySearch($location, $minPrice, $maxPrice);
        } else {
            $listings = $listingRepository->findAll();
        }

        return $this->render('front/index.html.twig', [
            'listings' => $listings,
            'searchParams' => [
                'location' => $location,
                'min_price' => $minPrice,
                'max_price' => $maxPrice
            ]
        ]);
    }

    #[Route('/listing/{id}', name: 'app_listing_show')]
    public function show(\App\Entity\Listing $listing): Response
    {
        return $this->render('front/show.html.twig', [
            'listing' => $listing,
        ]);
    }
}
