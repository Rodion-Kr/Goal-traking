<?
/*
Plugin Name: 
Description: 
Version: 1.0
Author: 
Author URI: http://
*/
header('Content-Type: text/html; charset= utf-8');
wp_enqueue_style( 'lar_style_css', plugins_url('style.css', __FILE__)); 
function main_menu_lar(){
    add_options_page('Goal traking Settings', 'Goal traking Settings', 4, 'btraking.php', 'create_page');
}

add_action('admin_menu', 'main_menu_lar');

// Create a plugin configuration page
function create_page(){
	
	?><div style="padding-left: 20px; padding-right: 20px; max-width: 970px;"><?php  
	
	if(isset($_POST['clean'])){
		delete_option('option_arrdate');
	}
	
	if(isset($_POST['send'])){
		$amount = 1;
		$fieldName = 'inform';

		while(isset($_POST[$fieldName])){
			$fieldName = 'inform' . $amount;
			$amount ++;
		}
		
		// Number of lines in the form:
		$row = $amount - 1;
		
		
		// Save the results of the form to the array:
		$arrdate = array();
		
		for($a = 0; $a < $row; $a++ ){
			
			if($a == 0){
				$cast_idform = 'inform';
				$cast_idelement = 'idelement';
				$cast_event = 'event';
				$cast_event_category = 'event_category';
				$cast_event_label = 'event_label';
			}
			else{
				$cast_idform = 'inform' . (string)$a;
				$cast_idelement = 'idelement' . (string)$a;
				$cast_event = 'event' . (string)$a;
				$cast_event_category = 'event_category' . (string)$a;
				$cast_event_label = 'event_label' . (string)$a;
			}
			
			$arrdate[$a] = array();

			$arrdate[$a][$cast_idform] = $_POST[$cast_idform];
			$arrdate[$a][$cast_idelement] =  $_POST[$cast_idelement];
			$arrdate[$a][$cast_event] = $_POST[$cast_event];
			$arrdate[$a][$cast_event_category] = $_POST[$cast_event_category];
			$arrdate[$a][$cast_event_label] = $_POST[$cast_event_label];
			
			update_option( 'option_arrdate', $arrdate );
		}
	}?>
		<p><strong style="font-size: 22px;">General Settings:</strong></p>
		<form action="" method="POST">
			<p style=" padding-left:10px; border-color:#a29e9e; padding-bottom: 10px; padding-bottom: 10px; border-bottom-style: double; border-top-style: double; padding-top: 10px;"><strong>ID</strong><span style="display:inline-block; padding:0 24px;"></span><span><strong>ID contact form 7:</strong></span> <span style="display:inline-block; padding:0 38px;"></span> 	<span><strong>ID elemetn (onclick):</strong></span> <span style="display:inline-block; padding:0 38px;"></span> <span><strong>Event*:</strong></span> <span style="display:inline-block; padding:0 65px;"></span> <span><strong>Event_category*:</strong></span> <span style="display:inline-block; padding:0 39px;"></span> <span><strong>Event_label*:</strong></span></p>
			<div id="bltable" style="padding-left:10px;"><?php 
					$val = get_option('option_arrdate');

					if ($val == ''){
						
						$inform =  'inform';
						$idelement =  'idelement';
						$event =  'event';
						$event_category =  'event_category';
						$event_label =  'event_label';	
						?>
						<div class="line" id="lineid">	
							<span class="id">1</span><span style="display:inline-block; padding:0 20px;"></span>
							<input class="inform" style="width:140px;" type="number" value="" size="1" min="0" name="<?php echo $inform; ?>" /> <span style="display:inline-block; padding:0 20px;"></span>
							<input class="idelement" style="width:140px;" type="text" value="" size="1" min="0" name="<?php echo $idelement; ?>" /> <span style="display:inline-block; padding:0 27px;"></span>
							<input class="event" style="width:140px;" type="text" required value=""  name="<?php echo $event; ?>" /><span style="display:inline-block; padding:0 17px;"></span>
							<input class="event_category" style="width:140px;" required value="" type="text"  name="<?php echo $event_category;?>" /><span style="display:inline-block; padding:0 20px;"></span>
							<input class="event_label" style="width:140px;" required value="" type="text"  name="<?php echo $event_label;?>" /><br/>
							<hr>
						</div>
					<?php } 

					else{
						for($dt = 0; $dt < count($val); $dt++){ 

							if($dt == 0){
								$inform =  'inform';
								$idelement =  'idelement';
								$event =  'event';
								$event_category =  'event_category';
								$event_label =  'event_label';	
								$lineid = 'lineid';
							}
							
							else{
								$inform =  'inform' . $dt;
								$idelement =  'idelement' . $dt;
								$event =  'event' . $dt;
								$event_category =  'event_category' . $dt;
								$event_label =  'event_label' . $dt;
								$lineid = 'lineid' . $dt;
							}
							
							$valinform = $val[$dt][$inform];
							$validelement =	$val[$dt][$idelement];				
							$valevent = $val[$dt][$event];
							$valevent_category = $val[$dt][$event_category];
							$valevent_label	= $val[$dt][$event_label];?>
							
							<div class="line"  id="<?php echo trim($lineid); ?>">	
								<span class="id"><?php echo $dt + 1; ?></span><span style="display:inline-block; padding:0 20px;"></span>
								<input class="inform" style="width:140px;" type="number" value="<?php echo $valinform; ?>" size="1" min="0" name="<?php echo $inform; ?>" /> <span style="display:inline-block; padding:0 20px;"></span>
								<input class="idelement" style="width:140px;" type="text" value="<?php echo $validelement; ?>" size="1" min="0" name="<?php echo $idelement; ?>" /> <span style="display:inline-block; padding:0 27px;"></span>
								<input class="event" style="width:140px;" type="text" required  value="<?php echo $valevent; ?>"  name="<?php echo $event; ?>" /><span style="display:inline-block; padding:0 17px;"></span>
								<input class="event_category" style="width:140px;" required  value="<?php echo $valevent_category; ?>" type="text"  name="<?php echo $event_category;?>" /><span style="display:inline-block; padding:0 20px;"></span>
								<input class="event_label" style="width:140px;" required  type="text" value="<?php echo $valevent_label; ?>"  name="<?php echo $event_label;?>" /><br/>
								<hr>
							</div><?php 
						}
					}
					?>
			</div>
			<span id="plus" style="padding-left:10px;"></span>
			<p style="padding-left:10px;"><input type="submit" id="send" name="send" class="button button-primary" value="Save Changes"> <input style="display:inline-block; margin-left:20px;" type="submit" class="button button-primary" id="clean" name="clean" value="Clean"></p></br>
		</form>	<?php
		
		if(isset($_POST['send'])){?>
			<div id="message" class="notice notice-success is-dismissible">
				<p>Entries have been updated.</p>
			</div><?php 
		} 
		
		if(isset($_POST['clean'])){?>
			<div id="message" class="notice notice-success is-dismissible">
				<p>Entries deleted successfully.</p></div><?php 
		} 
		
		?></div><?php
}
	
