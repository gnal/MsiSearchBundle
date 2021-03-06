<?php

namespace Msi\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    public function searchAction()
    {
        $parameters = [];
        $parameters['searches'] = [];
        $t = $this->getRequest()->query->get('t');

        if ($q = $this->getRequest()->query->get('q')) {
            $entities = $this->container->getParameter('msi_search.entities');
            foreach ($entities as $k => $entity) {
                $parts = explode(':', $entity);

                $repo = $this->getDoctrine()->getManager()->getRepository($entity);
                $qb = $repo->getSearchQueryBuilder($q);
                $parameters['searches'][$k]['bundle'] = $parts[0];
                $parameters['searches'][$k]['entity'] = $parts[1];
                $parameters['searches'][$k]['pager'] = $this->get('msi_admin.pager.factory')->create($qb);
                $parameters['searches'][$k]['pager']->paginate($this->getRequest()->query->get('page', 1) ?: 1, $t === null ? 3 : 10);
                $parameters['searches'][$k]['rows'] = $parameters['searches'][$k]['pager']->getIterator()->getArrayCopy();

                if (null === $t || intval($t) === $k) {
                    $parameters['searches'][$k]['active'] = true;
                } else {
                    $parameters['searches'][$k]['active'] = false;
                }
            }
        }

        return $this->render('MsiSearchBundle:Search:search.html.twig', $parameters);
    }
}
