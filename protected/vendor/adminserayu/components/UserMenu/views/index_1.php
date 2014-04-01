<div class="panel-group" id="accordion">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#Konten"><span class="glyphicon glyphicon-folder-close">
            </span>Konten</a>
        </h4>
      </div>
      <div id="Konten" class="panel-collapse collapsed">
        <ul class="list-group">
            <li class="list-group-item"><span class="glyphicon glyphicon-pencil"></span><?php echo TbHtml::link("Kategori", array("/".Yii::app()->controller->getIdAdminserayu()."/kategori/admin")) ?></li>

          <li class="list-group-item"><span class="glyphicon glyphicon-file"></span><?php echo TbHtml::link("Artikel", array("/".Yii::app()->controller->getIdAdminserayu()."/post/admin")) ?></li>

          <li class="list-group-item"><span class="glyphicon glyphicon-book"></span><?php echo TbHtml::link("Halaman", array("/".Yii::app()->controller->getIdAdminserayu()."/halaman/admin")) ?></li>

          <li class="list-group-item"> <span class="glyphicon glyphicon-comment"></span><?php echo TbHtml::link("Komentar", array("/".Yii::app()->controller->getIdAdminserayu()."/comment/")) ?>
              <span class="badge "><?php echo $jmlKomentar; ?>
              </span>
          </li>
          <?php $this->KomponenUser(Yii::app()->controller->getLevelUser()); ?>
        </ul>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#Dokumen"><span class="glyphicon glyphicon-hdd">
            </span>Dokumen</a>
        </h4>
      </div>
      <div id="Dokumen" class="panel-collapse collapse">
        <div class="list-group">
          <?php echo TbHtml::link("Manage Dokumen", array("/".Yii::app()->controller->getIdAdminserayu()."/dokumen/"), array("class"=>"list-group-item")) ?>
        </div>
      </div>
    </div>
    <?php if(Yii::app()->user->checkAccess("admin")): ?>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#Menu"><span class="glyphicon glyphicon-tasks">
            </span>Menu</a>
        </h4>
      </div>
      <div id="Menu" class="panel-collapse collapse">
        <div class="list-group">
          <?php echo TbHtml::link("Manage Menu", array("/".Yii::app()->controller->getIdAdminserayu()."/menu/"), array("class"=>"list-group-item")) ?>
        </div>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#komponen"><span class="glyphicon glyphicon-briefcase">
            </span>Komponen</a>
        </h4>
      </div>
      <div id="komponen" class="panel-collapse collapse">
        <div class="list-group">
          <?php echo TbHtml::link("Install Komponen", array("/".Yii::app()->controller->getIdAdminserayu()."/kom"), array("class"=>"list-group-item")) ?>
          <?php echo TbHtml::link("Manage Komponen", array("/".Yii::app()->controller->getIdAdminserayu()."/kom"), array("class"=>"list-group-item")) ?>
        </div>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#Widget"><span class="glyphicon glyphicon-asterisk">
            </span>Widget</a>
        </h4>
      </div>
      <div id="Widget" class="panel-collapse collapse">
        <div class="list-group">
          <?php echo TbHtml::link("Install Widget", array("/".Yii::app()->controller->getIdAdminserayu()."/widget/create"), array("class"=>"list-group-item")) ?>
          <?php echo TbHtml::link("Manage Widget", array("/".Yii::app()->controller->getIdAdminserayu()."/widget/admin"), array("class"=>"list-group-item")) ?>
        </div>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#Theme"><span class="glyphicon glyphicon-eye-open">
            </span>Theme</a>
        </h4>
      </div>
      <div id="Theme" class="panel-collapse collapse">
        <div class="list-group">
          <?php echo TbHtml::link("Install Theme", array("/".Yii::app()->controller->getIdAdminserayu()."/theme/create"), array("class"=>"list-group-item")) ?>
          <?php echo TbHtml::link("Manage Theme", array("/".Yii::app()->controller->getIdAdminserayu()."/theme/admin"), array("class"=>"list-group-item")) ?>
        </div>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#User"><span class="glyphicon glyphicon-user">
            </span>User</a>
        </h4>
      </div>
      <div id="User" class="panel-collapse collapse">
        <div class="list-group">
          <?php echo TbHtml::link("Manage User", array("/".Yii::app()->controller->getIdAdminserayu()."/user/admin"), array("class"=>"list-group-item")) ?>
          <?php echo TbHtml::link("Buat User", array("/".Yii::app()->controller->getIdAdminserayu()."/user/create"), array("class"=>"list-group-item")) ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>