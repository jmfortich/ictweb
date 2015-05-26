
<?php
	$user = Yii::app()->session['userid'];
	Yii::app()->clientscript

		->registerCoreScript('jquery' )
		//->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery-1.9.1.js')
		->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery-ui.js', CClientScript::POS_END )
		
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap.css')
		->registerCssFile( Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.css')
		->registerCssFile(Yii::app()->theme->baseUrl . '/css/jquery-ui.css');
		// use it when you need it!
		
		/*
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
		->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END )
		*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ICTWeb</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le styles -->
<style type="text/css">
  body {
  	/*background-image: url("<?php echo Yii::app()->theme->baseUrl."/img/bg.png"?>");*/
	padding-top: 60px;
  }
  .sidebar-nav {
	padding: 9px 0;
  }

	@media (max-width: 980px) {
		body{
			padding-top: 0px;
		}
	}
</style>

<script type="text/javascript">
jQuery(document).ready(function ($) {
	/*
	setTimeout(function(){

	       $("#dlg-detail").dialog({
	            show: {
	            effect: 'slideDown',
	            //duration: 1000,
	            },
	        });

    }, 1000)*/
    
 
	
	 $( "#accordion" ).accordion({
		 collapsible: true,
		 heightStyle: "content"
		 });

	 $( "#accordion2" ).accordion({
		 collapsible: true,
		 heightStyle: "content"
		 });

	 $( "#accordion3" ).accordion({
		 collapsible: true,
		 heightStyle: "content"
		 });

	 $( "#accordion4" ).accordion({
		 collapsible: true,
		 heightStyle: "content"
		 });
	//$('.toplink').tooltip();

	//getPendingRequests();
	
});

function handleResponse(response){
	var total = '<?php echo Yii::app()->session['pendingrequests'].Yii::app()->session['pendingrequests2'].Yii::app()->session['pendingtickets']; ?>';
	 if(response!=total){
		 //alert(response+"="+total);	
		 location.reload();
	 } 	

}

function getPendingRequests(){
	if ("Guest" != <?php echo "'".Yii::app()->user->name."'" ?>){
		$.post('/ictweb/index.php/request/checkrequests',function(data){
			handleResponse(data);
		});

		/*$.post('/prjfems/index.php/site/processtbmrequestv',function(data){
			handleResponse(data);
		});*/
	}
}

var auto_refresh = self.setInterval(
		
		function ()
		{
			getPendingRequests();
			
		}, 10000);
		
</script>

    <!-- blueprint CSS framework 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />-->
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
</head>

