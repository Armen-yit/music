<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     * @return array
     *
     */
    public function indexAction()
    {
       return [];
    }
}
