<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>

<h3><?php echo UserModule::t("Restore"); ?></h3>
<hr>
<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="alert-info">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="form wide">
<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form); ?>
	
	<div class="row">
		<?php echo CHtml::activeLabel($form,'login_or_email'); ?>
		<?php echo CHtml::activeTextField($form,'login_or_email') ?>
		<p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton(UserModule::t("Restore"),array('class'=>'btn-primary')); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<hr>
<?php endif; ?>