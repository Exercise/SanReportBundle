<?php

namespace San\ReportBundle\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class ReportCRUDController extends CRUDController
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
            'action' => 'list',
        ));
    }

    /**
     * Returns data for graph
     *
     * @return Response
     * @throws AccessDeniedException
     */
    public function dataAction(Request $request)
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $data = array();
        for ($i = 1; $i <= 60; $i++) {
            $data[] = array(strtotime('-' . (65 - $i) . ' days'), rand(50,100));
        }

        return $this->renderJson(array(0 => $data));
    }
}
