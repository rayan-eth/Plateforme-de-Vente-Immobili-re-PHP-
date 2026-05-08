<?php

namespace App\Controller;

use App\Entity\Listing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookingController extends AbstractController
{
    #[Route('/booking/request/{id}', name: 'app_booking_new', methods: ['GET', 'POST'])]
    public function new(Listing $listing, Request $request): Response
    {
        if ($request->isMethod('POST')) {
            // "Fake" submission processing
            $this->addFlash('success', 'Your reservation request has been received! We will contact you shortly.');
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('booking/new.html.twig', [
            'listing' => $listing,
        ]);
    }
}
