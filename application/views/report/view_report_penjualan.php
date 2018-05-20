<?php
$hari_ini = date('Y-m-d');
$bulan_ini = date('m');
$tahun_ini = date('Y');
?>
<br>
<body class="navigation-small">
    <div class="row">
        <div class="col-md-12">
            <div class="well inline-headers">
                <form class="form-inline" id="frmreport" name="frmreport" method="POST" action="<?php echo base_url();?>report/show_report">
                    <div class="form-group">
                        <div class="radio-inline">
                            <label>
                                Transaksi
                            </label>
                        </div>
                        <div class="inline">
                            <select id="slttransaksi" name="slttransaksi" class="form-control">
                                <option value="pembelian" <?php if ($this->input->post('slttransaksi') == 'pembelian') echo ' selected ';?>>Pembelian</option>
                                <option value="penjualan" <?php if ($this->input->post('slttransaksi') == 'penjualan') echo ' selected ';?>>Penjualan</option>
                            </select>
                        </div>
                    </div>
                    &nbsp;
                    <div class="form-group">
                        <div class="radio-inline">
                            <label>
                                Cetak Per
                            </label>
                        </div>
                        <div class="inline">
                            <select id="slttampilan" name="slttampilan" class="form-control">
                                <option value="detail" <?php if ($this->input->post('slttampilan') == 'detail') echo ' selected ';?>>Detail</option>
                                <option value="transaksi" <?php if ($this->input->post('slttampilan') == 'transaksi') echo ' selected ';?>>Transaksi</option>
                                <option value="barang" <?php if ($this->input->post('slttampilan') == 'barang') echo ' selected ';?>>Barang</option>
                            </select>
                        </div>
                    </div>
                    &nbsp;
                    <div class="form-group">
                        <div class="radio-inline">
                            <label>
                                Fixed
                            </label>
                            <input type="radio" value="fixedrange" name="optdate" checked="checked">
                        </div>
                        <div class="radio-inline">
                            <label>
                                Custom Range
                            </label>
                            <input type="radio" value="customrange" name="optdate">
                        </div>
                        <div class="inline">
                            <div id="fix">
                                <select id="sltdate" name="sltdate" class="form-control">
                                    <option value="">Semua</option>
                                    <?php $selected = ($this->input->post('sltdate') == $bulan_ini ? $selected = ' selected ' : '');?>
                                    <option value="<?=$hari_ini;?>" <?php if ($this->input->post('sltdate') == $hari_ini) echo ' selected ';?>>Hari Ini</option>
                                    <option value="<?=$bulan_ini;?>" <?php if ($this->input->post('sltdate') == $bulan_ini) echo ' selected ';?>>Bulan Ini</option>
                                    <option value="<?=$tahun_ini;?>" <?php if ($this->input->post('sltdate') == $tahun_ini) echo ' selected ';?>>Tahun Ini</option>
                                </select>
                            </div>
                        </div>
                        <div class="inline">
                            <div class="input-group input-daterange" id="cust">
                                <span class="input-group-addon">
                                    From
                                </span>
                                <input type="text" name="tgl_1" class="form-control" id="tgl_1" data-date-format="dd-mm-yyyy" value="">
                                <span class="input-group-addon">
                                    To
                                </span>
                                <input type="text" name="tgl_2" class="form-control" id="tgl_2" data-date-format="dd-mm-yyyy" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="radio-inline">
                            <label></label>
                        </div>
                        <div class="inline">
                            <button type="submit" id="show" class="btn btn-primary">
                                <i class="glyphicon glyphicon-adjust"></i>
                                <span>Show</span>
                            </button>
                            <button class="btn btn-success" id="export-btn"><i class="fa fa-cloud-download"></i> Export XLS</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <table id="reporttable" class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th nowrap>Bulan</th>
                            <th nowrap>Tanggal</th>
                            <th nowrap>ID Transaksi</th>
                            <th>Pembeli</th>
                            <th>Barang</th>
                            <th>Qty</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Ongkir</th>
                            <th>Total Terbayar</th>
                            <th>Margin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        error_reporting(0);
                        $MyLib = new globallib();

                        if (!empty($list_report['data'])) {
                            $grandTotal = 0;
                            $totQty = 0;
                            $totHarga = 0;
                            $totOngkir = 0;
                            $totMargin = 0;
                            $temp = "";
                            $TotTotal = 0;
                            $grdTotalMargin = 0;
                            $already_id = "";
                            $ongkir = "";
                            $tot = "";
                            $mar = "";
                            //saat upload..cek jika penjualan lebih dari 1 barang
                            //jumlahkan total barang dengan ongkir dan masukan ke field TotalTerbayar
                            //cek di view jika IDTransaksi sama ongkir cukup 1x dan total harga cukup 1x dan margin juga
                            // di summary smuanya


                            for ($i = 0; $i <= $list_report['rows'] - 1; $i++) {
                                $data = $list_report['data'][$i];
                                $subtotal_margin = 0;
                                $harga = ((int) $data['JumlahProduk'] > 1 ? (int) $data['HargaProduk'] : ((int) $data['HargaProduk'] / (int) $data['JumlahProduk']) );
                                $Total = ($harga * $data['JumlahProduk'] + $data['BiayaPengiriman'] + $data['BiayaAsuransi'] + $data['BiayaPelayanan'] + $data['KodePembayaran'] - abs($data['Voucher']));
                                $totQty += $data['JumlahProduk']; //$data['JumlahProduk;
                                $totHargaBeli += $data['HargaBeli'];
                                $totHarga += $data['HargaProduk'];
                                $totOngkir += $data['BiayaPengiriman'];
                                $margin = ($data['HargaProduk'] - $data['HargaBeli']) * $data['JumlahProduk'];
                                $grandTotal += $Total;
                                $bln = date("m", strtotime($data['Tanggal']));
                                $thn = date("Y", strtotime($data['Tanggal']));
                                if ($temp == $bln) {
                                    $tahun = $thn;
                                } else {
                                    if (!$temp == "") {
                                        ?>
                                        <tr>
                                            <?php
                                            $total_bulan = $this->report_model->getTotalPenjualanByMonth($temp, $tahun);
                                            $TotTotal = ($total_bulan->TotHrg + $total_bulan->TotKirim + $total_bulan->TotKdBayar - abs($total_bulan->TotVoucher));
                                            //$totMargin = ($total_bulan->TotHrg - $total_bulan->TotHrgBeli);
                                            $totMargin = ($total_bulan->SubTotalHrg - $total_bulan->SubTotalHrgBeli);
                                            $grdTotalMargin += $totMargin;
                                            ?>
                                            <td colspan="5" class="footrow-rtl footer"><b>TOTAL : &nbsp;</b></td>
                                            <td class="footrow-rtl footer"><b><?=$total_bulan->TotQty;?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotHrgBeli, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotHrg, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotKirim, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($TotTotal, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><span class="badge badge-success"><b><?=number_format($totMargin, 0, ',', '.');?></b></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="12"></td>
                                        </tr>
                                        <?php
                                    }

                                    $temp = $bln;
                                    $tahun = $thn;
                                }
                                if (!empty($bln)) {
                                    ?>
                                    <tr>
                                        <td> 
                                            <b>
                                                <?php
                                                if ($temp_so1 == $bln) {
                                                    echo"&nbsp;";
                                                    $temp = $bln;
                                                } else {
                                                    echo $MyLib->bulan($bln);
                                                    echo"&nbsp;";
                                                    echo $thn;
                                                    $temp_so1 = $bln;
                                                }
                                                ?>
                                            </b>
                                        </td>
                                        <?php
                                        if ($already_id == $data['IDTransaksi']) {
                                            echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
                                        } else {
                                            ?>
                                            <td><?=date("d-m-Y", strtotime($data['Tanggal']));?></td>
                                            <td><?=$data['IDTransaksi'];?></td>
                                            <td><?=$data['Pembeli'];?></td>
                                            <?php
                                            $already_id = $data['IDTransaksi'];
                                        }
                                        ?>

                                        <td><?=$data['NamaProduk'];?></td>
                                        <td><?=$data['JumlahProduk'];?></td>
                                        <td><?=number_format($data['HargaBeli'], 0, ',', '.');?></td>
                                        <td><?=number_format($harga, 0, ',', '.');?></td>
                                        <td>
                                            <?php
                                            if ($ongkir == $data['IDTransaksi']) {
                                                echo"&nbsp;";
                                            } else {
                                                echo number_format($data['BiayaPengiriman'], 0, ',', '.');
                                                $ongkir = $data['IDTransaksi'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($tot == $data['IDTransaksi']) {
                                                echo"&nbsp;";
                                            } else {
                                                if ($tot == $data['IDTransaksi']) {
                                                    echo number_format($Total, 0, ',', '.');
                                                } else {
                                                    echo number_format($data['TotalTerbayar'], 0, ',', '.');
                                                    $tot = $data['IDTransaksi'];
                                                }
                                                $tot = $data['IDTransaksi'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo number_format($margin, 0, ',', '.');
                                            ?>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <?php
                                $total_bulan = $this->report_model->getTotalPenjualanByMonth($temp, $tahun);
                                $TotTotal = ($total_bulan->TotHrg + $total_bulan->TotKirim + $total_bulan->TotKdBayar - abs($total_bulan->TotVoucher));
                                //$totMargin = ($total_bulan->TotHrg - $total_bulan->TotHrgBeli);
                                $totMargin = ($total_bulan->SubTotalHrg - $total_bulan->SubTotalHrgBeli);
                                $grdTotalMargin += $totMargin;
                                ?>
                                <td colspan="5" class="footrow-rtl footer"><b>TOTAL : &nbsp;</b></td>
                                <td class="footrow-rtl footer"><b><?=$total_bulan->TotQty;?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotHrgBeli, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotHrg, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotKirim, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($TotTotal, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><span class="badge badge-success"><b><?=number_format($totMargin, 0, ',', '.');?></b></span></td>
                            </tr>
                            <tr>
                                <td colspan="11"></td>
                            </tr>
                        </tbody>
                        <tfoot class="footer footrow">
                            <tr>
                                <td colspan="5"><b>GRAND TOTAL:</b></td>
                                <td class=""><b><?=$totQty;?></b></td>
                                <td class=""><b><?=number_format($totHargaBeli, 0, ',', '.');?></b></td>
                                <td class=""><b><?=number_format($totHarga, 0, ',', '.');?></b></td>
                                <td class=""><b><?=number_format($totOngkir, 0, ',', '.');?></b></td>
                                <td class=""><b><?=number_format($grandTotal, 0, ',', '.');?></b></td>
                                <td class=""><span class="badge badge-success"><b><?=number_format($grdTotalMargin, 0, ',', '.');?></b></span></td>
                            </tr>
                        </tfoot>
                        <?php
                    }
                    ?>


                </table>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function () {
        $('#export-btn').prop('disabled', true);
        $("#tgl_1").datepicker({
            todayHighlight: true,
            endDate: '1d',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#tgl_2').datepicker('setStartDate', minDate);
        });

        $("#tgl_2").datepicker({
            todayHighlight: true,
            endDate: '1d',
            autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#tgl_1').datepicker('setEndDate', minDate);
        });

        $('#cust').hide();

        $("input[name=optdate]:radio").click(function () {
            if ($('input[name=optdate]:checked').val() == "fixedrange") {
                $('#cust').hide();
                $('#fix').show();
            } else if ($('input[name=optdate]:checked').val() == "customrange") {
                $('#fix').hide();
                $('#cust').show();
            }
        });

        if ($("#reporttable tr").length > 1) {
            $('#export-btn').prop('disabled', false);
        }

        $('#export-btn').on('click', function (e) {
            e.preventDefault();
            ResultsToTable();
        });

        function ResultsToTable() {
            $("#reporttable").table2excel({
                filename: "report_penjualan",
                name: "Results"
            });
        }


    });

    function nProggress() {
        NProgress.start();
        setTimeout(function () {
            NProgress.done();
            $('.fade').removeClass('out');
        }, 1000);
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>