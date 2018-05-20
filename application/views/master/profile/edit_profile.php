<div class="col-sm-12">
    <?php echo $this->session->flashdata('msg');?>
</div>
<div class="container-fluid container-fullw bg-white">
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable">
                <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
                    <li class="active">
                        <a data-toggle="tab" href="#panel_edit_personal">
                            Personal Data
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#panel_edit_bank">
                            Bank Account
                        </a>
                    </li>
                </ul>
                <?php
                if (!empty($user_profile)) {
                    $userId = $user_profile[0]['UserId'];
                    $fullName = $user_profile[0]['FullName'];
                    $email = $user_profile[0]['Email'];
                    $Hphone = $user_profile[0]['HomePhoneNumber'];
                    $Mphone = $user_profile[0]['MobilePhoneNumber'];
                    $Wphone = $user_profile[0]['WorkPhoneNumber'];
                    $address = $user_profile[0]['Address'];
                    $provinceId = $user_profile[0]['Province'];
                    $province = $user_profile[0]['prov'];
                    $city = $user_profile[0]['kabupaten'];
                    $cityId = $user_profile[0]['City'];
                    $zipcode = $user_profile[0]['ZipCode'];
                    $birthday = $user_profile[0]['BirthDay'];
                    $religi = $user_profile[0]['Religion'];
                    $fax = $user_profile[0]['FaxNumber'];
                    $day = substr($birthday, 8, 2);
                    $month = substr($birthday, 5, 2);
                    $year = substr($birthday, 0, 4);
                    $photo = $user_profile[0]['Photo'];

                    $kab = $this->profile_model->get_kabupatenById($provinceId);
//                    echo "<pre>";
//                    print_r($kab[0]['id']);
//                    echo "</pre>";
                }
                ?>
                <div class="tab-content">
                    <div id="panel_edit_personal" class="tab-pane fade in active">
                        <form action="<?php echo base_url();?>master/profile/update_personal" id="form1" name="form1" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <legend>
                                    Account Info
                                </legend>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group err">
                                            <label class="control-label">
                                                Full Name <span class="symbol required"></span>
                                            </label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?=$fullName;?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Address
                                            </label>
                                            <textarea class="form-control" name="address" id="address"><?=$address;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Province
                                            </label>
                                            <select class="form-control" id="provinsi" name="provinsi">
                                                <option value="">Please Select</option>
                                                <?php
                                                foreach ($provinsi as $prov) {
                                                    $selected = ($prov['id'] == $provinceId ? $selected = ' selected ' : '');
                                                    echo "<option value='$prov[id]' $selected >$prov[name]</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                City
                                            </label>
                                            <select id="kabupaten-kota" name="kabupaten-kota" class="form-control">
                                                <option value="">Please Select</option>
                                                <?php
                                                foreach ($kab as $data) {
                                                    $selected = ($data['id'] == $cityId ? $selected = ' selected ' : '');
                                                    echo "<option value='$data[id]' $selected >$data[name]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Zip Code
                                            </label>
                                            <input class="form-control" type="text" name="zipcode" id="zipcode" value="<?=$zipcode;?>">
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-4'>    
                                                <div class='form-group'>
                                                    <label>Home Number</label>
                                                    <input type="text" class="form-control" id="home_number" name="home_number" value="<?=$Hphone;?>">
                                                </div>
                                            </div>
                                            <div class='col-sm-4'>
                                                <div class='form-group'>
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?=$Mphone;?>">
                                                </div>
                                            </div>
                                            <div class='col-sm-4'>
                                                <div class='form-group'>
                                                    <label>Work Number</label>
                                                    <input type="text" class="form-control" id="work_number" name="work_number" value="<?=$Wphone;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Fax Number
                                            </label>
                                            <input class="form-control" type="text" name="fax" id="fax" value="<?=$fax;?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Gender
                                            </label>
                                            <br>
                                            <input type="radio" value="M" name="gender" id="male" <?php if ($user_profile[0]['Gender'] == "M") echo " checked ";?>>
                                            Male
                                            <input type="radio" value="F" name="gender" id="female" <?php if ($user_profile[0]['Gender'] == "F") echo " checked ";?>>
                                            Female

                                        </div>

                                        <div class="form-group connected-group">
                                            <label class="control-label">
                                                Date of Birth
                                            </label>
                                            <div class="row">
                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                    <select name="dd" id="dd" class="form-control">
                                                        <option value="">Day</option>
                                                        <?php
                                                        for ($i = 1; $i <= 31; $i++) {
                                                            $dd = ($i <= 9 ? "0" . $i : $i);
                                                            $selected = ($i == $day ? $selected = ' selected ' : '');
                                                            echo "<option value='$dd' $selected>" . $i . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <select name="mm" id="mm" class="form-control">
                                                        <option value="">Month</option>
                                                        <?php
                                                        $globallib = new globallib();
                                                        for ($i = 1; $i <= 12; $i++) {
                                                            $bulan = $globallib->bulan($i);
                                                            $mm = ($i <= 9 ? "0" . $i : $i);
                                                            $selected = ($i == $month ? $selected = ' selected ' : '');
                                                            echo "<option value='" . $mm . "' $selected>" . $bulan . "</option>";
                                                            // echo "<option value='" . $i . "' $selected>" .$i. "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <select name="yyyy" id="yyyy" class="form-control">
                                                        <option value="">Year</option>
                                                        <?php
                                                        $now = date('Y');
                                                        for ($a = 1900; $a <= $now; $a++) {
                                                            $selected = ($a == $year ? $selected = ' selected ' : '');
                                                            echo "<option value = '" . $a . "' $selected>" . $a . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Religion
                                            </label>
                                            <select id="religion" name="religion" class="form-control">
                                                <option value="ISLAM" <?php if ($user_profile[0]['Religion'] == "ISLAM") echo " selected ";?>>ISLAM</option>
                                                <option value="KRISTEN" <?php if ($user_profile[0]['Religion'] == "KRISTEN") echo " selected ";?>>KRISTEN</option>
                                                <option value="KATOLIK" <?php if ($user_profile[0]['Religion'] == "KATOLIK") echo " selected ";?>>KATOLIK</option>
                                                <option value="HINDU" <?php if ($user_profile[0]['Religion'] == "HINDU") echo " selected ";?>>HINDU</option>
                                                <option value="BUDHA" <?php if ($user_profile[0]['Religion'] == "BUDHA") echo " selected ";?>>BUDHA</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="img_exist" id="img_exist" value="<?=$photo;?>">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <?php
                                                    if (empty($photo)) {
                                                        ?>
                                                        <img src="<?php echo base_url();?>assets/images/default-user.png" alt="photo" id="noimage">
                                                    <?php } else {?>
                                                        <img src="<?php echo base_url('uploads/profile/') . $photo;?>" alt="photo" id="noimage">
                                                    <?php }?>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="photo" accept="image/*"></span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Cancel</a>
                                                    <a href="javascript:void(0)" class="btn btn-default" onclick="delete_photo('<?=$userId;?>');">Remove</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--                            <fieldset>
                                                            <legend>
                                                                Additional Info
                                                            </legend>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Twitter
                                                                        </label>
                                                                        <span class="input-icon">
                                                                            <input class="form-control" type="text" placeholder="Text Field">
                                                                            <i class="fa fa-twitter"></i> </span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Facebook
                                                                        </label>
                                                                        <span class="input-icon">
                                                                            <input class="form-control" type="text" placeholder="Text Field">
                                                                            <i class="fa fa-facebook"></i> </span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Instagram 
                                                                        </label>
                                                                        <span class="input-icon">
                                                                            <input class="form-control" type="text" placeholder="Text Field">
                                                                            <i class="fa fa-instagram"></i> </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Linkedin
                                                                        </label>
                                                                        <span class="input-icon">
                                                                            <input class="form-control" type="text" placeholder="Text Field">
                                                                            <i class="fa fa-linkedin"></i> </span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">
                                                                            Skype
                                                                        </label>
                                                                        <span class="input-icon">
                                                                            <input class="form-control" type="text" placeholder="Text Field">
                                                                            <i class="fa fa-skype"></i> </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        * Required Fields
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <p>
                                        By clicking UPDATE, you are agreeing to the Policy and Terms &amp; Conditions.
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-default btn-wide" type="button" id="btn_back" onclick="window.location.href = '<?=base_url();?>master/profile'">
                                        Back <i class="fa fa-arrow-circle-left"></i>
                                    </button>
                                    <button class="btn btn-primary btn-wide" id="btn_account">
                                        Update <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div id="panel_edit_bank" class="tab-pane fade">
                        <div class="panel panel-white">
                            <div class="panel-heading border-light">
                                <h4 class="panel-title">Payment <span class="text-bold">List</span></h4>
                                <div class="panel-tools" >
                                    <button class="btn btn-primary btn-sm btn-o add-event" onclick="add_users_bank()"><i class="glyphicon glyphicon-plus"></i> Add New</button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table id="table" class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Bank Name</th>
                                            <th>Account Holder Name</th>
                                            <th>Account Number</th>
                                            <th>Status</th>
                                            <th style="width:80px;">Action</th>
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

        <script>
            $(document).ready(function () {
                NProgress.start();
                $.ajaxSetup({
                    type: "POST",
                    url: "<?php echo base_url('master/profile/get_data_city')?>",
                    cache: false,
                });

                $("#provinsi").change(function () {
                    var value = $(this).val();
                    if (value > 0) {
                        $.ajax({
                            data: {modul: 'kabupaten', id: value},
                            success: function (respond) {
                                $("#kabupaten-kota").html(respond);
                            }
                        })
                    } else {
                        $("#kabupaten-kota").html('');
                    }
                });

                table = $('#table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        "url": "<?php echo site_url('master/profile/ajax_list')?>",
                        "type": "POST"
                    },
                    "columnDefs": [
                        {
                            "targets": [-1],
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
            });

            $('#form1').submit(function (e) {
                e.preventDefault();
                var me = $(this);

                $.ajax({
                    url: me.attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: new FormData(this), //me.serialize(),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success == true) {
                            setTimeout(function () {
                                location = '<?php echo site_url();?>/master/profile';
                            }, 1000);
                        } else {
                            $.each(response.messages, function (key, value) {
                                var element = $('#' + key);
                                element.closest('div.err')
                                        .removeClass('has-error')
                                        .addClass(value.length > 0 ? 'has-error' : '')
                                        .find('.text-danger')
                                        .remove();

                                element.after(value);
                            });
                        }
                    }
                });
            });

            function add_users_bank()
            {
                save_method = 'add';
                $('#form_payment')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();
                $('#modal_form').modal('show');
                $('.modal-title').text('Add Payment');
                $('[name="rekNumber"]').focus();
            }


            function edit_bank(id, bId, rekNumb)
            {
                save_method = 'update';
                $('#form_payment')[0].reset();
                $('.form-group').removeClass('has-error');
                $('.help-block').empty();

                $.ajax({
                    url: "<?php echo site_url('master/profile/ajax_edit')?>/" + id + "/" + bId + "/" + rekNumb,
                    type: "GET",
                    dataType: "JSON",
                    success: function (data)
                    {
                        $('[name="id"]').val(data.UserId);
                        $('[name="bankName"]').val(data.BankId);
                        $('[name="rekNumber"]').val(data.RekNumber);
                        $('[name="temp_bankName"]').val(data.BankId);
                        $('[name="temp_rekNumber"]').val(data.RekNumber);
                        $('[name="rekName"]').val(data.RekName);
                        $('[name="status"]').val(data.Status);
                        $('#modal_form').modal('show');
                        $('.modal-title').text('Edit Bank');
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
                    url = "<?php echo site_url('master/profile/ajax_add')?>";
                } else {
                    url = "<?php echo site_url('master/profile/ajax_update')?>";
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#form_payment').serialize(),
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

            function delete_bank(id, bId, rekNumb)
            {
                if (confirm('Are you sure delete this data?'))
                {
                    $.ajax({
                        url: "<?php echo site_url('master/profile/ajax_delete')?>/" + id + "/" + bId + "/" + rekNumb,
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

            function delete_photo(id)
            {
                if (confirm('Are you sure delete this picture?'))
                {
                    $.ajax({
                        url: "<?php echo site_url('master/profile/remove_photo')?>/" + id,
                        type: "POST",
                        dataType: "JSON",
                        success: function (data)
                        {
                            alert('picture was deleted..!');
                            $("#noimage").attr("src", "<?php echo base_url();?>assets/images/default-user.png");
                            $("#img_exist").val('');
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
                        <h3 class="modal-title">Bank Form</h3>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="form_payment" class="form-horizontal">
                            <input type="hidden" value="" name="id"/> 
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Bank Name</label>
                                    <div class="col-md-9">
                                        <select id="bankName" name="bankName" class="form-control">
                                            <option value="">Please Select</option>
                                            <?php
                                            foreach ($list_bank as $value) {
                                                echo "<option value='" . $value['BankId'] . "'>" . $value['BankName'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <span class="help-block"></span>
                                        <input name="temp_bankName" type="hidden">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Account Number</label>
                                    <div class="col-md-9">
                                        <input name="rekNumber" placeholder="Account Number" class="form-control" type="text">
                                        <span class="help-block"></span>
                                        <input name="temp_rekNumber" type="hidden">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Account Name</label>
                                    <div class="col-md-9">
                                        <input name="rekName" placeholder="Account Name" value="<?=$fullName;?>" readonly="readonly" class="form-control" type="text">
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
                        <button type="button" class="btn btn-primary btn-o" data-dismiss="modal">Cancel</button>
                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->
    </div>
</div>