<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Discs;
use AppBundle\Entity\Singers;
use AppBundle\Form\DiscsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



class DiscsController extends Controller
{

    /**
     * @Route("/disc-list/{sId}",requirements={"sId" = "\d+"}, name="discs_list")
     * @Template()
     * @return array
     *
     */
    public function listAction($sId = null)
    {

        $em = $this->getDoctrine()->getManager();
        if($sId){
            $discs = $em->getRepository('AppBundle:Discs')->findBySingers($sId);
        }else{
            $discs = $em->getRepository('AppBundle:Discs')->findAll();
        }

        return array('discs'=>$discs);
    }


    /**
     * @Route("/disc-create", name="disc-create")
     * @Template()
     * @return array
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $discs = new Discs();
        $form = $this->createForm(new DiscsType(),$discs);

        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){

            $discs = $form->getData();

            $em->persist($discs);
            $em->flush();

            return $this->redirectToRoute('discs_list');
        }

        return array('form'=>$form->createView());
    }

    /**
     * @Route("/disc-edit/{id}",requirements={"id" = "\d+"}, name="disc_edit")
     * @Template()
     * @return array
     *
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $disc = $em->getRepository('AppBundle:Discs')->find($id);
        $form = $this->createForm(new DiscsType(),$disc);

        $form->handleRequest($request);

        if($form->isSubmitted()and $form->isValid()){

            $disc = $form->getData();

            $em->persist($disc);
            $em->flush();

            return $this->redirectToRoute('discs_list');
        }

        return array('form'=>$form->createView());

    }

    /**
     *
     * @Route("/disc-delete/{id}", requirements={"id" = "\d+"}, name="disc_delete")
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $disc = $em->getRepository("AppBundle:Discs")->find($id);
        $em->remove($disc);
        $em->flush();

        return $this->redirectToRoute('discs_list');
    }


}
