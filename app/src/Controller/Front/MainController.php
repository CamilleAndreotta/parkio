<?php 

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{   
    /**
     * @Route("/", name="home", methods={"GET"})
     *
     * @return Response
     */
    public function homePage(): Response
    {   
        
        return $this->render('front/main/parkio.html.twig');
    }

    /**
     * @Route("/fonctionnalites", name="functionnalities", methods={"GET"})
     *
     * @return Response
     */
    public function functionnalities(): Response
    {
        return $this->render('front/main/functionnality.html.twig');
    }

    /**
     * @Route("/doc/user", name="user_doc", methods={"GET"})
     *
     * @return Response
     */
    public function userDoc(): Response
    {
        return $this->render('front/main/user_doc.html.twig');
    }

    /**
     * @Route("/doc/admin", name="admin_doc", methods={"GET"})
     *
     * @return Response
     */
    public function adminDoc(): Response
    {
        return $this->render('front/main/admin_doc.html.twig');
    }

    /**
     * @Route("/mentions-legales", name="mentions", methods={"GET"})
     *
     * @return Response
     */
    public function mentions(): Response
    {
        return $this->render('front/main/mentions_legales.html.twig');
    }

    /**
     * @Route("/rgpd", name="rgpd", methods={"GET"})
     *
     * @return Response
     */
    public function rgpd(): Response
    {
        return $this->render('front/main/rgpd.html.twig');
    }

    /**
     * @Route("/contact", name="contact", methods={"GET"})
     *
     * @return Response
     */
    public function contact(): Response
    {
        return $this->render('front/main/contact.html.twig');
    }


}