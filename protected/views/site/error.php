<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2 style="color: #b94a48;">Restricted <?php // echo $code; ?></h2>
<hr>
<div class="red">
<?php echo CHtml::encode($message); ?>
</div>