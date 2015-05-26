<?php
/* @var $this DocumentController */
/* @var $model Document */
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
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'issuedby'); ?>
		<?php echo $form->textField($model,'issuedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'effectivitydt'); ?>
		<?php echo $form->textField($model,'effectivitydt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lstreviewdt'); ?>
		<?php echo $form->textField($model,'lstreviewdt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dtadded'); ?>
		<?php echo $form->textField($model,'dtadded'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isapprove'); ?>
		<?php echo $form->textField($model,'isapprove'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attach1'); ?>
		<?php echo $form->textField($model,'attach1',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->