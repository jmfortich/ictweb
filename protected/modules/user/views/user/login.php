<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>


<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>
<!-- 
<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>
 -->
<br><br><br><br><br>
 <div style="width:370px; margin: 0 auto;" > 
<div class="form wide">
<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'<img src="'.Yii::app()->theme->baseUrl.'/img/lock.gif"> Security Login',
		//'title'=>'<span class="icon icon-application_key">Security Login</span>',
));

	$form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array('validateOnSubmit'=>true)
	));

?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php // echo CHtml::errorSummary($model); 
		// echo $form->errorSummary($model); 
	?>
	
	<div class="row">
		<?php //echo CHtml::activeLabelEx($model,'username'); ?>
		<?php //echo CHtml::activeTextField($model,'username') ?>
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
		<?php //echo CHtml::activeLabelEx($model,'password'); ?>
		<?php //echo CHtml::activePasswordField($model,'password') ?>
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<p class="hint">
		<?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
		</p>
	</div>
	
	<!-- 
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>
	 -->
	 
	<div class="row buttons">
		<?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'btn-primary')); ?>
	</div>
	
<?php // echo CHtml::endForm(); ?>
<?php $this->endWidget(); 
 $this->endWidget(); ?>
</div><!-- form -->
</div>

<?php /*
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);*/
?>