<?php
/* @var $this ReqcategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reqcategories',
);

$this->menu=array(
	array('label'=>'Create Reqcategory', 'url'=>array('create')),
	array('label'=>'Manage Reqcategory', 'url'=>array('admin')),
);
?>

<h1>Reqcategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
