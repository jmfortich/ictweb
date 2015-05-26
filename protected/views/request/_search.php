<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subj'); ?>
		<?php echo $form->textField($model,'subj',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reqdate'); ?>
		<?php echo $form->textField($model,'reqdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'requestedby'); ?>
		<?php echo $form->textField($model,'requestedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statusid'); ?>
		<?php echo $form->textField($model,'statusid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->