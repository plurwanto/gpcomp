<!DOCTYPE html>
<html lang="en" class="no-js">

    <!-- start: BODY -->
    <body class="error-full-page">
        <div id="sound" style="z-index: -1;"></div>
        <img id="background" src="#" />
        <div id="cholder">
            <canvas id="canvas"></canvas>
        </div>
        <!-- start: PAGE -->
        <div class="container">
            <div class="row">
                <!-- start: 404 -->
                <div class="col-sm-12 page-error">
                    <div class="error-number teal">
                        404
                    </div>
                    <div class="error-details col-sm-6 col-sm-offset-3">
                        <h3>Oops! You are stuck at 404</h3>
                        <p>
                            Unfortunately the page you were looking for could not be found.
                            <br>
                            It may be temporarily unavailable, moved or no longer exist.
                            <br>
                            Check the URL you entered for any mistakes and try again.
                            <br>
                            <a href="<?php echo base_url()?>home" class="btn btn-teal btn-return">
                                Return home
                            </a>
                            <br>
                        </p>
                    </div>
                </div>
                <!-- end: 404 -->
            </div>
        </div>

    </body>
    <!-- end: BODY -->
</html>