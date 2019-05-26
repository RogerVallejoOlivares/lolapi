<?php
/**
 * Match page
 */

if(!isset($_SESSION)) {
    @session_start();
}

include('inc.config.php');
require(CWD.'includes/inc.user.php');

$returnUrl = 'index.php';
$currentUser = User::getCurrentUser();

if($currentUser === FALSE || ($currentUser !== FALSE && !$currentUser->isLogged())) {
    @header('Location: '.$returnUrl);
    exit();
}

$_SESSION['current_page'] = 'main';

include_once('templates/imports.template.php');
include_once('templates/navbarUsers.template.php');

?>

<section class="formSettings">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header cardTittle text-center">
                        <h4 class="">Summary</h4>
                    </div>
                    <div class="card-body text-center" id="cardMap">
                        <div class="row">
                            <div class="col-lg-5 col-6">
                                <h1 class="nameMatch text-primary">matalords</h1>
                                <h3 class="midMarginBtm">winner</h3>
                            </div>
                            <div class="col-lg-5 col-6 offset-lg-2">
                                <h1 class="nameMatch text-danger">asis</h1>
                                <h3 class="midMarginBtm">loser</h3>
                            </div>
                        </div>
                        <a href="#detailsMatch" class="btn bg-lot lowMarginBtm" >Go details</a>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card" id="detailsMatch">
                    <div class="card-header cardTittle text-center">
                        <h4 class="">Details</h4>
                    </div>
                    <div class="card-body text-center" id="">
                        <div class="row lowMarginBtm">
                            <div class="col-lg-5 col-6">
                                <h3 class="text-primary lowMarginBtm">matalords</h3>
                                <table class="table table-hover lowMarginBtm">
                                    <tbody>
                                    <tr>
                                        <td>payer1</td>
                                        <td>1.2</td>
                                    </tr>
                                    <tr>
                                        <td>payer2</td>
                                        <td>2.9</td>
                                    </tr>
                                    <tr>
                                        <td>payer3</td>
                                        <td>3.5</td>
                                    </tr>
                                    <tr>
                                        <td>payer4</td>
                                        <td>2.9</td>
                                    </tr>
                                    <tr>
                                        <td>payer5</td>
                                        <td>3.5</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h4>total: 12.5</h4>
                            </div>
                            <div class="col-lg-5 col-6 offset-lg-2">
                                <h3 class="text-danger lowMarginBtm">asis</h3>
                                <table class="table table-hover lowMarginBtm">
                                    <tbody>
                                    <tr>
                                        <td>payer1</td>
                                        <td>1.2</td>
                                    </tr>
                                    <tr>
                                        <td>payer2</td>
                                        <td>2.9</td>
                                    </tr>
                                    <tr>
                                        <td>payer3</td>
                                        <td>3.5</td>
                                    </tr>
                                    <tr>
                                        <td>payer4</td>
                                        <td>2.9</td>
                                    </tr>
                                    <tr>
                                        <td>payer5</td>
                                        <td>3.5</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h4>total: 12.5</h4>
                            </div>
                        </div>
                        <h3>Winner: matalords</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

include_once('templates/footer.template.php');

?>
