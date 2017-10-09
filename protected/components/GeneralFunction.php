<?php

//include_once 'smartypants.php';

class GeneralFunction {
    /*
      Sanitize class
      Copyright (C) 2007 CodeAssembly.com
      This program is free software: you can redistribute it and/or modify
      it under the terms of the GNU General Public License as published by
      the Free Software Foundation, either version 3 of the License, or
      (at your option) any later version.
      This program is distributed in the hope that it will be useful,
      but WITHOUT ANY WARRANTY; without even the implied warranty of
      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
      GNU General Public License for more details.
      You should have received a copy of the GNU General Public License
      along with this program.  If not, see http://www.gnu.org/licenses/
     */

    /**
     * Sanitize only one variable .
     * Returns the variable sanitized according to the desired type or true/false
     * for certain data types if the variable does not correspond to the given data type.
     *
     * NOTE: True/False is returned only for telephone, pin, id_card data types
     *
     * @param mixed The variable itself
     * @param string A string containing the desired variable type
     * @return The sanitized variable or true/false
     */
    public static function sanitizeOne($var, $type) {
        switch ($type) {
            case 'int': // integer
                $var = (int) $var;
                break;
            case 'str': // trim string
                $var = trim($var);
                break;
            case 'nohtml': // trim string, no HTML allowed
                $var = htmlentities(trim($var), ENT_QUOTES);
                break;
            case 'plain': // trim string, no HTML allowed, plain text
                $var = htmlentities(trim($var), ENT_NOQUOTES);
                break;
            case 'upper_word': // trim string, upper case words
                $var = ucwords(strtolower(trim($var)));
                break;
            case 'ucfirst': // trim string, upper case first word
                $var = ucfirst(strtolower(trim($var)));
                break;
            case 'lower': // trim string, lower case words
                $var = strtolower(trim($var));
                break;
            case 'urle': // trim string, url encoded
                $var = urlencode(trim($var));
                break;
            case 'trim_urle': // trim string, url decoded
                $var = urldecode(trim($var));
                break;
            case 'telephone': // True/False for a telephone number
                $size = strlen($var);
                for ($x = 0; $x < $size; $x++) {
                    if (!( ( ctype_digit($var[$x]) || ($var[$x] == '+') || ($var[$x] == '*') || ($var[$x] == 'p')) )) {
                        return false;
                    }
                }
                return true;
                break;
            case 'pin': // True/False for a PIN
                if ((strlen($var) != 13) || (ctype_digit($var) != true)) {
                    return false;
                }
                return true;
                break;
            case 'id_card': // True/False for an ID CARD
                if ((ctype_alpha(substr($var, 0, 2)) != true ) || (ctype_digit(substr($var, 2, 6)) != true ) || ( strlen($var) != 8)) {
                    return false;
                }
                return true;
                break;
            case 'sql': // True/False if the given string is SQL injection safe
                //  insert code here, I usually use ADODB -> qstr() but depending on your needs you can use mysql_real_escape();
                return mysql_real_escape_string($var);
                break;
        }
        return $var;
    }

    /**
     * Sanitize an array.
     *
     * sanitize($_POST, array('id'=>'int', 'name' => 'str'));
     * sanitize($customArray, array('id'=>'int', 'name' => 'str'));
     *
     * @param array $data
     * @param array $whatToKeep
     */
    public static function sanitize(&$data, $whatToKeep) {
        $data = array_intersect_key($data, $whatToKeep);
        foreach ($data as $key => $value) {
            $data[$key] = sanitizeOne($data[$key], $whatToKeep[$key]);
        }
    }

    // Change random generator to return UUID Version 3 to avoid collision and keep id format
    public static function randomgenerator($length = 10) {
        // $length is not used, kept in parameter to avoid code change from previous function usage
        $namespace = '1546058f-5a25-4334-85ae-e68f2a44bbaf';
        $name = uniqid();

        // Get hexadecimal components of namespace
        $nhex = str_replace(array('-', '{', '}'), '', $namespace);

        // Binary Value
        $nstr = '';

        // Convert Namespace UUID to bits
        for ($i = 0; $i < strlen($nhex); $i+=2) {
            $nstr .= chr(hexdec($nhex[$i] . $nhex[$i + 1]));
        }

        // Calculate hash value
        $hash = md5($nstr . $name);

        return strtoupper(sprintf('%08s-%04s-%04x-%04x-%12s',
                        // 32 bits for "time_low"
                        substr($hash, 0, 8),
                        // 16 bits for "time_mid"
                        substr($hash, 8, 4),
                        // 16 bits for "time_hi_and_version",
                        // four most significant bits holds version number 3
                        (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,
                        // 16 bits, 8 bits for "clk_seq_hi_res",
                        // 8 bits for "clk_seq_low",
                        // two most significant bits holds zero and one for variant DCE1.1
                        (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
                        // 48 bits for "node"
                        substr($hash, 20, 12)
        ));
    }

    public static function passwordgenerator($length = 8) {
        $chars = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));

        return $password;
    }

