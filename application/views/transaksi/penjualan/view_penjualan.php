<div class="row">
    <div class="col-md-12">
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                Transaksi Penjualan
                <div class="panel-tools">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#"></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="panel-group accordion-custom accordion-teal" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <i class="icon-arrow"></i>
                                    Upload Penjualan
                                </a></h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form id="frmUpload" method="POST" action="<?php echo base_url();?>transaksi/penjualan/save_penjualan" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label" for="sltsitus">
                                            Situs
                                        </label>
                                        <div class="col-sm-3">
                                            <select id="sltsitus" name="sltsitus" class="form-control">
                                                <?php
                                                foreach ($list_kategory as $value) {
                                                    echo '<option value="' . $value["CategoryId"] . '">' . $value["CategoryName"] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <span class="btn btn-success fileinput-button"> <i class="glyphicon glyphicon-plus"></i> <span>Add files...</span>
                                            <input type="file" name="file" id="file" accept=".csv">
                                        </span>
                                        <button type="button" id="upload" class="btn btn-primary start">
                                            <i class="glyphicon glyphicon-upload"></i>
                                            <span>Start upload</span>
                                        </button>
                                        <button type="button" id="cancel" class="btn btn-default" onclick="location.reload();">
                                            <i class="glyphicon glyphicon-refresh"></i>
                                            <span>Cancel</span>
                                        </button>
                                        <button type="submit" id="save" class="btn btn-info">
                                            <i class="glyphicon glyphicon-save"></i>
                                            <span>Save Data</span>
                                        </button>
                                    </div>
                                    <br>
                                    <div class="table table-responsive" id="tbldata" style="height:500px; width:100%;overflow: auto;">
                                        <div id="totalRow"></div>
                                        <table id="barangtable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="check_all" id="check_all"></th>
                                                    <th nowrap>Tanggal</th>
                                                    <th nowrap>ID Transaksi</th>
                                                    <th nowrap>Pembeli</th>
                                                    <th nowrap>Nama Produk</th>
                                                    <th nowrap>Harga Jual</th>
                                                    <th nowrap>Jumlah Produk</th>
                                                    <th>TransaksiDropshipper</th>
                                                    <th>NamaDropshipper</th>
                                                    <th>DetailDropshipper</th>
                                                    <th nowrap>Penjual</th>
                                                    <th>HP Pembeli</th>
                                                    <th>Alamat Pembeli</th>
                                                    <th>Kecamatan Pembeli</th>
                                                    <th>Kota Pembeli</th>
                                                    <th>Propinsi Pembeli</th>
                                                    <th>Kode Pos Pembeli</th>
                                                    <th>Biaya Pengiriman</th>
                                                    <th>Biaya Asuransi</th>
                                                    <th>Total Terbayar</th>
                                                    <th>Kurir</th>
                                                    <th>Kode Tracking</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>

                                    </div>
                                    <button class="btn btn-danger delete" type="button" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    <i class="icon-arrow"></i>
                                    List Penjualan
                                </a></h4>
                        </div>

                        <div id="collapseTwo" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table table-bordered table-hover table-condensed" id="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>ID Transaksi</th>
                                            <th>Pembeli</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var save_method;
            var table;

            $(document).ready(function () {
                table = $('#table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "url": "<?php echo site_url('transaksi/penjualan/ajax_list')?>",
                        "type": "POST"
                    },
                    "columnDefs": [
                        {
                            "targets": [-1, -2, -3, -4],
                            "orderable": false,
                        },
                    ],

                });
                $('#tbldata').hide();
                $('#save').hide();
                $('#cancel').hide();
                $('.delete').hide();

                $('#upload').click(function () {
                    if ($('#file').val() != '') {
                        $('#tbldata').show();
                        $('.delete').show();
                        $.ajax({
                            xhr: function () {
                                var xhr = new window.XMLHttpRequest();
                                //Upload progress
                                xhr.upload.addEventListener("progress", function (evt) {
                                    if (evt.lengthComputable) {
                                        var percentComplete = evt.loaded / evt.total;
                                        //Do something with upload progress
                                        nProggress();
                                    }
                                }, false);
                                return xhr;
                            },
                            url: '<?php echo base_url();?>transaksi/penjualan/upload_file',
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: new FormData($('#frmUpload')[0]),
                            //data: form_data,
                            type: 'post',
                            success: function (response) {
                                $('#save').show();
                                $('#cancel').show();
                                $('#totalRow').text("Showing " + response.data.length + " entries");
                                $('table#barangtable tr#baris0').remove();
                                var tr;
                                if (response.situs == "BL") {
                                    for (var i = 0; i < response.data.length; i++) {
                                        x = i + 1;
                                        $('table#barangtable tr#baris' + x).remove();
                                        html = '<tr id="baris">';
                                        html += '<td nowrap><input type="checkbox" class="case" name="chkchild[]" id="chkchild' + x + '""></td>';
                                        html += '<td nowrap><input type="text" name="field1[]" id="field' + x + '" value="' + response.data[i][1] + '"></td>';
                                        html += '<td nowrap><input readonly type="text" name="field2[]" id="field' + x + '" value="' + response.data[i][2] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field7[]" id="field' + x + '" value="' + response.data[i][7] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field14[]" id="field' + x + '" value="' + response.data[i][14] + '"></td>';
                                        //html += '<td nowrap><input type="text" name="field23[]" id="field' + x + '" value="' + response.hrg[i][23] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field15[]" id="field' + x + '" value="' + response.data[i][15] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field19[]" id="field' + x + '" value="' + response.data[i][19] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field3[]" id="field' + x + '" value="' + response.data[i][3] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field4[]" id="field' + x + '" value="' + response.data[i][4] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field5[]" id="field' + x + '" value="' + response.data[i][5] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field6[]" id="field' + x + '" value="' + response.data[i][6] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field8[]" id="field' + x + '" value="' + response.data[i][8] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field9[]" id="field' + x + '" value="' + response.data[i][9] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field10[]" id="field' + x + '" value="' + response.data[i][10] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field11[]" id="field' + x + '" value="' + response.data[i][11] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field12[]" id="field' + x + '" value="' + response.data[i][12] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field13[]" id="field' + x + '" value="' + response.data[i][13] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field16[]" id="field' + x + '" value="' + response.data[i][16] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field17[]" id="field' + x + '" value="' + response.data[i][17] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field18[]" id="field' + x + '" value="' + response.data[i][18] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field20[]" id="field' + x + '" value="' + response.data[i][20] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field21[]" id="field' + x + '" value="' + response.data[i][21] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field22[]" id="field' + x + '" value="' + response.data[i][22] + '"></td>';
                                        html += '</tr>';
                                        $('#barangtable').append(html);
                                    }
                                } else if (response.situs == "TP") {
                                    for (var i = 0; i < response.data.length; i++) {
                                        x = i + 1;
                                        $('table#barangtable tr#baris' + x).remove();
                                        html = '<tr id="baris">';
                                        html += '<td nowrap><input type="checkbox" class="case" name="chkchild[]" id="chkchild' + x + '""></td>';
                                        html += '<td nowrap><input type="text" name="field1[]" id="field' + x + '" value="' + response.data[i][1] + '"></td>';
                                        html += '<td nowrap><input readonly type="text" name="field2[]" id="field' + x + '" value="' + response.data[i][2] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field7[]" id="field' + x + '" value="' + response.data[i][3] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field14[]" id="field' + x + '" value="' + response.data[i][4] + '"></td>';
                                        //html += '<td nowrap><input type="text" name="field23[]" id="field' + x + '" value="' + response.hrg[i][23] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field15[]" id="field' + x + '" value="' + response.data[i][5] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field19[]" id="field' + x + '" value="' + response.data[i][6] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field3[]" id="field' + x + '" value="' + response.data[i][7] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field4[]" id="field' + x + '" value="' + response.data[i][8] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field5[]" id="field' + x + '" value="' + response.data[i][9] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field6[]" id="field' + x + '" value="' + response.data[i][10] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field8[]" id="field' + x + '" value="' + response.data[i][11] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field9[]" id="field' + x + '" value="' + response.data[i][12] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field10[]" id="field' + x + '" value="' + response.data[i][13] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field11[]" id="field' + x + '" value="' + response.data[i][14] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field12[]" id="field' + x + '" value="' + response.data[i][15] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field13[]" id="field' + x + '" value="' + response.data[i][16] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field16[]" id="field' + x + '" value="' + response.data[i][17] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field17[]" id="field' + x + '" value="' + response.data[i][18] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field18[]" id="field' + x + '" value="' + response.data[i][19] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field20[]" id="field' + x + '" value="' + response.data[i][20] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field21[]" id="field' + x + '" value="' + response.data[i][21] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field22[]" id="field' + x + '" value="' + response.data[i][22] + '"></td>';
                                        html += '<td nowrap><input type="text" name="field23[]" id="field' + x + '" value="' + response.data[i][23] + '"></td>';
                                        html += '</tr>';
                                        $('#barangtable').append(html);
                                    }
                                }

                                $('#file').val('');
                            },
                            error: function (xhr, status, error) {
                                $('#file').val('');
                                alert('File tidak sesuai');
                                //alert(xhr.responseText);
                            }
                        });
                    } else {
                        alert("Tidak ada file yang di pilih..!");
                    }
                });


                //deletes the selected table rows
                $(".delete").on('click', function () {
                    var tbody = $("#barangtable tbody");
                    $('.case:checkbox:checked').parents("tr").remove();
                    $('#check_all').prop("checked", false);
                    $('#totalRow').text("Showing " + tbody.children().length + " entries");
                });

                $("#check_all").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });

                $('#save').click(function (e) {
                    NProgress.start();
                    $('#save').attr("disabled", true);
                    //  if (confirm("Ada "+tbody.children().length + " yang akan disimpan..!")) {
                    var tbody = $("#barangtable tbody");
                    if (tbody.children().length == 0) {
                        alert('Tidak ada data..!');
                        e.preventDefault();
                    } else {
                        $('#save').text('Saving...');

                    }

                    //   }
                });

                $("input").change(function () {
                    $(this).parent().parent().removeClass('has-error');
                    $(this).next().empty();
                });
                $("textarea").change(function () {
                    $(this).parent().parent().removeClass('has-error');
                    $(this).next().empty();
                });
                $("select").change(function () {
                    $(this).parent().parent().removeClass('has-error');
                    $(this).next().empty();
                });
            });


            function reload_table()
            {
                table.ajax.reload(null, false); //reload datatable ajax 
            }



            function nProggress() {
                NProgress.start();
                setTimeout(function () {
                    NProgress.done();
                    $('.fade').removeClass('out');
                }, 1000);
            }

        </script>

    </div>
</div>