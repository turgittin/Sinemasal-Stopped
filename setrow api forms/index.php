<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="tr" lang="tr" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>sinemasal.org</title>
        <link rel="stylesheet" type="text/css" href="style/style.css" media="all"/>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.maskEdit.js"></script>

        <script type="text/javascript">
            function box_isEmpty(box_id, message) {
                var box = document.getElementById(box_id);
                if (trim(box.value) == '') {
                    alert(message);
                    box.focus();
                    return true;
                }

                return false;
            }//end function box_isEmpty();

            function box_isEmail(box_id, message) {
                var box = document.getElementById(box_id);

                if (!isValidEmail(box.value)) {
                    alert(message);
                    box.focus();
                    return false;
                }

                if (box.value == 'E-mail adresiniz') {
                    alert(message);
                    box.focus();
                    return false;
                }

                return true;

            }

            function isValidEmail(emailAdayi) {

                var reg_email = /^[a-zA-Z0-9]+[_a-zA-Z0-9-]*(\.[_a-z0-9-]+)*@.+\..+$/;

                if (emailAdayi.value == '') {
                    return false;
                }

                if (!reg_email.test(emailAdayi)) {
                    return false;
                }

                if (emailAdayi.charAt(emailAdayi.length - 1) == '.') {
                    return false;
                }

                return true;
            }//

            function submitForm() {

                 document.getElementById('email').focus();

                if (!document.getElementById('c_kadin').checked && !document.getElementById('c_erkek').checked) {
                    alert('Lütffen, cinsiyetinizi seçiz.');
                    return false;
                }

                if (!box_isEmail('email', 'Lütfen, geçerli bir e-mail adresi giriniz')) {
                    return false;
                }
				if(document.getElementById('il').value == "-1"){
					alert("Lütfen il seçiniz");
					 return false;
				}
                else {
                    return true;
                }
            }


            function trim(str, chars) {
                return ltrim(rtrim(str, chars), chars);
            }

            function ltrim(str, chars) {
                chars = chars || "\\s";
                return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
            }

            function rtrim(str, chars) {
                chars = chars || "\\s";
                return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
            }

        </script>

    </head>
    <body style="background: transparent !important">

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
            $cinsiyet = htmlspecialchars($_POST['cinsiyet']);
			$il = htmlspecialchars($_POST['il']);
 
 

            $link_ekle = 'http://www2.setrow.com/m/system/api/adresislemleri/api.php?k=5lJ71AfQK9CKMieCzgrhRCSeJY2QQdNMonKfNQYnPpZrz2UU8c&i=adres_ekle&t=1&grupid=14760&adres=' . $email . '&isim=&cinsiyet='.$cinsiyet.'&dtarihi=&oalan1=&oalan2=&oalan3=&medenihali=&sehir='.$il.'&meslek=&ceptel=&sabittel=&adresbilgisi=&evliliktarihi=';
			///'http://www2.setrow.com/m/system/api/adresislemleri/api.php?k=5lJ71AfQK9CKMieCzgrhRCSeJY2QQdNMonKfNQYnPpZrz2UU8c&i=adres_ekle&t=1&grupid=14760&adres=' . $email . '&isim=&cinsiyet='.$cinsiyet.'&dtarihi=&oalan1=newsletter&oalan2=&oalan3=&medenihali=&sehir=&meslek=&ceptel=&sabittel=&adresbilgisi=&evliliktarihi=';
 
            $response = post_to_url($link_ekle);

            $sonuc = strpos($response, '3');
            $sonuc2 = strpos($response, '2');
 
            if ($sonuc || $sonuc2) {

                $link_guncelle = 'http://www2.setrow.com/m/system/api/adresislemleri/api.php?k=5lJ71AfQK9CKMieCzgrhRCSeJY2QQdNMonKfNQYnPpZrz2UU8c&i=adres_guncelle&t=1&grupid=14760&adres=' . $email . '&isim=&cinsiyet='.$cinsiyet.'&dtarihi=&oalan1=newsletter&oalan2=&oalan3=&medenihali=&sehir='.$il.'&meslek=&ceptel=&sabittel=&adresbilgisi=&evliliktarihi=';
                $response = post_to_url($link_guncelle);

                setcookie("landing_display_status", "1");
            }
		 
            ?>



            <div class="newsletter_form-new basarili">
                <h2>&nbsp;</h2>

                <form onsubmit="return submitForm();" method="post">


                    <div class="gender_block">
                        <div style="padding-left:10px" class="">

                        </div>
					<div class="clear"></div>
                    </div>
 
                </form>

  </div>


                <?php
            } else {
                ?>


                <div class="newsletter_form-new">
                    <h2>&nbsp;</h2>

                    <form onsubmit="return submitForm();" method="post">


                        <div class="gender_block">
                            <div style="padding-left: 140px;padding-top: 15px;" class="">
                                <label><input type="radio" name="cinsiyet" id="c_kadin" value="k"/>Kadın</label>
                                <label><input type="radio" name="cinsiyet" id="c_erkek" value="e"/>Erkek</label>
								
								<select id="il" name="il" style="padding:0px;width:100px; height:18px; margin-left: 10px;">
								<option value="-1">İl Seçiniz</option>
								<option value="Adana" title="Adana">Adana</option>
								<option value="Adıyaman" title="Adıyaman">Adıyaman</option>
								<option value="Afyon" title="Afyon">Afyon</option>
								<option value="Ağrı" title="Ağrı">Ağrı</option>
								<option value="Amasya" title="Amasya">Amasya</option>
								<option value="Ankara" title="Ankara">Ankara</option>
								<option value="Antalya" title="Antalya">Antalya</option>
								<option value="Artvin" title="Artvin">Artvin</option>
								<option value="Ardahan" title="Ardahan">Ardahan</option>
								<option value="Aksaray" title="Aksaray">Aksaray</option>
								<option value="Aydın" title="Aydın">Aydın</option>
								<option value="Bartın" title="Bartın">Bartın</option>
								<option value="Balıkesir" title="Balıkesir">Balıkesir</option>
								<option value="Batman" title="Batman">Batman</option>
								<option value="Bayburt" title="Bayburt">Bayburt</option>
								<option value="Bilecik" title="Bilecik">Bilecik</option>
								<option value="Bingöl" title="Bingöl">Bingöl</option>
								<option value="Bitlis" title="Bitlis">Bitlis</option>
								<option value="Bolu" title="Bolu">Bolu</option>
								<option value="Burdur" title="Burdur">Burdur</option>
								<option value="Bursa" title="Bursa">Bursa</option>
								<option value="Çanakkale" title="Çanakkale">Çanakkale</option>
								<option value="Çankırı" title="Çankırı">Çankırı</option>
								<option value="Çorum" title="Çorum">Çorum</option>
								<option value="Denizli" title="Denizli">Denizli</option>
								<option value="Diyarbakır" title="Diyarbakır">Diyarbakır</option>
								<option value="Düzce" title="Düzce">Düzce</option>
								<option value="Edirne" title="Edirne">Edirne</option>
								<option value="Elazığ" title="Elazığ">Elazığ</option>
								<option value="Erzincan" title="Erzincan">Erzincan</option>
								<option value="Erzurum" title="Erzurum">Erzurum</option>
								<option value="Eskişehir" title="Eskişehir">Eskişehir</option>
								<option value="Gaziantep" title="Gaziantep">Gaziantep</option>
								<option value="Giresun" title="Giresun">Giresun</option>
								<option value="Gümüşhane" title="Gümüşhane">Gümüşhane</option>
								<option value="Hakkari" title="Hakkari">Hakkari</option>
								<option value="Hatay" title="Hatay">Hatay</option>
								<option value="Isparta" title="Isparta">Isparta</option>
								<option value="Mersin" title="Mersin">Mersin</option>
								<option value="Iğdır" title="Iğdır">Iğdır</option>
								<option value="İstanbul" title="İstanbul">İstanbul</option>
								<option value="İzmir" title="İzmir">İzmir</option>
								<option value="Karaman" title="Karaman">Karaman</option>
								<option value="Kars" title="Kars">Kars</option>
								<option value="Karabük" title="Karabük">Karabük</option>
								<option value="Kastamonu" title="Kastamonu">Kastamonu</option>
								<option value="Kayseri" title="Kayseri">Kayseri</option>
								<option value="Kırklareli" title="Kırklareli">Kırklareli</option>
								<option value="Kırıkkale" title="Kırıkkale">Kırıkkale</option>
								<option value="Kırşehir" title="Kırşehir">Kırşehir</option>
								<option value="Kilis" title="Kilis">Kilis</option>
								<option value="Kocaeli" title="Kocaeli">Kocaeli</option>
								<option value="Konya" title="Konya">Konya</option>
								<option value="Kütahya" title="Kütahya">Kütahya</option>
								<option value="Malatya" title="Malatya">Malatya</option>
								<option value="Manisa" title="Manisa">Manisa</option>
								<option value="Kahramanmaraş" title="Kahramanmaraş">Kahramanmaraş</option>
								<option value="Mardin" title="Mardin">Mardin</option>
								<option value="Muğla" title="Muğla">Muğla</option>
								<option value="Muş" title="Muş">Muş</option>
								<option value="Nevşehir" title="Nevşehir">Nevşehir</option>
								<option value="Niğde" title="Niğde">Niğde</option>
								<option value="Ordu" title="Ordu">Ordu</option>
								<option value="Osmaniye" title="Osmaniye">Osmaniye</option>
								<option value="Rize" title="Rize">Rize</option>
								<option value="Sakarya" title="Sakarya">Sakarya</option>
								<option value="Samsun" title="Samsun">Samsun</option>
								<option value="Şırnak" title="Şırnak">Şırnak</option>
								<option value="Siirt" title="Siirt">Siirt</option>
								<option value="Sinop" title="Sinop">Sinop</option>
								<option value="Sivas" title="Sivas">Sivas</option>
								<option value="Tekirdağ" title="Tekirdağ">Tekirdağ</option>
								<option value="Tokat" title="Tokat">Tokat</option>
								<option value="Trabzon" title="Trabzon">Trabzon</option>
								<option value="Tunceli" title="Tunceli">Tunceli</option>
								<option value="Şanlıurfa" title="Şanlıurfa">Şanlıurfa</option>
								<option value="Uşak" title="Uşak">Uşak</option>
								<option value="Van" title="Van">Van</option>
								<option value="Yalova" title="Yalova">Yalova</option>
								<option value="Yozgat" title="Yozgat">Yozgat</option>
								<option value="Zonguldak" title="Zonguldak">Zonguldak</option>								
								</select>
                            </div>

                            <div class="input_box">
                                <input style="padding:10px" class="input-text"
                                       type="text"
                                       name="email" id="email" placeholder="Lütfen email adresini giriniz" /><input type="hidden" name="islem" value="kaydet"/>
                                <input class="hidden-button" type="submit" value=" "/>
                            </div>

                            <div class="clear"></div>
                        </div>
 
                    </form>
                      </div>
                <?php } ?>
          
    </body>
</html>