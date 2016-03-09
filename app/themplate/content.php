<div class="container">
	<div class="starter-template section-form">
		<div class="row">
			<div class="col-xs-12 col-md-12 clear-both">
				<ul class="nav nav-pills">
					<li role="presentation" class="active"><a href="#" data-action="get_all_resume">Все резюме</a></li>
					<li role="presentation"><a href="#" data-action="get_add_resume">Добавить резюме</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="app-area" class="section-content">
	
		<?php if( !empty( $content_view ) && is_array( $content_view_include ) ){
		 		include_once "$content_view_include[0]"; 
	
		} ?>
	</div>
	

</div><!-- /.container -->