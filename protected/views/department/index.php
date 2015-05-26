<?php
/* @var $this DepartmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Departments',
);

$this->menu=array(
	array('label'=>'Create Department', 'url'=>array('create')),
	array('label'=>'Manage Department', 'url'=>array('admin')),
);
?>

<h3>Departments</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
