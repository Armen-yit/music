<?php

namespace AppBundle\Controller;

use AppBundle\Form\SingersType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



class SingersController extends Controller
{

    /**
     * @Route("/singer-list", name="singers_list")
     * @Template()
     * @return array
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $singers = $em->getRepository('AppBundle:Singers')->findAll();
        return array('singers'=>$singers);
    }



    /**
     * @Route("/singer-create", name="singer-create")
     * @Template()
     * @return array
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new SingersType());

        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){

            $singer = $form->getData();

            $em->persist($singer);
            $em->flush();

           return $this->redirectToRoute('singers_list');
        }

        return array('form'=>$form->createView());

    }

    /**
     * @Route("/singer-edit/{id}",requirements={"id" = "\d+"}, name="singer_edit")
     * @Template()
     * @return array
     *
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $singers = $em->getRepository('AppBundle:Singers')->find($id);
        $form = $this->createForm(new SingersType(),$singers);

        $form->handleRequest($request);

        if($form->isSubmitted()and $form->isValid()){

            $singer = $form->getData();

            $em->persist($singer);
            $em->flush();

           return $this->redirectToRoute('singers_list');
        }

        return array('form'=>$form->createView());

    }

    /**
     *
     * @Route("/singer-delete/{id}", requirements={"id" = "\d+"}, name="singer_delete")
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $singer = $em->getRepository("AppBundle:Singers")->find($id);
        $em->remove($singer);
        $em->flush();

        return $this->redirectToRoute('singers_list');
    }


}
