<?php
/* @var $this UsergroupController */
/* @var $model Usergroup */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usergroup-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
		'clientOptions' => array('validateOnSubmit'=>true),		
		
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'userid'); ?>
		<?php 
		echo $form->dropDownList($model, 'userid', CHtml::listData(Profile::model()->findAll(array('order' => 'firstname')), 'user_id', 'fullname'));
		
		?>
		<?php echo $form->error($model,'userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groupid'); ?>
		<?php 
		echo $form->dropDownList($model, 'groupid', CHtml::listData(Group::model()->findAll(array('order' => 'gname')), 'id', 'gname'));		
		?>
		<?php echo $form->error($model,'groupid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn-primary')); ?>
		</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
			