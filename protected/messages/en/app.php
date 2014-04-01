<?php
return array( 
    'app.dokumen' => 'File Manager',
    'app.theme' => 'Theme',
    
    
    //---------------POST-----------------
    'app.artikel' => 'Post',
    'app.artikel.konten' => 'Content',
    'app.artikel.ket' => 'Separate {name} with commas.',
    'app.artikel.postBerhasil' => 'Successfully Changed',
    //---------------APP------------------
    'app.artikel.judul' => 'Post',
    'app.artikel.menu.buat' => 'Create Post',
    'app.artikel.menu.manage' => 'Manage Post',
    'app.artikel.menu.ubah' => 'Update Post',
    'app.artikel.menu.lihat' => 'View Post',
    'app.artikel.menu.hapus' => 'Delete Post',
    'app.artikel.menu.daftar' => 'List Post',
    'app.artikel.menu.simpan' => 'Save Post',
    
    //---------------MODEL----------------
    'model.post.id' => 'ID',
    'model.post.parent' => 'Page Parent',
    'model.post.title' => 'Title',
    'model.post.content' => 'Content',
    'model.post.tags' => 'Tag',
    'model.post.status' => 'Status',
    'model.post.create_time' => 'Create Time',
    'model.post.update_time' => 'Update Time',
    'model.post.author_id' => 'Author ID',
    'model.post.slug' => 'Slug',
    'model.post.meta_title' => 'Meta Title',
    'model.post.meta_description' => 'Meta Description',
    'model.post.meta_keyword' => 'Meta Keyword',
    'model.post.hit' => 'Hit',
    'model.post.id_kategori' => 'Category',
    'model.post.layout' => 'Layout',
    'model.post.page' => 'isPage',
    'model.post.frontpage' => 'Front Page',
    
    //---------------Kategori-----------------
    'app.kategori' => 'Category',
    //---------------APP------------------
    'app.kategori.judul' => 'Category',
    'app.kategori.menu.buat' => 'Create Category',
    'app.kategori.menu.manage' => 'Manage Category',
    'app.kategori.menu.ubah' => 'Update Category',
    'app.kategori.menu.lihat' => 'View Category',
    'app.kategori.menu.hapus' => 'Delete Category',
    'app.kategori.menu.daftar' => 'List Category',
    'app.kategori.menu.simpan' => 'Save Category',
    
    //---------------MODEL----------------
    'model.kategori.id_kategori' => 'ID Category',
    'model.kategori.nama_kategori' => 'Title',
    'model.kategori.keterangan_kategori' => 'Content',
    'model.kategori.id_parent' => 'ID Parent',
    'model.kategori.alias_kategori' => 'Slug',
    
    //---------------Halaman-----------------
    'app.halaman' => 'Page',
    //---------------APP------------------
    'app.halaman.judul' => 'Page',
    'app.halaman.menu.buat' => 'Create Page',
    'app.halaman.menu.manage' => 'Manage Page',
    'app.halaman.menu.ubah' => 'Update Page',
    'app.halaman.menu.lihat' => 'View Page',
    'app.halaman.menu.hapus' => 'Delete Page',
    'app.halaman.menu.daftar' => 'List Page',
    'app.halaman.menu.simpan' => 'Save Page',
    
    //---------------Menu-----------------
    'app.menu' => 'Menu',
    //---------------APP------------------
    'app.menu.judul' => 'Page',
    'app.menu.menu.kembali' => 'Back',
    'app.menu.menu.buatItem' => 'Create Menu Item',
    'app.menu.menu.buat' => 'Create Menu',
    'app.menu.menu.manage' => 'Manage Menu',
    'app.menu.ket.keterangan1' => '
        <strong>Description:</strong><br/> 
            Create a menu item and then sort if you want sorted 
            by sliding one of the menu item you want to move up 
            or down, if you want to create a sub menu sliding menu 
            item to the right, and if you want to restore from 
            a sub menu into the main menu sliding menu item to left',
    'app.menu.ket.keterangan2' => '
        <strong>Description:</strong><br/>  
            Add menus to create a category menu, 
            then look at the details to create a menu item, 
            use the delete key to delete the category menu, 
            <br/>
                <i><strong>note: </strong><br/>
            * Name menu should not use spaces and not be the same,<br/> 
            * If you remove the categories menu, then all menu items in it will automatically be deleted as well</i><br/>',
    
    
    //---------------Komentar-----------------
    'app.komentar' => 'Comment',
    //---------------APP------------------
    'app.komentar.menu.pending' => 'Pending Comment',
    'app.komentar.menu.semua' => 'All Comments',
    'app.komentar.menu.simpan' => 'Save Comment',
    
    //---------------Komponen-----------------
    'app.komponen' => 'Component',
    //---------------APP------------------
    'app.komponen.menu.daftar' => 'List Component',
    'app.komponen.menu.install' => 'Install Component',
    'app.komponen.menu.manage' => 'Manage Component',
    //---------------MODEL----------------
    'model.komponen.id_komponen' => 'ID Component',
    'model.komponen.nama_komponen' => 'Component Name',
    'model.komponen.pembuat_komponen' => 'Author Component',
    'model.komponen.keterangan_komponen' => 'Content',
    'model.komponen.gambar_komponen' => 'Image',
    'model.komponen.table_komponen' => 'Table',
    'model.komponen.pengguna_komponen' => 'Component Users',
    
    //---------------User-----------------
    'app.user' => 'User',
    //---------------APP------------------
    'app.user.judul' => 'User',
    'app.user.menu.buat' => 'Create User',
    'app.user.menu.manage' => 'Manage User',
    'app.user.menu.ubah' => 'Update User',
    'app.user.menu.lihat' => 'View User',
    'app.user.menu.hapus' => 'Delete User',
    'app.user.menu.daftar' => 'List User',
    'app.user.menu.simpan' => 'Save User',
    //---------------MODEL----------------
    'model.user.id' => 'ID',
    'model.user.username' => 'Username',
    'model.user.password' => 'Password',
    'model.user.email' => 'Email',
    'model.user.name' => 'Name',
    'model.user.image' => 'Image',
    'model.user.level' => 'Level',
    'model.user.profile' => 'Profile',
    'model.user.lastvisit' => 'Last Visited',
    'model.user.new_password' => 'New Password',
    
    //---------------Widget-----------------
    'app.widget' => 'Widget',
    //---------------APP------------------
    'app.widget.menu.daftar' => 'List Widget',
    'app.widget.menu.install' => 'Install Widget',
    'app.widget.menu.manage' => 'Manage Widget',
    //---------------MODEL----------------
    'model.widget.id_widget' => 'ID Widget',
    'model.widget.nama_widget' => 'Widget Name',
    'model.widget.pembuat_widget' => 'Author Widget',
    'model.widget.keterangan' => 'Content',
    
    //---------------Theme-----------------
    'app.theme' => 'Theme',
    //---------------APP------------------
    'app.theme.menu.daftar' => 'List Theme',
    'app.theme.menu.install' => 'Install Theme',
    'app.theme.menu.manage' => 'Manage Theme',
    'app.theme.menu.hapus' => 'Delete Theme',
    'app.theme.menu.pasangWidget' => 'Add Widget',
    //---------------Keterangan------------------
    'app.theme.ket.pasangWidget' => 'Please select widget for adding',
    //---------------MODEL----------------
    'model.theme.id_theme' => 'ID Theme',
    'model.theme.nama_theme' => 'Theme Name',
    'model.theme.gambar_theme' => 'Image Theme',
    'model.theme.pembuat_theme' => 'Theme Author',
    'model.theme.keterangan_theme' => 'Content',
    'model.theme.status_theme' => 'Status',
    
    //---------------Pengaturan-----------------
    'app.pengaturan' => 'Configuration',

    'app.pengaturan.ket.maintenance' => 'This website is currently in Maintenance mode',
    'app.pengaturan.ket.sukses' => 'Settings successfully saved',
    'app.pengaturan.ket.tampilan' => 'displayed',
    'app.pengaturan.ket.tidakTampilkan' => 'Not displayed',
    'app.pengaturan.ket.aktif' => 'Active',
    'app.pengaturan.ket.tidakAktif' => 'Not Active',
    'app.pengaturan.ket.true' => 'True',
    'app.pengaturan.ket.false' => 'False',
    'app.pengaturan.menu.simpan' => 'Save Configuration',
    //---------------MODEL----------------
    'model.pengaturan.title' => 'Title Website',
    'model.pengaturan.adminEmail' => 'Email Administrator',
    'model.pengaturan.postsPerPage' => 'Post per Page',
    'model.pengaturan.kontakKeterangan' => 'Infromation Contact',
    'model.pengaturan.artikelTerkait' => 'Related Content',
    'model.pengaturan.profilePembuat' => 'Author Profile',
    'model.pengaturan.mPaktif' => 'Maintenance Mode',
    'model.pengaturan.keteranganPerbaikan' => 'Infromation Maintenance',
    'model.pengaturan.commentNeedApproval' => 'Comment Need Approval',
    'model.pengaturan.layoutArtikel' => 'Content Layout',
    'model.pengaturan.bahasa' => 'Language',
    'model.pengaturan.editor' => 'Editor',
);
?>