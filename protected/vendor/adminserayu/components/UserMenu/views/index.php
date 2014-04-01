<ul class="sidebar-menu">
    <li class="header" style="background-color: #525252">
        <?php echo TbHtml::link("<i class='glyphicon glyphicon-home'></i> Dashboard", array("/".Yii::app()->controller->getIdAdminserayu()."/default/index")) ?>
    </li>
    <li class="header" style="background-color: #525252">
        <a href="#">
            <i class="glyphicon glyphicon-book"></i> <?php echo Yii::t("app", "app.artikel.konten") ?>
        </a>
    </li>
    <div id="Konten" class="panel-collapse collapsed sidebar">
        <ul class="sidebar-menu">
            <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> ".Yii::t('app','app.kategori'), array("/".Yii::app()->controller->getIdAdminserayu()."/kategori/admin")) ?></li>
            <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> ".Yii::t('app','app.artikel'), array("/".Yii::app()->controller->getIdAdminserayu()."/post/admin")) ?></li>
            <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> ".Yii::t('app','app.halaman'), array("/".Yii::app()->controller->getIdAdminserayu()."/halaman/admin")) ?></li>
            <li><?php echo TbHtml::link('<i class="glyphicon glyphicon-chevron-right"></i> '.Yii::t('app','app.komentar').' <small class="badge pull-right bg-yellow">'.$jmlKomentar.'</small>', array("/".Yii::app()->controller->getIdAdminserayu()."/comment/")) ?></li>    
            <?php $this->KomponenUser(Yii::app()->controller->getLevelUser()); ?>
        </ul>
    </div>
    <li class="header" style="background-color: #525252">
        <?php echo TbHtml::link("<i class='glyphicon glyphicon-hdd'></i> ".Yii::t("app", "app.dokumen"), array("/".Yii::app()->controller->getIdAdminserayu()."/dokumen")) ?>
    </li>
    <?php if(Yii::app()->user->checkAccess("admin")): ?>
    <li class="header" style="background-color: #525252">
        <?php echo TbHtml::link("<i class='glyphicon glyphicon-list'></i> ".Yii::t("app", "app.menu"), array("/".Yii::app()->controller->getIdAdminserayu()."/menu")) ?>
    </li>
    <li class="header" style="background-color: #525252">
        <a data-toggle="collapse" data-parent="#accordion" href="#Komponen">
            <i class="glyphicon glyphicon-cog"></i> <?php echo Yii::t("app", "app.komponen") ?>
        </a>
    </li>
    <div id="Komponen" class="panel-collapse collapse sidebar">
        <ul class="sidebar-menu">
            <li class="fa">
                <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> Install ".Yii::t("app", "app.komponen"), array("/".Yii::app()->controller->getIdAdminserayu()."/komponen/create")) ?></li>
                <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> Manage ".Yii::t("app", "app.komponen"), array("/".Yii::app()->controller->getIdAdminserayu()."/komponen/admin")) ?></li>
            <li class="fa">
        </ul>
    </div>
    <li class="header" style="background-color: #525252">
        <a data-toggle="collapse" data-parent="#accordion" href="#Widget">
            <i class="glyphicon glyphicon-th"></i> <?php echo Yii::t("app", "app.widget") ?>
        </a>
    </li>
    <div id="Widget" class="panel-collapse collapse sidebar">
        <ul class="sidebar-menu">
            <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> Install ".Yii::t("app", "app.widget"), array("/".Yii::app()->controller->getIdAdminserayu()."/widget/create")) ?></li>
            <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> Manage ".Yii::t("app", "app.widget"), array("/".Yii::app()->controller->getIdAdminserayu()."/widget/admin")) ?></li>
        </ul>
    </div>
    <li class="header" style="background-color: #525252">
        <a data-toggle="collapse" data-parent="#accordion" href="#Theme">
            <i class="glyphicon glyphicon-credit-card"></i> <?php echo Yii::t("app", "app.theme") ?>
        </a>
    </li>
    <div id="Theme" class="panel-collapse collapse sidebar">
        <ul class="sidebar-menu">
            <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> Install ".Yii::t("app", "app.theme"), array("/".Yii::app()->controller->getIdAdminserayu()."/theme/create")) ?></li>
            <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> Manage ".Yii::t("app", "app.theme"), array("/".Yii::app()->controller->getIdAdminserayu()."/theme/admin")) ?></li>
        </ul>
    </div>
    <li class="header" style="background-color: #525252">
        <a data-toggle="collapse" data-parent="#accordion" href="#User">
            <i class="glyphicon glyphicon-user"></i> <?php echo Yii::t("app", "app.user") ?>
        </a>
    </li>
    <div id="User" class="panel-collapse collapse sidebar">
        <ul class="sidebar-menu">
            <li class="fa">
                <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> Manage ".Yii::t("app", "app.user"), array("/".Yii::app()->controller->getIdAdminserayu()."/user/admin")) ?></li>
                <li class="fa"><?php echo TbHtml::link("<i class='glyphicon glyphicon-chevron-right'></i> Buat ".Yii::t("app", "app.user"), array("/".Yii::app()->controller->getIdAdminserayu()."/user/create")) ?></li>
            <li class="fa">
        </ul>
    </div>
    <li class="header" style="background-color: #525252">
        <?php echo TbHtml::link("<i class='glyphicon glyphicon-wrench'></i> ".Yii::t("app", "app.pengaturan"), array("/".Yii::app()->controller->getIdAdminserayu()."/pengaturan")) ?>
    </li>
    <?php endif; ?>
</ul>
