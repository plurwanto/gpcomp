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
                                <option value="pembelian">Pembelian</option>
                                <option value="penjualan">Penjualan</option>
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
                                <option value="detail">Detail</option>
                                <option value="transaksi">Transaksi</option>
                                <option value="barang">Barang</option>
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
                            <th>Penjual</th>
                            <th>Barang</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Ongkir</th>
                            <th>Pelayanan</th>
                            <th>Kd bayar</th>
                            <th>Diskon</th>
                            <th>Total</th>
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
                            $totByPelayanan = 0;
                            $totKdBayar = 0;
                            $totDiskon = 0;
                            $temp = "";
                            $TotTotal = 0;
                            //echo $list_report['data'][1]['HargaProduk'];
                            //foreach ($list_report as $value) {

                            for ($i = 0; $i <= $list_report['rows'] - 1; $i++) {
                                $data = $list_report['data'][$i];

                                $harga = ((int) $data['HargaProduk'] ); /// (int) $data['JumlahProduk']);
                                $Total = ((int) $data['HargaProduk'] * $data['JumlahProduk'] + $data['BiayaPengiriman'] + $data['BiayaAsuransi'] + $data['BiayaPelayanan'] + $data['KodePembayaran'] - abs($data['Voucher']));
                                $totQty += $data['JumlahProduk']; //$data['JumlahProduk;
                                $totHarga += $data['HargaProduk'];
                                $totOngkir += $data['BiayaPengiriman'];
                                $totByPelayanan += $data['BiayaPelayanan'];
                                $totKdBayar += $data['KodePembayaran'];
                                $totDiskon += $data['Voucher'];
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
                                            $total_bulan = $this->report_model->getTotalPembelianByMonth($temp, $tahun);
                                            $TotTotal += ($total_bulan->TotHrg * $total_bulan->TotQty + $total_bulan->TotKirim + $total_bulan->TotKdBayar - abs($total_bulan->TotVoucher));
                                            ?>
                                            <td colspan="5" class="footrow-rtl footer"><b>TOTAL : &nbsp;</b></td>
                                            <td class="footrow-rtl footer"><b><?=$total_bulan->TotQty;?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotHrg, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotKirim, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotPelayanan, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotKdBayar, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotVoucher, 0, ',', '.');?></b></td>
                                            <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotTerbayar, 0, ',', '.');?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="11"></td>
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
                                            <b><?php
                                                if ($temp_so1 == $bln) {
                                                    echo"&nbsp;";
                                                    $temp = $bln;
                                                } else {
                                                    echo $MyLib->bulan($bln);
                                                    echo"&nbsp;";
                                                    echo $thn;
                                                    $temp_so1 = $bln;
                                                }
                                                ?></b>
                                        </td>
                                        <td><?=date("d-m-Y", strtotime($data['Tanggal']));?></td>
                                        <td><?php echo (!empty($data['Keterangan']) ? "<a href='#' data-toggle='tooltip' title='" . $data['Keterangan'] . "'>" . $data['IDTransaksi'] . "</a>" : $data['IDTransaksi']);?></td>
                                        <td><?=$data['Penjual'];?></td>
                                        <td><?=$data['NamaProduk'];?></td>
                                        <td><?=$data['JumlahProduk'];?></td>
                                        <td><?=number_format($harga, 0, ',', '.');?></td>
                                        <td><?=number_format($data['BiayaPengiriman'], 0, ',', '.');?></td>
                                        <td><?=number_format($data['BiayaPelayanan'], 0, ',', '.');?></td>
                                        <td><?=number_format($data['KodePembayaran'], 0, ',', '.');?></td>
                                        <td><?=number_format($data['Voucher'], 0, ',', '.');?></td>
                                        <td><?=number_format($Total, 0, ',', '.');?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <?php
                                $total_bulan = $this->report_model->getTotalPembelianByMonth($temp, $tahun);
                                $TotTotal = ($total_bulan->TotHrg + $total_bulan->TotKirim + $total_bulan->TotKdBayar - abs($total_bulan->TotVoucher));
                                ?>
                                <td colspan="5" class="footrow-rtl footer"><b>TOTAL : &nbsp;</b></td>
                                <td class="footrow-rtl footer"><b><?=$total_bulan->TotQty;?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotHrg, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotKirim, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotPelayanan, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotKdBayar, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotVoucher, 0, ',', '.');?></b></td>
                                <td class="footrow-rtl footer"><b><?=number_format($total_bulan->TotTerbayar, 0, ',', '.');?></b></td>
                            </tr>
                            <tr>
                                <td colspan="11"></td>
                            </tr>
                        </tbody>
                        <tfoot class="footer footrow">
                            <tr>
                                <td colspan="5"><b>GRAND TOTAL:</b></td>
                                <td class=""><b><?=$totQty;?></b></td>
                                <td class=""><b><?=number_format($totHarga, 0, ',', '.');?></b></td>
                                <td class=""><b><?=number_format($totOngkir, 0, ',', '.');?></b></td>
                                <td class=""><b><?=number_format($totByPelayanan, 0, ',', '.');?></b></td>
                                <td class=""><b><?=number_format($totKdBayar, 0, ',', '.');?></b></td>
                                <td class=""><b><?=number_format($totDiskon, 0, ',', '.');?></b></td>
                                <td class=""><b><?=number_format($grandTotal, 0, ',', '.');?></b></td>
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


//        $('#show').click(function (e) {
//            e.preventDefault();
//            nProggress();
//
//            $.ajax({
//                url: "<?php echo site_url('report/show_report')?>",
//                type: "POST",
//                data: $('#frmreport').serialize(),
//                dataType: "JSON",
//                success: function (response)
//                {
//                    $('#totalRow').text("Showing " + response.data.length + " entries");
//                    $('table#reporttable tr#baris').remove();
//                    var tr;
//                    var gdTotal = 0;
//                    for (var i = 0; i < response.data.length; i++) {
//                        x = i + 1;
//                        $('table#reporttable tr#baris' + x).remove();
//                        html = '<tr id="baris">';
//                        html += '<td nowrap>' + response.data[i][0] + '</td>';
//                        html += '<td nowrap>' + response.data[i][1] + '</td>';
//                        html += '<td nowrap>' + response.data[i][2] + '</td>';
//                        html += '<td nowrap>' + response.data[i][3] + '</td>';
//                        html += '<td nowrap>' + response.data[i][4] + '</td>';
//                        html += '<td nowrap>' + response.data[i][5] + '</td>';
//                        html += '<td nowrap>' + response.data[i][6] + '</td>';
//                        html += '<td nowrap>' + response.data[i][7] + '</td>';
//                        html += '<td nowrap>' + response.data[i][8] + '</td>';
//                        html += '<td nowrap>' + response.data[i][9] + '</td>';
//                        html += '</tr>';
//                        $('#reporttable').append(html);
//                        gdTotal = gdTotal + response.data[i][9];
//
//                    }
//                    $('#gdtotal').text(numberWithCommas(gdTotal));
//                },
//                error: function (jqXHR, textStatus, errorThrown)
//                {
//                    alert('Error get data from ajax');
//                }
//            });
//
//        });
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