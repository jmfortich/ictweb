<?php
/* @var $this PriorityController */
/* @var $data Priority */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pname')); ?>:</b>
	<?php echo CHtml::encode($data->pname); ?>
	<br />


</div>