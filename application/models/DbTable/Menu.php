<?php

class Application_Model_DbTable_Menu extends Zend_Db_Table_Abstract
{

    protected $_name = 'tbl_menu';
    
    public function addMenu($name, $parentId){
        $data=array(
            'menu_name'=>$name,
            'parent_id'=>$parentId,
        );
        $this->insert($data);
    }
    
    public function updateMenu($id, $name, $parentId){
        try{
            
        $data=array(
            'menu_name'=>$name,
            'parent_id'=>$parentId,
        );
        $this->update($data, 'menu_id=' . (int)$id);
        } catch (Exception $ex) {
echo $ex->getMessage();
        }
    }
    
    public function deleteMenu($id){
        $this->delete('menu_id=' . $id);
    }
    
    public function getMenu($id){
        $row=$this->fetchRow('menu_id=' . (int)$id);
        if(!$row){
            throw new Exception('Menu not found');
        }
        return $row->toArray();
    }
    public function getMenus(){
        $row = $this->fetchAll();
        $menu = array();
        foreach($row as $r){
            $menu[$r['menu_id']]=$r['menu_name'];
            //$menu=array($r['menu_id']=>$r['menu_name']);
        }
        return $menu;
    }
}

