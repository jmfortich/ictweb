<?php
/* @var $this ReqcategoryController */
/* @var $data Reqcategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ctitle')); ?>:</b>
	<?php echo CHtml::encode($data->ctitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cdesc')); ?>:</b>
	<?php echo CHtml::encode($data->cdesc); ?>
	<br />


</div>