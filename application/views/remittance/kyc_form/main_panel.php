<?php
  if($user['R'] == "FAC0026"){
?>
<div id="fac" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <p>This service is temporarily unavailable in your account.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="buttonfac" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php
  }
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
<script>
$(document).ready(function(){
  $("#fac").modal("show");
});

$("#buttonfac").click(function(){
  $("#send").hide();
  setTimeout(function() {
  window.location.href = "/Main";
}, 100);
});

$("#fac").click(function(){
  $("#send").hide();
  setTimeout(function() {
  window.location.href = "/Main";
}, 100);
});
$(document).ready(function () {
        var x=window.scrollX;
        var y=window.scrollY;

        window.onscroll=function () {
          window.scrollTo(x, y);
        };
        
        setTimeout(() => {
          window.onscroll= function () {
          };
        }, 800);
      });
</script>

<style>
    .id_file {
      position: relative;
      overflow: hidden;
      background-color: #FFC914;
    }

    .file-upload {
      position: absolute;
      font-size: 50px;
      opacity: 0;
      right: 0;
      top: 0;
    }
      
    .ups-btn{
      height: 56px;
      width: 160px;
      border-radius: 12px !important;
      padding: 8px 40px 8px 40px !important;
      border:none !important;
      background-color: #FFC914;
      color: white;
    }
    .ups-btn[disabled]{
          background-color: #cccccc;
          color: #666666
    }

    .ups-btnRecords{
      height: 56px;
      width: 322px;
      border-radius: 12px !important;
      padding: 8px 40px 8px 40px !important;
      border:none !important;
      background-color: #FFC914;
      color: white;
    }

    .img-title{
      height: 180px;
      width: 950px;
      border-radius: 20px;
    }
    
    /* Select CSS */
    /*the container must be positioned relative:*/
    .id-select {
      position: relative;
      width: 360px;
      border-radius:10px;
      background-color: #F4F4F4;
      color: black;
      height:38px; 
      border:none
    }

    .id-select select {
      display: none; /*hide original SELECT element:*/
    }

    .select-selected{
      width: 235;
      height: 38px;
      border-radius:10px; 
      color: black !important;
      font-size: 20px;
      font-weight: 500;
      padding-top: 5px !important;
    }

    /*style the arrow inside the select element:*/
    .select-selected:after {
      position: absolute;
      content: "";
      top: 18px;
      right: 25px;
      width: 0;
      height: 0;
      border: 6px solid transparent;
      border-color: black transparent transparent transparent;
    }

    /*point the arrow upwards when the select box is open (active):*/
    .select-selected.select-arrow-active:after {
      border-color: transparent transparent black transparent;
      top: 14px;
    }

    /*style the items (options), including the selected item:*/
    .select-items div,.select-selected {
      color: black;
      padding: 8px 16px;
      border: 1px solid transparent;
      border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
      cursor: pointer;
      user-select: none;
    }

    /*style items (options):*/
    .select-items {
      position: absolute;
      background-color: #FFC914;
      left: 0;
      right: 0;
      z-index: 99;
      width:360px;
      overflow-y: scroll;
      height: auto;
      max-height: 200px;
    }

    /*hide the items when the select box is closed:*/
    .select-hide {
      display: none;
    }

    .select-items div:hover, .same-as-selected {
      background-color: rgba(0, 0, 0, 0.1);
    }

    .btn-record-search{
      border: none;
      width:1238px;
      height:60px;
      border-radius: 16px;
      background-color:#FFF8E0;
      font-size: 18px;
      font-weight: 500;
    }

    .arrow-back{
      float: left;
      margin-left: 10px;
    }

    /* The container */
    .container1 {
      display: block;
      position: relative;
      padding-left: 20px; 
      cursor: pointer;
      font-weight: 400;
      font-size: 12px;
      border-radius: 4.15385px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container1 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }


    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 18px;
      width: 18px;
      border-radius: 4.15385px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container1:hover input ~ .checkmark {
      background-color: #ccc;
      border-radius: 4.15385px;
    }

    /* When the checkbox is checked, add a yellow background */
    .container1 input:checked ~ .checkmark {
      background: #FFC914;
      border-radius: 4.15385px;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .container1 input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .container1 .checkmark:after {
      left: 7px;
      top: 3px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }

    .record-search-table{
      width: 1160px;
      border: 1px solid #EBEBEB;
      border-collapse:collapse;
      border-radius: 8px 8px 8px 8px;
      margin-top: 5em;
    }
    .record-search-table thead{
        text-align: center;
        height: 34px;
        background-color: #F1F6FA;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px 8px 0px 0px;
    }
    
    .field-view::before{  
        content: attr(data-content);
        position:absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        color: black;        
        padding: 5px 7px;
        background-color: #FFFFFF;
        border-radius: 4px;
        top: -11px;
        left: 15px;
    }

    .corner1{
        border-radius: 8px 0px 0px 0px;
    }

    .corner2{
        border-radius: 0px 8px 0px 0px;
    }
    
    .no-record{
        text-align:center ;
        font-size: 14px;
        font-weight: 500;
        height: 212px;
    }

    .form-prev{
            background-color: white;
            border: none;
            width: 50px;
            height: 42px;
            position: absolute;
            padding-left: 50px;
            z-index:500;
            float: left;
            top: 20px;
        }
</style>

<div id="field-view-tag">
</div>

<body class="font-poppins">
  <div class="mainpanel">
    <div class="contentpanel">

      <form id="formKYC" name="formKYC" class="form-inline" enctype="multipart/form-data">
        <div class="container flex-center col" id="kycForm" style="padding-right: 150px;">
          <input hidden id="getRegcode" value="<?php echo $regcode ?>"></input>
          <input hidden id="getLevel" value="<?php echo $level ?>"></input>
          <!-- KYC ACCOUNT REGISTRATION BANNER -->
          <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/kyc_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="1200" height="300">
          
          <div class="container row">
            <h1 class="ups-h1 mt-1" style="text-align: center; padding-left: 70px; padding-right: 30px">KYC <span class="ups-txt-yellow">Form</span></h1>
            <div class="container">
              <h4 class="txt-center">Customer Information</h4>
            </div>
          </div>

          <!-- KYC NAME OF USER ROW -->
          <div class="container col flex-center mt-2" style="padding-right: 150px">
            <div class="container flex-center row" style="padding-right: 150px;">
              <label class="ups-input-label" style="text-align: center; width: 330px; margin-right: 5px;" >First Name</label>
              <label class="ups-input-label" style="text-align: center; width: 180px;" >Middle Name</label>
              <label class="ups-input-label" style="text-align: center; width: 320px; padding-right: 30px;" >Last Name</label>
            </div>
            <div class="row">
              <input type="text" id="fname" name="fname" class="ups-input-text field" oninput="this.value = this.value.toUpperCase()" placeholder="Enter FN" style="height: 38px; width: 237px; margin-right: 10px;" onkeypress="return isLetterKey(event)" required>
              <input type="text" id="mname" name="mname" class="ups-input-text" oninput="this.value = this.value.toUpperCase()" placeholder="Enter MN" style="height: 38px; width: 230px;  margin-right: 10px;" onkeypress="return isLetterKey(event)">
              <input type="text" id="lname" name="lname" class="ups-input-text field" oninput="this.value = this.value.toUpperCase()" placeholder="Enter LN" style="height: 38px; width: 237px;" onkeypress="return isLetterKey(event)" required>
            </div>
          </div>

          <!-- PRESENT ADDRESS TITLE -->
          <div class="row mt-2 mb-2">
            <label for="" class="ups-input-label" style="text-align: left; padding-right: 565px;" >Present Address</label>
          </div>

          <!-- Country and Province -->
          <div class="container col flex-center" style="padding-right: 150px">
            <div class="row">
              <label class="ups-input-label" style="text-align: center; width: 275px; padding-right: 365px;" >Country</label>
              <label class="ups-input-label" style="text-align: center; width: 95px; margin-right: 260px;" >State/Province</label>
            </div>
            <div class="flex-center row field">
              <select class="id-select form-group selOption" name="country" id="country" style="text-align: center; width: 350px; font-size: 18px; font-weight: 500;  margin-right: 10px;">
                    <option value="" disabled selected><p style="margin:0px">Select Country</p></option> 
                    <option value="Philippines">Philippines</option>
                    <option value="" disabled ><p style="margin:0px">-- Other Countries --</p></option> 
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Aland Islands">Åland Islands</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua and Barbuda">Antigua & Barbuda</option>
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
                    <option value="Bonaire, Sint Eustatius and Saba">Caribbean Netherlands</option>
                    <option value="Bosnia and Herzegovina">Bosnia & Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="Brunei Darussalam">Brunei</option>
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
                    <option value="Congo">Congo - Brazzaville</option>
                    <option value="Congo, Democratic Republic of the Congo">Congo - Kinshasa</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote D'Ivoire">Côte d’Ivoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curacao">Curaçao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czechia</option>
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
                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Islas Malvinas)</option>
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
                    <option value="Guernsey">Guernsey</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard Island and Mcdonald Islands">Heard & McDonald Islands</option>
                    <option value="Holy See (Vatican City State)">Vatican City</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran, Islamic Republic of">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea, Democratic People's Republic of">North Korea</option>
                    <option value="Korea, Republic of">South Korea</option>
                    <option value="Kosovo">Kosovo</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyan Arab Jamahiriya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macao">Macao</option>
                    <option value="Macedonia, the Former Yugoslav Republic of">North Macedonia</option>
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
                    <option value="Micronesia, Federated States of">Micronesia</option>
                    <option value="Moldova, Republic of">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar (Burma)</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Curaçao</option>
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
                    <option value="Palestinian Territory, Occupied">Palestine</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Pitcairn">Pitcairn Islands</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Réunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russian Federation">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Saint Barthelemy">St. Barthélemy</option>
                    <option value="Saint Helena">St. Helena</option>
                    <option value="Saint Kitts and Nevis">St. Kitts & Nevis</option>
                    <option value="Saint Lucia">St. Lucia</option>
                    <option value="Saint Martin">St. Martin</option>
                    <option value="Saint Pierre and Miquelon">St. Pierre & Miquelon</option>
                    <option value="Saint Vincent and the Grenadines">St. Vincent & Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">São Tomé & Príncipe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Serbia and Montenegro">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Sint Maarten">Sint Maarten</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="South Georgia and the South Sandwich Islands">South Georgia & South Sandwich Islands</option>
                    <option value="South Sudan">South Sudan</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard and Jan Mayen">Svalbard & Jan Mayen</option>
                    <option value="Swaziland">Eswatini</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syrian Arab Republic">Syria</option>
                    <option value="Taiwan, Province of China">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania, United Republic of">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-Leste">Timor-Leste</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad and Tobago">Trinidad & Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks & Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="United States Minor Outlying Islands">U.S. Outlying Islands</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Viet Nam">Vietnam</option>
                    <option value="Virgin Islands, British">British Virgin Islands</option>
                    <option value="Virgin Islands, U.s.">U.S. Virgin Islands</option>
                    <option value="Wallis and Futuna">Wallis & Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
              </select>
              <input type="text" id="province" name="province" class="ups-input-text" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Province" style="height: 38px; width: 360px; margin-left:13px;" onkeypress="return isLetterKey(event)" required>
            </div>
          </div>

          <!-- Street and ZIP Code -->
          <div class="container col flex-center" style="padding-right: 150px">
            <div class="row mt-2">
              <label for="" class="ups-input-label" style="text-align: left; width: 320px; padding-right: 360px;" >City</label>
              <label for="" class="ups-input-label" style="text-align: left; width: 320px; padding-right: 360px;" >Barangay</label>
            </div>
            <div class="row field">
              <input type="text" id="addressCity" name="addressCity" class="ups-input-text" oninput="this.value = this.value.toUpperCase()" placeholder="Enter City" style="height: 38px; width: 350px; margin-right: 10px;" onkeypress="return isLetterKey(event)" required>
              <input type="text" id="addressBrgy" name="addressBrgy" class="ups-input-text" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Barangay" style="height: 38px; width: 360px;" onkeypress="return /[0-9A-Za-z ]/i.test(event.key)" required>
            </div>
          </div>
          <!-- Street and Postal Code -->
          <div class="container col flex-center" style="padding-right: 150px">
            <div class="row mt-2">
              <label class="ups-input-label " style="text-align: left; width: 340px; padding-right: 320px; padding-left: 80px;">Unit/Lot/Block/Street/Subdivision</label>
              <label class="ups-input-label" style="text-align: left; width: 330px; padding-right: 350px; padding-left: 130px">Postal</label>
            </div>
            <div class="row field">
              <input type="text" id="addressStreet" name="addressStreet" class="ups-input-text" placeholder="Enter Street" style="height: 38px; width: 435px;  margin-left: 40px; margin-right: 10px;" required>
              <input type="text" id="addressZip" name="addressZip" class="ups-input-text" minlength="4" maxlength="4" placeholder="Enter ZIP Code" style="height: 38px; width: 275px;  margin-right: 45px" minLength="4" maxLength="4" onkeypress="return isNumberKey(event)" required>
            </div>
          </div>

          <!-- Permanent Address -->
          <div class="container row flex-center  mt-2">
            <label for="" class="ups-input-label me-4" style="width: px; margin-right: 365px;" >Permanent Address</label>
            <label class="container1"> Same as present address
              <input type="checkbox" id="sameAsPresent">
              <span class="checkmark"></span>
            </label>
          </div>

          <input type="text" id="permanentAddress" name="permanentAddress" class="ups-input-text field" placeholder="Enter Permanent Address" style="height: 38px; width: 725px; margin-left: 25px" required>
          
          <!-- Mobile and Email -->
          <div class="container col flex-center" style="padding-right: 157px">
            <div class="row mt-2">
              <label for="" class="ups-input-label" style="text-align: left; width: 320px; padding-right: 355px;" >Mobile</label>
              <label for="" class="ups-input-label" style="text-align: left; width: 320px; padding-right: 360px;" >Email</label>
            </div>
            <div class="row field">
              <!-- <label class="tel-code" style="height: 38px; width: 50px;"><img src="<?php echo BASE_URL()?>assets/icon/philippines.png" alt="" srcset="">+63</label> -->
              <input type="text" id="mobile" name="mobile" class="ups-input-text" placeholder="Enter Mobile Number" maxlength="11" minLength="11" style="height: 38px; width: 350px; margin-right: 10px;" onkeypress="return isNumberKey(event)" required>
              <input type="email" id="emailAdd" name="emailAdd" class="ups-input-text" placeholder="Enter Email Address" style="height: 38px; width: 360px;" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" required>
            </div>
          </div>

          <!-- Birthdate and Birthplace Labels and Textfields-->
          <div class="container col flex-center" style="padding-right: 157px">
            <div class="row mt-2">
              <label for="" class="ups-input-label" style="text-align: left; width: 320px; padding-right: 360px;" >Birthday</label>
              <label for="" class="ups-input-label" style="text-align: left; width: 320px; padding-right: 360px;" >Birthplace</label>
            </div>
            <div class="row field">
              <input type="date" id="birthDate" name="birthDate" class="ups-input-text" onkeydown="return false" placeholder="MM-DD-YYYY" style="height: 38px; width: 350px; margin-right: 10px;" required>
              <input type="text" id="placeOfBirth" name="placeOfBirth" class="ups-input-text" placeholder="Enter Place of Birth" style="height: 38px; width: 360px;" onkeypress="return isLetterKey(event)" required>
            </div>
          </div>

          <!-- Job and Source of Income Labels and Textfields -->
          <div class="container col flex-center" style="padding-right: 161px">
            <div class="row mt-2">
              <label for="" class="ups-input-label" style="text-align: left; width: 244px; margin-left: 4px;" >Occupation</label>
              <label for="" class="ups-input-label" style="text-align: left; width: 240px;" >Source of Fund</label>
              <label for="" class="ups-input-label" style="text-align: left; width: 228px;" >Nationality</label>
            </div>
            <div class="flex-center row field">
              <input type="text" id="occupation" name="occupation" class="ups-input-text" placeholder="Enter Occupation" style="height: 38px; width: 235px;  margin-right: 10px;" onkeypress="return /[a-zA-Z0-9 ]/i.test(event.key)" required>         
                <select class="id-select form-group selOption" name="sourceOfFund" id="sourceOfFund" style="width: 235px; text-align: center; font-size: 18px; font-weight: 500;">
                  <option  value="" disabled selected><p style="margin:0px">Choose one</p></option>  
                  <option  value="Salary"><p style="margin:0px">Salary</p></option>
                  <option  value="Savings"><p style="margin:0px">Savings</p></option>
                  <option  value="Inheritance"><p style="margin:0px">Inheritance</p></option>
                  <option  value="Company Profit"><p style="margin:0px">Company Profit</p></option>
                  <option  value="Investments"><p style="margin:0px">Investments</p></option>
                  <option  value="Others"><p style="margin:0px">Others</p></option>
                </select>
              <input type="text" id="nationality" name="nationality" class="ups-input-text" placeholder="Enter Nationality" style="height: 38px; width: 225px; margin-left: 10px;" onkeypress="return isLetterKey(event)" required>
            </div>
          </div>


          <!-- ID 1 Title-->
          <div class="container col flex-center mt-4" style="padding-right: 150px">
            <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500;" >ID # 1</label>
          </div>

          <!-- ID 1 Labels -->
          <div class="container col flex-center" style="padding-right: 140px">
            <div class="row mt-2">
              <label for="" class="ups-input-label" style="text-align: left; width: 240px;" >Type of ID</label>
              <label for="" class="ups-input-label" style="text-align: left; width: 240px;" >ID Number</label>
              <label for="" class="ups-input-label" style="text-align: left; width: 240px;" >Date Issued</label>
            </div>
          </div>
     
          <!-- ID 1 Type Selection and Fields -->
          <div class="flex-center row field"  style="width: 820px; margin-left: 5px;" id="divId1">
            <select class="id-select form-group selOption" name="idType1" id="idType1" style="width: 235px; text-align: center; font-size: 18px; font-weight: 500;">
              <option value="" disabled selected  style="margin:0px;"><p style="margin:0px;">Choose ID Type</p></option>  
              <option value="" disabled style="margin:0px;"><p style="margin:0px;">-- Primary IDs --</p></option> 
              <option value="UMID"><p style="margin:0px">UMID</p></option>
              <option value="Passport"><p style="margin:0px">Passport</p></option>
              <option value="Driver's License"><p style="margin:0px">Driver's License</p></option>
              <option value="Philippine Postal ID"><p style="margin:0px">PHLPost ID</p></option>
              <option value="" disabled style="margin:0px;"><p style="margin:0px;">-- Secondary IDs --</p></option>  
              <option value="Philhealth ID"><p style="margin:0px">Philhealth ID</p></option>
              <option value="PRC ID"><p style="margin:0px">PRC ID</p></option>
              <option value="SSS ID"><p style="margin:0px">SSS ID</p></option>
              <option value="TIN ID"><p style="margin:0px">TIN ID</p></option>
              <option value="Voter's ID"><p style="margin:0px">Voter's ID</p></option>
            </select>
            &nbsp;
            <input type="text" id="idNumber1" name="idNumber1" class="ups-input-text" placeholder="Enter ID Number" style="height: 38px; width: 230px; margin-left: 10px; margin-right: 10px;"  >
            &nbsp;
            <input type="date" id="dateIssued1" name="dateIssued1" onkeydown="return false"  class="ups-input-text" placeholder="" style="height: 38px; width: 225px;">
          </div>

          <!-- ID 1 Image Attachment -->
          <div class="container col flex-center mb-4" style="padding-right: 165px">
            <div class="row mt-2">
              <label for="" class="ups-input-label" style="text-align: left; padding-right: 615px;" >Attachment</label>
            </div>
            <div class="flex-center row field">
              <input type="text" id="id_attachment1" name="id_attachment1" class="ups-input-text mx-3" placeholder="No uploaded file" style="height: 38px; width: 585px; margin-right: 10px;" disabled  >
              <div class="id_file btn btn-lg btn-dark">
                Upload ID
                <input type="file" class="file-upload" id="id_attachment1_upload" accept="image/*" name="file_upload1"/>
              </div>
            </div>
          </div>

          <div class="container col flex-center" style='display:none;' id='hider-secondId'>
            <!-- ID 2 -->
            <div class="container col flex-center" style="padding-right: 180px">
              <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500;" >ID # 2</label>
            </div>
            
            <!-- ID 2 Labels -->
            <div class="container col flex-center" style="padding-right: 175px">
              <div class="row mt-2">
                <label for="" class="ups-input-label" style="text-align: left; width: 240px;" >Type of ID</label>
                <label for="" class="ups-input-label" style="text-align: left; width: 240px;" >ID Number</label>
                <label for="" class="ups-input-label" style="text-align: left; width: 240px; padding-right: 35px" >Date Issued</label>
              </div>
            </div>

            <!-- ID 2 Type Selection and Fields -->
            <div class="ups-input-field flex-center row" style="width: 820px; margin-right: 140px" id="divID2">
              <select class="id-select form-group selOption" name="idType2" id="idType2" style="width: 235px; text-align: center; font-size: 18px; font-weight: 500;">
              <option value="" disabled selected  style="margin:0px;"><p style="margin:0px;">Choose ID Type</p></option>  
              <option value="Philhealth ID"><p style="margin:0px">Philhealth ID</p></option>
              <option value="PRC ID"><p style="margin:0px">PRC ID</p></option>
              <option value="SSS ID"><p style="margin:0px">SSS ID</p></option>
              <option value="TIN ID"><p style="margin:0px">TIN ID</p></option>
              <option value="Voter's ID"><p style="margin:0px">Voter's ID</p></option>
            </select>
              &nbsp;
              <input type="text" id="idNumber2" name="idNumber2" class="ups-input-text" placeholder="" style="height: 38px; width: 250px;"  >
              &nbsp;
              <input type="date" id="dateIssued2" name="dateIssued2" class="ups-input-text" placeholder="" style="height: 38px; width: 240px;"  >
            </div>

            <!-- ID 2 Image Attachment -->
            <div class="container col flex-center mb-4" style="padding-right: 165px">
              <div class="row mt-2" style="padding-right: 35px">
                <label for="" class="ups-input-label" style="text-align: left; padding-right: 630px;" >Attachment</label>
              </div>
              <div class="row" style="padding-right: 35px" id="divAttachment2">
                <input type="text" id="id_attachment2" name="id_attachment2" class="ups-input-text mx-3" placeholder="No uploaded file" style="height: 38px; width: 600px;" disabled  >
                <div class="id_file btn btn-lg btn-dark">
                  Upload ID
                  <input type="file" class="file-upload" id="id_attachment2_upload" accept="image/*" name="file_upload2"/>
                </div>
              </div>
            </div>
          </div>

          <!-- Upload Image Signature -->
          <div class="container col flex-center" style="padding-right: 165px">
            <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500;" >Signature</label>
          </div>

          <div class="container col flex-center mb-4" style="padding-right: 165px">
            <div class="row mt-2">
              <label for="" class="ups-input-label" style="text-align: left; padding-right: 605px;" >Attachment</label>
            </div>
            <div class="flex-center row field">
              <input type="text" id="signature_attachment" name="signature_attachment" class="ups-input-text mx-3" placeholder="No uploaded file" style="height: 38px; width: 510px; margin-right: 10px" disabled  >
              <div class="id_file btn btn-lg btn-dark">
                Upload Signature
                <input type="file" class="file-upload" id="signature_attachment_upload" accept="image/*" name="file_upload3"/>
              </div>
            </div>
          </div>

          <!-- Proceed to NEXT PAGE - Review Details  -->
          <div class="container flex-center col mt-4" style="padding-right: 165px">
            <button class="continue ups-btn btn-yellow mb-2 btn-review" style="font-size: 20px; font-weight: 600; padding-left: 20px;" id="view-details-btn">Review</button>
          </div>
        </div>


        <!-- PAGE 2 -->
        <!-- Review Customer Details -->
        <div class="container flex-center col" id="kycReview" style="padding-right: 160px">
          <!-- KYC ACCOUNT REGISTRATION BANNER FOR PAGE 2 -->
          <img class="img-title mt-2" src="<?php echo BASE_URL() ?>assets/images/kyc/kyc_banner.png" style="text-align: center; padding-left: 70px; padding-right: 30px" alt="UPS Title Bar" width="1200" height="300">

          <div class="container row mt-2">
            <h1 class="ups-h1 txt-center ups-txt-dark">Review your <span class="ups-txt-yellow">details</span></h1>
              <div class="container">
                <h4 class="txt-center" style="margin-right: 35px">Customer Information</h4>
              </div>
          </div>

          <!-- Return to KYC Form Button -->
          <div class="container col flex-left" >
            <button class="form-prev" id="form-prev"><img src="<?php echo BASE_URL()?>assets/icon/prev.png" alt="" srcset="" style="margin-top: 245px"></button>  
          </div>

          <!-- Review Full name and Addresses -->
          <div class="container col flex-center mt-2" style="padding-right: 210px">
            <div class="field-view row" style="height: 52px; width: 725px; margin-left: 25px;" id="f1" ></div>
          </div>

          <div class="container col flex-center" style="padding-right: 210px">
            <div class="field-view row" style="height: 52px; width: 720px; margin-left: 25px;" id="f2" ></div>
          </div>

          <div class="container col flex-center" style="padding-right: 210px">
            <div class="field-view row" style="height: 52px; width: 720px; margin-left: 25px" id="f3" ></div>
          </div>

          <!-- Review Mobile Number and Email -->
          <div class="container col flex-center" style="padding-right: 210px">
            <div class="row">
              <div class="col-xs-6">
                <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f4" disabled></div>
              </div>
              <div class="col-xs-6">
                <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f5" disabled></div>
              </div>
            </div>
          </div>

          <!-- Review Birthdate and Birthplace -->
          <div class="container col flex-center" style="padding-right: 210px">
            <div class="row">
              <div class="col-xs-6">
                <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f6" disabled></div>
              </div>
              <div class="col-xs-6">
                <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f7" disabled></div>
              </div>
            </div>
          </div>

          <!-- Review Occupation and Source of Fund/s -->
          <div class="container col flex-center" style="padding-right: 210px">
            <div class="row">
              <div class="col-xs-6">
                <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f8" disabled></div>
              </div>
              <div class="col-xs-6">
                <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f9" disabled></div>
              </div>
            </div>
          </div>

          <!-- Review Country and Nationality -->
          <div class="container col flex-center" style="padding-right: 210px">
            <div class="row">
              <div class="col-xs-6">
                <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f10" disabled></div>
              </div>
              <div class="col-xs-6">
                <div class="field-view row"  name="" style="height: 52px; width: 340px; margin-left: 25px;" id="f11" disabled></div>
              </div>
            </div>
          </div>

          <!-- Review ID 1 -->
          <div class="container col flex-center" style="padding-right: 210px">
            <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500; margin-left: 15px" >ID # 1</label>
          </div>

          <!-- Review ID 1 Information and File Attachment -->
          <div class="container col flex-center mt-2" style="padding-right: 200px">
            <div class="row" style="margin-left: 5px;">
              <div class="col-xs-4">
                <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f12" disabled></div>
              </div>
              <div class="col-xs-4">
                <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f13" disabled></div>
              </div>
              <div class="col-xs-4">
                <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f14" disabled></div>
              </div>
            </div>
          </div>

          <div class="container col flex-center"  style="padding-right: 210px">
            <div class="field-view row" style="height: 52px; width: 720px; margin-left: 25px" id="f15" ></div>
          </div>

          <!-- Review ID 2 -->
          <div id="reviewID2" class="container col flex-center">
            <div class="container col flex-center" style="padding-right: 175px">
              <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500; margin-right: 40px" >ID # 2</label>
            </div>

            <!-- Review ID 2 Information and File Attachment-->
            <div class="container col flex-center mt-2" style="padding-right: 205px">
              <div class="row">
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f16" disabled></div>
                </div>
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f17" disabled></div>
                </div>
                <div class="col-xs-4">
                  <div class="field-view row"  name="" style="height: 52px; width: 230px; margin-left: 5px;" id="f18" disabled></div>
                </div>
              </div>
            </div>

            <div class="container col flex-center" style="padding-right: 190px">
              <div class="field-view row" style="height: 52px; width: 725px; margin-left: -10px" id="f19" ></div>
            </div>
          </div>

          <!-- Review Attached Signature -->
          <div class="container col flex-center" style="padding-right: 175px">
            <label for="" class="ups-input-label" style="text-align: center; width: 320px; font-size: 22px; font-weight: 500;" >Signature</label>
          </div>
          <div class="container col flex-center mt-1" style="padding-right: 175px">
            <div class="field-view row" style="height: 52px; width: 725px; margin-left: 5px" id="f20" ></div>
          </div>

          <!-- SUBMIT FORM  -->
          <div class="container flex-center col mt-1" style="padding-right: 210px">
            <button type="submit" class="continue ups-btn btn-yellow mb-2" style="font-size: 20px; font-weight: 600; padding-left: 20px;" id="btnSubmit" name="btnSubmit">Submit</button>
          </div>
        </div> 
      </form>
      <!-- END OF FORM -->

      <!-- SUCCESS FORM -->
      <div class="container flex-center col" id="success">
        <div class="container flex-center mt-1">
            <img src="<?php echo BASE_URL()?>assets/icon/unified-logo.png" alt="" srcset=""> 
            <span style="width:155px; height:30px; font-size:20px; font-weight:600;">UPS Web Portal</span>
        </div>
        <!-- SUCCESSFULLY UPDATED -->
        <center>
          <div class="mt-1" id="update">
            <span class="ups-input-label mt-3">Account Updated</span>
            <div id="updateOld"> 
              <h1 class="ups-h1 txt-center mt-1" style="width:518px; height:90px;">Good Job! Your Account has been Updated.</h1>
            </div>
            <!-- SUCCESSFULLY UPDATED, WAITING FOR APPROVAL -->
            <div id="updateNew"> 
              <h1 class="ups-h1 txt-center mt-1" style="width:518px; height:90px;">Good Job! Your Account has been Updated, Verification is in Progress.</h1>
            </div>
          </div>
          <!-- SUCCESSFULLY ADDED NEW KYC -->
          <div class="mt-1" id="added">
            <span class="ups-input-label mt-3">Account Verification</span>
            <div id="addedNew">
              <h1 class="ups-h1 txt-center mt-1" style="width:518px; height:90px;">Good Job! Your Account Verification is in Progress.</h1>
            </div>
            <div id="pending">
              <h1 class="ups-h1 txt-center mt-1" style="width:518px; height:90px;">Your Account Verification is in Progress.</h1>
            </div>
          </div>
          <div class="mt-1" id="addedHub">
            <span class="ups-input-label mt-3">Account Creation</span>
            <div id="addedHubNew">
              <h1 class="ups-h1 txt-center mt-1" style="width:518px; height:90px;">Good Job! Your Account has been Created.</h1>
            </div>
          </div>
        </center>
        <span class="ups-input-label mt-3">Thanks for using Unified!</span>
        <img src="<?php echo BASE_URL()?>assets/icon/success2.png" alt="" srcset="">
        <div class="container flex-center col mt-3">
          <a href="/Main"><button class="ups-btnRecords btn-yellow mb-2 mt-6" style="font-size: 20px; font-weight: 600;">RETURN TO HOME</button></a>
        </div>
      </div>

      <!-- ERROR FORM -->
      <div class="container flex-center col" id="err">
        <span class="ups-input-label mt-3">Oopps..</span>
        <div id="errMessage"></div>
        <div class="container flex-center col mt-1">
          <a href="/kyc_form"><button class="ups-btnRecords btn-yellow mb-2 mt-6" style="font-size: 20px; font-weight: 600;">RETURN TO FORM</button></a>
        </div>
      </div>


    </div>
  </div>