/* -The end of the plugin settings page- */

	if( !is_admin() ){
		
		add_action("wp_footer", "foot_script");	
		
		function foot_script(){
		
			$st = get_option( 'option_arrdate');
			
			// Number of fields
			$qvant = count($st);?>
			<script>
				window.onload = function() {
				/*-------------------------------------------------------------------------------------------------*/	
					document.addEventListener( 'wpcf7mailsent', function( event ) {
					<?php
					for($bul = 0; $bul < $qvant; $bul++ ){
						
						if($bul == 0){
							$inform =  'inform';
							$idelement =  'idelement';
							$event =  'event';
							$event_category =  'event_category';
							$event_label =  'event_label';	
						}
						else{
							$inform =  'inform' . $bul;
							$idelement =  'idelement' . $bul;
							$event =  'event' . $bul;
							$event_category =  'event_category' . $bul;
							$event_label =  'event_label' . $bul;
						}

						if($st[$bul][$inform] != ''){?>
							if ( '<?php echo $st[$bul][$inform];  ?>' == event.detail.contactFormId ) {
								gtag('event', '<?php echo $st[$bul][$event]; ?>', {'event_category': '<?php echo $st[$bul][$event_category]; ?>','event_label': '<?php echo $st[$bul][$event_label]; ?>',});
							}<?
						}
					} ?>
					}, false ); 
					/*-------------------------------------------------------------------------------------------------*/
					<?php for($bnex = 0; $bnex < $qvant; $bnex++ ){
						if($bnex == 0){
							$inform =  'inform';
							$idelement =  'idelement';
							$event =  'event';
							$event_category =  'event_category';
							$event_label =  'event_label';	
						}
						else{
							$inform =  'inform' . $bnex;
							$idelement =  'idelement' . $bnex;
							$event =  'event' . $bnex;
							$event_category =  'event_category' . $bnex;
							$event_label =  'event_label' . $bnex;
						}
						if($st[$bnex][$idelement] != ''){?>
							jQuery("<?php echo $st[$bnex][$idelement]; ?>").click(function(){
								gtag('event', '<?php echo $st[$bnex][$event]; ?>', {'event_category': '<?php echo $st[$bnex][$event_category]; ?>','event_label': '<?php echo $st[$bnex][$event_label]; ?>',});
							});
				  <?php } 
					}?>
				}
			</script>
			<?
		}
	} 
	
