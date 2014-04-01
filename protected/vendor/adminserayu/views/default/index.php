<?php
/* @var $this DefaultController */

$this->judul="Dashboard";
?>

<?php
$this->widget(
    'yiiwheels.widgets.highcharts.WhHighCharts',
    array(
        'pluginOptions' => array(
            'title'  => array('text' => 'Statistik Pengunjung'),
            'xAxis'  => array(
                'categories' => array('Januari', 'Februari', 'Maret', "April","Mei", "Juni", "Juli", "Agustus","September","Oktober","November","Desember")
            ),
            'yAxis'  => array(
                'title' => array('text' => 'Jumlah Kunjungan')
            ),
            'series' => array(
                array('name' => 'Jumlah Pengunjung', 'data' =>StatistikPengunjung::model()->perTahun()),
            )
        )
    )
);
?>
