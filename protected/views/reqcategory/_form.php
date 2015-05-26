<?php
/* @var $this ReqcategoryController */
/* @var $model Reqcategory */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reqcategory-form',
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
		<?php echo $form->labelEx($model,'ctitle'); ?>
		<?php echo $form->textField($model,'ctitle',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'ctitle'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cdesc'); ?>
		<?php echo $form->textField($model,'cdesc',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'cdesc'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->