<?php

namespace AlbumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AlbumBundle\Form\AlbumType;
use AlbumBundle\Entity\Album;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class AlbumController extends Controller
{
    public function viewAction($album_id)
    {
        $em = $this->getDoctrine()->getManager();
        $album = $em->getRepository('AlbumBundle:Album')->find($album_id);
        $reviews = $em->getRepository('ReviewBundle:Review')
            ->findBy(array('albumId' => $album_id));
        return $this->render('AlbumBundle:Album:view.html.twig',
            ['album' => $album, 'reviews' => $reviews]);
    }

    public function createAction(Request $request)
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album, [
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user = $this->container->get('security.token_storage')
                ->getToken()->getUser();

            /* @var UploadedFile $file */
            $file = $form['image']->getData();

            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $newFileName = $fileName . '-' . uniqid() . '.' . $file->guessExtension();


            $album->setTitle($album->getTitle());
            $album->setArtist($album->getArtist());
            $album->setIsrc($album->getIsrc());
            $album->setTrackList($album->getTrackList());
            $album->setAuthor($user);
            $album->setImage($newFileName);

            $em->persist($album);
            $em->flush();

            $destination = $this->getParameter('uploads_directory');
            $file->move($destination, $newFileName);


            return $this->redirect($this->generateUrl('album_view',
                ['album_id' => $album->getId()]));
        }
        return $this->render('AlbumBundle:Album:create.html.twig',
            ['form' => $form->createView()]);
    }

    public function editAction($album_id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $album = $em->getRepository('AlbumBundle:Album')
            ->find($album_id);

        $form = $this->createForm(AlbumType::class, $album, [
            'action' => $request->getUri()
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('album_view',
                ['album_id' => $album_id])
            );
        }
        return $this->render('AlbumBundle:Album:edit.html.twig',
            ['form' => $form->createView(),
            'album' => $album]
        );
    }

    public function deleteAction($album_id)
    {
        $em = $this->getDoctrine()->getManager();
        $album = $em->getRepository('AlbumBundle:Album')
            ->find($album_id);
        $em->remove($album);
        $em->flush();

        return $this->redirect($this->generateUrl('album_index'));
    }

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
        return $this->render('AlbumBundle:Album:index.html.twig',
            ['albums' => $albums]
        );
    }

}
