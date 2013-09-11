<?php

namespace Msi\SearchBundle\Controller;

use Msi\AdminBundle\Controller\Controller;

class SearchController extends Controller
{
    public function searchAction()
    {
        $ids = $this->container->getParameter('msi_search.search_ids');
        foreach ($ids as $id) {
            $admin = $this->get($id);
        }

        return $this->renderStuff();
    }
}
