<?php
  # POBIERANIE SERCA STRONY !
  include("_assest/php/main.php");
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $config['title'].'@ BARTOZ SMS SHOP'; ?></title> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://bootswatch.com/yeti/bootstrap.css">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://bootswatch.com/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="http://bootswatch.com/assets/js/bootswatch.js"></script> 

    <link rel="stylesheet" href="_assest/css/style.css">
  </head>

    <body>
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php"><?php echo $config['nazwa'].'@ BARTOZ SMS SHOP'; ?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" style="margin-right:0px;">
              <li class="active"><a href="index.php">STRONA GŁÓWNA <span class="sr-only">(current)</span></a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="Cb"></div>

        <div class="container">
        <?php

          $Web->buy(@$_POST['id'], @$_POST['nick'], @$_POST['code'], @$_POST['number'], @$_POST['cmd']);

          $id = '1';
          foreach($item as $i){
          echo'
            <div class="col-md-3">
              <div class="panel panel-default">
                <div class="panel-body">
                  <span class="label label-success">['.$i['id'].'] '.$i['name'].'</span>
                  <br>
                  <img src="'.$i['img'].'" class="img-rounded" width="100px" height="auto" style="margin-top:30px; margin-left:60px; margin-bottom:10px;">
                  <br>
                  <a type="button" data-toggle="modal" data-target="#item'.$id.'" class="btn btn-info">KUPUJE ('.$i['price'].' ZŁ)</a>
                </div>
              </div>
            </div>
            ';

          echo'
          <div class="modal fade" id="item'.$i['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                USŁUGA: '.$i['name'].'
              </div>
              <div class="modal-body" style="text-align:center;">
                <Br>
                <div class="well well-sm" style="text-align:center; height:150px;"><img src="'.$i['img'].'" width="150"></div>
                <br>
                '.$i['opis'].'
              </div>
              <div class="modal-footer" style="text-align:center;">
                ABY ZAKUPIĆ USŁUGĘ NALEŻY WYSŁAŚ SMS NA NUMER: <b>'.$i['number'].'</b><br>
                WPISUJĄC W TREŚCI: <b>'.$config['sms_tresc'].'</b><br>
                KOSZ TEJ USŁUGI TO: <b>'.$i['price'].'ZŁ </b> + VAT<br> 
              </div>
                <form method="POST">
                  <div class="modal-footer" style="text-align:center;margin-left:141px;">
                    <div class="form-group has-success" style="width:300px; ">
                      <input type="text" name="nick" class="form-control" placeholder="Wpisz nazwe użytkownika na serwerze."><br>
                      <input type="text" name="code" class="form-control" placeholder="Wpisz kod zwrotny"><br>
                      <input type="text" name="id" style="display:none;" value="'.$i['id'].'"><br>
                       <input type="text" name="number" style="display:none;" value="'.$i['number'].'"><br>
                        <input type="text" name="cmd" style="display:none;" value="'.$i['cmd'].'"><br>
                    </div>
                  </div>
                  <div class="modal-footer" style="margin-right:141px;">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">NIE KUPUJE</button>
                    <button type="submit" name="kup" class="btn btn-primary btn-xs"> <i class="fa fa-opencart"></i> KUPUJE</button>
                  </div>
                  <div class="modal-footer">
                    Płatności zapewnia firma <a href="http://microsms.pl/">MicroSMS</a>. <br/>
                    Korzystanie z serwisu jest jednozanczne z akceptacją <a href="http://microsms.pl/partner/documents/">regulaminów</a>.<br/>
                    Jeśli nie dostałeś kodu zwrotnego w ciągu 30 minut skorzystaj z <a href="http://microsms.pl/customer/complaint/">formularza reklamacyjnego</a><br/><br/>
                  </div>
                </form>
              </div>
            </div>
          </div>
          ';
          $id++;
          }
          ?>
        </div>
        <div class="col-md-12">
         <div class="well">
            Wszelkie Prawa Zastrzeżone ! - Free License
            <span class="pull-right">
              AUTOR: <a href="http://www.mpcforum.pl/user/1001275-endox/"><button type="button" class="btn btn-xs btn-primary">BARTOZ</button></a>
            </span>
         </div>
        </div>
    </body>

    <!-- SKRYPTY JS -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('[data-toggle=tooltip]').tooltip();
      }); 
    </script>
<html>
