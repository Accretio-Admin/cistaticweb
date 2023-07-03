<!-- // Password Requirement Plugin -->
<link href="<?php echo BASE_URL()?>assets/css/jquery.passwordRequirements.css" rel="stylesheet" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="<?php echo BASE_URL()?>assets/js/jquery.passwordRequirements.min.js"></script>
<script>
    $(document).ready(function() {
        $("form").bind("keypress", function(e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    });
</script>
<body class="login-body">
    <div class="contentpanel">
        <?php if (is_null($process)): ?>
        <form id="RetailerReg" name="RetailerReg">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3  well" style="margin-top: 1%;" id="RegProcess1">
                <div class='divAlert' id="divAlerts"></div>
                <?php if ($result['S'] === 0 || $result['S'] === '0' ): ?>
                    <div class="alert alert-danger"><?php echo $result['M'] ?></div>
                <?php elseif ($result['S'] === 1 || $result['S'] === '1' ): ?>
                    <div class="alert alert-success"><?php echo $result['M'] ?></div>
                <?php endif ?>
                <!-- <div class="form-group">
                    <a class="btn btn-default well" style="width: 150px; border: none; margin: 0px;" href="<?php echo base_url()?>Login/"><span class="glyphicon glyphicon-lock"></span>&nbsp;Back To Login</a>
                </div> -->
                <div class="form-group">
                    <div class="input-group">
                        <p>Please confirm your Login Credentials</p>
                        <h3>FREE REGISTRATION</h3>
                    </div>
                </div>
                
                <div class="form-group">
                    <span>REFERRAL CODE:</span>
                    <input type="text" class="form-control" name="referralCode" id="referralCode" value="<?php echo $referralCode; ?>" disabled required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="inputUsername" id="inputUsername" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="inputPassword" id="pass1" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="inputCP" id="pass2" placeholder="Confirm Password" onkeyup="checkPassRetailer(); checkMatchRetailer();" required>
                    <span id="confirmMessage" class="confirmMessage"></span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="inputLN" id="inputLN" placeholder="Last Name" required>
                </div>
                <div class = "form-group">
                    <input type="text" class="form-control" name="inputFN" id="inputFN" placeholder="First Name" required>
                </div>
                <div class = "form-group">
                    <p class = "alert alert-info fade in" style = "margin: 0px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Note! </strong>Please put your suffix after your first name.<i>(Ex. John Jr.)</i></p>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="inputMD" id="inputMD" placeholder="Middle Name">
                </div>
                <div class="form-group"> 
                    <select id="countrynew" name="country" class="form-control"> 
                            <option value ="" class="Location" disabled selected>Please Select Mobile Number</option>
                            <option data-countryCode="PH" value="63">Philippines (+63)</option> 
                        <optgroup label="Other countries">
                            <option data-countryCode="US" value="1">USA (+1)</option>
                            <option data-countryCode="GB" value="44">UK (+44)</option>
                            <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                            <option data-countryCode="AD" value="376">Andorra (+376)</option>
                            <option data-countryCode="AO" value="244">Angola (+244)</option>
                            <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                            <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                            <option data-countryCode="AR" value="54">Argentina (+54)</option>
                            <option data-countryCode="AM" value="374">Armenia (+374)</option>
                            <option data-countryCode="AW" value="297">Aruba (+297)</option>
                            <option data-countryCode="AU" value="61">Australia (+61)</option>
                            <option data-countryCode="AT" value="43">Austria (+43)</option>
                            <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                            <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                            <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                            <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                            <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                            <option data-countryCode="BY" value="375">Belarus (+375)</option>
                            <option data-countryCode="BE" value="32">Belgium (+32)</option>
                            <option data-countryCode="BZ" value="501">Belize (+501)</option>
                            <option data-countryCode="BJ" value="229">Benin (+229)</option>
                            <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                            <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                            <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                            <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                            <option data-countryCode="BW" value="267">Botswana (+267)</option>
                            <option data-countryCode="BR" value="55">Brazil (+55)</option>
                            <option data-countryCode="BN" value="673">Brunei (+673)</option>
                            <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                            <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                            <option data-countryCode="BI" value="257">Burundi (+257)</option>
                            <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                            <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                            <option data-countryCode="CA" value="1">Canada (+1)</option>
                            <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                            <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                            <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                            <option data-countryCode="CL" value="56">Chile (+56)</option>
                            <option data-countryCode="CN" value="86">China (+86)</option>
                            <option data-countryCode="CO" value="57">Colombia (+57)</option>
                            <option data-countryCode="KM" value="269">Comoros (+269)</option>
                            <option data-countryCode="CG" value="242">Congo (+242)</option>
                            <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                            <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                            <option data-countryCode="HR" value="385">Croatia (+385)</option>
                            <option data-countryCode="CU" value="53">Cuba (+53)</option>
                            <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                            <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                            <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                            <option data-countryCode="DK" value="45">Denmark (+45)</option>
                            <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                            <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                            <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                            <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                            <option data-countryCode="EG" value="20">Egypt (+20)</option>
                            <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                            <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                            <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                            <option data-countryCode="EE" value="372">Estonia (+372)</option>
                            <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                            <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                            <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                            <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                            <option data-countryCode="FI" value="358">Finland (+358)</option>
                            <option data-countryCode="FR" value="33">France (+33)</option>
                            <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                            <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                            <option data-countryCode="GA" value="241">Gabon (+241)</option>
                            <option data-countryCode="GM" value="220">Gambia (+220)</option>
                            <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                            <option data-countryCode="DE" value="49">Germany (+49)</option>
                            <option data-countryCode="GH" value="233">Ghana (+233)</option>
                            <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                            <option data-countryCode="GR" value="30">Greece (+30)</option>
                            <option data-countryCode="GL" value="299">Greenland (+299)</option>
                            <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                            <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                            <option data-countryCode="GU" value="671">Guam (+671)</option>
                            <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                            <option data-countryCode="GN" value="224">Guinea (+224)</option>
                            <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                            <option data-countryCode="GY" value="592">Guyana (+592)</option>
                            <option data-countryCode="HT" value="509">Haiti (+509)</option>
                            <option data-countryCode="HN" value="504">Honduras (+504)</option>
                            <!-- <option data-countryCode="HK" value="852">Hong Kong (+852)</option> -->
                            <option data-countryCode="HU" value="36">Hungary (+36)</option>
                            <option data-countryCode="IS" value="354">Iceland (+354)</option>
                            <option data-countryCode="IN" value="91">India (+91)</option>
                            <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                            <option data-countryCode="IR" value="98">Iran (+98)</option>
                            <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                            <option data-countryCode="IE" value="353">Ireland (+353)</option>
                            <option data-countryCode="IL" value="972">Israel (+972)</option>
                            <option data-countryCode="IT" value="39">Italy (+39)</option>
                            <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                            <option data-countryCode="JP" value="81">Japan (+81)</option>
                            <option data-countryCode="JO" value="962">Jordan (+962)</option>
                            <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                            <option data-countryCode="KE" value="254">Kenya (+254)</option>
                            <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                            <option data-countryCode="KP" value="850">Korea North (+850)</option>
                            <option data-countryCode="KR" value="82">Korea South (+82)</option>
                            <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                            <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                            <option data-countryCode="LA" value="856">Laos (+856)</option>
                            <option data-countryCode="LV" value="371">Latvia (+371)</option>
                            <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                            <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                            <option data-countryCode="LR" value="231">Liberia (+231)</option>
                            <option data-countryCode="LY" value="218">Libya (+218)</option>
                            <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                            <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                            <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                            <option data-countryCode="MO" value="853">Macao (+853)</option>
                            <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                            <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                            <option data-countryCode="MW" value="265">Malawi (+265)</option>
                            <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                            <option data-countryCode="MV" value="960">Maldives (+960)</option>
                            <option data-countryCode="ML" value="223">Mali (+223)</option>
                            <option data-countryCode="MT" value="356">Malta (+356)</option>
                            <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                            <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                            <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                            <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                            <option data-countryCode="MX" value="52">Mexico (+52)</option>
                            <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                            <option data-countryCode="MD" value="373">Moldova (+373)</option>
                            <option data-countryCode="MC" value="377">Monaco (+377)</option>
                            <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                            <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                            <option data-countryCode="MA" value="212">Morocco (+212)</option>
                            <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                            <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                            <option data-countryCode="NA" value="264">Namibia (+264)</option>
                            <option data-countryCode="NR" value="674">Nauru (+674)</option>
                            <option data-countryCode="NP" value="977">Nepal (+977)</option>
                            <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                            <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                            <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                            <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                            <option data-countryCode="NE" value="227">Niger (+227)</option>
                            <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                            <option data-countryCode="NU" value="683">Niue (+683)</option>
                            <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                            <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                            <option data-countryCode="NO" value="47">Norway (+47)</option>
                            <option data-countryCode="OM" value="968">Oman (+968)</option>
                            <option data-countryCode="PW" value="680">Palau (+680)</option>
                            <option data-countryCode="PA" value="507">Panama (+507)</option>
                            <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                            <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                            <option data-countryCode="PE" value="51">Peru (+51)</option>
                            <option data-countryCode="PL" value="48">Poland (+48)</option>
                            <option data-countryCode="PT" value="351">Portugal (+351)</option>
                            <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                            <option data-countryCode="QA" value="974">Qatar (+974)</option>
                            <option data-countryCode="RE" value="262">Reunion (+262)</option>
                            <option data-countryCode="RO" value="40">Romania (+40)</option>
                            <option data-countryCode="RU" value="7">Russia (+7)</option>
                            <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                            <option data-countryCode="SM" value="378">San Marino (+378)</option>
                            <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                            <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                            <option data-countryCode="SN" value="221">Senegal (+221)</option>
                            <option data-countryCode="CS" value="381">Serbia (+381)</option>
                            <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                            <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                            <option data-countryCode="SG" value="65">Singapore (+65)</option>
                            <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                            <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                            <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                            <option data-countryCode="SO" value="252">Somalia (+252)</option>
                            <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                            <option data-countryCode="ES" value="34">Spain (+34)</option>
                            <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                            <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                            <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                            <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                            <option data-countryCode="SD" value="249">Sudan (+249)</option>
                            <option data-countryCode="SR" value="597">Suriname (+597)</option>
                            <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                            <option data-countryCode="SE" value="46">Sweden (+46)</option>
                            <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                            <option data-countryCode="SI" value="963">Syria (+963)</option>
                            <!-- <option data-countryCode="TW" value="886">Taiwan (+886)</option> -->
                            <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                            <option data-countryCode="TH" value="66">Thailand (+66)</option>
                            <option data-countryCode="TG" value="228">Togo (+228)</option>
                            <option data-countryCode="TO" value="676">Tonga (+676)</option>
                            <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                            <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                            <option data-countryCode="TR" value="90">Turkey (+90)</option>
                            <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                            <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                            <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                            <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                            <option data-countryCode="UG" value="256">Uganda (+256)</option>
                            <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                            <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                            <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                            <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                            <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                            <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                            <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                            <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                            <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                            <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                            <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                            <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                            <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                            <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                            <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                            <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                            <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <div class='row'>
                        <div class="col-xs-6 col-sm-7 col-md-7">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <input type="text" class="form-control" name="inputMobileNo" id="regMobile" placeholder="11-Digit Mobile Number" maxlength="10" tabindex="-1" required disabled>
                                    <button id="btnmobSend" class="btn btn-default" type="button"   tabindex="-1" style="height:50px;!important;">Send</button>
                                </span>
                            </div>
                            <small class="pleaseWait1" style="float:right;display:none;">Please Wait..</small>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1"></div>
                        <div class="col-xs-4 col-sm-3 col-md-3">
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <input type="text" class="form-control" name="inputPinmobile" style="padding-left: 2px;" id="inputPinmobile" placeholder="PIN" maxlength="6" required disabled>
                                        <button class="btn btn-default" type="button"  tabindex="-1" style="height:50px;!important;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                                    </span>
                                    <span id="MobPinloading" class="glyphicon glyphicon-refresh glyphicon-refresh-animate form-control-feedback" aria-hidden="true" ></span>
                                </div>
                            </div>
                            <small class="pleaseWait2" style="float:right;display:none;">Verifying..</small>	
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class='row'>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <input type="email" class="form-control" name="inputEmail"  id="inputEmail" placeholder="Email Address"  tabindex="-1"  required>
                                   
                                </span>
                            </div>
                            <small class="pleaseWait3" style="float:right;display:none;">Please Wait..</small>
                        </div>
                        <div class="col-xs-1 col-sm-1 col-md-1"></div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="inputTpass" id="tpass1" placeholder="Transaction Password" required disabled>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="inputCTpass" id="tpass2" placeholder="Confirm Transaction Password" onkeyup="checkTPassRetailer(); " required disabled>
                    <span id="confirmTMessage" class="confirmTMessage"></span>
                </div>
                <div id="infos" class="alert alert-info" style="display:none"></div>
                <div id="errors" class="alert alert-danger" style="display:none"></div>
                <div class="form-group">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                        <a href="<?php echo BASE_URL(); ?>Login/" class="btn btn-default pull-right"><i><u><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back</u></i></a>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <button type="submit" name="btnRetailerReg" id="btnRetailerReg" class="btn btn-primary" disabled>Confirm&nbsp;<span class="glyphicon glyphicon-share-alt" ></span></button>
                    </div>
                </div>
            </div>
        </form>
        <?php endif ?>
        <div class="col-md-3">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        </div>  
    </div>

    <div class="hidRegMobile" style="display:none" >
    		<form id="frmMobReg" method="post">
    				<input class="hiddenMob" type="text" name ="regMob" />
    				<button type="submit" id="btnMobReg" style="display:none"></button>
    		</form>

    </div>

    <div class="hidRegMobile" style="display:none" >
    		<form id="frmMobpinReg" method="post">
                    <input class="hiddenMobpin" type="text" name ="regMobpin_newr" />
    				<input class="hiddenMobs" type="text" name ="regMobforpin" />
    				<button type="submit" id="btnMobpinReg" style="display:none"></button>
    		</form>

    </div>

    
</body>

<script>
	$('#countrynew').on('change',function(){
		
		$("#regMobile").removeAttr('disabled');
		
	});

    function checkPassRetailer()
    {
        var pass1 = document.getElementById('pass1');
        var pass2 = document.getElementById('pass2');
        var message = document.getElementById('confirmMessage');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        if(pass1.value == pass2.value){
            pass2.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Password Match!"
        }else{
            pass2.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Password Do Not Match!"
        }
    } 
    
    function checkMatchRetailer()
    {  
        var message1 = document.getElementById('confirmMessage');
        var message2 = document.getElementById('confirmTMessage');
        var btn = document.getElementById('btnStep2');
        if(message1.innerHTML == message2.innerHTML){
            btn.style.display = 'block';
        }else{
            btn.style.display = 'none';
        }
    }

    function checkTPassRetailer()
    {
        var tpass1 = document.getElementById('tpass1');
        var tpass2 = document.getElementById('tpass2');
        var message = document.getElementById('confirmTMessage');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";
        if(tpass1.value == tpass2.value){
            tpass2.style.backgroundColor = goodColor;
            message.style.color = goodColor;
            message.innerHTML = "Transaction Password Match!"
            $("#btnRetailerReg").removeAttr("disabled");
        }else{
            tpass2.style.backgroundColor = badColor;
            message.style.color = badColor;
            message.innerHTML = "Transaction Password Do Not Match!"
            $("#btnRetailerReg").attr("disabled","disabled"); 
        }
    }

    $('#RetailerReg').submit((e) => {
        e.preventDefault();

        waitingDialog.show('Retailer Registration. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});

        var formdata = new FormData();
        formdata.append('username',$('#inputUsername').val());
        formdata.append('password',$('#pass2').val());
        formdata.append('mobile',$('#regMobile').val());
        formdata.append('email',$('#inputEmail').val());
        formdata.append('tpass',$('#tpass2').val());
        formdata.append('pmob',$('#inputPinmobile').val());
        formdata.append('pcountry',$('#countrynew').val());
        formdata.append('fname',$('#inputLN').val());
        formdata.append('lname',$('#inputFN').val());
        formdata.append('mname',$('#inputMD').val());
        formdata.append('referralCode',$('#referralCode').val());
        
        $.ajax({
            url: "Retailer/retailer_register",
            type: 'POST',
            data : formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                var retail = JSON.parse(data);
                if(retail['S'] == '1'){
                    validationSuccess(retail['M']);
                    waitingDialog.hide();

                    window.scroll({
                        top: 0, 
                        left: 0, 
                        behavior: 'smooth'
                    });

                    setTimeout(function () {
                        window.location.href = '../Login';
                    }, 1500);
                } else {
                    waitingDialog.hide();
                    validationFail(retail['M']);

                    window.scroll({
                        top: 0, 
                        left: 0, 
                        behavior: 'smooth'
                    });
                }

            }
        });
    });

    function validationFail (data) {
        $('.divAlert').html('<div class="alert alert-danger alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data+'</div>');
    }
    function validationSuccess (data) {
        $('.divAlert').html('<div class="alert alert-success alert-dismissible" role="alert">'+                
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+data+'</div>');
    }

    $("#frmMobReg").on('submit', function() {
            if($('#btnmobSend').data('timer') != 'START'){
                $("#Mobloading").css('display','block');
                $(".pleaseWait1").css('display','block');

                var data = $(this).serialize();
                $.ajax({   
                    type : 'POST',
                    url  : 'Retailer/check_mobile',
                    data : {regMob : 0 + data.replace('regMob=','')},
                    success :  function(data)
                    {  
                        
                        $("#Mobloading").css('display','none');
                        $(".pleaseWait1").css('display','none');
                        $("#infos").html("");
                        $("#errors").html("");
                        $("#errors").css('display','none');
                        $("#infos").css('display','none');
                        
                        var res = data.split('|'); 
                        // if (res[0] == 1 && $("#country").val() !== null) {
                            if (res[0] == 1 && $("#country").val() !== null) {
                            //OTP SENT SUCCESS
                            $("#inputPinmobile").prop('disabled',false);
                           
                            // $("#inputPinmobile").focus();
                            // $("#infos").css('display','block');
                            // $("#infos").html(res[1]); //MESSAGE FROM RESPONSE OF SP 
                            swal({
                                title: 'OTP Sent!',
                                text: "Please wait for the OTP on your number to proceed.",
                                icon: 'success',
                                buttons: false,
                            })
                            delayTimer()
                        } else if (res[0] && $("#regMobile").val().length == 0){
                            //IF EMPTY NUMBER FIELD
                            $("#infos").css('display','none'); 
                            // $("#errors").css('display','block');
                            // $("#errors").html(res[1]);
                            swal({
                                title: 'Error!',
                                text: "Fill-in mobile number field.",
                                icon: 'error',
                                buttons: false,
                            })
                        } else {
                            //IF WRONG NUMBER
                            $("#infos").css('display','none'); 
                            // $("#errors").css('display','block');
                            // $("#errors").html(res[1]);
                            swal({
                                title: 'Error!',
                                text: "Please input correct number type.",
                                icon: 'error',
                                buttons: false,
                            })
                        }
                        if (res[0] == 3 ) {                 
                        $("#back").css('display','block');
                        $('#inputEmail').attr('disabled',true);
                        $("#inputPinmobile").attr('disabled', true);
                        } 
                    }
                });
            }
                return false;
          
    });

    //frmMobpinReg for Updated UI
    $("#frmMobpinReg").on('submit', function() {
          $("#MobPinloading").css('display','block');
          $(".pleaseWait2").css('display','block');
       
            var data = $(this).serialize();
            $.ajax({
                type : 'POST',
                url  : 'Retailer/check_mobile',
                data : data,
                
                success :  function(data)
                { 
                  $("#MobPinloading").css('display','none');
                  $(".pleaseWait2").css('display','none');
                 
                  var res = data.split('|');
                  $("#infos").html("");
                  $("#errors").html("");
                  $("#errors").css('display','none');
                  $("#infos").css('display','none');
                  $("#inputEmail").prop('disabled',false);
                  $("#tpass1").prop('disabled',false);
                  $("#tpass2").prop('disabled',false);
                  // alert(res[0]);

                    if (res[0] == 0) {  
                        $('#btnStep1').prop('disabled', true)
                        swal({
                        title: 'Verification Failed!',
                        text: "OTP is incorrect or already expired. Please try again.",
                        icon: 'error',
                        buttons: false,
                    })              
                    //   $("#errors").css('display','block');
                    //   $("#errors").html(res[1]);
                      $('#inputEmail').attr('disabled',true);
                    } else if (res[0] == 1 ) {
                        $('#btnStep1').prop('disabled', false);
                        // $('#regMobile').attr('disabled',true);
                        swal({
                            title: 'Verification Success!',
                            text: "You may now proceed to the next step.",
                            icon: 'success',
                            buttons: false,
                        })
                    
                    //   $("#infos").css('display','block');
                    //   $("#infos").html(res[1]);
                      $("#inputEmail").removeAttr('disabled');
                      $("#inputEmail").focus(); 
                      $("#btnmobSend").html("Resend");
                      $("#btnmobSend").removeAttr('disabled');
                }
            }

            });

          return false;
        });
</script>