</body>

<script>
/*####################################################### STEP 1 #######################################################*/
  var userlevel, fname, mname, lname, addressStreet, addressCity, addressBrgy, addressZip, permanentAddress, mobile, email, 
  birthDate, placeOfBirth, occupation, sourceOfFund, province, country, nationality, idType1, idNumber1, dateIssued1, 
  id_attachment1, idType2, idNumber2, dateIssued2, id_attachment2, signature_attachment;

  function isNumberKey(evt){ 
    //var e = evt || window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
      return true;
	}

  function isLetterKey(evt){
    var keyCode = (evt.which) ? evt.which : evt.keyCode
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
      return false;
      return true;
  }
  function disabledReview(){
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if($('#addressZip').val().length < 3){
      $('#view-details-btn').prop('disabled', true);
    }
    else if($('#mobile').val().length != 11){
      $('#view-details-btn').prop('disabled', true);
    }
    else if(!testEmail.test($('#emailAdd').val())){
      $('#view-details-btn').prop('disabled', true);
    }
    else{
      $('#view-details-btn').prop('disabled', false);
    }
  }

  $('#addressZip').keyup(disabledReview)
  $('#mobile').keyup(disabledReview)
  $('#emailAdd').keyup(disabledReview)
  // $('#addressZip').keyup(function(){
  //   if($(this).val().length < 3){
  //     $('#view-details-btn').prop('disabled', true);
  //   }
  //   else{
  //     $('#view-details-btn').prop('disabled', false);
  //   }
  // })

  // $('#mobile').keyup(function(){
  //   if($(this).val().length != 11){
  //     $('#view-details-btn').prop('disabled', true);
  //   }
  //   else{
  //     $('#view-details-btn').prop('disabled', false);
  //   }
  // })

  // $('#emailAdd').keyup(function(){
  //   var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
  //   if(!testEmail.test($('#emailAdd').val())){
  //     $('#view-details-btn').prop('disabled', true);
  //   }
  //   else{
  //     $('#view-details-btn').prop('disabled', false);
  //   }
  // })



  /* Fetch present address */
  $('#sameAsPresent').on('change', function(){
    var isCheck = $('#sameAsPresent').prop('checked');
    var arr_presentAddr = [];

    addressStreet = $('#addressStreet').val();
    addressBrgy   = $('#addressBrgy').val();
    addressCity   = $('#addressCity').val();
    province      = $('#province').val();
    country       = $('#country').val();
    addressZip    = $('#addressZip').val();

    if(addressStreet){
      arr_presentAddr.push(addressStreet);
    }
    if(addressBrgy){
      arr_presentAddr.push(addressBrgy);
    }
    if(addressCity){
      arr_presentAddr.push(addressCity);
    }
    if(province){
      arr_presentAddr.push(province);
    }
    if(country){
      arr_presentAddr.push(country);
    }
    if(addressZip){
      arr_presentAddr.push(addressZip);
    }
    
    if(arr_presentAddr.length > 0){
      if(isCheck) {
        var presentAddr = "";
        var count_presentAddr = arr_presentAddr.length-1;
        for(let i=0; i < count_presentAddr; i++){
          presentAddr += arr_presentAddr[i]+", ";
        }
        $('#permanentAddress').val(presentAddr+arr_presentAddr[count_presentAddr]).prop("disabled", true);
        $('#permanentAddress').css("border","none");
      } else {
        $('#permanentAddress').val("").prop("disabled", false);
      }
    }
  });

  /* DISPLAY FILE NAME ON INPUT FIELD */

  // $('#signature_attachment_upload').bind('change', function() {
    //this.files[0].size gets the size of your file.
    // alert(this.files[0].size > 1887436);
  // });

  $('#id_attachment1_upload').on('change', function(){
    if($(this).val().length == 0){
      $('#id_attachment1').val('');
    }
    if(this.files[0].size < 2097152){
      var attachmmentId1 = $('#id_attachment1_upload').val().replace(/C:\\fakepath\\/i, '').toLowerCase();
      $('#id_attachment1').val(attachmmentId1);
    }else{
      $('#id_attachment1_upload').val('')
      $('#id_attachment1').val('');
      swal({
        title  : 'Image is too big!',
        text   : 'Please attach image below 2MB',
        icon   : 'warning',
        buttons: false,
      })
    }
  });

  $('#id_attachment2_upload').on('change', function(){
    $('#id_attachment2').css("border","none");
    if($(this).val().length == 0){
      $('#id_attachment2').val('');
    }
    if(this.files[0].size < 2097152){
      var attachmmentId2 = $('#id_attachment2_upload').val().replace(/C:\\fakepath\\/i, '').toLowerCase();
      $('#id_attachment2').val(attachmmentId2);
    }else{
      $('#id_attachment2_upload').val('')
      $('#id_attachment2').val('');
      swal({
        title  : 'Image is too big!',
        text   : 'Please attach image below 2MB',
        icon   : 'warning',
        buttons: false,
      })
    }
  });

  $('#signature_attachment_upload').on('change', function(){ 
    if($(this).val().length == 0){
      $('#signature_attachment').val('');
    }
    if(this.files[0].size < 2097152){
      var attachmmentSignature1 = $('#signature_attachment_upload').val().replace(/C:\\fakepath\\/i, '').toLowerCase();
      $('#signature_attachment').val(attachmmentSignature1);
    }else{
      $('#signature_attachment_upload').val('')
      $('#signature_attachment').val('');
      swal({
        title  : 'Image is too big!',
        text   : 'Please attach image below 2MB',
        icon   : 'warning',
        buttons: false,
      })
    }

  });

  /* REMOVE DISABLED INPUT FIELDS UPON SUBMIT */
  // $('#formKYC').submit(function(e) {
  //   $(':disabled').each(function(e) {
  //       $(this).prop('disabled', false);
  //   });
  // });

  /* REMOVE RED BORDER */
  $(document).ready(function() {
    $('#kycForm').show('slide', {direction: 'down'}, 350)
    
    $('.field input').on('change', function(){
      $('.field input').each(function() {
        if($(this).val().length > 0){
          $(this).css("border","none");
        }
      });
    });

    $('input.field').on('change', function(){
      $('input.field').each(function() {
        if($(this).val().length > 0){
          $(this).css("border","none");
        }
      });
    });

    $('.attachment input').on('change', function(){
      $('.attachment input').each(function() {
        if($(this).val().length > 0){
          $(this).css("border","none");
        }
      });
    });

    $('#country, #sourceOfFund, #idType1, #idType2, #idNumber2, #dateIssued2').on('change', function(){
      $(this).css("border","none");
    });

  });

  /* CHECK FIELDS */
  $('#view-details-btn').click(function(e){
    e.preventDefault();
    let empty = false;
    let emptyInput = false;
    let emptyAttachment = false;
    let emptySelect = false;

    var idArray1 = [];
    var idArray2 = [];
    var idArray3 = [];
    var idArray4 = [];
    
    /* All Input Field */
    $('.field input').each(function() {
      empty = $(this).val().length;
      $(this).val().length < 1 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray1.push(empty);
    });

    $('#addressZip').each(function() {
      empty = $(this).val().length;
      $(this).val().length < 4 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray1.push(empty);
    });

    $('#mobile').each(function() {
      empty = $(this).val().length;
      $(this).val().length < 11 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray1.push(empty);
    });

    $('#emailAdd').each(function() {
      empty = $(this).val();
      $(this).val().match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) ? $(this).css("border", "none") : $(this).css("border","3px solid red");
      idArray1.push(empty);
    });

    /* Input fname, lname, permanentAddress */
    $('input.field').each(function() {
      emptyInput = $(this).val().length;
      $(this).val().length < 1 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray2.push(emptyInput);
    });

    /* Input File Upload */
    $('.attachment input').each(function() {
      emptyAttachment = $(this).val().length;
      $(this).val().length < 1 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray3.push(emptyAttachment);
    });

    $('.selOption > option:selected').each(function() {
      emptySelect = $(this).val().length;
      $(this).val().length < 1 ? $(this).css("border","3px solid red") : $(this).css("border", "none");
      idArray4.push(emptySelect);
    });
    
    $('#country').val() == null ? $('#country').css("border","3px solid red") : $('#country').css("border", "none");
    $('#sourceOfFund').val() == null ? $('#sourceOfFund').css("border","3px solid red") : $('#sourceOfFund').css("border", "none");

    $('#idType1').val() == null ? $('#idType1').css("border","3px solid red") : $('#idType1').css("border", "none");
    if($('#idType2').is(':visible')){
      $('#idType2').val() == null ? $('#idType2').css("border","3px solid red") : $('#idType2').css("border", "none");
    }
    

    const someIsNotZero1 = idArray1.some(item => item == 0);
    const someIsNotZero2 = idArray2.some(item => item == 0);
    const someIsNotZero3 = idArray3.some(item => item == 0);
    const someIsNotZero4 = idArray4.some(item => item == 0);
    // alert(someIsNotZero1+" "+ idArray1+ " | " + someIsNotZero2+" "+ idArray2 + " | " + someIsNotZero3+" "+ idArray3 + " | " + someIsNotZero4 + " " + idArray4); /* Required fields checker */
    
    if (!someIsNotZero1 && !someIsNotZero2 && !someIsNotZero3 && !someIsNotZero4 ){
      handleView();
    }else{
      swal({
        title: 'Blank fields detected!',
        text: "Please fill-in required fields.",
        icon: 'warning',
        buttons: false,
      })
    }
 })
 
