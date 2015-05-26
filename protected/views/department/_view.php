<?php
/* @var $this DepartmentController */
/* @var $data Department */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dcode')); ?>:</b>
	<?php echo CHtml::encode($data->dcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dtitle')); ?>:</b>
	<?php echo CHtml::encode($data->dtitle); ?>
	<br />


</div>