    public static function purifyText($html) {

        $pattern = '/\<\?xml([^\>\/]*)\/\>/'; // or with * replaced with +
        $html = preg_replace($pattern, '', $html);

        $purifier = new CHtmlPurifier;
        $clean = strip_tags($purifier->purify($html));

        $clean = str_replace(chr(194), "", $clean);   // removing � from string (need to set UTF=8 encoding for database)

        $StrArr = str_split($clean);
        $NewStr = '';
        foreach ($StrArr as $Char) {
            $CharNo = ord($Char);
            if ($CharNo == 163) { // keep £ 
                $NewStr .= $Char;
                continue;
            }
            if ($CharNo > 31 && $CharNo < 127) {
                $NewStr .= $Char;
            }
        }

        $clean = utf8_encode($NewStr);
        $shorten = substr($clean, 0, 100);

        return $shorten . '...';
    }

    public static function CleanXMLText($html) {
        $pattern = '/\<\?xml([^\>\/]*)\/\>/'; // or with * replaced with +

        $html = preg_replace($pattern, '', $html);
        $html = preg_replace('/<\?xml.*\/>/im', '', $html);
        return $html;
    }

    public static function checkwordpaste($html) {
        if (strpos($html, 'MsoNormal') == true)
            return true;
    }

    public static function purifyFullText($html) {
        $pattern = '/\<\?xml([^\>\/]*)\/\>/'; // or with * replaced with +
        $html = preg_replace($pattern, '', $html);

        $purifier = new CHtmlPurifier;
        $clean = strip_tags($purifier->purify($html));

        $clean = str_replace(chr(194), "", $clean);   // removing � from string (need to set UTF=8 encoding for database)

        $StrArr = str_split($clean);
        $NewStr = '';
        foreach ($StrArr as $Char) {
            $CharNo = ord($Char);
            if ($CharNo == 163) { // keep £ 
                $NewStr .= $Char;
                continue;
            }
            if ($CharNo > 31 && $CharNo < 127) {
                $NewStr .= $Char;
            }
        }

        $clean = utf8_encode($clean);

        return $clean;
    }
    
    public static function formatDate($date = "", $format = "d-m-Y") {
        if ($date != "") {
            // convert to display format
            $date = strtotime($date);
            $date = date("$format", $date);
        } else {
            $date = null;
        }
        return $date;
    }

    public static function setStatusLabel() {
        $arr = array(
            0 => Yii::t('app', 'InActive'),
            1 => Yii::t('app', 'Active'),
        );
        return $arr;
    }

    public static function getStatusLabel($index) {
        $arr = self::setStatusLabel();

        if (isset($arr[$index])) {
            return $arr[$index];
        }

        return $index;
    }

    // status Active or Inactive
    public static function gridStatus($data) {
        return self::getStatusLabel($data);
    }

    public static function setYesNoLabel() {
        $arr = array(
            1 => Yii::t('app', 'Yes'),
            0 => Yii::t('app', 'No'),
        );
        return $arr;
    }

    public static function getYesNoLabel($index) {
        $arr = self::setYesNoLabel();

        if (isset($arr[$index])) {
            return $arr[$index];
        }

        return $index;
    }

    // status Active or Inactive
    public static function gridYesNo($data) {
        return self::getYesNoLabel($data);
    }
    
    public static function setEditableSource($arr, $attr = ''){
        $data = [];
        
        foreach($arr as $index => $value){
            if(is_object($value)){  
                $data[] = ['value' => $value->{$value->tableSchema->primaryKey}, 'text' => $value->{$attr}];
            }
            else{
                $data[] = ['value' => $index, 'text' => $value];
            }
        }
        return $data;
    }

