<!-- 
<ul class="actions">
	<li><?php echo CHtml::link(UserModule::t('Manage User'),array('/user/admin')); ?></li>
	<li><?php echo CHtml::link(UserModule::t('Manage Profile Field'),array('admin')); ?></li>
<?php 
	if (isset($list)) {
		foreach ($list as $item)
			echo "<li>".$item."</li>";
	}
?>
</ul>
 -->
 
   <hr>
  <?php
  
    echo TbHtml::buttonGroup(array(
    array('label' => 'Manage User','url' => array('/user/admin'),
		'size'=>TbHtml::BUTTON_SIZE_MINI),
	array('label' => 'Manage Profile Field','url' => array('admin'),
		'size'=>TbHtml::BUTTON_SIZE_MINI),
	array('label' => 'Create','url' => 'create',
			'size'=>TbHtml::BUTTON_SIZE_MINI),
    ));
