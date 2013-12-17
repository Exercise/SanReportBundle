<?php

namespace San\ReportBundle\Controller\Admin;

use San\ReportBundle\Model\Plot;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @ParamConverter("plot", class="San\ReportBundle\Model\Plot", converter="fos_rest.request_body")
     */
    public function dataAction(Request $request, Plot $plot)
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $data = $this->get('san.plot_service')->getData($plot);

        return $this->renderJson($data);
    }
}
