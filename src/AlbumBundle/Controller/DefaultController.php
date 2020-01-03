<?php

namespace AlbumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AlbumBundle\Entity\Album;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository(Album::class)->findAll();
        $pagination = $this->get("knp_paginator");
        $albums = $pagination->paginate(
            $query,
            $request->query->getInt('page', 1),
            2
        );
        return $this->render('AlbumBundle:Default:index.html.twig',
            ['albums' => $albums]
        );
    }
}
