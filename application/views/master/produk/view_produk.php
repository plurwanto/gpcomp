<div class="row">
    <div class="col-md-12">
        <br>
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-external-link-square"></i>
                List Produk
                <div class="panel-tools">
                    <a class="btn btn-primary btn-xs" href="javascript:void(0)" onclick="add_produk();"><i class="ace-icon fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover table-condensed" id="table">
                    <thead>
                        <tr>
                            <th>Produk Name</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Tanggal Publish</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th style="width:100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


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
                        "url": "<?php echo site_url('master/produk/ajax_list')?>",
                        "type": "POST"
                    },
                    "columnDefs": [
                        {
                            "targets": [-1],
                            "orderable": false,
                        },
                        {
                            "targets": [-2],
                            "orderable": false,
                        },
                        {
                            "targets": [-3],
                            "orderable": false,
                        },
                        {
                            "targets": [-4],
                            "orderable": false,
                        },
                        {
                            "targets": [-5],
                            "orderable": false,
                        },
                        {
                            "targets": [-6],
                            "orderable": false,
                        },
                    ],

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

                $('#mulaijual').datepicker({
                    autoclose: true,
                    endDate: '1d',
                    todayHighlight: true
                });

            });

            function add_produk()
            {
                save_method = 'add';
                $('#form')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();
                $('#modal_form').modal('show');
                $('.modal-title').text('Add Category');
                $('[name="produkName"]').focus();
            }

            function edit_data(id)
            {
                save_method = 'update';
                $('#form')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();

                $.ajax({
                    url: "<?php echo site_url('master/produk/ajax_edit')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function (data)
                    {
                        $('[name="id"]').val(data.id);
                        $('[name="produkName"]').val(data.NamaProduk);
                        $('[name="hargaBeli"]').val(data.HargaBeliProduk);
                        $('[name="hargaJual"]').val(data.HargaJualProduk);
                        $('[name="mulaijual"]').val(data.MulaiJual);
                        $('[name="status"]').val(data.Status);
                        $('#modal_form').modal('show');
                        $('.modal-title').text('Edit Category');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }

            function reload_table()
            {
                table.ajax.reload(null, false); //reload datatable ajax 
            }

            function save()
            {
                $('#btnSave').text('Saving...'); //change button text
                $('#btnSave').attr('disabled', true); //set button disable 
                var url;

                if (save_method == 'add') {
                    url = "<?php echo site_url('master/produk/ajax_add')?>";
                } else {
                    url = "<?php echo site_url('master/produk/ajax_update')?>";
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#form').serialize(),
                    dataType: "JSON",
                    success: function (data)
                    {
                        if (data.status)
                        {
                            $('#modal_form').modal('hide');
                            reload_table();
                        } else
                        {
                            for (var i = 0; i < data.inputerror.length; i++)
                            {
                                $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                                $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                            }
                        }
                        $('#btnSave').text('Save');
                        $('#btnSave').attr('disabled', false);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error adding / update data');
                        $('#btnSave').text('save'); //change button text
                        $('#btnSave').attr('disabled', false); //set button enable 

                    }
                });
            }

            function delete_data(id)
            {
                if (confirm('Are you sure delete this data?'))
                {
                    $.ajax({
                        url: "<?php echo site_url('produk/ajax_delete')?>/" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            $('#modal_form').modal('hide');
                            reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error deleting data');
                        }
                    });

                }
            }

        </script>

        <!-- Bootstrap modal -->
        <div class="modal fade" id="modal_form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Produk Form</h3>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="form" class="form-horizontal">
                            <input type="hidden" value="" name="id"/> 
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Nama Produk</label>
                                    <div class="col-md-9">
                                        <input name="produkName" placeholder="Nama Produk" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Harga Beli</label>
                                    <div class="col-md-9">
                                        <input name="hargaBeli" placeholder="Harga Beli" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Harga Jual</label>
                                    <div class="col-md-9">
                                        <input name="hargaJual" placeholder="Harga Jual" class="form-control" type="text">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Mulai Di Jual</label>
                                    <div class="col-md-9">
                                        <div class="input-medium">
                                            <div class="input-group">
                                                <input type="text" id="mulaijual" name="mulaijual" value="<?=date("d-m-Y");?>" class="input-medium date-picker input-sm" data-date-format="dd-mm-yyyy">
                                                
                                            </div>
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Status</label>
                                    <div class="col-md-9">
                                        <select id="status" name="status" class="form-control">
                                            <option value="Y" >Aktive</option>
                                            <option value="T" >Not Aktive</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->
    </div>
</div>