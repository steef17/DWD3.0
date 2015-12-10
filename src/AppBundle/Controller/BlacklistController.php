<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Blacklist;
use AppBundle\Form\BlacklistType;

/**
 * Blacklist controller.
 *
 * @Route("/blacklist")
 */
class BlacklistController extends Controller
{
    /**
     * Lists all Blacklist entities.
     *
     * @Route("/", name="blacklist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blacklists = $em->getRepository('AppBundle:Blacklist')->findAll();

        return $this->render('blacklist/index.html.twig', array(
            'blacklists' => $blacklists,
        ));
    }

    /**
     * Creates a new Blacklist entity.
     *
     * @Route("/new", name="blacklist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $blacklist = new Blacklist();
        $form = $this->createForm(new BlacklistType(), $blacklist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blacklist);
            $em->flush();

            return $this->redirectToRoute('blacklist_show', array('id' => $blacklist->getId()));
        }

        return $this->render('blacklist/new.html.twig', array(
            'blacklist' => $blacklist,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Blacklist entity.
     *
     * @Route("/{id}", name="blacklist_show")
     * @Method("GET")
     */
    public function showAction(Blacklist $blacklist)
    {
        $deleteForm = $this->createDeleteForm($blacklist);

        return $this->render('blacklist/show.html.twig', array(
            'blacklist' => $blacklist,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Blacklist entity.
     *
     * @Route("/{id}/edit", name="blacklist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Blacklist $blacklist)
    {
        $deleteForm = $this->createDeleteForm($blacklist);
        $editForm = $this->createForm(new BlacklistType(), $blacklist);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blacklist);
            $em->flush();

            return $this->redirectToRoute('blacklist_edit', array('id' => $blacklist->getId()));
        }

        return $this->render('blacklist/edit.html.twig', array(
            'blacklist' => $blacklist,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Blacklist entity.
     *
     * @Route("/{id}", name="blacklist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Blacklist $blacklist)
    {
        $form = $this->createDeleteForm($blacklist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blacklist);
            $em->flush();
        }

        return $this->redirectToRoute('blacklist_index');
    }

    /**
     * Creates a form to delete a Blacklist entity.
     *
     * @param Blacklist $blacklist The Blacklist entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Blacklist $blacklist)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blacklist_delete', array('id' => $blacklist->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
