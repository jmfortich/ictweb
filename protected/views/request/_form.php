<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php 
Yii::import('application.extensions.timepicker.EJuiDateTimePicker');

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'request-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),	
	'htmlOptions' =>array('enctype'=>"multipart/form-data" ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'recipient'); ?>
		<?php //echo $form->textField($model,'subj',array('size'=>50,'maxlength'=>50)); 
			 echo $form->dropDownList($model, 'recipient', CHtml::listData(Profile::model()->findAll(array('order' => 'firstname','condition'=>'roleid=3')), 'user_id', 'fullname')); 

		?>
		<?php echo $form->error($model,'recipient'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'subj'); ?>
		<?php echo $form->textField($model,'subj',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'subj'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc',array('rows'=>3, 'cols'=>50));?>
		<?php echo $form->error($model,'desc'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'catid'); ?>
		<?php //echo $form->textField($model,'rsourceid'); 
				echo $form->dropDownList($model, 'catid', CHtml::listData(Reqcategory::model()->findAll(array('order'=>'ctitle ASC')), 'id', 'ctitle'),
						 array('options' => array('2'=>array('selected'=>true))));
				
		?>
		<?php echo $form->error($model,'catid'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'neededon'); ?>
		<?php 
			$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
					'model'=>$model,
					'attribute'=>'neededon',
					'options'=>array(
							'showAnim'=>'blind',
							'showSecond'=>true,
                            'timeFormat'=>'hh:mm:ss',
                            'dateFormat'=>'yy-mm-dd',
							//'changeMonth' => true,
							//'changeYear' => true,
					),
			));
		
		?>
		<?php echo $form->error($model,'neededon'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'rsourceid'); ?>
		<?php //echo $form->textField($model,'rsourceid'); 
				echo $form->dropDownList($model, 'rsourceid', CHtml::listData(Reqsource::model()->findAll(), 'id', 'rsname'),
						 array('options' => array('3'=>array('selected'=>true))));
				
		?>
		<?php echo $form->error($model,'rsourceid'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'requestedby'); ?>
		<?php echo $form->dropDownList($model, 'requestedby', CHtml::listData(Profile::model()->findAll(array('order' => 'firstname','condition'=>'roleid=3 or deptid=1')), 'user_id', 'fullname'),
				array('options' => array(Yii::app()->session['userid']=>array('selected'=>true)))); ?>
		<?php echo $form->error($model,'requestedby'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>3, 'cols'=>50));?>
		<?php echo $form->error($model,'remark'); ?>
	</div>
	
	<div id="divattach1" class="row">
	    <?php echo $form->labelEx($model,'attach1'); ?>
	    <?php echo $form->fileField($model,'attach1'); ?>
		<?php  //  echo $form->error($model, 'attach1', array('clientValidation' => 'js:customValidateFile(messages)'), false, true);	?>
		<?php echo $form->error($model, 'attach1');	?>
	</div>
	
	<?php // $infoFieldFileID = CHtml::activeId($model, 'attach1'); ?>
	
	<?php //echo CHtml::link('Upload ajax', '#', array("onclick"=>"js:upload_file(this)"));?>
<!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'statusid'); ?>
		<?php echo $form->textField($model,'statusid'); ?>
		<?php echo $form->error($model,'statusid'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'reqdate'); ?>
		<?php echo $form->textField($model,'reqdate'); ?>
		<?php echo $form->error($model,'reqdate'); ?>
	</div>
 -->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn-primary','onclick'=>'return validation(this);')); ?>
	</div>

<?php 

$this->endWidget(); ?>

</div><!-- form -->
 
 <script type="text/javascript">

 function validation(thisform)
 {
    with(thisform)
    {
       if(validateFileExtension(Request_attach1, "Request_attach1_em_", "pdf/office/image files are only allowed!",
       new Array("jpg","pdf","jpeg","gif","png","doc","docx","xls","xlsx","ppt","txt","")) == false)
       {
          return false;
       }
       if(validateFileSize(Request_attach1,1048576, "Request_attach1_em_", "Document size should be less than 1MB!")==false)
       {
          return false;
       }
    }
 }

 function validateFileExtension(component,msg_id,msg,extns)
 {
    var flag=0;
    with(component)
    {
       var ext=value.substring(value.lastIndexOf('.')+1);
       for(i=0;i<extns.length;i++)
       {
          if(ext==extns[i])
          {
             flag=0;
             break;
          }
          else
          {
             flag=1;
          }
       }
       if(flag!=0)
       {
          document.getElementById(msg_id).innerHTML=msg;
		  document.getElementById("divattach1").className="row error";
		  document.getElementById(msg_id).style="";
         // component.value="";
         // component.style.backgroundColor="#eab1b1";
          //component.style.border="thin solid #000000";
         // component.focus();
          return false;
       }
       else
       {
          return true;
       }
    }
 }

 function validateFileSize(component,maxSize,msg_id,msg)
 {
    if(navigator.appName=="Microsoft Internet Explorer")
    {
       if(component.value)
       {
          var oas=new ActiveXObject("Scripting.FileSystemObject");
          var e=oas.getFile(component.value);
          var size=e.size;
       }
    }
    else
    {
       if(component.files[0]!=undefined)
       {
          size = component.files[0].size;
       }
    }
    if(size!=undefined && size>maxSize)
    {
    	document.getElementById(msg_id).innerHTML=msg;
		document.getElementById("divattach1").className="row error";
		document.getElementById(msg_id).style="";       
		//component.value="";
       //component.style.backgroundColor="#eab1b1";
       //component.style.border="thin solid #000000";
       //component.focus();
       return false;
    }
    else
    {
       return true;
    }
 }

</script>