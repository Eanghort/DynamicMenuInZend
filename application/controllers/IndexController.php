<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $tblMenu = new Application_Model_DbTable_Menu();
        $data = $tblMenu->getMenus();
        $this->view->data=$data;
    }

    public function addMenuAction()
    {
        $menu = new Application_Model_DbTable_Menu();
        $frmAdd = new Application_Form_FrmAddMenu();
        
        $this->view->form = $frmAdd;
        if($this->getRequest()->isPost()){
            $frmData = $this->getRequest()->getPost();
            if($frmAdd->isValid($frmData)){
                $menu_name = $frmAdd->getValue('menu_name');
                $parent_id = $frmAdd->getValue('parent_id');
                $tblMenu = new Application_Model_DbTable_Menu();
                $tblMenu->addMenu($menu_name, $parent_id);
                $frmAdd->reset();
            }
        }
        else{
            $parent_menu=$menu->getMenus();
            $frmAdd->set_parent_menu($menu->getMenus());
        }
    }

    public function updateMenuAction()
    {
        $frmUpdate=new Application_Form_FrmAddMenu();
        $menus = new Application_Model_DbTable_Menu();
        $frmUpdate->set_parent_menu($menus->getMenus());
        $frmUpdate->Add->setLabel('Save');
        $this->view->form=$frmUpdate;
        if($this->getRequest()->isPost()){
            $frmData=$this->getRequest()->getPost();
            if($frmUpdate->isValid($frmData)){
                $menu_id = (int)$frmUpdate->getValue('menu_id');
                $menu_name=$frmUpdate->getValue('menu_name');
                $parent_id=$frmUpdate->getValue('parent_id');
                $tblMenu = new Application_Model_DbTable_Menu();
                $tblMenu->updateMenu($menu_id, $menu_name, $parent_id);
                $frmUpdate->reset();
            }
            else{
                $frmUpdate->populate($frmData);
            }
        }
        else{
            $id=$this->_getParam('id', 0);
            $frmUpdate->populate($menus->getMenu($id));
        }
    }

    public function deleteMenuAction()
    {
        $id=$this->_getParam('id',0);
        if($id>0){
            $tblmenu = new Application_Model_DbTable_Menu();
            $tblmenu->deleteMenu($id);
        }
    }


}







