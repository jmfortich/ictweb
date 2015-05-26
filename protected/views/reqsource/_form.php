<?php
/* @var $this ReqsourceController */
/* @var $model Reqsource */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reqsource-form',
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
		<?php echo $form->labelEx($model,'rsname'); ?>
		<?php echo $form->textField($model,'rsname',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'rsname'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->