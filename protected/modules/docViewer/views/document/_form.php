<?php
/* @var $this DocumentController */
/* @var $model Document */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php
Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),
	'htmlOptions' =>array('enctype'=>"multipart/form-data"),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'issuedby'); ?>
		<?php 
			echo $form->dropDownList($model, 'issuedby', CHtml::listData(Profile::model()->findAll(array('order' => 'firstname','condition'=>'roleid=3')), 'user_id', 'fullname'));
		
		?>
		<?php echo $form->error($model,'issuedby'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'groupid'); ?>
		<?php 
			echo $form->dropDownList($model, 'groupid', CHtml::listData(Group::model()->findAll(array('order' => 'gname')), 'id', 'gname'));
		?>
		<?php echo $form->error($model,'groupid'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'effectivitydt'); ?>
		<?php 
			$this->widget('CJuiDateTimePicker',array(
					'id'=>'effectivitydt',
					'model'=>$model, //Model object
					'attribute'=>'effectivitydt', //attribute name
					'mode'=>'datetime', //use "time","date" or "datetime" (default)
					'language' => '',
					'options'=>array(
							'dateFormat'=>'yy-mm-dd',
							'timeformat'=>'H:i') // jquery plugin options
			));
		?>
		<?php echo $form->error($model,'effectivitydt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lstreviewdt'); ?>
		<?php 
			$this->widget('CJuiDateTimePicker',array(
					'id'=>'lstreviewdt',
					'model'=>$model, //Model object
					'attribute'=>'lstreviewdt', //attribute name
					'mode'=>'datetime', //use "time","date" or "datetime" (default)
					'language' => '',
					'options'=>array(
							'dateFormat'=>'yy-mm-dd',
							'timeformat'=>'H:i') // jquery plugin options
			));	
		?>
		<?php echo $form->error($model,'lstreviewdt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isapprove'); ?>
		<?php 
		echo $form->dropDownList($model, 'isapprove', array(0=>'No',1=>'Yes'));
		
		?>
		<?php echo $form->error($model,'isapprove'); ?>
	</div>

	<div id="divattach1" class="row">
		<?php echo $form->labelEx($model,'attach1'); ?>
		<?php echo $form->fileField($model,'attach1'); ?>
		<?php echo $form->error($model,'attach1'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn-primary','onclick'=>'return validation(this);'
		)); ?>
		</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
		
<script type="text/javascript">

 function validation(thisform)
 {
    with(thisform)
    {
       if(validateFileExtension(Document_attach1, "Document_attach1_em_", "pdf files are only allowed!",
       new Array("pdf")) == false)
       {
          return false;
       }
       if(validateFileSize(Document_attach1,1048576, "Document_attach1_em_", "Document size should be less than 1MB!")==false)
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
		