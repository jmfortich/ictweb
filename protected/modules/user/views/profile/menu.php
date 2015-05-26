<!-- 
<ul class="actions">
<?php 
if(UserModule::isAdmin()) {
?>
<li><?php echo CHtml::link(UserModule::t('Manage User'),array('/user/admin')); ?></li>
<?php 
} else {
?>
<li><?php echo CHtml::link(UserModule::t('List User'),array('/user')); ?></li>
<?php
}
?>
<li><?php echo CHtml::link(UserModule::t('Profile'),array('/user/profile')); ?></li>
<li><?php echo CHtml::link(UserModule::t('Edit'),array('edit')); ?></li>
<li><?php echo CHtml::link(UserModule::t('Change password'),array('changepassword')); ?></li>
<li><?php echo CHtml::link(UserModule::t('Logout'),array('/user/logout')); ?></li>
</ul>
 -->
 
 
 <hr>
 <div class="floatingmenu">
  <?php 
  
  
    echo TbHtml::buttonGroup(array(
    array('label' => 'Profile','icon'=>TbHtml::ICON_USER,'url' => array('/user/profile'),
		'size'=>TbHtml::BUTTON_SIZE_MINI),
	/*array('label' => 'Edit','icon'=>TbHtml::ICON_PENCIL,'url' => array('edit'),
		'size'=>TbHtml::BUTTON_SIZE_MINI),*/
	array('label' => 'Change Password','icon'=>TbHtml::ICON_LOCK,'url' => array('changepassword'),
		'size'=>TbHtml::BUTTON_SIZE_MINI),
 
    )); 
  
?>
</div>
<!--  
<li><?php echo CHtml::link(UserModule::t('Profile'),array('/user/profile')); ?></li>
<li><?php echo CHtml::link(UserModule::t('Edit'),array('edit')); ?></li>
<li><?php echo CHtml::link(UserModule::t('Change password'),array('changepassword')); ?></li>
-->

        


