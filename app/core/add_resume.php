
<div id="add-resume" >
  <form class="form-horizontal" action="/" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="inputname" class="col-sm-2 control-label">Имя</label>
      <div class="col-sm-10">
        <input type="text" name="resume_name" class="form-control" id="inputname" placeholder="Имя">
      </div>
    </div>
    <div class="form-group">
      <label for="inputdate" class="col-sm-2 control-label">Дата подачи</label>
      <div class="col-sm-10">
        <input type="date" value="<?php echo date("Y-m-d");?>" name="resume_date" class="form-control" id="inputdate" placeholder=">Дата подачи">
      </div>
    </div>
    <div class="form-group">
      <label for="inputstatus" class="col-sm-2 control-label">Статус</label>
      <div class="col-sm-10">
        <select name="status_resume" class="form-control">
          <option value="1">ожидает</option>
          <option value="2">отклонено</option>
          <option value="3">принято</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="exampleInputFile" class="col-sm-2 control-label">Прикрепить резюме</label>
      <div class=" col-sm-10">
        <input type="file" id="exampleInputFile" name="resume_file">
        <p class="help-block">Example block-level help text here.</p>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="add-resume" class="btn btn-default btn-lg btn-block">Добавить</button>
      </div>
    </div>
  </form>
</div>