<?php
/* @var $this TicketController */
/* @var $data Ticket */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestid')); ?>:</b>
	<?php echo CHtml::encode($data->requestid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resourceid')); ?>:</b>
	<?php echo CHtml::encode($data->resourceid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('priorityid')); ?>:</b>
	<?php echo CHtml::encode($data->priorityid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rsourceid')); ?>:</b>
	<?php echo CHtml::encode($data->rsourceid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resolution')); ?>:</b>
	<?php echo CHtml::encode($data->resolution); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('startdt')); ?>:</b>
	<?php echo CHtml::encode($data->startdt); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('finishdt')); ?>:</b>
	<?php echo CHtml::encode($data->finishdt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualstart')); ?>:</b>
	<?php echo CHtml::encode($data->actualstart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualfinish')); ?>:</b>
	<?php echo CHtml::encode($data->actualfinish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assignedby')); ?>:</b>
	<?php echo CHtml::encode($data->assignedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('progress')); ?>:</b>
	<?php echo CHtml::encode($data->progress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statusid')); ?>:</b>
	<?php echo CHtml::encode($data->statusid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	*/ ?>

</div>