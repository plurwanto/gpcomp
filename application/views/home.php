<div class="page-header">
    <h1>Dashboard  <small>overview & stats</small></h1>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="core-box">
            <div class="heading">
                <i class="clip-cart circle-icon circle-green"></i>
                <h2>Total Pembelian</h2>
            </div>
            <div class="content">
                <h3 class="text-info"><?=$total_pembelian_qty_harga[0]['JumlahProduk'];?>  |  Rp <?=number_format($total_pembelian_qty_harga[0]['HargaProduk'], 0, ',', '.');?></h3>
            </div>
            <a class="view-more" href="<?php echo base_url()?>report">
                View More <i class="clip-arrow-right-2"></i>
            </a>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="core-box">
            <div class="heading">
                <i class="clip-cart circle-icon circle-teal"></i>
                <h2>Total Penjualan</h2>
            </div>
            <div class="content">
                <h3 class="text-info"><?=$total_penjualan_qty_harga[0]['JumlahProduk'];?>  |  Rp <?=number_format($total_penjualan_qty_harga[0]['HargaProduk'], 0, ',', '.');?></h3>
            </div>
            <a class="view-more" href="<?php echo base_url()?>report">
                View More <i class="clip-arrow-right-2"></i>
            </a>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="core-box">
            <div class="heading">
                <i class="clip-seven-segment-9 circle-icon circle-bricky"></i>
                <h2>Total Profit</h2>
            </div>
            <div class="content">
                <h3 class="text-info">Rp <?=number_format($total_margin_penjualan[0]['margin_penjualan'], 0, ',', '.');?></h3>
            </div>
            <a class="view-more" href="<?php echo base_url()?>report">
                View More <i class="clip-arrow-right-2"></i>
            </a>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="core-box">
            <div class="heading">
                <i class="clip-barcode circle-icon circle-bricky"></i>
                <h2>Total Barang</h2>
            </div>
            <div class="content">
                <h3 class="text-info"><?=$total_produk;?> Produk</h3>
            </div>
            <a class="view-more" href="<?php echo base_url()?>master/produk">
                View More <i class="clip-arrow-right-2"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- start: CATEGORIES PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="icon-external-link-sign"></i>
                Grafik Penjualan
                <div class="panel-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs">
                            Tahun <span id="tahun_ini"></span>
                        </button>
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            foreach ($tahun as $value) {
                                echo "<li value='" . $value['Thn'] . "'><a href='#'>Tahun " . $value['Thn'] . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="flot-small-container">
                    <div id="placeholder5" class="flot-placeholder"></div>
                </div>
                <br>
                <div class="center">Tahun <span id="label_thn"></span></div>
            </div>
        </div>
        <!-- end: CATEGORIES PANEL -->
    </div>
    
    <div class="col-md-12">
        <!-- start: CATEGORIES PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="icon-external-link-sign"></i>
                Grafik Penjualan Per Item
                <div class="panel-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs">
                            Tahun <span id="tahun_ini2"></span>
                        </button>
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php
                            foreach ($tahun as $value) {
                                echo "<li value='" . $value['Thn'] . "'><a href='#'>Tahun " . $value['Thn'] . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="flot-container">
                    <div id="placeholder6" class="flot-placeholder"></div>
                </div>
                <br>
                <div class="center">Tahun <span id="label_thn2"></span></div>
            </div>
        </div>
        <!-- end: CATEGORIES PANEL -->
    </div>
    
    <div class="col-md-10">
        <!-- start: CATEGORIES PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="icon-external-link-sign"></i>
                Produk Terlaris
                <div class="panel-tools">

                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="flot-small-container">
                    <div id="placeholder-h2" class="flot-placeholder"></div>
                </div>
            </div>
        </div>
        <!-- end: CATEGORIES PANEL -->
    </div>
</div>

<?php
//echo "<pre>";
//print_r($barang_terlaris);
//echo "</pre>";
?>
<script>
    jQuery(document).ready(function () {
        Index.init();
    });


</script>