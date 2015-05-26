<?php
/* @var $this DocumentController */
/* @var $data Document */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issuedby')); ?>:</b>
	<?php echo CHtml::encode($data->issuedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('effectivitydt')); ?>:</b>
	<?php echo CHtml::encode($data->effectivitydt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lstreviewdt')); ?>:</b>
	<?php echo CHtml::encode($data->lstreviewdt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtadded')); ?>:</b>
	<?php echo CHtml::encode($data->dtadded); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isapprove')); ?>:</b>
	<?php echo CHtml::encode($data->isapprove); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('attach1')); ?>:</b>
	<?php echo CHtml::encode($data->attach1); ?>
	<br />

	*/ ?>

</div>