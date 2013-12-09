<?php

namespace San\ReportBundle\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController;

class UserRegistrationReportCRUDController extends CRUDController
{
    /**
     * return the Response object associated to the list action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return Response
     */
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm('report');

        return $this->render('SanReportBundle:Admin:report.html.twig', array(
            'form'   => $form->createView(),
            'action' => 'list'
        ));
    }
}
