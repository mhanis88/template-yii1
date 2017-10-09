<?php
/*
 * osh on 03/10/2014 : Create separate menu files to be loaded based on user role id
 * System Administrator Main Navigation
 * 
 */
$nav_module = '';
if (isset(Yii::app()->controller->module->id))
    $nav_module = Yii::app()->controller->module->id; //print_r($this->uniqueid);exit;
?>

<?php
Yii::app()->clientScript->registerCss("", "
//hazam 21/5/2015
/* Special class on .container surrounding .navbar, used for positioning it into place. */
.navbar-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    z-index: 20;
    margin-top: 20px;
}

/* Flip around the padding for proper display in narrow viewports */
.navbar-wrapper .container {
    padding-left: 0;
    padding-right: 0;
}
.navbar-wrapper .navbar {
    padding-left: 15px;
    padding-right: 15px;
}

.navbar-content {
    width:320px;
    padding: 15px;
    padding-bottom:0px;
}
.navbar-content:before, .navbar-content:after {
    display: table;
    content: '';
    line-height: 0;
}
.navbar-nav.navbar-right:last-child {
    margin-right: 15px !important;
}
.navbar-footer
{
    background-color:#DDD;
}
.navbar-footer-content { padding:15px 15px 15px 15px; }
");
?>

<ul class="nav navbar-nav">
    <?php if (!Yii::app()->user->isGuest): ?>
        <li <?php echo ($this->uniqueid == 'site' && $this->action->id == 'index' ? 'class="active"' : '') ?>>
            <a href="<?php echo Yii::app()->createUrl('site/index'); ?>"><span class="glyphicon glyphicon-home"></span> <?php echo Yii::t('app', 'Home') ?></a>
        </li>

        <?php
        $treeMenu = SysMenu::model()->getAllowMenuArray(SysRoleMenu::model()->getAllowedMenu(Yii::app()->user->role));
        $currentNav = array('module' => $nav_module, 'controller' => $this->id, 'action' => $this->action->id);
        GeneralFunction::drawMenuNav($currentNav, $treeMenu);
        ?>

        <?php /*
          <li <?php echo ($this->uniqueid == 'site' && $this->action->id == 'page' && $this->action->view == 'pages/about' ? 'class="active"' : '') ?>>
          <a href="<?php echo Yii::app()->createUrl('site/page', array('view' => 'about')); ?>"><?php echo Yii::t('app', 'About') ?></a>
          </li>
          <li <?php echo ($this->uniqueid == 'site' && $this->action->id == 'contact' ? 'class="active"' : '') ?>>
          <a href="<?php echo Yii::app()->createUrl('site/contact'); ?>"><?php echo Yii::t('app', 'Contact') ?></a>
          </li>
          <li <?php echo ($this->uniqueid == 'site' && $this->action->id == 'page' && $this->action->view == 'pages/example' ? 'class="active"' : '') ?>>
          <a href="<?php echo Yii::app()->createUrl('site/page', array('view' => 'example')); ?>"><?php echo Yii::t('app', 'Example') ?></a>
          </li>
          <li <?php echo ($this->uniqueid == 'booster' && $this->action->id == 'index' ? 'class="active"' : '') ?>>
          <a href="<?php echo Yii::app()->createUrl('booster/index'); ?>"><?php echo Yii::t('app', 'Yii Booster') ?></a>
          </li>
         */ ?>
    <?php endif; ?>
</ul>


<ul class="nav navbar-nav navbar-right">
    <?php
    /*
     * this could be useful if system requirement using dual language
     */
    /*
      ?>
      <li>
      <a href="<?php echo Yii::app()->createUrl('/site/language',array('id'=>1)); ?>"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/icons/my.png'); ?></a>
      </li>
      <li>
      <a href="<?php echo Yii::app()->createUrl('/site/language',array('id'=>0)); ?>"><?php echo CHtml::image(Yii::app()->baseUrl.'/images/icons/gb.png'); ?></a>
      </li>
      <?php
     */
    ?>
    <?php if (Yii::app()->user->isGuest): ?>
        <li <?php echo ($this->uniqueid == 'site' && $this->action->id == 'login' ? 'class="active"' : '') ?>>
            <a href="<?php echo Yii::app()->createUrl('site/login'); ?>"><?php echo Yii::t('app', 'Login') ?></a>
        </li>
    <?php else: ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo Yii::t('app', 'My Profile') . ' ( ' . Yii::app()->user->name . ' )'; ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="<?php echo Yii::app()->createUrl('site/changePassword', array('id' => Yii::app()->user->id)) ?>"><?php echo Yii::t('app', 'Change Password'); ?></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">
                        <span class="glyphicon glyphicon-off"></span>&nbsp;<?php echo Yii::t('app', 'Logout') ?>
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
</ul>