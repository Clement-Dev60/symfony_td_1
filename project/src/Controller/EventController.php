<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/event/new', name: 'event_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $event = new Event();
        $form = $this->createForm(EventFormType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();

            $this->addFlash('success', 'Événement créé avec succès !');

            return $this->redirectToRoute('event_list');
        }

        return $this->render('event/new.html.twig', [
            'form' => $form,
        ]);
    }
}
