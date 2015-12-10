<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Filter;
use AppBundle\Form\FilterType;

/**
 * Filter controller.
 *
 * @Route("/filter")
 */
class FilterController extends Controller
{
    /**
     * Lists all Filter entities.
     *
     * @Route("/", name="filter_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $filters = $em->getRepository('AppBundle:Filter')->findAll();

        return $this->render('filter/index.html.twig', array(
            'filters' => $filters,
        ));
    }

    /**
     * Creates a new Filter entity.
     *
     * @Route("/new", name="filter_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $filter = new Filter();
        $form = $this->createForm(new FilterType(), $filter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filter);
            $em->flush();

            return $this->redirectToRoute('filter_show', array('id' => $filter->getId()));
        }

        return $this->render('filter/new.html.twig', array(
            'filter' => $filter,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Filter entity.
     *
     * @Route("/{id}", name="filter_show")
     * @Method("GET")
     */
    public function showAction(Filter $filter)
    {
        $deleteForm = $this->createDeleteForm($filter);

        return $this->render('filter/show.html.twig', array(
            'filter' => $filter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Filter entity.
     *
     * @Route("/{id}/edit", name="filter_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Filter $filter)
    {
        $deleteForm = $this->createDeleteForm($filter);
        $editForm = $this->createForm(new FilterType(), $filter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filter);
            $em->flush();

            return $this->redirectToRoute('filter_edit', array('id' => $filter->getId()));
        }

        return $this->render('filter/edit.html.twig', array(
            'filter' => $filter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Filter entity.
     *
     * @Route("/{id}", name="filter_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Filter $filter)
    {
        $form = $this->createDeleteForm($filter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($filter);
            $em->flush();
        }

        return $this->redirectToRoute('filter_index');
    }

    /**
     * Creates a form to delete a Filter entity.
     *
     * @param Filter $filter The Filter entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Filter $filter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('filter_delete', array('id' => $filter->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
