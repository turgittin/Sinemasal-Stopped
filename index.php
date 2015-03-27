 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>SineMASAL</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/ionicons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <?php
$resimler = array(
    "./assets/img/header.jpg",
    "./assets/img/header-1.jpg");
    $dk = date("i");
    $img = $resimler[$dk%count($resimler)];
?>
  <style type="text/css">
  .h {
    background: url("<?= $img ?>") no-repeat center top;
    padding-top: 180px;
    text-align:center;
    background-attachment: relative;
    background-position: center center;
    /*min-height: 700px;*/
    width: 100%;
    height: 100%;
    color: white;
    
      -webkit-background-size: 100%;
      -moz-background-size: 100%;
      -o-background-size: 100%;
      background-size: 100%;

      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
  }
  </style>

  <body>


  <script type="text/javascript">
function pencereAc_400(url){
window.open(url,'video','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400px,height=200px');
}function dataSend(){
var link = 'http://www.setrow.com/system/kisiekle.php?lang=Tr&a='+document.getElementById("adi").value+'&m='+document.getElementById("mailadres").value+'&gid='+document.getElementById("grupid").value+'&mk='+document.getElementById("mkodu").value;
pencereAc_400(link);
}</script><span class="baslik3">Haber listemize kaydolarak tüm yeniliklerden haberdar olabilirsiniz.</span>
<input style="border: 1px solid #A3A3A3;width: 120px;font-size: 8pt;color: #A3A3A3;" id="adi" name="adi" type="text" onblur="javascript:if(this.value == '') this.value = 'Adım Soyadım';" onfocus="javascript:if(this.value == 'Adım Soyadım') this.value = '';" value="Adım Soyadım"  />
<input style="border: 1px solid #A3A3A3;width: 120px;font-size: 8pt;color: #A3A3A3;" id="mailadres" name="mailadres" type="text"  onblur="javascript:if(this.value == '') this.value = 'E-Posta Adresim';" onfocus="javascript:if(this.value == 'E-Posta Adresim') this.value = '';" value="E-Posta Adresim"  />
<input id="grupid" name="grupid" type="hidden" value="14760" size="5" />
<input id="mkodu" name="mkodu" type="hidden" value="688" size="5" />
<input style="border: 1px solid #A3947D;width: 50px;font-size: 8pt;margin-left: 5px;" name="gonder" type="button" value="Ekle" onclick="javascript:dataSend();" />

        <?php
        if (isset($_POST['islem']) && $_POST['islem'] == 'kaydet' && isset($_POST['email'])) {
         
            function post_to_url($url) {

                $post = curl_init();

                curl_setopt($post, CURLOPT_URL, $url);
                curl_setopt($post, CURLOPT_POST, '');
                curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

                $result = curl_exec($post);

                return $result;

                curl_close($post);
            }

            $email = htmlspecialchars($_POST['email']);
 
 

            $link_ekle = 'http://www2.setrow.com/m/system/api/adresislemleri/api.php?k=5lJ71AfQK9CKMieCzgrhRCSeJY2QQdNMonKfNQYnPpZrz2UU8c&i=adres_ekle&t=1&grupid=14760&adres='.$email.'&isim=&cinsiyet=&dtarihi=&oalan1=&oalan2=&oalan3=&medenihali=&sehir=&meslek=&ceptel=&sabittel=&adresbilgisi=&evliliktarihi=&oalan4=&oalan5=&oalan6=&oalan7=&oalan8=&oalan9=&oalan10=&oalan11=&oalan12=&oalan13=&oalan14=&oalan15=';
      ///'http://www2.setrow.com/m/system/api/adresislemleri/api.php?k=5lJ71AfQK9CKMieCzgrhRCSeJY2QQdNMonKfNQYnPpZrz2UU8c&i=adres_ekle&t=1&grupid=14760&adres=' . $email . '&isim=&cinsiyet='.$cinsiyet.'&dtarihi=&oalan1=newsletter&oalan2=&oalan3=&medenihali=&sehir=&meslek=&ceptel=&sabittel=&adresbilgisi=&evliliktarihi=';
 var_dump($email);
            $response = post_to_url($link_ekle);

            $sonuc = strpos($response, '3');
            $sonuc2 = strpos($response, '2');
 
            if ($sonuc || $sonuc2) {

                $link_guncelle = 'http://www2.setrow.com/m/system/api/adresislemleri/api.php?k=5lJ71AfQK9CKMieCzgrhRCSeJY2QQdNMonKfNQYnPpZrz2UU8c&i=adres_guncelle&t=1&grupid=14760&adres=' . $email . '&isim=&cinsiyet='.$cinsiyet.'&dtarihi=&oalan1=newsletter&oalan2=&oalan3=&medenihali=&sehir='.$il.'&meslek=&ceptel=&sabittel=&adresbilgisi=&evliliktarihi=';
                $response = post_to_url($link_guncelle);

                setcookie("landing_display_status", "1");
            }
     }
            ?>

    <div class="h">
      <div class="logo"></div>

      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 centered">
            <h1>18 Nisan 2015 <a href="http://www.tedxreset.com" target="_blank">TEDxReset</a> sunumumuzun ardından yenilenen yüzümüzle sizlerleyiz!</h1>
            <h3>Açılışımızı hatırlatabilmemiz için mail adresinizi bırakabilirsiniz.</h3>
            <div class="mtb">
              <form role="form" action="index.php" method="post" enctype="plain"> 
                <input type="email" name="email" class="subscribe-input" placeholder="E-posta adresinizi giriniz..." required="">
                <button class='btn btn-conf btn-green' style="color:#000;" type="submit">gönder</button>
              </form>
            </div><!--/mt-->
          </div>
        </div><!--/row-->
      </div><!--/container-->
    </div><!-- /H -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/retina-1.1.0.js"></script>


  </body>
</html>
