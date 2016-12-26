<?php

	$newsletter_id = $_REQUEST['newsletter_id'];
	$ERRLIST = get_post_meta($newsletter_id,'pingError',true);
	

	
	
?>


<link rel="stylesheet" type="text/css" href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/jquery.gridster.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/jquery.gridster.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/jquery-csv-master/src/jquery.csv.min.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/bootstrap.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet">

<link href="<?php echo pdftvtpl2_plugin_url; ?>/assets/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo pdftvtpl2_plugin_url; ?>/assets/js/angularjs-v1.4.8.js"></script>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

<?php //print_r($ERRLIST); ?>
<div class="container-fluid">
	<div class="col-sm-12">					
		<table id="errorTable" class="display">
			<thead>	
				<tr>	
					<!--<th><button type="button" class="alert alert-danger" id="checkallcheckboxPing">Check all</button></th>-->
					<th>Time & Date</th>
					<th>Reference</th>
					<th>Service</th>
					<th>Method</th>
					<th>ERROR</th>
					<th>View Data</th>
				</tr>
			</thead>

			<?php

			 foreach($ERRLIST as $k => $err): ?>
			<tr>		  
				<!--<td style="text-align:center;" class="datacheckboxes" ><input type="checkbox" name="tableline{{ x.line }}" value="{{ x.line }}" /></td>-->
				<td style="text-align:center;">
					<?php echo $err['TIMEDATE']; ?>
				</td>	
				<td style="text-align:center;">
					<?php echo $err['Reference']; ?>
				</td>
				<td style="text-align:center;">
					<?php echo $err['Service']; ?>
				</td>
				<td style="text-align:center;">
					<?php echo $err['Method']; ?>
				</td>		
				<td style="color:red;">
					<?php echo $err['ERROR']; ?>
				</td style="text-align:center;">	
				<td style="text-align:center;">	

					<a class="viewdata" data-toggle="modal" data-id="errorsum<?php echo $k; ?>" data-target="#errModal" href="#">View Data</a>
					<div style="display:none;" id="errorsum<?php echo $k; ?>">
						<table class="table">
							<tr>
								<td>Error Summary:</td>
								<td style="color:red;"><?php echo $err['ERROR']; ?></td>
							</tr>
							<tr>
								<td>Url Field:</td>
								<td><?php echo site_url('create-newsletter'); ?></td>
							</tr>
							<tr>
								<td>Post Data:</td>
								<td><?php
									global $pdftvtpl2_allfields_default;
								
									$arr = array_diff_key($pdftvtpl2_allfields_default, $err['View Data']);
									$arr = array_merge($err['View Data'], $arr);
									  unset($arr['TIMEDATE']);
									if(empty($arr)){
										$arr =$err['View Data'];
									}	
									
									foreach($arr as $k=>$v){
										
										if($v==""){
										
										$allstr .= "<span style='background:yellow'>".$k."</span>=".$v."&";
										
										}elseif($k=="letter_password" || $k=="partner_id"){

											if (strpos($err['ERROR'], 'Password Incorrect') !== false) {
												$allstr .= $k."=<span style='background:red;'>".$v."</span>&";	
											}	
											
										}elseif($v=="YOURDATA"){
										
											$allstr .= "<span style='background:red;'>".$k."=".$v."</span>&";	
											
										}else{											
											$allstr .= $k."=".$v."&";	
																					
										}
										
									}
										
										echo $allstr;
                                        $allstr = "";
								?></td>
							</tr>
						
						</table>
					</div>
					<?php //echo $err['View Data']; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<!--<div class="col-md-12">
			<button type="button" ng-click="deletePing('delete');" class="alert alert-danger" name="delete">Delete</button>
			<button type="button" ng-click="deletePing('deleteall');" class="alert alert-danger" name="deleteall">Delete All</button>
		</div>-->
		<script>
			jQuery(document).ready(function(){
				jQuery('#errorTable').dataTable({order:[[0, 'desc']]});
				jQuery(document).on('click','.viewdata',function(){
					
					var id = jQuery(this).attr('data-id');
					jQuery('#modalGetter').html(jQuery('#'+id).html());
					
				})
			})
		</script>
	</div>
</div>

<!-- Modal -->
<div id="errModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">VIEW DATA</h4>
      </div>
      <div class="modal-body" id="modalGetter">
		
	  
	  
	  
	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>