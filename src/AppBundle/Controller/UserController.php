<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User\User;
use AppBundle\Form\User\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    // Gestion de l'affichage de l'utilisateur
    public function viewAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        // Liste des armées et des battles ou le visiteur à participer
        $listArmies = $em->getRepository("AppBundle:Army\Army")->findBy(array('user' => $user));

        $listBattles = $em->getRepository("AppBundle:Battle\Battle")->findAllOfVisitor($user);

        return $this->render('AppBundle:User:view.html.twig', array(
            'user' => $user,
            'listBattles' => $listBattles,
            'listArmies' => $listArmies
        ));
    }

    // Gestion d'edition d'utilisateurf
    public function editAction(Request $request, User $user)
    {
        if(null === $user || $user != $this->get('security.token_storage')->getToken()->getUser() )
        {
            $request->getSession()->getFlashBag()->add('danger', 'Vous avez essaier de modifier un profile n\'étant pas le vôtre.');

            return $this->redirectToRoute("app_home");
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(UserType::class, $user);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user');
        }

        return $this->render("AppBundle:User:edit.html.twig", array('form' => $form->createView()));
    }
}