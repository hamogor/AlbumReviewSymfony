<?php

namespace ReviewBundle\Controller;

use ReviewBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ReviewBundle\Form\ReviewType;

class ReviewController extends Controller
{
    public function createAction($album_id, Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review, [
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->container->get('security.token_storage')
                ->getToken()->getUser();
            $album = $em->getRepository('AlbumBundle:Album')
                ->find($album_id);

            $review->setReview($review->getReview());
            $review->setTimestamp(new \DateTime());
            $review->setUserId($user);
            $review->setScore($review->getScore());
            $review->setAuthor($user->getUsername());
            $review->setAlbumId($album);

            $em->persist($review);
            $em->flush();
            return $this->redirect($this->generateUrl('album_view',
                ['album_id' => $album_id]));
        }
        return $this->render('ReviewBundle:Review:create.html.twig',
            ['form' => $form->createView()]
        );
    }

    public function editAction($review_id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('ReviewBundle:Review')
            ->find($review_id);


        $form = $this->createForm(ReviewType::class, $review, [
            'action' => $request->getUri()
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->flush();
            $album_id = $review->getAlbumId();
            return $this->redirect($this->generateUrl('album_index')
            );
        }
        return $this->render('ReviewBundle:Review:edit.html.twig',
            ['form' => $form->createView(),
                'review' => $review]
        );
    }

    public function deleteAction($review_id)
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('ReviewBundle:Review')
            ->find($review_id);

        $em->remove($review);
        $em->flush();

        return $this->redirect($this->generateUrl('album_index'));
    }

    public function viewAction($review_id)
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository('ReviewBundle:Review')
            ->find($review_id);
        return $this->render('ReviewBundle:Review:view.html.twig',
            ['review' => $review]
        );
    }

}
