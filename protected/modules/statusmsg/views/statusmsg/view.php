<?php
/* @var $this StatusmsgController */
/* @var $model Statusmsg */

$this->breadcrumbs=array(
	'Statusmsgs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Statusmsg', 'url'=>array('index')),
	array('label'=>'Create Statusmsg', 'url'=>array('create')),
	array('label'=>'Update Statusmsg', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Statusmsg', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Statusmsg', 'url'=>array('admin')),
);
?>

<h1>View Statusmsg #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'userid',
		'msg',
		'dateadded',
	),
)); ?>
