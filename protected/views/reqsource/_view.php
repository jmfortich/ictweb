<?php
/* @var $this ReqsourceController */
/* @var $data Reqsource */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rsname')); ?>:</b>
	<?php echo CHtml::encode($data->rsname); ?>
	<br />


</div>