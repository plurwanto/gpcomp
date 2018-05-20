<div class="col-sm-12">
    <?php echo $this->session->flashdata('msg');?>
</div>
<div class="container-fluid container-fullw bg-white">
    <div class="row">
        <div class="col-md-12">
            <?php
            $MyLib = new globallib();
            if (!empty($user_profile)) {
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
                $gender = ($user_profile[0]['Gender'] == 'M' ? 'MALE' : ($user_profile[0]['Gender'] == 'F' ? 'FEMALE' : ''));
                $photo = $user_profile[0]['Photo'];
            }
            ?>

            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="user-left">
                        <div class="center">
                            <h4><?=$fullName;?></h4>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="user-image">
                                    <div class="fileinput-new thumbnail"><?php
                                        if (empty($photo)) {
                                            ?>
                                            <img src="<?php echo base_url();?>assets/images/default-user.png" alt="photo" id="noimage">
                                        <?php } else {?>
                                            <img src="<?php echo base_url('uploads/profile/') . $photo;?>" alt="photo" id="noimage">
                                        <?php }?>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="social-icons block">
                                <ul>
                                    <li data-placement="top" data-original-title="Twitter" class="social-twitter tooltips">
                                        <a href="http://www.twitter.com" target="_blank">
                                            Twitter
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Facebook" class="social-facebook tooltips">
                                        <a href="http://facebook.com" target="_blank">
                                            Facebook
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Google" class="social-google tooltips">
                                        <a href="http://google.com" target="_blank">
                                            Google+
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="LinkedIn" class="social-linkedin tooltips">
                                        <a href="http://linkedin.com" target="_blank">
                                            LinkedIn
                                        </a>
                                    </li>
                                    <li data-placement="top" data-original-title="Github" class="social-github tooltips">
                                        <a href="#" target="_blank">
                                            Github
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                        </div>
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th colspan="3">Contact Information</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Email:</td>
                                    <td>
                                        <a href="">
                                            <?=$email;?>
                                        </a></td>

                                </tr>
                                <tr>
                                    <td>Mobile Phone:</td>
                                    <td><?=$Mphone;?></td>

                                </tr>
                                <tr>
                                    <td>Work Phone</td>
                                    <td><?=$Wphone;?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3">General information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Gender</td>
                                    <td><?=$gender;?></td>

                                </tr>
                                <tr>
                                    <td>Religion</td>
                                    <td><?=$religi;?></td>

                                </tr>
                                <tr>
                                    <td>Full Address</td>
                                    <td><?=$address;?></td>

                                </tr>
                                <tr>
                                    <td>Province</td>
                                    <td><?=$province;?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><?=$city;?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><span class="label label-sm label-info">Administrator</span></td>

                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><button class="btn btn-info btn-xs" onclick="change_pwd()">Change Password</button></td>

                                </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3">Additional information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Birth Day</td>
                                    <td><?=$MyLib->ubah_tanggal($birthday);?></td>

                                </tr>
                                <tr>
                                    <td>KTP</td>
                                    <td></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-7 col-md-8">
                    <div class="row space20">
                        <div class="col-sm-3">
                            <button class="btn btn-icon margin-bottom-5 margin-bottom-5 btn-block" onclick="location.href = '<?php echo base_url();?>master/profile/edit_profile';">
                                <i class="ti-layers-alt block text-primary text-extra-large margin-bottom-10"></i>
                                Edit Profile
                            </button>
                        </div>
                    </div>

                    <div class="panel panel-white space20">
                        <div class="panel-heading">
                            <h4 class="panel-title">Recent </h4>
                        </div>
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function change_pwd()
    {
        $('#form_pwd')[0].reset();
        $('.form-group').removeClass('has-error');
        $('div.err').removeClass('has-error');
        $('#modal_form2').modal('show');
        $('.modal-title').text('Change Password');
        $('[name="oldpwd"]').focus();
    }

    function save()
    {
        var url;

        url = "<?php echo site_url('master/profile/change_password')?>";

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form_pwd').serialize(),
            dataType: "JSON",
            success: function (response)
            {
                if (response.success == true) {
                    setTimeout(function () {
                        location = '<?php echo site_url();?>master/profile';
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
    }
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Cange Password</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_pwd" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Old Password</label>
                            <div class="col-md-9 err">
                                <input type="password" class="form-control" id="oldpwd" name="oldpwd">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">New Password</label>
                            <div class="col-md-9 err">
                                <input type="password" class="form-control" id="newpwd" name="newpwd">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Confirm Password</label>
                            <div class="col-md-9 err">
                                <input type="password" class="form-control" id="confpwd" name="confpwd">
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