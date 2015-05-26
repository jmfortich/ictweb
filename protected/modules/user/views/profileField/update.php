<?php
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	UserModule::t('Update'),
);
?>

<h3><?php echo UserModule::t('Update ProfileField ').$model->id; ?></h3>
<hr>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php echo $this->renderPartial('_menu', array(
		'list'=> array(
			CHtml::link(UserModule::t('Create Profile Field'),array('create')),
			CHtml::link(UserModule::t('View Profile Field'),array('view','id'=>$model->id)),
		),
	));
?>
