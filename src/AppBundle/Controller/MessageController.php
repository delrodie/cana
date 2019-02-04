<?php

namespace AppBundle\Controller;

use AppBundle\Utils\Inventaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class BackendController
 * @Route("message")
 */
class MessageController extends Controller
{
    /**
     * @Route("/monture", name="message_monture")
     */
    public function montureAction(Session $session, Inventaire $inventaire)
    {
        if ($session->get('montureId')){
            $approvisionnement = $inventaire->approvisionnement($session->get('montureId'));
            if ($approvisionnement){
                $session->remove('montureId');
                $this->addFlash('notice', 'La quantité a été ajoutée avec succès');
                return $this->redirectToRoute('monture_index');
            }else{
                $session->remove('montureId');
                $this->addFlash('error', "Echec de l'augmentation du stock. Veuillez faire l'ajout en modification!");
                return $this->redirectToRoute('monture_index');
            }
        }

        return $this->redirectToRoute('monture_index');
    }
}
