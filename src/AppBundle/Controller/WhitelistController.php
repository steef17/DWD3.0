<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Whitelist;
use AppBundle\Form\WhitelistType;

/**
 * Whitelist controller.
 *
 * @Route("/whitelist")
 */
class WhitelistController extends Controller
{
    /**
     * Lists all Whitelist entities.
     *
     * @Route("/", name="whitelist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $whitelists = $em->getRepository('AppBundle:Whitelist')->findAll();

        return $this->render('whitelist/index.html.twig', array(
            'whitelists' => $whitelists,
        ));
    }

    /**
     * Creates a new Whitelist entity.
     *
     * @Route("/new", name="whitelist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $whitelist = new Whitelist();
        $form = $this->createForm(new WhitelistType(), $whitelist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($whitelist);
            $em->flush();

            return $this->redirectToRoute('whitelist_show', array('id' => $whitelist->getId()));
        }

        return $this->render('whitelist/new.html.twig', array(
            'whitelist' => $whitelist,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Whitelist entity.
     *
     * @Route("/{id}", name="whitelist_show")
     * @Method("GET")
     */
    public function showAction(Whitelist $whitelist)
    {
        $deleteForm = $this->createDeleteForm($whitelist);

        return $this->render('whitelist/show.html.twig', array(
            'whitelist' => $whitelist,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Whitelist entity.
     *
     * @Route("/{id}/edit", name="whitelist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Whitelist $whitelist)
    {
        $deleteForm = $this->createDeleteForm($whitelist);
        $editForm = $this->createForm(new WhitelistType(), $whitelist);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($whitelist);
            $em->flush();

            return $this->redirectToRoute('whitelist_edit', array('id' => $whitelist->getId()));
        }

        return $this->render('whitelist/edit.html.twig', array(
            'whitelist' => $whitelist,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Whitelist entity.
     *
     * @Route("/{id}", name="whitelist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Whitelist $whitelist)
    {
        $form = $this->createDeleteForm($whitelist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($whitelist);
            $em->flush();
        }

        return $this->redirectToRoute('whitelist_index');
    }

    /**
     * Creates a form to delete a Whitelist entity.
     *
     * @param Whitelist $whitelist The Whitelist entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Whitelist $whitelist)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('whitelist_delete', array('id' => $whitelist->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
