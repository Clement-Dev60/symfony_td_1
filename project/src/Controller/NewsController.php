<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Event;
use App\Form\NewsFormType;
use App\Form\EventFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("IS_AUTHENTICATED_FULLY")]
class NewsController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function home(Request $request, EntityManagerInterface $em): Response
    {
        $news = new News();
        $newsForm = $this->createForm(NewsFormType::class, $news);
        $newsForm->handleRequest($request);

        if ($newsForm->isSubmitted() && $newsForm->isValid()) {
            $em->persist($news);
            $em->flush();
            $this->addFlash('success', 'News créée !');
            return $this->redirectToRoute('admin');
        }

        $event = new Event();
        $eventForm = $this->createForm(EventFormType::class, $event);
        $eventForm->handleRequest($request);

        if ($eventForm->isSubmitted() && $eventForm->isValid()) {
            $em->persist($event);
            $em->flush();
            $this->addFlash('success', 'Événement créé !');
            return $this->redirectToRoute('admin');
        }
        $rssUrl = 'https://www.agglo-compiegne.fr/rss/actualites'; // remplace par l'URL de ton choix
        $rss = simplexml_load_file($rssUrl);

        return $this->render('admin/forms.html.twig', [
            'newsForm'  => $newsForm,
            'eventForm' => $eventForm,
            'rssItems'  => $rss->channel->item ?? [],
        ]);
    }
    #[Route('/news', name: 'news_list')]
    public function list(EntityManagerInterface $em): Response
    {
        $news = $em->getRepository(News::class)->findAll();

        return $this->render('news/list.html.twig', [
            'newsList' => $news,
        ]);
    }
    #[Route('/event', name: 'event_list')]
    public function list_event(EntityManagerInterface $em): Response
    {
        $event = $em->getRepository(Event::class)->findAll();

        return $this->render('event/list.html.twig', [
            'eventList' => $event,
        ]);
    }
}
