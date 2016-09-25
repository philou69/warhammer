<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Battle\Battle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Battle\PhotoBattle;
use AppBundle\Form\Battle\PhotoBattleType;

class PhotoBattleController extends Controller
{
    public function addAction(Request $request, Battle $battle)
    {
        $em = $this->getDoctrine()->getManager();
        $photo = new PhotoBattle();

        $form = $this->createForm(PhotoBattleType::class, $photo);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($photo);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info','Votre photo a bien été ajoutée.');
            if($battle->getResume() === null )
            {
                return $this->redirectToRoute('battle_view_add', array('slugBattle' => $battle->getSlugBattle()));
            }else{
                return $this->redirectToRoute('battle_view_edit', array('id' => $battle->getResume()->getId()));
            }


        }
        return $this->render('AppBundle:PhotoBattle:add.html.twig', array('form' => $form->createView()));
    }

    public function deleteAction(Request $request, PhotoBattle $photoBattle, $slugBattle)
    {
        $em = $this->getDoctrine()->getManager();
        $battle = $em->getRepository("AppBundle:Battle\Battle")->findOneBy(array("slugBattle" => $slugBattle));
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($photoBattle);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Votre photo a bien été supprimée.');

            if($battle->getResume() === null )
            {
                return $this->redirectToRoute('battle_view_add', array('slugBattle' => $battle->getSlugBattle()));
            }else{
                return $this->redirectToRoute('battle_view_edit', array('id' => $battle->getResume()->getId()));
            }
        }

        return $this->render('AppBundle:PhotoBattle:delete.html.twig', array('form' => $form->createView(), 'photoBattle' => $photoBattle, 'battle' => $battle));
    }
}