<br>
<div class="row">
    <div class="col-md-12">
        <div class="well inline-headers">
            <form class="form-inline" id="frmreport" name="frmreport" method="POST">
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
                                <option value="10-07-2017">Hari Ini</option>
                                <option value="minggu">Minggu Ini</option>
                                <option value="bulan">Bulan Ini</option>
                                <option value="tahun">Tahun Ini</option>
                                <option value="semua">Semua</option>
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
            <table id="reporttable" class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th nowrap>Tanggal</th>
                        <th nowrap>ID Transaksi</th>
                        <th>Penjual</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
</div>

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

        $('#show').click(function (e) {
            e.preventDefault();
            nProggress();

            $.ajax({
                url: "<?php echo site_url('report/show_report')?>",
                type: "POST",
                data: $('#frmreport').serialize(),
                dataType: "JSON",
                success: function (response)
                {
                    $('#totalRow').text("Showing " + response.data.length + " entries");
                    $('table#reporttable tr#baris').remove();
                    var tr;
                    for (var i = 0; i < response.data.length; i++) {
                        x = i + 1;
                        $('table#reporttable tr#baris' + x).remove();
                        html = '<tr id="baris">';
                        html += '<td nowrap>' + response.data[i][0] + '</td>';
                        html += '<td nowrap>' + response.data[i][1] + '</td>';
                        html += '<td nowrap>' + response.data[i][2] + '</td>';

                        html += '</tr>';
                        $('#reporttable').append(html);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        });
    });

    function nProggress() {
        NProgress.start();
        setTimeout(function () {
            NProgress.done();
            $('.fade').removeClass('out');
        }, 1000);
    }
</script>