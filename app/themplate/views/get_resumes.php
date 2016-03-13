<?php
/**
template with table for html List View summary
**/?>
<?php /*if ( isset( $_GET['result'] ) && 'success' == $_GET['result']){ ?>
	<div class="alert alert-success" role="alert">
		<p>Фаил загружен. Резюме успешно добавлено</p>
	</div>
<?php } */ ?>
<div id="get-resumes" >
	<div class="row">
		<div class="col-xs-12 col-md-12 clear-both">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Имя </th>
					<th>Дата</th>
					<th>Статус</th>
					<th>Файл резюме</th>
					<th>Отзывы <span id="reviews-counter" class="badge review-cnt"><?php echo $reviews_count[0]['review_cnt']; ?></span></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach( $resume as $value ){ ?>
					<tr id="block_resume_<?php echo $value['resume_id'];?>">
						<td><?php echo $value['resume_name']; ?></td>
						<td><?php echo $value['resume_date']; ?> </td>
						<td>
							<div class="resume-status-text-block" >
								<?php echo $value['status_type']; ?>
							</div> 
							<div class="resume-status-block" >
								<?php foreach( $resume_status as $status_value ){ ?>
									<span id="resume_<?php echo $value['resume_id'];?>_status_<?php echo $status_value["status_id"]?>" class="<?php echo ( $value['status_type'] == $status_value['status_type'] ) ? 'active_status' : '' ; ?> status_icon">
										<a data-action="change_resume_status" class="status_link" href="#" title="<?php echo $status_value['status_type'] ?>" data-resume-status="<?php echo $status_value["status_id"]?>"  data-resume-id="<?php echo $value["resume_id"]?>" >
										<?php switch ( $status_value["status_id"] ) {
											case '1':
												echo '<i class="fa fa-clock-o"></i>';
												break;
											case '2':
												echo '<i class="fa fa-thumbs-down"></i>';
												break;
											case '3':
												echo '<i class="fa fa-thumbs-up"></i>';
												break;
											default:
												break;
										}?>
										</a>
									</span>
								<?php } ?>
							</div>
						</td>

						<td><a href="<?php echo 'http://' . UPLOAD_URL . $value['resume_file_name']; ?>"><?php echo $value['resume_file_name']; ?></a></td>
						<td>
							<span class="review-read  btn btn-primary btn-xs" data-resume-id="<?php echo $value['resume_id'] ?>" data-action="get_review_form" data-toggle="modal" data-target="#myModal">
						  		Посмотреть отзывы
						  		<span class="badge review-cnt"><?php echo !empty( $value['cnt_review'] ) ? $value['cnt_review'] : '0' ?></span>
							</span>
						</td>
					</tr>
			<?php } ?>
			</tbody>
		</table>
		</div>
	</div>
</div>
<?php require_once 'get_reviews.php' ?>