/*####################################################### STEP 2 #######################################################*/

  $('#kycForm').hide()
  $('#kycReview').hide()
  // $('#search-record').hide()
  $('#success').hide()
  $('#err').hide()

  $('#f1').attr('data-content', 'Full Name')
  $('#f2').attr('data-content', 'Present Address')
  $('#f3').attr('data-content', 'Permanent Address')
  $('#f4').attr('data-content', 'Mobile Number')
  $('#f5').attr('data-content', 'Email')
  $('#f6').attr('data-content', 'Birth Date')
  $('#f7').attr('data-content', 'Birthplace')
  $('#f8').attr('data-content', 'Occupation')
  $('#f9').attr('data-content', 'Source of Fund')
  $('#f10').attr('data-content', 'Country')
  $('#f11').attr('data-content', 'Nationality')
  $('#f12').attr('data-content', 'ID Type')
  $('#f13').attr('data-content', 'ID Number')
  $('#f14').attr('data-content', 'Date Issued')
  $('#f15').attr('data-content', 'Attached ID')
  $('#f16').attr('data-content', 'ID Type')
  $('#f17').attr('data-content', 'ID Number')
  $('#f18').attr('data-content', 'Date Issued')
  $('#f19').attr('data-content', 'Attached ID')
  $('#f20').attr('data-content', 'Attached Signature')
   
  /* FETCH ALL INPUT DETAILS */
  function handleView(){
    $('#kycReview').show('slide', {direction: 'right'}, 200)
    $('#kycForm').hide()

    userlevel         = $('#getLevel').val().trim()
    fname             = $('#fname').val().trim()
    mname             = $('#mname').val().trim()
    lname             = $('#lname').val().trim()
    addressStreet     = $('#addressStreet').val().trim()
    addressCity       = $('#addressCity').val().trim()
    addressBrgy       = $('#addressBrgy').val().trim()
    addressZip        = $('#addressZip').val().trim()
    permanentAddress  = $('#permanentAddress').val().trim()
    mobile            = $('#mobile').val().trim()
    email             = $('#emailAdd').val().trim()
    birthDate         = $('#birthDate').val().trim()
    placeOfBirth      = $('#placeOfBirth').val().trim()
    occupation        = $('#occupation').val().trim()
    sourceOfFund      = $('#sourceOfFund').val()
    province          = $('#province').val().trim()
    country           = $('#country').val().trim()
    nationality       = $('#nationality').val().trim()
    idType1           = $('#idType1').val()
    idNumber1         = $('#idNumber1').val().trim()
    dateIssued1       = $('#dateIssued1').val().trim()
    id_attachment1    = $('#id_attachment1').val()
    idType2           = $('#idType2').val()
    idNumber2         = $('#idNumber2').val().trim()
    dateIssued2       = $('#dateIssued2').val().trim()
    id_attachment2    = $('#id_attachment2').val()
    signature_attachment = $('#signature_attachment').val()

    var arr_presentAddr = [];
    if(addressStreet)
      arr_presentAddr.push(addressStreet);

    if(addressBrgy)
      arr_presentAddr.push(addressBrgy);

    if(addressCity)
      arr_presentAddr.push(addressCity);

    if(province)
      arr_presentAddr.push(province);

    if(country)
      arr_presentAddr.push(country);

    if(addressZip)
      arr_presentAddr.push(addressZip);


    var presentAddr = "";
    var count_presentAddr = arr_presentAddr.length-1;

    for(let i=0; i < count_presentAddr; i++){
      presentAddr += arr_presentAddr[i]+", ";
    }

    $('#f1').text(fname +" "+ mname +" "+ lname)
    $('#f2').text(presentAddr+arr_presentAddr[count_presentAddr])
    $('#f3').text(permanentAddress)
    mobile.slice(0,1) == 0 ? $('#f4').text("+63 " + mobile.substring(1)) : $('#f4').text("+63 " + mobile)
    $('#f5').text(email)
    $('#f6').text(birthDate)
    $('#f7').text(placeOfBirth)
    $('#f8').text(occupation)
    $('#f9').text(sourceOfFund)
    $('#f10').text(country)
    $('#f11').text(nationality)
    $('#f12').text(idType1)
    $('#f13').text(idNumber1)
    $('#f14').text(dateIssued1)
    $('#f15').text(id_attachment1)
    $('#f16').text(idType2)
    $('#f17').text(idNumber2)
    $('#f18').text(dateIssued2)
    $('#f19').text(id_attachment2)
    $('#f20').text(signature_attachment)
  }

  $('#form-prev').click(function(e){
    e.preventDefault()
    if($('#kycReview').show()){
      $('#kycReview').removeClass('form-active')
      $('#kycForm').show('slide', {direction: 'down'}, 200)
      $('#kycReview').hide()
    }
 })

  /* SUBMIT REGISTRATION FORM */
  function registerTest(){
    var formData = new FormData();

    formData.append('userlevel', userlevel);
    formData.append('fname', fname);
    formData.append('mname', mname);
    formData.append('lname', lname);
    formData.append('addressStreet', addressStreet);
    formData.append('addressCity', addressCity);
    formData.append('addressBrgy', addressBrgy);
    formData.append('addressZip', addressZip);
    formData.append('permanentAddress', permanentAddress);
    formData.append('mobile', mobile);
    formData.append('emailAdd', email);
    formData.append('birthDate', birthDate);
    formData.append('placeOfBirth', placeOfBirth);
    formData.append('occupation', occupation);
    formData.append('sourceOfFund', sourceOfFund);
    formData.append('province', province);
    formData.append('country', country);
    formData.append('nationality', nationality);
    formData.append('idType1', idType1);
    formData.append('idNumber1', idNumber1);
    formData.append('dateIssued1', dateIssued1);
    formData.append('file_upload1', $('#id_attachment1_upload')[0].files[0]);
    formData.append('idType2', idType2);
    formData.append('idNumber2', idNumber2);
    formData.append('dateIssued2', dateIssued2);
    formData.append('file_upload2', $('#id_attachment2_upload')[0].files[0]);
    formData.append('file_upload3', $('#signature_attachment_upload')[0].files[0]);

    waitingDialog.show('Posting Transaction. Please Wait.', {dialogSize: 'sm', progressType: 'primary'});
    $.ajax({
      url         :"/Kyc_form/kyc_register",
      type        :'POST',
      data        : formData,
      processData : false,
      contentType : false,
      success : function (data) {
        var jsonData = JSON.parse(data);
        // console.log("parse", jsonData)
        if(jsonData.S == 1){
          $('#kycReview').hide();

          if(jsonData.M.S == "1"){
            $('#success').show('slide', {direction: 'up'}, 200);
            $('#err').hide();

            if(jsonData.M.M == "SUCCESSFULLY UPDATED"){
              $('#update').show();
              $('#updateOld').show();
              $('#updateNew').hide();
              $('#added').hide();
              $('#addedNew').hide();
              $('#pending').hide();
              $('#addedHub').hide();
              $('#addedHubNew').hide();

            } else if(jsonData.M.M== "SUCCESSFULLY UPDATED, WAITING FOR APPROVAL"){
              $('#update').show();
              $('#updateOld').hide();
              $('#updateNew').show();
              $('#added').hide();
              $('#addedNew').hide();
              $('#pending').hide();
              $('#addedHub').hide();
              $('#addedHubNew').hide();

            } else if(jsonData.M.M== "KYC WAITING FOR APPROVAL"){
              $('#update').hide();
              $('#updateOld').hide();
              $('#updateNew').hide();
              $('#added').show();
              $('#addedNew').hide();
              $('#pending').show();
              $('#addedHub').hide();
              $('#addedHubNew').hide();

            } else if(jsonData.M.M== "SUCCESSFULLY ADDED NEW KYC BY HUB"){
              $('#update').hide();
              $('#updateOld').hide();
              $('#updateNew').hide();
              $('#added').hide();
              $('#addedNew').hide();
              $('#pending').hide();
              $('#addedHub').show();
              $('#addedHubNew').show();

            } else {
              $('#update').hide();
              $('#updateOld').hide();
              $('#updateNew').hide();
              $('#added').show();
              $('#addedNew').show();
              $('#pending').hide();
              $('#addedHub').hide();
              $('#addedHubNew').hide();
              
            }

          }else{
            $('#err').show('slide', {direction: 'up'}, 200);
            $('#success').hide();
            $('#errMessage').text(jsonData.M.M);
          }

        }else{
          $('#err').show('slide', {direction: 'up'}, 200);
          $('#success').hide();
          $('#kycReview').hide();
          $('#errMessage').text(jsonData.M.M);
        }

        waitingDialog.hide();
      }
    });

  }

  $('#btnSubmit').click(function(e){
    e.preventDefault();
    registerTest();
  })

