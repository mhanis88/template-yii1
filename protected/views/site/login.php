<style>
    /*
         * for sidebar Document (Guidelines & Manual)
         */
    nav.sidebar-menu-collapsed {
        width: 40px;
    }

    nav.sidebar-menu-expanded {
        width: 106px;
    }

    nav.sidebar {
        position: fixed;
        top: 55%;
        right: 0px;
        height: auto;
        background: none repeat scroll 0 0 lightgrey;
        color: white;
        padding: 10px 10px;
    }

    nav.sidebar a#justify-icon {
        outline: 0;
        color: white;
        font-size: 24px;
        font-style: normal;
    }

    nav.sidebar a#logout-icon {
        outline: 0;
        color: white;
        font-size: 24px;
        font-style: normal;
        position: absolute;
        bottom: 10px;
        left: 10px;
    }

    nav.sidebar ul {
        margin: 0;
        padding: 0;
        /* margin-top: 150px; */
    }

    nav.sidebar ul li {
        margin: 0;
        padding: 0;
        /* margin-top: 20px; */
        list-style-type: none;
    }

    nav.sidebar ul li a.expandable {
        outline: 0;
        color: grey;
        text-decoration: none;
        font-size: 20px;
    }

    nav.sidebar ul li a.expandable:hover {
        color: #bbbbbb;
    }

    nav.sidebar ul li a.expandable span.expanded-element {
        margin-left: 2px;
        display: none;
        font-size: 11px;
        position: relative;
        bottom: 2px;
    }

    nav.sidebar ul li.active {
        background: none repeat scroll 0 0 black;
        border-radius: 4px;
        text-align: center;
        margin-left: -4px;
        padding: 4px;
    }

    nav.sidebar ul li.active a.expandable {
        color: white !important;
    }

    nav.sidebar ul li.active a.expandable:hover {
        color: white !important;
    }
</style>

<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
/*
  $this->breadcrumbs = array(
  'Login',
  );
 */
?>

<div class="container">
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">Log In</div>
            </div>

            <div class="panel-body" >
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
                    'htmlOptions' => array('class' => 'form-horizontal'),
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
                ?>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'placeholder' => Yii::t('app', 'Username'), 'id' => 'user')); ?>
                </div>
                <?php echo $form->error($model, 'username', array('class' => 'bg-danger')); ?>
                <br />
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => Yii::t('app', 'Password'), 'id' => 'password')); ?>
                </div>
                <?php echo $form->error($model, 'password', array('class' => 'bg-danger')); ?>
                <br />
                <div class="form-group">
                    <!-- Button -->
                    <div class="col-sm-12 controls rememberMe">
                        <?php echo $form->checkBox($model, 'rememberMe'); ?>
                        <?php echo $form->label($model, 'rememberMe'); ?>
                        <?php // echo $form->error($model, 'rememberMe'); ?>
                    </div>
                    <div class="col-sm-12 controls">
                        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary pull-right')); ?>
                        <h6><?php echo CHtml::link(Yii::t('app', 'Forgot Password ?'), Yii::app()->createUrl('site/forgotPassword')) ?></h6>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>

<nav class='sidebar sidebar-menu-collapsed hidden-xs hidden-sm hidden-phone hidden-tablet'>
    <ul>
        <li>
            <a tabindex="0" class="expandable" id="popoverGuideline">
                <span class="fa-stack collapsed-element" data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t('app', 'Themes') ?>" data-content="Test themes"><span class="glyphicon glyphicon-list-alt"></span><!--<i class="fa fa-bookmark"></i>-->
                    <span class="expanded-element"><?php echo Yii::t('app', 'Themes') ?></span>
            </a>
        </li>
    </ul>
</nav>

<div id="popoverGuidelineContent" style="display: none">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'themes-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
    ));
    ?>

    <div class="form-group">
        <div class="col-sm-8">
            <?php echo CHtml::radioButtonList('all_themes', SysThemes::getCurrentThemesByID(), SysThemes::getOptionList(), array('class' => 'picked', 'labelOptions' => array('style' => 'color:grey'))); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div> 