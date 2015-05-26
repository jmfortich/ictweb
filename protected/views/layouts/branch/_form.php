<?php
/* @var $this BranchController */
/* @var $model Branch */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'branch-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'brcode'); ?>
		<?php echo $form->textField($model,'brcode',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'brcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brname'); ?>
		<?php echo $form->textField($model,'brname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'brname'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->