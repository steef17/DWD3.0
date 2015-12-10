<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Customer;

/**
 * Customer controller.
 *
 * @Route("/customer")
 */
class CustomerController extends Controller
{
    /**
     * Lists all Customer entities.
     *
     * @Route("/", name="customer_index")
     * @Method("GET")
     */
    public function indexAction()
    {



        $em = $this->getDoctrine()->getManager();

        $customers = $em->getRepository('AppBundle:Customer')->findAll();

        return $this->render('customer/index.html.twig', array(
            'customers' => $customers,
        ));





    }

    /**
     * Finds and displays a Customer entity.
     *
     * @Route("/{id}", name="customer_show")
     * @Method("GET")
     */
    public function showAction(Customer $customer)
    {

        return $this->render('customer/show.html.twig', array(
            'customer' => $customer,
        ));
    }
}