    // use for dynamic user menu ***********************************************
    /*
     * create multidimensional array for the menu
     */
    public static function buildTreeMenu(array $elements, $parentId = null) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildTreeMenu($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    /*
     * create menu from the created array menu from function buildTreeMenu
     */
    public static function drawMenuNav($currentNav, $listOfItems, $first = true) {
        // global $nav_module;
        $nav_module = $currentNav['module'];
        $nav_controller = $currentNav['controller'];
        $nav_action = $currentNav['action'];

        if ($first != true) {
            echo '<ul class="dropdown-menu" role="menu">';
        }

        foreach ($listOfItems as $item) {

            $model = SysMenu::model()->findByPk($item['id']);
            $url = $model->menu_url;

            $hasChildren = isset($item['children']) ? true : false;

            $parentClass = 'class="';
            $parentMenuLink = '';
            $menuLabel = Yii::t('app', $model->menu_name);

            $currentActive = SysMenu::model()->getControllerModuleAction($item['id']);

            if ($hasChildren) {
                $parentClass .= 'dropdown';
                $parentMenuLink = 'class="dropdown-toggle" data-toggle="dropdown"';

                if ($first) {
                    $parentMenuLink .= ' role="button" aria-expanded="false"';
                    $menuLabel .= ' <span class="caret"></span>';
                } else {
                    $parentClass .= '-submenu';
                }
            }

            if ($hasChildren) {
                if (in_array($nav_module, $currentActive['module']) && in_array($nav_controller, $currentActive['controller'])) {
                    $parentClass .= ' active';
                }
            } else {
                if (in_array($nav_module, $currentActive['module']) && in_array($nav_controller, $currentActive['controller']) && in_array($nav_action, $currentActive['action'])) {
                    $parentClass .= ' active';
                }
            }

            $parentClass .= '"';

            $menuLink = (empty($url) || $url == '#') ? '#' : Yii::app()->createUrl($url);

            if ($model->divider == 1)
                echo '<li class="divider"></li>';

            echo '<li ' . $parentClass . '><a href="' . $menuLink . '" ' . $parentMenuLink . '>' . $menuLabel . '</a>';
            if ($hasChildren) {
                self::drawMenuNav($currentNav, $item['children'], false);
            }
            echo "</li>\n";
        }

        if ($first != true) {
            echo '</ul>';
        }
    }

    /*
     * get the children of the parent menu
     */
    public static function getChildrenFor($ary, $id) {
        $results = array();

        foreach ($ary as $el) {
            if ($el['parent_id'] == $id) {
                $results[] = $el;
            }
            if (isset($el['children']) && count($el['children']) > 0 && ($children = self::getChildrenFor($el['children'], $id)) !== FALSE) {
                $results = array_merge($results, $children);
            }
        }

        return count($results) > 0 ? $results : FALSE;
    }

    /*
     * pull out the children so that it will be the same level as parent
     */
    public static function getFinalMenu($arr) {
        $out = array();
        if (is_array($arr)) {
            foreach ($arr as $a) {
                $out = array_merge($out, self::getFinalMenu($a));
            }
            return $out;
        } else
            return array($arr);
    }

    public static function printTree($tree, $r = 0, $p = null) {
        foreach ($tree as $i => $t) {
            $dash = ($t['parent_id'] == 0) ? '' : str_repeat('&nbsp;', $r * 3) . '- ';

            $model = SysMenu::model()->findByPk($t['id']);
            printf("\t<option value='%d'>%s%s</option>\n", $t['id'], $dash, $model->menu_name);
            if (isset($t['children'])) {
                self::printTree($t['children'], $r + 1, $t['parent_id']);
            }
        }
    }

    public static function printAccessMenu($checked, $tree, $r = 0, $p = null) {
        foreach ($tree as $i => $t) {
            $dash = ($t['parent_id'] == 0) ? '' : str_repeat('&nbsp;', $r * 6);
            $chkbx = CHtml::checkBox('Menu[]', (in_array($t['id'], $checked) ? true : false), array('value' => $t['id']));

            $model = SysMenu::model()->findByPk($t['id']);
            echo '<div class="checkbox">'. $dash .'<label>'. $chkbx .' <span class="cls-access-menu cls-parent-'. $t['parent_id'] .'">'. $model->menu_name .'</span></label></div>';
            if (isset($t['children'])) {
                self::printAccessMenu($checked, $t['children'], $r + 1, $t['parent_id']);
            }
        }
    }

    public static function roleCheckerAction($role, $controller, $action = '') {
        if (Yii::app()->user->id == 'sysadmin') {
            return true;
        }

        $condition = array(
            'role_id' => $role,
            'module_name' => isset($controller->module) ? $controller->module->id : '',
            'controller_name' => $controller->id,
            'action_name' => empty($action) ? $controller->action->id : $action,
        );
        $count = VwRoleAccess::model()->countByAttributes($condition);

        return ($count > 0) ? true : false;
    }

    /*
     * get the value from the given/supplied model
     * @param object $model, object of the model
     * @param string $attributes, column name in the object
     * return array
     * 
     * saiful on 08/09/2015
     */
    public static function getUniqueKey($model, $attributes) {
        $key = array();
        foreach ($model as $m) {
            $value = $m->getAttributes(array($attributes));
            $key[] = $value[$attributes];
        }
        return $key;
    }

    public static function get_client_ip() {
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}
