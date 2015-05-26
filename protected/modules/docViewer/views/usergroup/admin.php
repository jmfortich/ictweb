<?php
/* @var $this UsergroupController */
/* @var $model Usergroup */

$this->breadcrumbs=array(
	'Usergroups'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('submenu_ajax', "
	$('#addlink').click(function(){
		$.ajax({
			type:'GET',
			url: $(this).attr('href'),
			beforeSend: function() {
						           $('#content').addClass('ajaxloading');
						        },
			complete: function() {
						          $('#content').removeClass('ajaxloading');
						        },
			success: function(data) {
				  $('#detail-section').html(data);
	        }
		});
		return false;
	});
");

Yii::app()->clientScript->registerScript(
'myHideEffect',
'$(".alert-info").animate({opacity: 0.9}, 1000).fadeOut("slow");');

?>

<h3>Manage <medium>USER GROUPS</medium>
 <a id="addlink" href='<?php echo Yii::app()->createUrl("docViewer/group/create",array("asDialog"=>1));?>'><i class="icon-plus"></i></a>
</h3>
<hr>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usergroup-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'userid',
		'groupid',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>


<?php

 $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'dlg-detail',
        'options' => array(
            //'title' => 'Dialog Box Title',
            'closeOnEscape' => true,
            'autoOpen' => false,
            'modal' => true,
        	'width' => auto,
        	'height' => auto,
        	'open'=>'js:function(){$("#dlg-detail input:first").focus();}',
        ),
)); ?>
<div id="detail-section" style="dispay:none;"></div>
<hr><br>
<?php $this->endWidget(); 
echo "<br/>";
foreach(Yii::app()->user->getFlashes() as $key => $message) {
	echo '<div class="alert alert-' . $key . '"><i class="icon-ok"></i> ' . $message . "</div>\n";
}
?>
