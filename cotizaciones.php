<?php
require_once("aplication_top.php");
$title_header_page = _TITLE_RESERVAS;
$description_header_page = _TITLE_DESCRIPTION_RESERVAS;
$keyword_header_page = _TITLE_KEYWORD_RESERVAS;
include("header.php");
?>



<!--  Calendar  -->
<script type='text/javascript' src='adapter/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="adapter/calendar_picker/calendar.js" charset="iso-8859-1"></script>
<script type="text/javascript" src="adapter/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="adapter/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="adapter/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<link rel="stylesheet" href="<?php echo _URL ?>css/contactenos.css" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo _URL ?>js/jform_reservas.js"></script>

<script>
    function new_captcha() {
        var c_currentTime = new Date();
        var c_miliseconds = c_currentTime.getTime();
        document.getElementById('captcha').src = 'captcha.php?x=' + c_miliseconds;
    }
</script>

<?php
$IdPaq = (int)$_GET['idpaq'];

$SQL = "SELECT fk_paquete,txt_title FROM tbl_paquete_details WHERE fk_paquete = '$IdPaq'";
$QueryPaq = $GLOBALS['CONNECT_DB']->Query($SQL) or die(mysql_error());
$TypePkg = "";
while ($FetchPaq = $GLOBALS['CONNECT_DB']->Fetch($QueryPaq)) {
    $cls_paq_form = new cls_tbl_paquete($FetchPaq['fk_paquete']);
    $TypePkg = utf8_decode($FetchPaq['txt_title']);
}
?>