<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?php echo Yii::app()->createUrl("site/index");?>" ><?php echo Yii::app()->name ?></a>
				<div class="nav-collapse">
					<?php $this->widget('zii.widgets.CMenu',array(
						'htmlOptions' => array( 'class' => 'nav' ),
						'activeCssClass'	=> 'active',
						/*'items'=>array(
							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
							array('label'=>'Contact', 'url'=>array('/site/contact')),
							array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
						),*/
						'items'=>array(
						array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
						array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
						array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
						array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
						),	
					)); ?>
					<p class="navbar-text pull-right">
					<?php
					if(!Yii::app()->user->isGuest){
					//$branch = Yii::app()->session['branch']; 
					$user= Yii::app()->session['userid'];
							$sql = "SELECT count(*) FROM request r where r.recipient =".$user." AND  r.statusid=1";
							$sql2 = "SELECT count(*) FROM request r where r.requestedby=$user AND r.statusid=3";
							Yii::app()->session['pendingtickets'] = Yii::app()->db->createCommand("SELECT count(*) FROM ticket  where resourceid=$user and progress=0")->queryScalar();
							Yii::app()->session['pendingrequests'] = Yii::app()->db->createCommand($sql)->queryScalar();
							Yii::app()->session['pendingrequests2'] = Yii::app()->db->createCommand($sql2)->queryScalar();
								
					/*
					echo TbHtml::ajaxButton('',Yii::app()->createUrl('site/processtbmrequest'),array(
		'type'=>'POST',
		'success'=>'js:function(nrequest){ alert(nrequest+" new request/s retrieved."); if(nrequest>0){location.reload();} }'
),array('color' => TbHtml::BUTTON_COLOR_DEFAULT,'size'=>TbHtml::BUTTON_SIZE_SMALL,'icon'=>TbHtml::ICON_REFRESH));*/
					/*echo CHtml::ajaxSubmitButton('Get Request',Yii::app()->createUrl('site/processtbmrequest'),
					                    array(
					                        'type'=>'POST',
					                        'data'=> 'js:{"data1": val1, "data2": val2 }',                        
					                        'success'=>'js:function(string){ alert(string); }'           
					                    ),array('style'=>'border: none; background: #FFF url("images path");'));*/
					?></p>
					
					<p class="navbar-text pull-right">New Requests [&nbsp;
			
					<?php if(Yii::app()->session['role']==3){ ?>
						<span class="badge badge-info"><a href="<?php echo Yii::app()->createUrl('request/admin',array('filter'=>'t'))?>" title="Pending Requests" data-toggle="tooltip" class="toplink" ><?php echo Yii::app()->session['pendingrequests'];?></a></span>	
						<span class="badge"><a href="<?php echo Yii::app()->createUrl('request/admin',array('filter'=>'t2'))?>" title="Pending Verification Requests" data-toggle="tooltip" class="toplink" ><?php echo Yii::app()->session['pendingrequests2'];?></a></span>				
									
					<?php } ?>
						<span class="badge badge-inverse"><a title="Pending Ticket Requests" data-toggle="tooltip" class="toplink" href="<?php echo Yii::app()->createUrl('ticket/admin',array('filter'=>'t'))?>"><?php  echo Yii::app()->session['pendingtickets'];?></a></span>
					<?php  
						if(Yii::app()->session['isAdmin']==1){ ?>
						<span class="badge badge-success"><a title="User Requests" data-toggle="tooltip" class="toplink" href="<?php echo Yii::app()->createUrl('user/admin',array('filter'=>'t'))?>"><?php  echo Yii::app()->db->createCommand("SELECT count(*) FROM profiles  where roleid=0")->queryScalar();?></a></span>
					<?php }?>]
					
					<?php }?></p>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>

    <div class="container-fluid">
      <div class="row-fluid">
        <?php if(!Yii::app()->user->isGuest){?>  
		<div id="sidemenu" class="span2 navbar-inner">	  
			<div id="accordion" >
			<h4><strong>Main Menu</strong></h4>
			<div id="result">
			<ul class="nav nav-list">
              <li class="nav-header">ICT Logs</li> 
              <?php if(Yii::app()->session['role']==3 or Yii::app()->user->isGuest){?>
	              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('branch/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Branch</a></li>
	              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('reqcategory/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Category</a></li>
	              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('position/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Position</a></li>
	              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('priority/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Priority</a></li>
	              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('role/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Role </a></li>
	              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('status/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Status </a></li>
	              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('reqsource/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Source</a></li>    
              <?php }?>          
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('request/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Request </a></li>              
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('ticket/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Ticket </a></li>            
        	</ul> 

 			<ul class="nav nav-list">
              <li class="nav-header">DocViewer</li>           
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('docViewer/document/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Document</a></li>
              <?php if(Yii::app()->session['role']==3 or Yii::app()->user->isGuest){?>
              <li><a href="<?php echo Yii::app()->createAbsoluteUrl('docViewer/group/admin')?>"><?php echo TbHtml::icon(TbHtml::ICON_CHEVRON_RIGHT); ?> Groups</a></li>
              <?php }?>
        	</ul>        	
        	
			</div>
			</div>	

			
			<div id="accordion2" >
			<h4><strong>StatusMsg</strong></h4>
			<div id="result">	
			<div id="statusmsgdiv" class="alert alert-success">
			<?php 
			
				$result = Yii::app()->db->createCommand("select concat_ws('>> ',dateadded,msg) from statusmsg where userid=$user order by dateadded DESC LIMIT 1")->queryScalar();		
				echo empty($result)==false ? $result : '***';	
			?><br>
				<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("statusmsg/statusmsg/admin")?>"><i class="icon-plus"></i> All Status</a>&nbsp;
			
				</div>
			</div>
			</div>
			
      	</div>
       
        <div class="span9">
		<!--  <div class="well"> 
			
 		 </div> -->  <?php echo $content ?>
 		 

        </div><!--/span-->
      <?php 	}else{
      	echo "<div>";
      	echo $content;
      	echo "</div>";
      }?>
      </div><!--/row-->

 	 	  <hr>
      <footer class="navbar" style="text-align:center;">   
       <!--  <img src="<?php echo Yii::app()->theme->baseUrl."/img/logo60x60.png"?>"><br> -->
        Copyright &copy 2015 by <a href="http://www.tagumcooperative.coop" target="_new"> Tagum Cooperative</a>. <br>All rights reserved.
      </footer>     
    </div><!--/.fluid-container-->
</body>
</html>
