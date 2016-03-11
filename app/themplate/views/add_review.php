<?php
/**
themplate with form for add review
**/?>
<a class="btn btn-info btn-xs btn-block form-review-collapse-link" role="button" data-toggle="collapse" href="#collapseFormReview" aria-expanded="false" aria-controls="collapseFormReview">
    Форма для отзыва <span class="caret"></span>
</a>
<div class="collapse" id="collapseFormReview">
    <form id="add_review_form" class="form-horizontal" action="javascript:void(null);" onsubmit="sendReview()" method="POST" >
      <div class="form-group">
        <label for="input_name" class="col-sm-2 control-label">Отзыв оставил</label>
        <div class="col-sm-10">
          <input type="text" name="author_review_name" class="form-control" id="input_name" placeholder="Имя автора">
        </div>
      </div>
      <div class="form-group">
        <label for="input_text" class="col-sm-2 control-label">Отзыв</label>
        <div class="col-sm-10">
          <textarea name="review_text" class="form-control" id="input_text" placeholder="Оставьте отзыв" ></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="hidden" name="add-review" value="1">
          <input type="hidden" name="review_resume_id" value="<?php echo $data; ?>">
          <button type="submit" class="btn btn-default btn-lg btn-block">Добавить</button>
        </div>
      </div>
    </form>
</div>