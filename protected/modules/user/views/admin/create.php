<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('admin'),
	UserModule::t('Create'),
);
?>
<h3><?php echo UserModule::t("Create User"); ?></h3>
<hr>
<?php 

	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>
  <hr>
  <?php
    echo BsHtml::buttonGroup(array(
    array('label' => 'Manage User','url' => '#',
		'size'=>BsHtml::BUTTON_SIZE_MINI),
    )); ?>
