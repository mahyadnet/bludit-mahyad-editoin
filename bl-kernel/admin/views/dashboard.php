<div id="dashboard" class="container">
	<div class="row">
	<?php if ($login->role()==='admin'): ?>
		<div class="col-md-7">
	<?php else: ?>
		<div class="col-md-12">
	<?php endif ?>		
			<!-- Good message -->
			<div>
			<h2 id="hello-message" class="pt-0">
				<span class="fa fa-hand-paper-o"></span><span><?php echo $L->g('hello') ?></span>
			</h2>
			<script>
			$( document ).ready(function() {
				$("#hello-message").fadeOut(1000, function() {
					var date = new Date()
					var hours = date.getHours()
					if (hours > 6 && hours < 12) {
						$(this).html('<span class="fa fa-sun-o"></span><?php echo $L->g('good-morning') ?>');
					} else if (hours > 12 && hours < 18) {
						$(this).html('<span class="fa fa-sun-o"></span><?php echo $L->g('good-afternoon') ?>');
					} else if (hours > 18 && hours < 22) {
						$(this).html('<span class="fa fa-moon-o"></span><?php echo $L->g('good-evening') ?>');
					} else {
						$(this).html('<span class="fa fa-moon-o"></span><span><?php echo $L->g('good-night') ?></span>');
					}
				}).fadeIn(1000);
			});
			</script>
			</div>

			<!-- Quick Links -->
			<!-- <div class="container pb-5" id="jsclippyContainer">

				<div class="row">
					<div class="col">
						<div class="form-group">
						<select id="jsclippy" class="clippy" name="state"></select>
						</div>
					</div>
				</div> -->

		<!-- <script>
			$(document).ready(function() {

				var clippy = $("#jsclippy").select2({
					placeholder: "<?php # $L->p('Start typing to see a list of suggestions') ?>",
					allowClear: true,
					width: "100%",
					theme: "bootstrap4",
					minimumInputLength: 2,
					dropdownParent: "#jsclippyContainer",
					language: {
						inputTooShort: function () { return ''; }
					},
					ajax: {
						url: HTML_PATH_ADMIN_ROOT+"ajax/clippy",
						data: function (params) {
							var query = { query: params.term }
							return query;
						},
						processResults: function (data) {
							return data;
						}
					},
					templateResult: function(data) {
						// console.log(data);
						var html = '';
						if (data.type=='menu') {
							html += '<a href="'+data.url+'"><div class="search-suggestion">';
							html += '<span class="fa fa-'+data.icon+'"></span>'+data.text+'</div></a>';
						} else {
							if (typeof data.id === 'undefined') {
								return '';
							}
							html += '<div class="search-suggestion">';
							html += '<div class="search-suggestion-item">'+data.text+' <span class="badge badge-pill badge-light">'+data.type+'</span></div>';
							html += '<div class="search-suggestion-options">';
							html += '<a target="_blank" href="'+DOMAIN_PAGES+data.id+'"><?php # $L->p('view') ?></a>';
							html += '&nbsp;';
							html += '<a class="ml-2" href="'+DOMAIN_ADMIN+'edit-content/'+data.id+'"><?php # $L->p('edit') ?></a>';
							html += '</div></div>';
						}

						return html;
					},
					escapeMarkup: function(markup) {
						return markup;
					}
				}).on("select2:closing", function(e) {
					e.preventDefault();
				}).on("select2:closed", function(e) {
					clippy.select2("open");
				});
				clippy.select2("open");

			});
			</script> -->
			<!-- </div> -->

			<?php Theme::plugins('dashboard') ?>
		</div>

		<?php if ($login->role()==='admin'): ?>
			<div class="col-md-5">
				<!-- Notifications -->
				<ul class="list-group list-group-striped b-0">
				<li class="list-group-item pt-0"><h4 style="margin-top: 1em;"><?php $L->p('Notifications') ?></h4></li>
				<?php

				$logs = array_slice($syslog->db, 0, NOTIFICATIONS_AMOUNT);
				foreach ($logs as $log) {
					$dateRaw = $log['date'];
					$format="H:i:s - Y/m/d";
					if(!function_exists("jdate")){
						require_once PATH_KERNEL . "jdate.func.php";
					}
					$output = jdate($format, strtotime($dateRaw));

					$phrase = $L->g($log['dictionaryKey']);
					echo '<li class="list-group-item">';
					echo $phrase;
					if (!empty($log['notes'])) {
						echo ' « <b>'.$log['notes'].'</b> »';
					}
					echo '<br><span class="notification-date"><small>';
					echo $output;
					echo ' [ '.$log['username'] .' ]';
					echo '</small></span>';
					echo '</li>';
				}
				?>
				</ul>

			</div>
		<?php endif ?>
	</div>
</div>
