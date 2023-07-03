
<div class="container-fluid">
    <label for="" style="padding-bottom:25px;">ACCOUNT DETAILS</label>
    <div class="row" style="padding-bottom:15px;">
        <div class="col-md-12">
            <a href="#" style="width: 100px;" class="btn btn-primary" id="btnNewKyc">NEW</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="SEARCH EXISTING ACCOUNT" id="inputSearch" />
        </div>
        <div class="col-md-7">
            <button type="button" class="btn btn-primary" id="btnSearch"><i class="fa fa-search"></i></button>
        </div>
    </div>
</div>

<div class="account_details">

</div>

<div class="account_details_modal">

</div>

<div id="gocab_kyc_modal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                <h4 class="modal-title">Fill-out all Account’s Details</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputFname" placeholder="FIRST NAME" required/></div></div>
                    <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputMname" placeholder="MIDDLE NAME"/></div></div>
                    <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputLname"  placeholder="LAST NAME" required/></div></div>
                    <div class='row' style="padding-bottom:5px;">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">BIRTH DATE</span>
                                <input type="date" class="form-control" id="inputBdate" required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select id="selectGender" class="form-control" required>
                                <option value="" selected disabled hidden>GENDER</option>
                                <option value="M">MALE</option>
                                <option value="F">FEMALE</option>
                            </select>
                        </div>
                    </div>
                    <div class='row' style="padding-bottom:5px;">
                        <div class="col-md-8"><input type="number" class="form-control" id="inputMobile" placeholder="MOBILE NUMBER" required/></div>
                        <div class="col-md-4">
                            <select id="selectCountry" class="form-control" required>
                                <option value="" selected hidden disabled>COUNTRY</option>
                                <option value="Afganistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antigua & Barbuda">Antigua & Barbuda</option>
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
                                <option value="Bonaire">Bonaire</option>
                                <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Canary Islands">Canary Islands</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Channel Islands">Channel Islands</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos Island">Cocos Island</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote DIvoire">Cote DIvoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Curaco">Curacao</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor">East Timor</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands">Falkland Islands</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Ter">French Southern Ter</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Great Britain">Great Britain</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Hawaii">Hawaii</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="India">India</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea North">Korea North</option>
                                <option value="Korea Sout">Korea South</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Midway Islands">Midway Islands</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Nambia">Nambia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherland Antilles">Netherland Antilles</option>
                                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                <option value="Nevis">Nevis</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau Island">Palau Island</option>
                                <option value="Palestine">Palestine</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Phillipines">Philippines</option>
                                <option value="Pitcairn Island">Pitcairn Island</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Republic of Montenegro">Republic of Montenegro</option>
                                <option value="Republic of Serbia">Republic of Serbia</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russia</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="St Barthelemy">St Barthelemy</option>
                                <option value="St Eustatius">St Eustatius</option>
                                <option value="St Helena">St Helena</option>
                                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                <option value="St Lucia">St Lucia</option>
                                <option value="St Maarten">St Maarten</option>
                                <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                <option value="Saipan">Saipan</option>
                                <option value="Samoa">Samoa</option>
                                <option value="Samoa American">Samoa American</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
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
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Tahiti">Tahiti</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Erimates">United Arab Emirates</option>
                                <option value="United States of America">United States of America</option>
                                <option value="Uraguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City State">Vatican City State</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                <option value="Wake Island">Wake Island</option>
                                <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zaire">Zaire</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px;">
                        <div class="col-md-12">
                            <textarea id="inputAddress" class="form-control" placeholder="ADDRESS" required></textarea>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:15px;">
                        <div class="col-md-12">
                            <input type="email" class="form-control" id="inputEmail"  placeholder="EMAIL" required/>
                        </div>
                    </div>
                    <label>Additional Information</label>
                    <div class="row" style="padding-bottom:5px;">
                        <div class="col-md-12">
                            <select id="selectCountryOfBirth" class="form-control" required>
                                <option value="" selected hidden disabled>COUNTRY(OF BIRTH)</option>
                                <option value="Afganistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antigua & Barbuda">Antigua & Barbuda</option>
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
                                <option value="Bonaire">Bonaire</option>
                                <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Canary Islands">Canary Islands</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Channel Islands">Channel Islands</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos Island">Cocos Island</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote DIvoire">Cote DIvoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Curaco">Curacao</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor">East Timor</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands">Falkland Islands</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Ter">French Southern Ter</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Great Britain">Great Britain</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Hawaii">Hawaii</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="India">India</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea North">Korea North</option>
                                <option value="Korea Sout">Korea South</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Midway Islands">Midway Islands</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Nambia">Nambia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherland Antilles">Netherland Antilles</option>
                                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                <option value="Nevis">Nevis</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau Island">Palau Island</option>
                                <option value="Palestine">Palestine</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Phillipines">Philippines</option>
                                <option value="Pitcairn Island">Pitcairn Island</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Republic of Montenegro">Republic of Montenegro</option>
                                <option value="Republic of Serbia">Republic of Serbia</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russia</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="St Barthelemy">St Barthelemy</option>
                                <option value="St Eustatius">St Eustatius</option>
                                <option value="St Helena">St Helena</option>
                                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                <option value="St Lucia">St Lucia</option>
                                <option value="St Maarten">St Maarten</option>
                                <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                <option value="Saipan">Saipan</option>
                                <option value="Samoa">Samoa</option>
                                <option value="Samoa American">Samoa American</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
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
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Tahiti">Tahiti</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Erimates">United Arab Emirates</option>
                                <option value="United States of America">United States of America</option>
                                <option value="Uraguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Vatican City State">Vatican City State</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                <option value="Wake Island">Wake Island</option>
                                <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zaire">Zaire</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputNationality" placeholder="NATIONALITY" required/></div></div>
                    <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputRelationship" placeholder="RELATIONSHIP WITH THE SENDER" required/></div></div>
                    <div class="row" style="padding-bottom:5px;">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">SOURCE OF FUND</span>
                                <select id="selectSourceOfFund" class="form-control" required>
                                    <option value="" selected hidden disabled>SELECT OPTION</option>
                                    <option value="employed">EMPLOYED</option>
                                    <option value="self employed">SELF-EMPLOYED</option>
                                    <option value="unemployed">UNEMPLOYED</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div id="employed" style="padding-bottom:15px;" hidden>
                        <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputOccupation" placeholder="OCCUPATION"/></div></div>
                        <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputCompanyName" placeholder="COMPANY NAME"/></div></div>
                        <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputJobTitle" placeholder="JOB TITLE/POSITION"/></div></div>
                    </div>
                    <div id="selfEmployed" style="padding-bottom:15px;" hidden>
                        <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputBusinessName" placeholder="BUSINESS NAME"/></div></div>
                        <div class="row" style="padding-bottom:5px;">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">REGISTRATION DATE</span>
                                    <input type="date" class="form-control" id="inputRegistrationDate" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputNatureBusiness" placeholder="NATURE OF BUSINESS"/></div></div>
                        <div class="row" style="padding-bottom:5px;"><div class="col-md-12"><input type="text" class="form-control" id="inputYearsOperation" placeholder="YEARS IN OPERATION"/></div></div>
                    </div>
                    <div id="unEmployed" style="padding-bottom:15px;" hidden>
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">UNEMPLOYED</span>
                            <select id="selectUnemployed" class="form-control">
                                <option value="" selected hidden disabled>SELECT OPTION</option>
                                <option value="remittance">REMITTANCE</option>
                                <option value="pension">PENSION</option>
                                <option value="allowance">ALLOWANCE</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px;">
                        <form id="uploadForm" method="post" class="col-md-12" enctype="multipart/form-data">
                            <label for="">Upload ID</label>
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required/>
                        </form>
                    </div>
                    <div class="show_idtype" style="padding-bottom:15px;" hidden>
                        <div class="input-group" style="padding-bottom:5px;">
                            <span class="input-group-addon" id="basic-addon1">ID TYPE</span>
                            <select id="selectIdType" class="form-control" required>
                                <option value="" selected hidden disabled>CHOOSE ID</option>
                                <option value="1">Passport</option>
                                <option value="2">Driver(s) License</option>
                                <option value="3">Professional Regulation Commission (PRC)</option>
                                <option value="4">Unified Multi-Purpose ID (UMID)</option>
                                <option value="7">Postal ID</option>
                                <option value="8">Voters ID</option>
                                <option value="9">Senior Citizen Card</option>
                                <option value="10">Social Security System (SSS)</option>
                                <option value="11">Tax Identification Card (TIN)</option>
                            </select>
                        </div>
                        <div class="row" style="padding-bottom:5px;">
                            <div class="col-md-12"><input type="text" class="form-control" id="inputIdNumber"  placeholder="ID NUMBER" required/></div>
                        </div>
                        <div class="input-group" style="padding-bottom:5px;">
                            <span class="input-group-addon" id="basic-addon1">EXPIRATION DATE</span>
                            <input type="date" class="form-control" id="inputExpiration" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btnUpload" class="btn btn-default">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btnNewKyc').on('click', function(){
        $('#gocab_kyc_modal').modal('show');

        let dtToday = new Date();
        
        let month = dtToday.getMonth() + 1;
        let day = dtToday.getDate();
        let year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        let maxDate = year + '-' + month + '-' + day;

        $('#inputExpiration').attr('min', maxDate);
    });

    $('#btnSearch').on('click', function(){
        let search = $('#inputSearch').val();
        search_kyc(search);
    });

    function search_kyc(search)
    {
       $.ajax({
            method: "POST",
            url: "/Ecash_payout/get_id_details",
            dataType: "JSON",
            data: {
                search: search,
            },
            success: function (response) {
                // console.log(response['TABLE']);
                $('.account_details').html(response['TABLE'])
            }
       });
    }

    $('#selectSourceOfFund').on('change', function(){
        let selectedSOF = $('#selectSourceOfFund').val();

        if(selectedSOF === 'employed')
        {
            $('#employed').prop('hidden', null);
            $('#selfEmployed').prop('hidden', true);
            $('#unEmployed').prop('hidden', true);
        } else if(selectedSOF === 'self employed'){
            $('#employed').prop('hidden', true);
            $('#selfEmployed').prop('hidden', null);
            $('#unEmployed').prop('hidden', true);
        } else if(selectedSOF === 'unemployed'){
            $('#employed').prop('hidden', true);
            $('#selfEmployed').prop('hidden', true);
            $('#unEmployed').prop('hidden', null);
        } else {
            $('#employed').prop('hidden', true);
            $('#selfEmployed').prop('hidden', true);
            $('#unEmployed').prop('hidden', true);
        }
    });

    $('#selectSourceOfFund').on('change', function(){
        $('#inputOccupation').val('');
        $('#inputCompanyName').val('');
        $('#inputJobTitle').val('');
        $('#inputBusinessName').val('');
        $('#inputRegistrationDate').val('');
        $('#inputNatureBusiness').val('');
        $('#inputYearsOperation').val('');
        $('#selectUnemployed').val('');
    });

    $('#gocab_kyc_modal').on('hide.bs.modal', function(){
        $('#inputFname').val('');
        $('#inputMname').val('');
        $('#inputLname').val('');
        $('#inputBdate').val('');
        $('#selectGender').val('');
        $('#inputMobile').val('');
        $('#inputEmail').val('');
        $('#inputAddress').val('');
        $('#selectCountry').val('');
        $('#selectCountryOfBirth').val('');
        $('#inputNationality').val('');
        $('#inputRelationship').val('');
        $('#selectSourceOfFund').val('');
        $('#inputOccupation').val('');
        $('#inputCompanyName').val('');
        $('#inputJobTitle').val('');
        $('#inputBusinessName').val('');
        $('#inputRegistrationDate').val('');
        $('#inputNatureBusiness').val('');
        $('#inputYearsOperation').val('');
        $('#selectUnemployed').val('');
        $('#fileToUpload').val('');
        $('.show_idtype').prop('hidden',true);
    });

    $('#fileToUpload').on('change', function(){
        $('.show_idtype').prop('hidden',null);
    });

    $('#btnUpload').on('click',function(e){
        let fname = $('#inputFname').val();
        let mname = $('#inputMname').val();
        let lname = $('#inputLname').val();
        let bdate = $('#inputBdate').val();
        let gender = $('#selectGender').find(':selected').val();
        let mobile = $('#inputMobile').val();
        let email = $('#inputEmail').val();
        let address = $('#inputAddress').val();
        let country = $('#selectCountry').find(':selected').val();
        let countryBirth = $('#selectCountryOfBirth').find(':selected').val();
        let nationality = $('#inputNationality').val();
        let relationship = $('#inputRelationship').val();
        let sourceFund = $('#selectSourceOfFund').find(':selected').val();
        let occupation = $('#inputOccupation').val();
        let company = $('#inputCompanyName').val();
        let jobtitle = $('#inputJobTitle').val();
        let businessName = $('#inputBusinessName').val();
        let registrationDate = $('#inputRegistrationDate').val();
        let natureBusiness = $('#inputNatureBusiness').val();
        let yearsInOperation = $('#inputYearsOperation').val();
        let unemployed = $('#selectUnemployed').find(':selected').val();

        let idType = $('#selectIdType').find(':selected').val();
        let idExpiration = $('#inputExpiration').val();
        let idNumber = $('#inputIdNumber').val();
        let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if(fname === ''){
            $.alert('Please Input First Name');
            return false;
        }
        if(lname === ''){
            $.alert('Please Input Last Name');
            return false;
        }
        if(bdate === ''){
            $.alert('Please Input Birth Date');
            return false;
        }
        if(gender === ''){
            $.alert('Please select Gender');
            return false;
        }
        if(mobile === ''){
            $.alert('Please Input Mobile Number');
            return false;
        }
        if (!/^\d{11}$/.test(mobile)) 
        {
            $.alert('Please input valid number. Ex. 09123456789');
            return false;
        }
        if(country === ''){
            $.alert('Please Select Country');
            return false;
        }
        if(address === ''){
            $.alert('Please Input Address');
            return false;
        }
        if(email === ''){
            $.alert('Please Input Email Address');
            return false;
        }
        if (!email.match(mailformat)){
            $.alert('You have entered an invalid email address!');
            return false;
        }
        if(countryBirth === ''){
            $.alert('Please Select Country(Of Birth)');
            return false;
        }
        if(nationality === ''){
            $.alert('Please Input Nationality');
            return false;
        }
        if(relationship === ''){
            $.alert('Please Input Relationship with the Sender');
            return false;
        }
        if(sourceFund === ''){
            $.alert('Please Select Source of Fund');
            return false;
        }
        if(sourceFund === 'employed' && occupation === ''){
            $.alert('Please Input Occupation');
            return false;
        }
        if(sourceFund === 'employed' && company === ''){
            $.alert('Please Input Company Name/Employer');
            return false;
        }
        if(sourceFund === 'employed' && jobtitle === ''){
            $.alert('Please Input Job Title');
            return false;
        }
        if(sourceFund === 'self employed' && businessName === ''){
            $.alert('Please Input Business Name');
            return false;
        }
        if(sourceFund === 'self employed' && registrationDate === ''){
            $.alert('Please Input Registration Date');
            return false;
        }
        if(sourceFund === 'self employed' && natureBusiness === ''){
            $.alert('Please Input Nature of Business');
            return false;
        }
        if(sourceFund === 'self employed' && yearsInOperation === ''){
            $.alert('Please Input Years in Operation');
            return false;
        }
        if(sourceFund === 'unemployed' && unemployed === ''){
            $.alert('Please Select Unemployed Option');
            return false;
        }
        if($('#fileToUpload').get(0).files.length === 0)
        {
            $.alert('Please select image ID to upload');
            return false;
        }
        if(idType === ''){
            $.alert('Please Select ID Type');
            return false;
        }
        if(idNumber === ''){
            $.alert('Please Input ID Number');
            return false;
        }
        if(idExpiration === ''){
            $.alert('Please Input ID Expiration Date');
            return false;
        }

        let formData = new FormData($('#uploadForm')[0]);

        formData.append('fname', fname);
        formData.append('mname', mname);
        formData.append('lname', lname);
        formData.append('bdate', bdate);
        formData.append('gender', gender);
        formData.append('mobile', mobile);
        formData.append('email', email);
        formData.append('address', address);
        formData.append('country', country);
        formData.append('countryBirth', countryBirth);
        formData.append('nationality', nationality);
        formData.append('relationship', relationship);
        formData.append('sourceFund', sourceFund);
        formData.append('idType', idType);
        formData.append('idExpiration', idExpiration);
        formData.append('idNumber', idNumber);
        formData.append('occupation', occupation);
        formData.append('company', company);
        formData.append('jobtitle', jobtitle);
        formData.append('businessName', businessName);
        formData.append('registrationDate', registrationDate);
        formData.append('natureBusiness', natureBusiness);
        formData.append('yearsInOperation', yearsInOperation);
        formData.append('unemployed', unemployed);

        $.ajax({
            url: '/Ecash_payout/upload_gocab_id',
            method:'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success:function(data){

                if(data['S'] === '1')
                {
                    let search = '';
                    $.alert(data['M']);
                    $('#gocab_kyc_modal').modal('hide');
                    search_kyc(search);
                }
                else
                {
                    $.alert(data['M']);
                }

                
            }
        });
    });
</script>