</script>

<!-- select script -->
<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("id-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>
<script>
    function checkPass1(){ 
    
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        $('.pass-match').show()
        $('.not-match').hide()
        message.innerHTML = "Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        $('.pass-match').hide()
        $('.not-match').show()
        message.innerHTML = "Password Do Not Match!"
    }
   }


// $('#kycForm').hide()
// $('#kycReview').hide()
// $('#search-record').show()
// $('#success').hide()
</script>

<!-- DATEPICKER SCRIPT - DISABLE FUTURE DATES & 16YRS FROM PRESENT DATE -->
<script>
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear() - 16;
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    // alert(maxDate);
    $('#birthDate').attr('max', maxDate);
});

$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#dateIssued1').attr('max', maxDate);
    $('#dateIssued2').attr('max', maxDate);
});
</script>

<script>
$(function(){
    $('#idType1').on('change', function() {
      if ( this.value === 'Philhealth ID' || this.value === 'SSS ID' || this.value === 'PRC ID' || this.value === 'TIN ID' || this.value === 'Voter\'s ID')
      {
        $("#hider-secondId").show();
        $("#hider-secondId #idType2").attr('class', 'id-select form-group selOption')
        $('#hider-secondId #divID2').attr('class', 'flex-center row field')
        $('#hider-secondId #divAttachment2').attr('class', 'row attachment')
        $('#kycReview #reviewID2').show()
      }
      else
      {
        $("#hider-secondId").hide();
        $('#hider-secondId #idType2').val('')
        $('#hider-secondId #idNumber2').val('')
        $('#hider-secondId #dateIssued2').val('')
        $('#hider-secondId #id_attachment2').val('')
        $('#hider-secondId #id_attachment2_upload').val('')
        $("#hider-secondId #idType2").attr('class', 'id-select form-group')
        $('#hider-secondId #divID2').attr('class', 'flex-center row')
        $('#hider-secondId #divAttachment2').attr('class', 'row')
        $('#kycReview #reviewID2').hide()
      }

      if( $('#idType2').is(':visible'))
        if($('#idType1').val() == $('#idType2').val()){
          swal({
            title: 'MUST NOT BE THE SAME',
            text: "TYPE OF ID 1 & TYPE OF ID 2",
            icon: 'warning',
            buttons: false,
          }).then(function(){
            $('#idType1').val('')
          })
        }
    });

    $('#idType2').on('change', function() {
      if($('#idType1').val() == $('#idType2').val()){
        swal({
          title: 'MUST NOT BE THE SAME',
          text: "TYPE OF ID 1 & TYPE OF ID 2",
          icon: 'warning',
          buttons: false,
        }).then(function(){
          $('#idType2').val('')
        })
      }
    })

});
</script> 