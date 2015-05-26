<?php
/* @var $this ReqsourceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reqsources',
);

$this->menu=array(
	array('label'=>'Create Reqsource', 'url'=>array('create')),
	array('label'=>'Manage Reqsource', 'url'=>array('admin')),
);
?>

<h1>Reqsources</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
