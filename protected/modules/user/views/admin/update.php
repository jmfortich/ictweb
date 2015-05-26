<?php
$this->breadcrumbs=array(
	(UserModule::t('Users'))=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	(UserModule::t('Update')),
);
?>

<h3><?php echo  UserModule::t('Update User')." ".$model->id; ?></h3>
<hr>
<?php 
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile)); ?>
	
	  <hr>
  <?php
  /*
    echo TbHtml::buttonGroup(array(
    array('label' => 'Manage User','icon'=>TbHtml::ICON_USER,'url' => array('admin'),
		'size'=>TbHtml::BUTTON_SIZE_MINI),
	array('label' => 'View','icon'=>TbHtml::ICON_COG,'url' => array('view','id'=>$model->id),
		'size'=>TbHtml::BUTTON_SIZE_MINI),
	array('label' => 'Create','icon'=>TbHtml::ICON_PLUS_SIGN,'url' => array('create'),
			'size'=>TbHtml::BUTTON_SIZE_MINI),
    ));
    */
  

  
?>