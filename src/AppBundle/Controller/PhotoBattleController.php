<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Battle\Battle;
use AppBundle\Entity\Battle\PhotoBattle;
use AppBundle\Form\Battle\PhotoBattleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhotoBattleController extends Controller
{
    // Page d'ajout d'une photo de battle
    public function addAction(Request $request, Battle $battle)
    {
        // On vérifie que la battle existe
        if(null === $battle){
            throw new NotFoundHttpException('Cette battle n\'existe pas !');
        }

        $em = $this->getDoctrine()->getManager();
        $now = new \DateTime();
        // On crée une instance photoBattle qu'on lie au visiteur
        $photo = new PhotoBattle();
        $photo->setUser($this->get('security.token_storage')->getToken()->getUser());
        $photo->setDateUpload($now);

        $form = $this->createForm(PhotoBattleType::class, $photo);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($photo);
            $em->flush();

            // Apres enregistrement de la photo, on vérifie si la battle à un résumé ou non
            if($battle->getResume() === null )
            {
                return $this->redirectToRoute('resume_add', array('slugBattle' => $battle->getSlugBattle()));
            }else{
                return $this->redirectToRoute('resume_edit', array('id' => $battle->getResume()->getId()));
            }


        }
        return $this->render('AppBundle:PhotoBattle:add.html.twig', array('form' => $form->createView()));
    }

    // gestion de la suppression  d'une photoBattle
    public function deleteAction(Request $request, PhotoBattle $photoBattle, $slugBattle )
    {
        // On vérifie si la photoBattle existe et que le visiteur en est bien le propriétaire
        if(null === $photoBattle){
            throw new NotFoundHttpException('Cette Photo de bataille n\'existe pas !');
        }
        if($photoBattle->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour supprimer cette photo');
        }
        $em = $this->getDoctrine()->getManager();


        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($photoBattle);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Votre photo a bien été supprimée.');

            return $this->redirectToRoute('battles');
        }

        return $this->render('AppBundle:PhotoBattle:delete.html.twig', array('form' => $form->createView(), 'photoBattle' => $photoBattle, 'slugBattle' => $slugBattle));
    }

    // Gestion d'affichage des photos battles du visiteur
    public  function indexAction($page)
    {
        // On vérifie de ne pas être sur la page 0 ou moins
        if($page < 1 ) {
            throw $this->createNotFoundException("La page ". $page ." n'existe pas");
        }
        // On fixe le nombre de page
        $nbPerPage = 20;
        $user = $this->get('security.token_storage')->getToken()->getUser();

        // On récupere notre objet Paginator
        $listPhotos = $this->getDoctrine()
                            ->getManager()
                            ->getRepository("AppBundle:Battle\PhotoBattle")
                            ->getPhotos($page, $nbPerPage, $user);

        // On calcul le nombre total de page
        $nbPages= ceil(count($listPhotos)/$nbPerPage);

        // Si la page n'existe pas, on retourne une erreur 404
        if($page > $nbPages){
            return $this->createNotFoundException('La page '. $page . ' n\'exciste pas.');
        }

        return $this->render('AppBundle:PhotoBattle:page.html.twig', array(
                'listPhotos' => $listPhotos,
                'nbPages' => $nbPages,
                'page' => $page
        ));
    }
}