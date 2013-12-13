<?php

namespace San\ReportBundle\Controller\Admin;

use San\ReportBundle\Form\Model\Plot;
use Sonata\AdminBundle\Controller\CRUDController;

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
        $data = array();
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $plot = new Plot();
        $form = $this->createForm('plot_report', $plot);
        $form->handleRequest($this->get('request'));
        if ($form->isValid()) {
            $data = $this->get('san.plot_service')->getData($form->get('reports')->getData());
        }

        return $this->render('SanReportBundle:Admin:report.html.twig', array(
            'form'   => $form->createView(),
            'data'   => $data,
            'action' => 'list',
        ));
    }

    /**
     * Returns data for graph
     *
     * @return Response
     * @throws AccessDeniedException
     */
    public function dataAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $data = array();
        for ($i = 1; $i <= 60; $i++) {
            $data[] = array(strtotime('-' . (65 - $i) . ' days'), rand(50,100));
        }

        return $this->renderJson($data);
    }
}
