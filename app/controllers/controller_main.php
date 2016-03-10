<?php 
class Controller_Main extends Controller {

	private $model_resume;
	private $model_review;
	public $error = array();

	private static $controller_main = null;

	function __construct() {
		parent::__construct();
		$this->model_resume = new Model_Resume();
		$this->model_review = new Model_Review();
	}

	public function action_index() {
		if( isset( $_POST['add-resume'] ) ){
			$this->add_resume();
			return;
		}else{
			$data = $this->get_data_for_resume();
			if( !empty( $data ) ){
				$this->get_views( 'get_resumes.php', $data );
			}

		}
		
		

	}
	public function action_save_review_form(){
		$review_author = !empty( $_POST['author_review_name'] ) ? htmlspecialchars( trim( $_POST[ 'author_review_name'] ) ): '' ;
		$review_text = !empty( $_POST['review_text'] ) ? htmlspecialchars( trim( $_POST[ 'review_text'] ) ) : '' ;
		$review_resume_id = !empty( $_POST['review_resume_id'] ) ?  intval( $_POST[ 'review_resume_id'] ) : '';
		if( empty( $review_resume_id ) ||  empty( $review_text ) || empty( $review_author ) ){
			return false;
		}
		$result = $this->model_review->addViews( $review_text, $review_author, $review_resume_id );
		if( ! empty( $result ) ) {
			echo json_encode( $this->model_review->returnLastViews( $result ) );
		}

	}

	public function action_get_add_resume() {
		/* function for oauth with fb*/
		echo $this->view->update_content( 'add_resume.php' );

	}
	public function action_get_all_resume() {
		$data = $this->get_data_for_resume();
		if( !empty( $data ) ){
			echo $this->view->update_content( 'get_resumes.php', $data );
		}

	}
	public function action_get_review_form(){
		if( isset( $_POST['action'] ) ){
			$data = array();
			$review_id = !empty( $_POST['action_review'] ) ? intval( $_POST['action_review'] ) : '';
			$data = $this->get_data_for_review( $review_id );
			if( !empty( $review_id ) ){
				$response['reviews'] = $this->view->update_content( 'get_review_content.php', false );
				$response['form'] = $this->view->update_content( 'add_review.php', $review_id );
				echo json_encode( $response );
			}	
		} else {
			return false;
		}
	}

	public function add_resume(){	
		$error = array();
		$valid_ext = array( 'doc', 'docx', 'docm', 'rtf', 'odt', 'sxw', 'txt', 'pdf', 'tex', 'texi', 'wpd', 'xls', 'xlsx', 'xlsm', 'xlsx', 'sxc', 'csv' );
		$resume_name = ! empty( $_POST['resume_name'] ) ? trim( $_POST['resume_name'] ) : '' ;
		$resume_date = ! empty( $_POST['resume_date'] ) ? trim( $_POST['resume_date'] ) : date('Y-m-d') ;
		$resume_status = ! empty( $_POST['status_resume'] ) ? intval( trim( $_POST['status_resume'] ) ) : 1 ;
		$upload_url = UPLOAD_DIR;
		$old_file_name	= basename( $_FILES['resume_file']['name'] );
		$ext =	substr( $old_file_name, 1 + strrpos( $old_file_name, '.' ) );
		if( in_array( $ext, $valid_ext ) ) {
			$resume_file_name = str_replace( " ", "_", iconv( "utf-8", "cp1251", $resume_name ) ). "_" . $resume_date . '.' . $ext;
			if ( is_uploaded_file( $_FILES['resume_file']['tmp_name'] ) ) {
				$upload_file_name = $upload_url . $resume_file_name;
				if ( move_uploaded_file( $_FILES['resume_file']['tmp_name'], $upload_file_name) ) {
					$message[] = " Фаил загружен. "; 
					
				} else {
					$error[] = "Ошибка, фаил не загружен.\n";
				}
				if( empty( $error ) ){
					$f = fopen( $upload_file_name,"rb"); 
					$upload = fread ($f, filesize( $upload_file_name ) ); // считали файл в переменную
					fclose($f); // закрыли файл, можно опустить
					$resume_file = addslashes( $upload );
				}
			}
		} else{
			$error[] = "Ошибка, неправильный формат файла.\n";
		}
		if( empty( $resume_name ) || ! empty( $error ) ){
			$this->get_views( 'add_resume.php', $error );
			return;
		}
		$resume_file_name = iconv( "cp1251", "utf-8", $resume_file_name );
		$result = $this->model_resume->addResume(  $resume_name, $resume_date, $resume_status, $resume_file_name, $resume_file );
		if ( empty( $error ) && ! empty( $result ) ){
			echo $this->get_views( 'add_resume_succes.php', $message );
			return;
		}

	}

	private function get_data_for_resume(){
		$data = array(); 
		$data['resume'] = $this->model_resume->returnResume();
		$data['resume_status'] = $this->model_resume->returnResumeStatus();
		if( !empty( $data['resume'] ) && !empty( $data['resume_status'] ) ) {
			return $data;
		} else {
			return false;
		}

	}

	private function get_data_for_review(){
		$data = array(); 
	}

	public function get_views( $get_views, $data = false ) {
		/* function for oauth with fb*/	
		$this->view->generate( 'header.php' );
		$this->view->generate( 'content.php',  $get_views, $data );
		$this->view->generate( 'footer.php' );

	}
}