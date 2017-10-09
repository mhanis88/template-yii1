<?php

/**
 * This is the model class for table "sys_menu".
 *
 * The followings are the available columns in table 'sys_menu':
 * @property integer $menu_id
 * @property string $menu_name
 * @property string $menu_url
 * @property integer $parent_menu_id
 * @property integer $divider
 * @property integer $menu_level
 * @property integer $seq
 * @property string $record_by
 * @property string $record_date
 * @property string $update_by
 * @property string $update_date
 * @property integer $is_publish
 *
 * The followings are the available model relations:
 * @property SysRole[] $roles
 * @property SysMenu $parentMenu
 * @property SysMenu[] $menus
 */
class SysMenu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('menu_name, menu_level, seq', 'required'),
            array('parent_menu_id, divider, menu_level, seq, is_publish', 'numerical', 'integerOnly' => true),
            array('menu_name, menu_url', 'length', 'max' => 100),
            array('record_by, update_by', 'length', 'max' => 50),
            array('record_date, update_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('menu_id, menu_name, menu_url, parent_menu_id, divider, seq, record_by, record_date, update_by, update_date, is_publish', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'roles' => array(self::MANY_MANY, 'SysRole', 'sys_access_menu(menu_id, role_id)'),
            'parentMenu' => array(self::BELONGS_TO, 'SysMenu', 'parent_menu_id'),
            'menus' => array(self::HAS_MANY, 'SysMenu', 'parent_menu_id'),
            
            'childs' => array(self::HAS_MANY, 'SysMenu', 'parent_menu_id', 'order' => 'seq ASC, menu_name ASC'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'menu_id' => 'Menu',
            'menu_name' => 'Menu Name',
            'menu_url' => 'Menu Url',
            'parent_menu_id' => 'Parent Menu',
            'divider' => 'Divider',
            'menu_level' => 'Level',
            'seq' => 'Seq',
            'record_by' => 'Record By',
            'record_date' => 'Record Date',
            'update_by' => 'Update By',
            'update_date' => 'Update Date',
            'is_publish' => 'Publish',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->with = array('parentMenu');

        $criteria->compare('t.menu_id', $this->menu_id);
        $criteria->compare('t.menu_name', $this->menu_name, true);
        $criteria->compare('t.menu_url', $this->menu_url, true);
        $criteria->compare('t.parent_menu_id', $this->parent_menu_id);
        $criteria->compare('t.divider', $this->divider);
        $criteria->compare('t.menu_level', $this->menu_level);
        $criteria->compare('t.seq', $this->seq);
        $criteria->compare('t.record_by', $this->record_by, true);
        $criteria->compare('t.record_date', $this->record_date, true);
        $criteria->compare('t.update_by', $this->update_by, true);
        $criteria->compare('t.update_date', $this->update_date, true);
        $criteria->compare('t.is_publish', $this->is_publish);

        $sort = new CSort;
        $sort->defaultOrder = array(
            'seq' => CSort::SORT_ASC,
        );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => $sort,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysMenu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->record_by = Yii::app()->user->id;
            $this->record_date = new CDbExpression('NOW()');
        } else {
            $this->record_date = GeneralFunction::formatDate($this->record_date, "Y-m-d H:i:s");
            $this->update_by = Yii::app()->user->id;
            $this->update_date = new CDbExpression('NOW()');
        }

        return parent::beforeSave();
    }

    protected function afterSave() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");

        return parent::afterSave();
    }

    protected function afterFind() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");

        return parent::afterFind();
    }

    /*
     * to find the list of menu
     * SysMenu::model()->getMenuList();
     * return array
     */

    public function getMenuList($parentOnly=false) {
        
        if($parentOnly){
            $model = SysMenu::model()->with('parentMenu')->findAll(array('order' => 'parentMenu.seq'));
            $list = [];
            foreach($model as $menu){
                if(isset($menu->parentMenu->menu_name)){
                    $list[$menu->parent_menu_id] = $menu->parentMenu->menu_name;
                }
            }
        }
        else{
            $criteria = array(
                // 'is_active' => 1,
                // 'is_delete' => 0,
            );
            $model = SysMenu::model()->findAllByAttributes($criteria, array('order' => 'seq'));
            $list = CHtml::listData($model, 'menu_id', 'menu_name');            
        }
        return $list;
        
    }
    
    public function getParentMenuList($parentOnly=true) {
        
        if($parentOnly){
            $model = SysMenu::model()->with('parentMenu')->findAll(array('order' => 'parentMenu.seq'));
            $list = [];
            foreach($model as $menu){
                if(isset($menu->parentMenu->menu_name)){
                    $list[] = ['parent_id' => $menu->parent_menu_id, 'id' => $menu->menu_id, 'level' => $menu->menu_level];
                }
            }
        }
        return $list;
        
    }

    /*
     * to get all menu in the form of multidimensional array
     * SysMenu::model()->getAllMenuArray();
     * return array
     */

    public function getAllMenuArray($skipLevel=false) {
        $modelMenu = SysMenu::model()->findAll(array('condition' => 'is_publish = :publish', 'order' => 'seq ASC', 'params' => array(':publish' => 1)));
        $arrMenu = array();
        foreach ($modelMenu as $menu) {
            if($skipLevel===true)
                $arrMenu[] = array('parent_id' => $menu->parent_menu_id, 'id' => $menu->menu_id);
            else
                $arrMenu[] = array('parent_id' => $menu->parent_menu_id, 'id' => $menu->menu_id, 'level' => $menu->menu_level);
        }
        
        return GeneralFunction::buildTreeMenu($arrMenu);
    }

    /*
     * to get all menu in the form of multidimensional array
     * SysMenu::model()->getAllMenuArray();
     * return array
     */

    public function getAllowMenuArray($menu) {
        $criteria = array(
            'is_publish' => 1,
            'menu_id' => $menu,
        );
        
        if(Yii::app()->user->id == 'sysadmin'){
            unset($criteria['menu_id']);
        }
        
        $modelMenu = SysMenu::model()->findAllByAttributes($criteria,array('order' => 'seq ASC'));
        $arrMenu = array();
        foreach ($modelMenu as $menu) {
            $arrMenu[] = array('parent_id' => $menu->parent_menu_id, 'id' => $menu->menu_id);
        }

        return GeneralFunction::buildTreeMenu($arrMenu);
    }

    /*
     * to get all menu in the form of multidimensional array
     * SysMenu::model()->getAllChildrenMenu();
     * return mix either boolean(false) or array
     */

    public function getAllChildrenMenu($menu_id,$skipLevel=false) {
        $allMenu = $this->getAllMenuArray($skipLevel);
        $allChildren = GeneralFunction::getChildrenFor($allMenu,$menu_id);

        return $allChildren;
    }

    /*
     * to get all children menu in the form of array
     * SysMenu::model()->getAllRelatedMenu();
     * return mix either boolean(false) or array($activeMenu)
     */

    public function getAllRelatedMenu($menu_id,$skipLevel=false) {
        $allChildren = $this->getAllChildrenMenu($menu_id,$skipLevel);
        if($allChildren!==false){
            // $allMenu = $this->getAllMenuArray($skipLevel);
            $activeMenu = GeneralFunction::getFinalMenu($allChildren);
            $activeMenu = array_unique($activeMenu);
            return $activeMenu;
        }
        return false;
    }

    /*
     * to get all related module/controller/action
     * use to set active menu
     * SysMenu::model()->getControllerModuleAction();
     * return array
     */

    public function getControllerModuleAction($menu_id){
        /*
         * check if supplied menu_id has children
         * if not false then it will return an array
         * else just use the given menu_id
         */
        if($this->getAllChildrenMenu($menu_id)!==false){
            $menu_id = $this->getAllRelatedMenu($menu_id,true);
        }
        $model = $this->findAllByAttributes(array('menu_id' => $menu_id));
        
        $current = [];
        $current['module'] = [];
        $current['controller'] = [];
        $current['action'] = [];

        foreach($model as $menu){
            $url = $menu->menu_url;
            if(!empty($url) && $url!='#'){
                $ar_url = explode('/',$url);
                $current['module'][] = isset($ar_url[0]) ? $ar_url[0] : '';
                $current['controller'][] = isset($ar_url[1]) ? $ar_url[1] : '';
                $current['action'][] = isset($ar_url[2]) ? $ar_url[2] : '';
            }
        }
        return $current;
    }

    /*
     * function to get multi level dropdownlist
     * saiful on 19/08/2015
     */

    public $data = array();

    public function getDropDownList($parent = '') {
        $criteria = new CDbCriteria;
        if (!empty($parent)) {
            $criteria->compare('parent_menu_id', $parent);
        } else {
            $criteria->condition = 'parent_menu_id IS NULL';
        }
        $criteria->order = 'seq ASC, menu_name ASC';
        $parents = $this->findAll($criteria);
        $data = $this->makeDropDown($parents);
        return $data;
    }

    /*
     * function to make dropdownlist
     * saiful on 19/08/2015
     */

    public function makeDropDown($parents) {
        global $data;

        $data = array();
        // $data[] = '';
        foreach ($parents as $parent) {
            $data[$parent->menu_id] = $parent->menu_name;
            // childs is the relation name
            $this->subDropDown($parent->childs);
        }

        return $data;
    }

    /*
     * function to make subdropdownlist
     * saiful on 19/08/2015
     */

    public function subDropDown($children, $space = '-') {
        global $data;

        foreach ($children as $child) {
            $data[$child->menu_id] = str_repeat('&nbsp;', strlen($space) * 3) . '- ' . $child->menu_name;
            // childs is the relation name
            $this->subDropDown($child->childs, $space . '-');
        }
    }

}
