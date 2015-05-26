<?php
$this->breadcrumbs=array(
	UserModule::t('Profile Fields')=>array('admin'),
	UserModule::t('Create'),
);
?>
<h3><?php echo UserModule::t('Create Profile Field'); ?></h3>
<hr>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php echo $this->renderPartial('_menu',array(
		'list'=> array(),
	)); ?>