<?php
/* @var $this BranchController */
/* @var $data Branch */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brcode')); ?>:</b>
	<?php echo CHtml::encode($data->brcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brname')); ?>:</b>
	<?php echo CHtml::encode($data->brname); ?>
	<br />


</div>