<div id="content">
    <div class="wrapper2">
        <div id="left">
            <div class="wrapper2">
                <div class="extra-indent">


                    <?php include("body-left.php"); ?>


                    <div class="module_none">
                        <div class="boxIndent">
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="container">
            <div class="moduletable_Breadcrumbs">
                <div class="breadcrumbs_Breadcrumbs">
                    <a href="<?php echo _URL ?>index.php" class="pathway">Inicio</a> &gt;
                    <a href="<?php echo _URL ?>reservas.php" class="pathway">Reservas</a>
                </div>

            </div>

            <div class="content-indent">
                <div class="cart-view">
                    <h3 style="background-color: #F90197;"><span><span>SOLICITAR INFORMACION SOBRE EL PAQUETE TURISTICO</span></span></h3>


                    <div class="login-box">
                        <form method="post" id="FormRegister" name="FormRegister">
                            <p style="text-align:justify;">Agradeceremos completar el formulario, indicando la cantidad de personas a viajar, fechas de viaje y requerimientos especiales. Uno de nuestros representantes se pondra en contacto con usted a la brevedad posible para brindarle mayor información acerca de su solicitud.</p>

                            <div class="width70 floatleft">
                                <a href="#">
                                    Destino Solicitado:</a>
                            </div>

                            <div class="clear"></div>
                            <div class="width100">
                                <div class="clear"></div>
                                <p class="floatleft width70" id="com-form-login-username">
                                    <?php print $TypePkg; ?>
                                </p>
                            </div>
                            <div class="clear"></div>

                            <div class="width38 floatleft">
                                <a href="#">
                                    Registros Obligatorios (*):</a>
                            </div>

                            <div class="clear"></div>

                            <div class="width100">
                                <div class="clear"></div>

                                <p class="floatleft width38" id="com-form-login-username">
                                    <a href="#">(*)</a> Nombre(s): <input type="text" name="txt_nombres" id="txt_nombres" class="inputbox" size="18" title="Ingrese su nombre" />
                                </p>

                                <p class="floatleft width38" id="com-form-login-password">
                                    <a href="#">(*)</a> Apellidos: <input id="txt_apellidos" type="text" name="txt_apellidos" class="inputbox" size="18" title="Ingrese su apellido" />
                                </p>

                                <p class="floatleft width38" id="com-form-login-username">
                                    <a href="#">(*)</a> Email (minuscula): <input type="text" name="txt_email" id="txt_email" class="inputbox" size="18" title="Ingrese su correo" />
                                </p>

                                <p class="floatleft width38" id="com-form-login-password">
                                    <a href="#">(*)</a> Telefono: <input id="txt_telefono" type="text" name="txt_telefono" class="inputbox" size="18" title="Ingrese su numero de telefono" />
                                </p>

                                <p class="floatleft width38" id="com-form-login-username">
                                    Celular: <input type="text" name="txt_celular" id="txt_celular" class="inputbox" size="18" title="Ingrese su numoer de celular" />
                                </p>

                                <p class="floatleft width38" id="com-form-login-password">
                                    Ciudad de Procedencia: <input id="txt_ciudad" type="text" name="txt_ciudad" class="inputbox" size="18" title="Ingrese su ciudad" />
                                </p>


                                <p class="floatleft width38" id="com-form-login-username">
                                    <label><a href="#">(*)</a> Pais de Procedencia: </label>
                                    <select class="inputbox" name="sle_pais" style="height:25px;">
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru" selected="selected">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>

                                    </select>
                                </p>


                            </div>
                            <div class="clear"></div>


                            <div class="width70 floatleft">
                                <a href="#">
                                    Datos del Viaje: (click en el icono de calendario)</a>
                            </div>

                            <div class="clear"></div>

                            <div class="width100">
                                <div class="clear"></div>

                                <p class="floatleft width38" id="com-form-login-username">
                                    <a href="#">(*)</a> Fecha de Salida (formato: dd-mm-aaaa): <input type="text" name="txt_fecha_salida" id="txt_fecha_salida" class="inputbox" size="10" title="Ingrese la Fecha de Viaje" />
                                    <img title="Calendario | click aqui" src="adapter/calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" align="right" style="margin:0; padding:0; float:left;" />
                                </p>

                                <p class="floatleft width38" id="com-form-login-username">
                                    Fecha de Retorno (formato: dd-mm-aaaa): <input type="text" name="txt_fecha_retorno" id="txt_fecha_retorno" class="inputbox" size="10" title="Ingrese la Fecha de Retorno" />
                                    <img title="Calendario | click aqui" src="adapter/calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar02" align="right" style="margin:0; padding:0; float:left;" />
                                </p>
                                <p class="floatleft width38" id="com-form-login-username">
                                    <a href="#">(*)</a> N° de Adultos: <input type="text" name="txt_cantidad_adultos" id="txt_cantidad_adultos" class="inputbox" size="18" title="Ingrese la cantidad" />
                                </p>

                                <p class="floatleft width38" id="com-form-login-password">
                                    N° de Niños: <input id="txt_cantidad_ninos" type="text" name="txt_cantidad_ninos" class="inputbox" size="18" title="Cantidad de Niños" />
                                </p>

                                <p class="floatleft width38" id="com-form-login-password">
                                    Hotel (opcional): <input id="txt_hoteles" type="text" name="txt_hoteles" class="inputbox" size="18" alt="Password" />
                                </p>



                            </div>

                            <div class="clear"></div>

                            <div class="width100" style="visibility:hidden;">
                                <div class="clear"></div>
                                <p class="floatleft width38" id="com-form-login-password">
                                    <a href="#">(*)</a> Destino:
                                    <select name="sle_destino" id="sle_destino" class="inputbox" title="ingrese el destino" style="height:25px; line-height:25px; font-size:10px;">
                                        <option value="0">Seleccione el destino</option>
                                        <?php
                                        $SQL = "SELECT fk_paquete,txt_title FROM tbl_paquete_details ORDER BY txt_title ASC";
                                        $QueryPaq = $GLOBALS['CONNECT_DB']->Query($SQL) or die(mysql_error());
                                        $TypePkg = "";
                                        while ($FetchPaq = $GLOBALS['CONNECT_DB']->Fetch($QueryPaq)) {
                                            $cls_paq_form = new cls_tbl_paquete($FetchPaq['fk_paquete']);
                                            $TypePkg = utf8_decode($FetchPaq['txt_title']);

                                            echo "<option value=\"{$FetchPaq['fk_paquete']}\" ";
                                            if ($IdPaq > 0 && $IdPaq == $FetchPaq['fk_paquete']) echo "selected";
                                            echo ">" . $TypePkg . "</option>";
                                        }
                                        ?>
                                    </select>
                                </p>
                            </div>
                            <div class="clear"></div>
                            <div class="customer-comment marginbottom15">
                                <span class="comment"><a href="#">(*)</a> Codigo de Seguridad:</span><br />
                                <table>
                                    <tr>
                                        <td style="vertical-align:middle;"><img src="captcha.php" id="captcha" onclick="javascript:new_captcha();" style="cursor:pointer;margin:0 0 4px 0;" width="140" height="50" /><br /></td>
                                        <td style="font-size: 11px; font-family: Arial,Helvetica,sans-serif; padding-left: 5px; vertical-align: middle; text-align: justify;width:200px; line-height:150%; color:#000;">Ingrese el c&oacute;digo de imagen que se muestra, si desea generar un nuevo c&oacute;digo haga click en la misma imagen: </td>
                                    </tr>
                                </table>
                                <p class="floatleft width38" id="com-form-login-username">
                                    <a href="#">(*)</a> Digite el codigo de seguridad:
                                    <input type="text" value="" id="get_captcha" name="get_captcha" class="inputbox" size="18" title="Digite el codigo de seguridad" style="border:1px solid #000;" />
                                </p>
                            </div>

                            <div class="clr"></div>

                            <div class="customer-comment marginbottom15">
                                <span class="comment"><a href="#">(*)</a> Consultas sobre el Paquete Turisticos &oacute; Tours:</span><br />
                                <textarea class="customer-comment" name="txt_mensaje" id="txt_mensaje" cols="60" rows="1"></textarea>
                            </div>

                            <div class="clr"></div>

                            <div class="width100" id="com-form-login-remember">
                                <div class="width38 floatleft">
                                    <input type="submit" id="btn_submit" name="btn_submit" class="button" value="Enviar Ahora" />
                                </div>




                                <div class="width38 floatleft remember">
                                    <label style="float:left;" for="remember">Enviarme Promociones a mi correo</label>
                                    <input type="checkbox" id="remember" name="remember" class="inputbox" value="yes" alt="Remember Me" />
                                </div>

                            </div>

                            <div class="width100" id="com-form-login-remember">
                                <p class="text"><img id="ImgLoadingContact" src="images/ajax-loader.gif" alt="Procesando.." style=" background:none; float:left; width:auto; position:absolute; margin-left:5px; margin-top:20px; margin-bottom:15px;" /></p>

                                <p class="text">
                                    <label for="message"></label>
                                <div align="center" id="message_form" class="error_"></div>
                                </p>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

</div>
<div class="clear"></div>

<script type="text/javascript">
    /*  CALENDAR  */
    var cal = new Zapatec.Calendar.setup({

        inputField: "txt_fecha_salida", // id of the input field
        ifFormat: "%d-%m-%Y", // format of the input field
        button: "icon_calendar", // trigger button (well, IMG in our case)
        showsTime: false

    });


    dtCh = '-';
</script>

<script type="text/javascript">
    /*  CALENDAR  */
    var cal = new Zapatec.Calendar.setup({

        inputField: "txt_fecha_retorno", // id of the input field
        ifFormat: "%d-%m-%Y", // format of the input field
        button: "icon_calendar02", // trigger button (well, IMG in our case)
        showsTime: false

    });


    dtCh = '-';
</script>

<?php
include("footer.php");
?>