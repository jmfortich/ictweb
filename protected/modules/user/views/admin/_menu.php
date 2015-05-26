<!-- 
<ul class="actions">
<?php 
	if (count($list)) {
		foreach ($list as $item)
			echo "<li>".$item."</li>";
	}
?>
	<li><?php echo CHtml::link(UserModule::t('List User'),array('/user')); ?></li>
	<li><?php echo CHtml::link(UserModule::t('Manage User'),array('admin')); ?></li>
	<li><?php echo CHtml::link(UserModule::t('Manage Profile Field'),array('profileField/admin')); ?></li>
</ul>
 -->
 
  <hr>
  <?php
    echo TbHtml::buttonGroup(array(
    array('label' => 'Manage User','icon'=>TbHtml::ICON_USER,'url' => array('admin'),
		'size'=>TbHtml::BUTTON_SIZE_MINI),
	array('label' => 'Manage Profile Field','icon'=>TbHtml::ICON_COG,'url' => array('profileField/admin'),
		'size'=>TbHtml::BUTTON_SIZE_MINI),
	array('label' => 'Create','icon'=>TbHtml::ICON_PLUS_SIGN,'url' => array('create'),
			'size'=>TbHtml::BUTTON_SIZE_MINI),
    )); ?>