<?= $this->start('content_with_box') ?>
<div id="step-1" style="text-align:center;">				
<video id="video" width="300" height="300" autoplay="true" style="margin:auto;"></video>
<br /><br /><button id="time_in" class="btn btn-sm btn-info">Time In</button><button id="time_out" class="btn btn-sm btn-info">Time Out</button>
</div>
<div id="step-2-time_in" style="display:none;text-align:center;">
<canvas id="photo_in" width="300" height="300"></canvas>	
<br /><br /><button id="save_in" class="btn btn-sm btn-success">Save</button>		
</div>	
<div id="step-2-time_out" style="display:none;text-align:center;">
<canvas id="photo_out" width="300" height="300"></canvas>	
<br /><br /><button id="save_out" class="btn btn-sm btn-success">Save</button>		
</div>	
<?= $this->end() ?>
<?= $this->start('js_footer') ?>
<script>
$(document).ready(function(){
	var video = document.getElementById("video");

	takeApicture(video);
		function takeApicture(video){
			
			var canvas_1 	= document.getElementById("photo_in")
			var canvas_2 	= document.getElementById("photo_out")
			context_1 	= canvas_1.getContext("2d")
			context_2 	= canvas_2.getContext("2d")
			
			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
 
			if (navigator.getUserMedia) {       
			    navigator.getUserMedia({video: true}, handleVideo, videoError);
			}
 
			function handleVideo(stream) {
			    video.src = window.URL.createObjectURL(stream);
			}
			 
			function videoError(e) {
			    // do something
			}

			document.getElementById("time_in").addEventListener("click", function() {
				context_1.drawImage(video, 0, 0, 300, 300);
				$("#step-1").hide();
				$('#step-2-time_in').show();
				video.pause();
			});
			
			document.getElementById("time_out").addEventListener("click", function() {
				context_2.drawImage(video, 0, 0, 300, 300);
				$("#step-1").hide();
				$('#step-2-time_out').show();
				video.pause();
			});
		}

		$("#save_in").click(function(){
			var buff = $('#photo_in')[0].toDataURL();
			$.ajax({
				url : "<?php echo $this->Url->build(['controller' => 'Attendance', 'action' => 'addattendance']) ?>",
				type : "POST",
				data : { "photo" : buff, "type" : "time_in"},
				success : function(data){
					document.location.href = "<?php echo $this->Url->build(['controller' => 'Attendance', 'action' => 'index']) ?>";					
				}				
			})
		});

		$("#save_out").click(function(){
			var buff = $('#photo_out')[0].toDataURL();
			$.ajax({
				url : "<?php echo $this->Url->build(['controller' => 'Attendance', 'action' => 'addattendance']) ?>",
				type : "POST",
				data : { "photo" : buff, "type" : "time_out"},
				success : function(data){
					document.location.href = "<?php echo $this->Url->build(['controller' => 'Attendance', 'action' => 'index']) ?>";
					
				}				
			})
		});
		
	});	
</script>
<?= $this->end() ?>