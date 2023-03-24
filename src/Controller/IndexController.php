<?php
/**
 * Created by PhpStorm.
 * User: renato
 * Date: 28/09/18
 * Time: 18.28
 */

namespace CostTranslation\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Zf2datatable\Column as Column;


class IndexController extends AbstractActionController
{
    protected $ServiceLocator;
    protected $MvcTranslator;

    /**
     * @return mixed
     */
    public function getServiceLocator()
    {
        return $this->ServiceLocator;
    }

    /**
     * @param mixed $ServiceLocator
     */
    public function setServiceLocator($ServiceLocator)
    {
        $this->ServiceLocator = $ServiceLocator;
    }

    /**
     * @return mixed
     */
    public function getMvcTranslator()
    {
        return $this->MvcTranslator;
    }

    /**
     * @param mixed $MvcTranslator
     */
    public function setMvcTranslator($MvcTranslator)
    {
        $this->MvcTranslator = $MvcTranslator;
    }



    public function gridtranslationAction()
    {
        $sm = $this->getServiceLocator();
        $translator = $sm->get('translator');
        $request = $this->getRequest();
        $grid = $sm->get('zf2datatablegrid');
        $grid->setTitle('Users');
        $grid->setDefaultItemsPerPage(5);
        $grid->setTranslator($translator);

        $doctrine2Service = $sm->get('doctrine2service');
        $em = $sm->get('doctrine.entitymanager.orm_default');
        $EntitiName = 'CostTranslation\Entity\Message';
        $qb = $em->createQueryBuilder();
        $qb->select('msg');
        $qb->from($EntitiName, 'msg');
        $grid->setDataSource($doctrine2Service->getSource($qb));
        $grid->getDataSource()->setEntity($EntitiName);

        $grid->setisAllowAdd(true);
        $grid->setisAllowEdit(true);
        $grid->setisAllowDelete(true);
        $grid->setisAllowView(false);

        $identity = $grid->getIdentyColumns();
        $grid->setIsCrud(true);
        $grid->setFrmMainCrud(new $EntitiName(), true);

        $col = new Column\Select('messageId', 'msg');
        $col->setLabel('Id');
        $col->setIdentity(true, false);
        $grid->addColumn($col);

        $col = new Column\Select('key', 'msg');
        $col->setLabel('Translatin Key');
        $grid->addColumn($col);

        $col = new Column\Select('textEn', 'msg');
        $col->setLabel('English');
        $grid->addColumn($col);

        $col = new Column\Select('textIt', 'msg');
        $col->setLabel('Italian');
        $grid->addColumn($col);

        $grid->render();
        return $grid->getResponse();
    }


    public function switchlanguageAction()
    {
        $e = $this->getEvent();
        $routematch = $e->getRouteMatch();
        $lang = ($routematch->getParam("language")) ?: null;
        $redirect = ($routematch->getParam("redirect")) ?: null;
        return $this->redirect()->toRoute($redirect);
    }

}