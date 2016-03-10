<?php
/**
template with table for html List View summary
**/?>

<div id="get-resumes" >
	<div class="row">
		<div class="col-xs-12 col-md-12 clear-both">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Имя</th>
					<th>Дата</th>
					<th>Статус</th>
					<th>Файл резюме</th>
					<th>Отзывы</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach( $resume as $value ){ ?>
					<tr>
						<td><?php echo $value['resume_name']; ?></td>
						<td><?php echo $value['resume_date']; ?> </td>
						<td>
							<div class="resume-status-text-block" >
								<?php echo $value['status_type']; ?>
							</div> 
							<div class="resume-status-block" >
								<?php foreach( $resume_status as $status_value ){ ?>
									<span id="resume_status_<?php echo $status_value["status_id"]?>" data-resume-status="<?php echo $status_value["status_id"]?>" class="<?php echo ( $value['status_type'] == $status_value['status_type'] ) ? 'active_status' : '' ; ?>">
										<a href="" title="<?php echo $status_value['status_type'] ?>">
										<?php switch ( $status_value["status_id"] ) {
											case '1':
												echo '<i class="fa fa-clock-o"></i>';
												break;
											case '2':
												echo '<i class="fa fa-thumbs-up"></i>';
												break;
											case '3':
												echo '<i class="fa fa-thumbs-down"></i>';
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
							? Отзывов
							<!-- Button trigger modal -->
							<span class="btn btn-primary btn-xs" data-resume-id="<?php echo $value['resume_id'] ?>" data-action="get_review_form" data-toggle="modal" data-target="#myModal">
							  Посмотреть
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