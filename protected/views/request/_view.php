<?php
/* @var $this RequestController */
/* @var $data Request */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subj')); ?>:</b>
	<?php echo CHtml::encode($data->subj); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reqdate')); ?>:</b>
	<?php echo CHtml::encode($data->reqdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestedby')); ?>:</b>
	<?php echo CHtml::encode($data->requestedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusid')); ?>:</b>
	<?php echo CHtml::encode($data->statusid); ?>
	<br />


</div>