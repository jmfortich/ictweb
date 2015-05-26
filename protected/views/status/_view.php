<?php
/* @var $this StatusController */
/* @var $data Status */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sname')); ?>:</b>
	<?php echo CHtml::encode($data->sname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stype')); ?>:</b>
	<?php echo CHtml::encode($data->stype); ?>
	<br />


</div>