if( is_admin()){
	
	add_action("admin_footer", "foot_code");
	
 	function foot_code() {?><script>
			window.onload = function() {
				if (document.querySelector("#plus")){
					document.querySelector("#plus").onclick = function(){
												
						// Insert an additional empty field:
						// Main div:
						var block =  document.querySelector('#bltable');
						
						var blockhtml = block.children.length;
					
						var htmlblock = block.children[blockhtml - 1].innerHTML;
						
						var lastel = block.children[blockhtml - 1];
						
						var spanId = lastel.getElementsByClassName("id");
						
						var idNamb = spanId[0].innerHTML;
						
						var inside = htmlblock; 
						
						var el = document.querySelector('#bltable');
						var idnmb = 'lineid' + String(idNamb.trim()); 
						
						/*------------------------------------*/
						
						
						/* Сheck the empty field */
						if(String(idNamb.trim()) == '1'){
							var inp = 'lineid';
						}else{
							var typeInt = idNamb - 1;
							var inp = 'lineid'+ String(typeInt);
						}

						var brot = document.getElementById(inp);

						var nu = 'event_label';
						var classname = brot.getElementsByClassName(nu);

						if(classname[0].defaultValue != ''){
	
							var htmlmY = document.createElement('div');
							htmlmY.setAttribute("class", 'line');
							htmlmY.setAttribute("id", idnmb);
							htmlmY.innerHTML = inside;
							el.appendChild(htmlmY);
							
							// Generate a unique "name" for each element:
							var elCltd = document.getElementById(idnmb);
							
							//id
							var mainId = elCltd.getElementsByClassName("id");
							for (var e = 0; e < mainId.length; e++) {
								mainId[e].innerHTML = Number(idNamb) + 1;
							}
							
							var inform = 'inform' + String(Number(idNamb));
							var in1 = elCltd.getElementsByClassName("inform");
							for (var i = 0; i < in1.length; i++) {
								in1[i].setAttribute("name", inform);
								in1[i].setAttribute("value", '');
							}
							
							var idelement = 'idelement' + String(Number(idNamb));
							var in2 = elCltd.getElementsByClassName("idelement");
							for (var n = 0; n < in2.length; n++) {
								in2[n].setAttribute("name", idelement);
								in2[n].setAttribute("value", '');
							}
							
							var event = 'event' + String(Number(idNamb));
							var in3 = elCltd.getElementsByClassName("event");
							for (var m = 0; m < in3.length; m++) {
								in3[m].setAttribute("name", event);
								in3[m].setAttribute("value", '');
							}
							
							var event_category = 'event_category' + String(Number(idNamb));
							var in4 = elCltd.getElementsByClassName("event_category");
							for (var p = 0; p < in4.length; p++) {
								in4[p].setAttribute("name", event_category);
								in4[p].setAttribute("value", '');
							}
							
							var event_label = 'event_label' + String(Number(idNamb));
							var in5 = elCltd.getElementsByClassName("event_label");
							for (var g = 0; g < in5.length; g++) {
								in5[g].setAttribute("name", event_label);
								in5[g].setAttribute("value", '');
							}
						}
					}
				}
			}	
		</script><?php }}

	register_deactivation_hook( __FILE__, 'myplugin_deactivation' );
	
	function myplugin_deactivation() {
		delete_option("option_arrdate");
	}?>
