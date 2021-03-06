<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <SCRIPT>
        var datatable;
        $(document).ready(function () {
        });
    </SCRIPT>
    <style type="text/css">
        .file {
            position: relative;
            overflow: hidden;
            padding: 0.45rem 0.9rem;
            font-size: 0.875rem;
        }
        .inputfile {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
    </style>
</head>
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">My Page</h4>
            <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a href="#profile" id="pills-home-tab" data-toggle="tab" aria-expanded="false" class="nav-link active show">
                        My Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#change" id="pills-profile-tab" data-toggle="tab" aria-expanded="true" class="nav-link">
                        Password
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form action="<?=base_url()?>chageProfile" method="post" enctype="multipart/form-data" class="comment-area-box mt-2 mb-3">
                        <div class="form-group text-center">
                            <img src="<?=$imagePath?>" id="myphoto" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                            <h4 class="mb-0"><?=$name?></h4>
                        </div>
                        <div class="form-group col-12">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" readonly name="email" value="<?=$email?>" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group col-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" readonly name="name" value="<?=$name?>" placeholder="Enter name">
                        </div>
                        <div class="form-group col-12">
                            <div class="file btn btn-lg btn-primary">
                                Change photo
                                <input type="file" class="inputfile" onchange="previewImage(this)" name="file"/>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary waves-effect waves-light col-12">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="change" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <form action="changePassword" method="post" enctype="multipart/form-data" class="comment-area-box mt-2 mb-3">
                        <div class="form-group col-12">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Enter password">
                        </div>
                        <div class="form-group col-12">
                            <label for="confirm">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm" name="confirm" aria-describedby="emailHelp" placeholder="Confirm password">
                        </div>
                        <div class="form-group col-12">
                            <button type="button" onclick="savePassword()" class="btn btn-primary waves-effect waves-light col-12">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(e)
        {
            document.querySelector("#myphoto").src = e.target.result;

            Session("reload") = "yes";
        }
        reader.readAsDataURL(event.files[0]);
    }
    function savePassword() {
        if ($('#password').val() != $('#confirm').val())
        {
            showNotify("Warning", "warning", "Please enter correct confirm password");
            return;
        }
        var request = $.ajax({
            url: "<?=base_url()?>chagePassword",
            type: "POST",
            data: {password : $('#password').val()},
            dataType: "html"
        });

        request.done(function(msg) {
            if(msg == "success"){
                showNotify("Well Done!", "success", "Operation successful");
            }else{
                showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
            }
        });
        request.fail(function(jqXHR, textStatus) {
            showNotify("Oh snap!", "error", "Change a few things up and try submitting again.");
        });
    }
</script>