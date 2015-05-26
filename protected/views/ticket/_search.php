<?php
/* @var $this TicketController */
/* @var $model Ticket */
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
		<?php echo $form->label($model,'requestid'); ?>
		<?php echo $form->textField($model,'requestid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resourceid'); ?>
		<?php echo $form->textField($model,'resourceid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'priorityid'); ?>
		<?php echo $form->textField($model,'priorityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rsourceid'); ?>
		<?php echo $form->textField($model,'rsourceid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resolution'); ?>
		<?php echo $form->textArea($model,'resolution',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'startdt'); ?>
		<?php echo $form->textField($model,'startdt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finishdt'); ?>
		<?php echo $form->textField($model,'finishdt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actualstart'); ?>
		<?php echo $form->textField($model,'actualstart'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'actualfinish'); ?>
		<?php echo $form->textField($model,'actualfinish'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'assignedby'); ?>
		<?php echo $form->textField($model,'assignedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'progress'); ?>
		<?php echo $form->textField($model,'progress'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statusid'); ?>
		<?php echo $form->textField($model,'statusid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remark'); ?>
		<?php echo $form->textField($model,'remark',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->