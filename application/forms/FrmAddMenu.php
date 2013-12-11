<?php

class Application_Form_FrmAddMenu extends Zend_Form
{
    protected $parent_menu = array();
    private $menu_parent = null;
    public function init()
    {
        $this->setName('frmMenu');
        $this->setMethod('post');
        $menu_id = $this->createElement('hidden','menu_id');
        $this->addElement($menu_id);
        $menu_name = $this->createElement('text', 'menu_name');
        $menu_name->setLabel('Menu Name');
        $this->addElement($menu_name);
        $this->menu_parent = $this->createElement('select', 'parent_id');
        $this->menu_parent->setLabel('Parent Menu');
        $this->menu_parent->addMultiOptions(array('0'=>'NULL'));
        $this->addElement($this->menu_parent);
        $add = $this->createElement('submit','Add');
        $this->addElement($add);
        $cancel = $this->createElement('button','Cancel');
        $this->addElement($cancel);
    }
    public function set_parent_menu($parent){
        $this->menu_parent->addMultiOptions($parent);
    }
}

