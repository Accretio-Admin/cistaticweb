<div class="mainpanel">
	<div class="pageheader">
		<div class="media">
			<div class="pageicon pull-left">
				<i class="fa fa-shopping-cart"></i>
			</div>
			<div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL('/Main')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ONLINE SHOP</li>
                </ul>
                <h4>MLM SHOP</h4>
                <div class="w3-right-align" <?php if($user['L']=='7') echo 'style="display:none"';?> ><b>GC LIMIT <label id="gc_limit" class="w3-text-red"
                 style="margin-top:-10px; font-size:150%"></label> </b></div>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->
  <!--===================================| External Link |================================================-->	
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" 
		integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
  <!--===================================| Built-In |=====================================================-->
  	<script>
      var path='<?php echo BASE_URL().$this->router->fetch_class()?>',level='<?php echo trim($user['L']);?>',R='<?php echo trim($user['R'])?>';
	  var products=<?php echo $API;?>,page=1,data,purchases,orders,outlet,limit,transaction,wallet;
	  var cart=CryptoJS.AES.decrypt(sessionStorage.getItem("Cart")||'','îîî').toString(CryptoJS.enc.Utf8);

	  	function EntryCheck(Obj,Type){	
			var val=Obj.value;
			var size=val.length;
			var clear='';
			switch(Type){
				case 'Letter':	var	accept=/[A-Za-z.]/;			break;
				case 'LetSpc':	var	accept=/[A-Za-z. ]/;		break;
				case 'Amount':	var accept=/[0-9.-]/;			break;
				case 'Number':	var accept=/[0-9]/;				break;
				case 'TelNum':	var accept=/[0-9 -]/;			break
				case 'Mix'	 :	var accept=/[A-Za-z0-9.,]/;		break;
				case 'MixSpc':	var accept=/[A-Za-z0-9., _]/;	break;
				case 'Email' :	var accept=/[A-Za-z0-9.,@_]/;	break;
			}
			for(var ctr=0;ctr<size;ctr++){
				if(accept.test(val.substr(ctr,1)))clear+=val.substr(ctr,1);
				if(val.charCodeAt(ctr)==10 && (Type=='MixSpc' || Type=='LetSpc') )clear+=val.substr(ctr,1);
			}
			Obj.value=clear;
		  }

	  	function Searcher(Obj,Table,Option){
			Option=null||'';
			//|-------------------| Default Value |--------------------|//
			var Column='';				
			var ColStart='0';				
			var ColEnd='0';
			var RowStart='0'; 				
			var RowEnd='0';
			var input, filter, table, tr, td, i;
			//|-------------------| Redeclaration |--------------------|//
			var optionItem=Option.split(';');
			for(var ctr=0;ctr<optionItem.length;ctr++){
				objData=optionItem[ctr].split('?');
				obj=objData[0].split('=');
				switch(obj[0].toUpperCase()){
					case 'COLUMN':		Column=obj[1];		break;
					case 'COLSTART':	ColStart=obj[1];	break;
					case 'COLEND':		ColEnd=obj[1]; 		break;
					case 'ROWSTART':	RowStart=obj[1];	break;
					case 'ROWEND':		RowEnd=obj[1];		break;
					
				}
			}
			filter = Obj.value.toUpperCase();
			table = document.getElementById(Table);
			tr = table.getElementsByTagName("tr");
			for (i = RowStart; i < (tr.length-RowEnd); i++) {
				tr[i].style.display='';
				if(Column!='' && Column!=null){  
					td = tr[i].getElementsByTagName("td")[Column];
					tr[i].style.display = "none";	
					if (td.innerHTML.toUpperCase().indexOf(filter) > -1) tr[i].style.display = "";
				}
				else { 
					var str='none';
					for(var ctr=ColStart;ctr<(tr[i].getElementsByTagName('td').length-ColEnd);ctr++){
						if(tr[i].getElementsByTagName('td').item(ctr).innerHTML.toUpperCase().indexOf(filter)>-1)str='';
					}
					tr[i].style.display=str;
				}
			}
		}
		
	  function Press(e){							
		if(window.event){ var keyPress = e.keyCode;}	// IE
		else if(e.which){ var keyPress = e.which;}
		return keyPress;
	   }
	  function Submit(e,Target){	
		  console.log(e);
		  if(event.type === "click"){
			$('#'+Target).click();	
		  }
		  else{
            var code=Press(e);
            switch(code){
                case 13: $('#'+Target).click();		
				break;
            }
		  }
       } 
	  function UpdIndex(Target,Value,Index,Seperator,Logic){
			Logic=Logic||'Logic';
			var Sep=Seperator;
			if(Seperator==null||Seperator=='')Sep=',';
			if(Logic=='Logic') var data=Target;
			else			   var data=window.document.getElementById(Target).value
			data=data.split(Sep);
			var Val=Value;
			var newStr='';
			for(var ctr=1;ctr<=data.length;ctr++){
				if(ctr!=Index){
					if(newStr!='')newStr+=Sep;
					newStr+=data[ctr-1];
				}
				else{
					if(newStr!='')newStr+=Sep;
					newStr+=Value;
				}
			}
			if(Logic=='Logic') return newStr;
			else			   window.document.getElementById(Target).value=newStr;
			}

	  function DelIndex(Target,Index,Seperator,Logic){
			Logic=Logic||'Logic';
			var Sep=Seperator;
			if(Seperator==null||Seperator=='')Sep=',';
			if(Logic=='Logic') var data=Target;
			else			   var data=window.document.getElementById(Target).value
			data=data.split(Sep);
			var newStr='';
			for(var ctr=1;ctr<=data.length;ctr++){
				if(ctr!=Index){
					if(newStr!='')newStr+=Sep;
					newStr+=data[ctr-1];
				}
			}
			if(Logic=='Logic') return newStr;
			else			   window.document.getElementById(Target).value=newStr;
			}
	  function SelIndex(Target,Index,Seperator,Logic){
			Logic=Logic||'Logic';
			var Sep=Seperator;
			if(Seperator==null||Seperator=='')Sep=',';
			try{var data=window.document.getElementById(Target).value;}
			catch(e){var data=Target;}	
			data=data.split(Sep);
			var newStr='';
			for(var ctr=1;ctr<=data.length;ctr++){
				if(ctr==Index){
					newStr+=data[ctr-1];
					break;
				}
			}
			if(Logic=='Logic') return newStr;
			else			   window.document.getElementById(Target).value=newStr;
			}

	  function AddIndex(Target,Value,Seperator,Logic){
			Logic=Logic||'Logic';
			var Sep=Seperator; 
			if(Seperator==null||Seperator=='')Sep=',';
			if(Logic=='Logic') var Str=Target;
			else				var Str=window.document.getElementById(Target).value;
			if(Str!='')Str+=Sep;
			Str+=Value;
			if(Logic=='Logic') return Str;
			else				window.document.getElementById(Target).value=Str;
			}
	  function GetValue(ID){
        var check='';
        try{
          check=document.getElementById(ID).value.trim();
        }
        catch(e){
          var no=document.getElementsByName(ID).length;
          if(no>1){
            for(var ctr=0;ctr<no;ctr++){	
              if(document.getElementsByName(ID).item(ctr).checked==true){ 
                check=document.getElementsByName(ID).item(ctr).value; 
                break;
              }
            }
          }
          else check=document.getElementsByName(ID).item((no-1)).value; 
        }
        return check;
       }
        function GatherData(Form) {
			var data='{';
				var Form=document.getElementById(Form);
				data+= '"regcode": '+'"F9130379"';
				for (var i=0;i<Form.length;i++){
					if(Form.elements[i].name.trim()!=''){
						switch(Form.elements[i].type){
							case 'radio': 
							if(Form.elements[i].checked==true){
								if(data!='{')data+=','; 
								data+='"'+Form.elements[i].name+'":"'+encodeURIComponent(Form.elements[i].value)+'"';  
							}
							break;		
							case 'checkbox':
							if(data!='{')data+=','; 
							if(Form.elements[i].checked==true)
							data+='"'+Form.elements[i].name+'":"'+encodeURIComponent(Form.elements[i].value)+'"';
							else data+='&'+Form.elements[i].name+'='+0;
							break;
							default:
							if(data!='{')data+=','; 
							data+='"'+Form.elements[i].name+'":"'+encodeURIComponent(Form.elements[i].value)+'"';
						}
					}
			}
			
			data+='}';//alert(data);
			console.log(data);
			return JSON.parse(data);
        }
      function Currency(n) {
        return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        }
      function Toggle(ID){
          var obj=document.getElementsByClassName('divItems');
          var sz=obj.length;
          for(var x=0;x<sz;x++){
            (ID==obj[x].id)?jQuery("#"+obj[x].id).slideToggle(250):jQuery("#"+obj[x].id).slideUp(250);
          }
       }
      $(document).ready(function(){//UPSBEA0010|4,UPSWEL004|4
				console.log('-----------------------------| Above Built-In Error |----------------------------------');
        		//|----------------------| Add Cart |-------------------------|//
					$('#BTNAddCart').click(()=>{
						var str=''
						var details = []
						var canAdd = true

						if (cart != '') {
							var itm = cart.split(',');

							//Get the first item in cart
							for (var x = 0; x < itm.length; x++) {
								details=itm[x].split('-')

								data = products.DATA_LIST.filter((data) => {
									return (data.ID==details[0]) ? data: null
								})
							}

							var cebuRMRegs = [
								'RMGLB', 'RMDBA', 'RMLVM', 'RMSWS', 'RMGLB10', 'RMLVM10', 'RMJ'
							]

							var manilaRMRegs = [ 
								'RMDIN', 'RMKAL', 'RMMIR', 'RMNF', 'RMRP', 'RMRS', 'RMSL', 'RMTPG', 'RMSC', 'RMSP', 'RMSS', 'RMSU'
							]
							
							//Add Product Restriction
							if (cebuRMRegs.includes(data[0].product_code)) {
								if (cebuRMRegs.includes($('#ProductCode').html())) {
									canAdd = true
								} else {
									alert('Products in cart should be for pickup in Cebu only.')
									canAdd = false
								}
							} else if (manilaRMRegs.includes(data[0].product_code)) {
								if (manilaRMRegs.includes($('#ProductCode').html())) {
									canAdd = true
								} else {
									alert('Products in cart  should be for deliver in Metro Manila only.')
									canAdd = false
								}
							} else { 
								if (!manilaRMRegs.includes($('#ProductCode').html()) && !cebuRMRegs.includes($('#ProductCode').html())) {
									canAdd = true
								} else {
									alert('Product in cart should be non-ricemart product only.')
									canAdd = false
								}
							}
						}

						if ($('#QTY').val() == "0" || $('#QTY').val() == "" || $('#QTY').val() == null) {
							alert("Please Input quantity atleast 1")
						} else if (canAdd) {
							var str=$('#ProductID').html()+'-'+$('#QTY').val()
							cart=AddIndex(cart,str);
							sessionStorage.setItem("Cart",CryptoJS.AES.encrypt(cart,'îîî'))
							readCart()
							$('#QTY').val(1)
							note('New Item Added to Cart')

							$('.tbl-weight').addClass("w3-hide")

							if (GetValue('remarks')=='For Deliver') {
								$('#weight').removeClass("w3-hide")
								$('.tbl-weight').removeClass("w3-hide")
								$(".LocationRM").prop("selected", true)
							} else {
								$('#weight').addClass("w3-hide")
								$('.tbl-weight').addClass("w3-hide")
							}	

							var count = $("#List td").closest("tr").length
                        	$('#cartCount').text(count)
						}
					});
				//|----------------------| Clear Cart |-----------------------|//
					$('#BTNCancel').click(()=>{
						sessionStorage.setItem("Cart",'');
						cart='';
						// $('#Delivery').removeClass("w3-hide");
						$('.Ricemart').attr("hidden",false);
						$('#ShippingRates').val('0.00');
						$('#TAmount').val('0.00');
						$(".LocationRM").prop("selected", true);
						sessionStorage.removeItem('shiprate');
						readCart();

						var count = $("#List td").closest("tr").length;
                        $('#cartCount').text(count);
					});
				//|----------------------| Check Out |------------------------|//
					$('#BTNCheckOut').click(() => {
						var location_id = $('#Deliver').find(":selected").val();
						var location_id2 = $('#Outlet').find(":selected").val();
						var MainData = GatherData('Main');
						console.log(MainData)
						$('#divDelivery').addClass("w3-hide");
						if(GetValue('remarks')=='For Deliver')$('#divDelivery').removeClass("w3-hide");
						if(location_id == '' && GetValue('remarks')=='For Deliver'){
							alert('Please Select Location');
						}else if(location_id2 == '' && GetValue('remarks')=='For Pickup'){
							alert('Please Select Outlet');
						}else {
							$('#modalPaymentMode').modal('show');
						}
						var count = $("#List td").closest("tr").length;
                        $('#cartCount').text(count);
					});
					$('#BTNProductCart').click(() => {
                        $('#modalProductCart').modal('show');
                    })
				//|----------------------| Deliver MLM Location |------------------------|//					
					$("#Deliver").on('change',function(){
						// Alert Location
						var displayLocation = $("#Deliver option:selected").text();

						var delivery_location = displayLocation.toLowerCase();

						//getting ID value of location pass to $location_id to PHP
						var location_id = $('#Deliver').find(":selected").val();

						var fetchProvince = $.ajax({
									type: 'post',
									url: path+'/MLMProvince_MLM',
									data: { location_id: location_id },
										success: function(response){
											let res = JSON.parse(response);
											$('#provinceMLM').html(res.option);
										}
								});	
						$("#location").val(displayLocation);

						if(location_id == "1" || location_id == "2" || location_id == "5" ){
							// NCR/Luzon/Island = ***REG123 notify hub using regcode and get hub location***
							hub_regcode = "REG123";
							hub_location = "manila";
							
							// Setup Regcode to connect in HUB Branch
								if(location_id == "1") {	
									delivery_location = "manila";
									shipping_location = hub_location+"_"+delivery_location;
										// Fetch Province;
										fetchProvince	
										// alert(hub_regcode);		
									sessionStorage.setItem("location_id","1");
									weightid = sessionStorage.getItem("weight").toString();
									shipweightid = sessionStorage.getItem("shipweight").toString();
									weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
									console.log("weight",weightfromkg);
									shiprate = weightfromkg[weightid].manila_manila;
									if(shipweightid==0.00){
										shiprate = 0.00;
									}
									$('#ShippingRates').val(shiprate);
									sessionStorage.setItem("shiprate",shiprate);
									readCart();
								} else if(location_id == "2") {	
									delivery_location = "luzon";
									shipping_location = hub_location+"_"+delivery_location;
										// Fetch Province;
										fetchProvince	
										// alert(hub_regcode);
									sessionStorage.setItem("location_id","2");
									weightid = sessionStorage.getItem("weight").toString();
									weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
									shiprate = weightfromkg[weightid].manila_luzon;
									$('#ShippingRates').val(shiprate);
									sessionStorage.setItem("shiprate",shiprate);
									readCart();
								} 
								else {
									shipping_location = hub_location+"_"+delivery_location;
										// Fetch Province;
										fetchProvince
										// alert(hub_regcode);
									sessionStorage.setItem("location_id","5");
									weightid = sessionStorage.getItem("weight").toString();
									weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
									shiprate = weightfromkg[weightid].manila_island;
									$('#ShippingRates').val(shiprate);
									sessionStorage.setItem("shiprate",shiprate);
									readCart();
								}
						} else if(location_id == "3") {
							// Visayas = 13979797 notify hub using regcode
							hub_location = "visayas";
							hub_regcode = "13979797";
							// hub_location = visayas;
							shipping_location = hub_location+"_"+delivery_location;
								// Fetch Province
								fetchProvince		
								// visayas_delivery_location		
								// alert(hub_regcode);
							sessionStorage.setItem("location_id","3");
							weightid = sessionStorage.getItem("weight").toString();
							weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
							shiprate = weightfromkg[weightid].visayas_visayas;
							$('#ShippingRates').val(shiprate);
							sessionStorage.setItem("shiprate",shiprate);
							readCart();
						} else if(location_id == "4") {
							// Mindanao = FH000016 notify hub using regcode	
							hub_location = "mindanao";
							hub_regcode = "FH000016";
							// hub_location = mindanao;
							shipping_location = hub_location+"_"+delivery_location;
								// Fetch Province
								fetchProvince					
								// alert(hub_regcode);
							sessionStorage.setItem("location_id","4");
							weightid = sessionStorage.getItem("weight").toString();
							weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
							shiprate = weightfromkg[weightid].mindanao_mindanao;
							$('#ShippingRates').val(shiprate);
							sessionStorage.setItem("shiprate",shiprate);
							readCart();
						}

					});

					$('#provinceMLM').on('change',function(){
						// Alert Province
						// var displayProvince = $("#province option:selected").text();

						var province_id = $('#provinceMLM').find(":selected").val();

						var fetchCity = $.ajax({
									type: 'post',
									url: path+'/MLMCity_MLM',
									data: { province_id: province_id },
										success: function(response){
											let res = JSON.parse(response);
											$('#cityMLM').html(res.option);
											// console.log(response);
										}
								});	

						if(province_id == province_id) {
							// Fetch City
							fetchCity				
							// alert(province_id);				
						} 

					});			
				//|----------------------| Pay Out |--------------------------|//
					$('#BTNPayout').click(() => {
						var province = $('#provinceMLM').find(":selected").val();
						var city = $('#cityMLM').find(":selected").val();
						var onlyNCR = $('#Deliver').find(":selected").val();
						var chk=1,msg='Unable to Continue, Please check the following:\n';
						var regcode = $('#user-regcode').val();
						console.log(regcode)
						console.log("regcode here")

						//console.log('Cart:'+$('#Cart').val());
						//console.log('Outlet:'+$('#Outlet').val());

						if(province=='' && GetValue('remarks')=='For Deliver'){
							msg+='\nPlease Select Province';
						}
						if(city=='' && GetValue('remarks')=='For Deliver'){
							msg+='\nPlease Select City';
						}
						if(GetValue('remarks')=='For Deliver' && onlyNCR != '1'){
								if( data[0].product_code=='RMDIN'||
									data[0].product_code=='RMKAL'||
									data[0].product_code=='RMMIR'||
									data[0].product_code=='RMNF'||
									data[0].product_code=='RMRP'||
									data[0].product_code=='RMRS'||
									data[0].product_code=='RMSL'||
									data[0].product_code=='RMTPG') {
									
									msg+='\nOnly Applicable in Metro Manila';
							} else {
								chk=1;
							}
						}	
						if($('#Cart').val()==''){
							chk=0;
							msg+='\nNo Item in the cart';
						}
						if( ($('#Outlet').val()=='' || $('#Outlet').val()==null) && GetValue('remarks')=='For Pickup'){
							chk=0;
							msg+='\nNo Outlet Selected';
						}
						if($('#PaymentType').val()==''||$('#PaymentType').val()==null){
							chk=0;
							msg+='\nNo Payment Option Selected';
						}
						if(limit<Number($('#total-gcprice').val().replace(',', '')) && $('#PaymentType').val()=='GC'){
							chk=0;
							msg+='\nSorry, your total GC purchase is already exceed and consumed your daily limit. Please try again next day.';							
						}
						if(1500>Number($('#total-gcprice').val().replace(',', '')) && $('#PaymentType').val()=='GC'){
							chk=0;
							msg+='\nSorry, your total GC purchase did not meet 1,500 minimum transaction. Please add more products or use other payment mode.';							
						}
						if($('#PaymentType').val()=='GC') {
							var itm=$('#Cart').val().split(','),x,sz,detail,list='',gcItem=0,pickup=0;
							sz=itm.length;
							for(x=0;x<sz;x++){ 
								detail=itm[x].split('|');//console.log(detail[0]);
								if(detail[0]=='UPSDEV0001' || detail[0]=='UPSDEV0002' || detail[0]=='UPSDEV0003'){pickup=1;chk=0;}
								GetProduct(detail[0]);
								if(data[0].gc_allow==0){gcItem=1;chk=0;
									if(list!='')list+=',';
									list+=detail[0];
								}
							}
							if(gcItem==1)msg+='\nPurchased not Successful, "'+list+'" is not allowed in the payment option.';
							if(pickup==1 && GetValue('remarks')=='For Deliver')msg+='\nOne of your item in cart is not allowed for deliver transaction.';
							if(pickup==1 && $('#Outlet').val()!='F756342')msg+='\nOne of your item in cart is only allowed to pickup in Quezon Branch.';
						}
						switch($('#PaymentType').val()){
							// case 'ECASH':	var amt=Number($('#total-dcprice').val().replace(',', '')),bal=Number(wallet.Data[0].ECash)-Number(wallet.Data[0].MLMECash);break;
							case 'ECASH':	var amt=Number($('#total-dcprice').val().replace(',', '')),bal=Number(wallet.Data[0].ECash) - Number(wallet.Data[0].MLMECash);break;
							case 'GC':		var amt=Number($('#total-gcprice').val().replace(',', '')),bal=Number(wallet.Data[0].GC) - Number(wallet.Data[0].MLMGC);break;
							case 'PV':		var amt=Number($('#total-pvprice').val().replace(',', '')),bal=Number(wallet.Data[0].PV) - Number(wallet.Data[0].MLMPV);break;
						}
						if(amt>bal){
							chk=0;
							msg+='\nSorry you don\'t have sufficient balance to proceed this purchase.';
						}
						if(chk==1){
							PayOut();
							$('#modalProductCart').modal('hide');
						}else{
							alert(msg);
						}
					});
				//|----------------------| Search |---------------------------|//
					$('#btnSearch').click(()=>{
						//console.log(path+'/'+$('#txtSearch').val());
						window.open(path+'/MLMShop/'+$('#txtSearch').val(),'_self');
					});  	
				//|-----------------------------------------------------------|//
				GetProduct();
				if(level!=7){
					GetPurchases();
					GetTransaction();
					GetOutlet();
					GetGC();
					term();
				}
				if(level==7)
					GetPurchases();
					GetTransaction();
					GetOutlet();
					GetGC();
					
					GetOrders();
					GetWallet();
					readCart(); 
					term();
				if(level==7)view('divDisplay','divProducts', 'divOrders');
				else view('divDisplay','divProducts');
				console.log('-----------------------------| Below Built-In Error |----------------------------------');
		});
	  //|----------------------| View Cart |----------------------|//
	   	const viewCart=(ID,Type)=>{
			var records=orders,x,str='',prc,gc,pv,dis,qty,wght,total=0,totalprc=0,totaldis=0,totalqty=0,totalgc=0,totalpv=0,grandtotal=0,totalpw=0;   
			 if(Type=='Purchase')   records=purchases;
			var data=records.Data.filter((data)=>{
				return (data.rowid==ID)?data:null;
							return data;
				});
			
			for(x in data[0].Cart){
				prc=Number(data[0].Cart[x].price * data[0].Cart[x].quantity);			totalprc  +=prc;
				gc=Number(data[0].Cart[x].gc_price * data[0].Cart[x].quantity);			totalgc   +=gc;
				pv=Number(data[0].Cart[x].pv * data[0].Cart[x].quantity);				totalpv   +=pv;
				if(	data[0].Cart[x].product_code=='RMDIN'||
					data[0].Cart[x].product_code=='RMKAL'||
					data[0].Cart[x].product_code=='RMMIR'||
					data[0].Cart[x].product_code=='RMNF'||
					data[0].Cart[x].product_code=='RMRP'||
					data[0].Cart[x].product_code=='RMRS'||
					data[0].Cart[x].product_code=='RMSL'||
					data[0].Cart[x].product_code=='RMTPG'){
					dis=Number(data[0].Cart[x].price * 1 * data[0].Cart[x].quantity);totaldis  +=dis;
				} else {
					dis=Number(data[0].Cart[x].price * 0.7 * data[0].Cart[x].quantity);totaldis  +=dis;
					}
				qty=Number(data[0].Cart[x].quantity);									totalqty  +=qty;
				wght=Number(data[0].Cart[x].weight * data[0].Cart[x].quantity);			totalpw	  +=wght;
				str +='<tr><td width="150" class="w3-center">'+data[0].Cart[x].product_code+'</td>\
						   <td class="w3-center">'+data[0].Cart[x].product_name+'</td>\
						   <td width="100" class="w3-center">'+qty+'</td>\
						<?php if($this->user['R'] == 'F7897947'){ ?>
						   <td width="100" class="w3-center">'+wght+'</td>\
						<?php	}?>
						   <td width="100" class="w3-right-align">'+Currency(prc)+'</td>\
						   <td width="100" class="w3-right-align">'+Currency(gc)+'</td>\
						<?php if($this->user['R'] == '1234567'){ ?>
						   <td width="100" class="w3-right-align">'+Currency(dis)+'</td>\
						<?php	}?>
						   <td width="100" class="w3-right-align">'+Currency(pv)+'</td></tr>';
			} 
			$('#pdfLink').prop({
				"href":"https://mobilereports.globalpinoyremittance.com/portal/mlm_receipt/"+data[0].Cart[0].trackingno,
				"target":"_blank"});
			$('#lblTrack').html(data[0].Cart[0].trackingno);
			$('#tPrice').html(Currency(totalprc));
			$('#tGCPrice').html(Currency(totalgc));
			$('#tDPrice').html(Currency(totaldis)); 
			$('#tPVPrice').html(Currency(totalpv));
			$('#tQty').html(totalqty);
			$('#tWght').html(totalpw);
			$('#cartList').html(str);
			$('#viewCart').modal('show');
		}
	  //|----------------------| Orders |-------------------------|//
	  	GetOrders=()=>{
			$('#Task').val('GetOrders');
			$.ajax({
				data:GatherData('Main'),
				type:'post',
				url: path+'/MLMShop', 
				beforeSend:function(){
					//console.log('Sending:'+JSON.stringify(GatherData('Main')));
					$('#OrderList').html('<tr><td colspan="100%"><center><img src="<?php echo BASE_URL().'assets/images/Loading.gif'?>"></center></td></tr>');
				},
				success: function(result){
					//console.log('Get Order Response:'+result);
					orders=JSON.parse(result);
					if(orders.S==2 || orders.S==0)GetOrders();
					else		   viewOrder();
				}
			});
		}
	  //|----------------------| Purchases |----------------------|//
		GetPurchases=()=>{
			$('#Task').val('GetPurchases');
			$.ajax({
				data:GatherData('Main'),
				type:'post',
				url: path+'/MLMShop', 
				beforeSend:function(){
					//console.log('Sending:'+JSON.stringify(GatherData('Main')));
					$('#PurchaseList').html('<tr><td colspan="100%"><center><img src="<?php echo BASE_URL().'assets/images/Loading.gif'?>"></center></td></tr>');
				},
				success: function(result){
					//console.log('Get Purchases Response:'+result);
					purchases=JSON.parse(result);
					if(purchases.S==2 || purchases.S==0)GetPurchases();
					else			  viewPurchase();
				}
			});
		}
	  //|----------------------| Transaction |--------------------|//
		GetTransaction=()=>{
			$('#Task').val('TRANSACTION');
			$.ajax({
				data:GatherData('Main'),
				type:'post',
				url: path+'/MLMShop', 
				beforeSend:function(){
					//console.log('Sending:'+JSON.stringify(GatherData('Main')));
					$('#TransactionList').html('<tr><td colspan="100%"><center><img src="<?php echo BASE_URL().'assets/images/Loading.gif'?>"></center></td></tr>');
				},
				success: function(result){
					//console.log('Get Purchases Response:'+result);
					transaction=JSON.parse(result);
					if(transaction.S==2 || transaction.S==0)GetTransaction();
					else			  viewTransaction();
				}
			});
		}	
	  //|----------------------| Outlet |-------------------------|//
	  	GetOutlet=()=>{
			$('#Task').val('GetOutlet');
			$.ajax({
				data:GatherData('Main'),
				type:'post',
				url: path+'/MLMShop', 
				beforeSend:function(){
					$('#Outlet').html('<option value="">Please wait...</option>');
				},
				success: function(result){
					//console.log('Get Outlet Response:'+result);
					outlet=JSON.parse(result);
					if(outlet.S==2 || outlet.S==0)GetOutlet();
					else{
						var str='<option value="" disabled selected>PLEASE SELECT OUTLET</option>';
						for (x in outlet.Data) {
							str+='<option value="'+outlet.Data[x].Regcode+'">'+outlet.Data[x].Area.toUpperCase()+'</option>';	
						}
						$('#Outlet').html(str);
					}
				}
			});
		}	
	  //|----------------------| Pay Out |------------------------|//
		PayOut=() => {
			$('#Task').val('PayOut');
			console.log(GatherData('Main'));
		
			$.ajax({
				data:GatherData('Main'),
				type:'post',
				url: path+'/MLMShop', 
				beforeSend:function(){
					$('#BTNClose').click();
					note('Please wait... Processing....',20000);

					//console.log('Sending:'+JSON.stringify(GatherData('Main')));
					//$('#PurchaseList').html('<center><img src="<?php echo BASE_URL().'assets/images/Loading.gif'?>"></center>');
				},
				success: function(result){
					//console.log('Payout Response:'+result);
					var res=JSON.parse(result);
					if(res.S==2)PayOut();
					else{
						$('#BTNCancel').click();
						GetPurchases();
						GetWallet();
						GetGC();
						GetTransaction();
						note(res.M + ' <a href="https://mobilereports.globalpinoyremittance.com/portal/mlm_receipt/'+res.TN+'" target="_blank">\
								  <i class="fa fa-file-pdf-o" style="color:white" ></i></a>',60000);	
					}
					
				}
			});
		}	
	  //|----------------------| Read Cart |----------------------|//
		const readCart=()=>{
			var str='',details=[],txt='',prc=0,totalpv=0,total=0,totalgc=0,totaldc=0,totalpw=0;
			if(cart!=''){
				var itm=cart.split(','); 

				for(var x=0;x<itm.length;x++){
					details=itm[x].split('-');
					data=products.DATA_LIST.filter((data)=>{
						return (data.ID==details[0])?data:null;
					});
					// console.log("data",data)
					prc=data[0].price;

					var rmPcNoDiscFilter = [
						'RMDIN', 
						'RMKAL', 
						'RMSC', 
						'RMSU', 
						'RMSP', 
						'RMSS', 
						'RMMIR', 
						'RMNF', 
						'RMRP', 
						'RMRS', 
						'RMSL', 
						'RMTPG', 
						'RMGLB', 
						'RMDBA', 
						'RMSWS', 
						'RMLVM',
						'RMGLB10',
						'RMLVM10',
						'RMJ'
					]

					var dprice = prc
					rmPcNoDiscFilter.includes(data[0].product_code) ? dprice * 1 : dprice * 0.7

					cebuRMRgCodes = [
						'RMDBA',
						'RMGLB',
						'RMLVM',
						'RMSWS',
						'RMGLB10',
						'RMLVM10',
						'RMJ'
					]

					// manilaRM = [
					// 	'RMKAL',
					// 	'RMDIN',
					// 	'RMTPG',
					// 	'RMNF',
					// 	'RMMIR',
					// 	'RMSL',
					// 	'RMRS',
					// 	'RMRP'
					// ]

					if (cebuRMRgCodes.includes(data[0].product_code)) {
						prc = parseFloat(prc)
						
						if (level === '7' || level === '16') { //Reorder - ECPC/HUB Price for CEBU
							prc = Math.round(prc + (prc * 0.03))
						} else if (level === '1' || level === '6') { //Reorder - Dealer Price CEBU
							prc = Math.round(prc + (prc * 0.05))
						} else if (level === '5') { //Reorder - Non Member/Retail CEBU
							prc = Math.round(prc + (prc * 0.06))
						}

						prc = prc.toFixed(2)
					}
					// else if(manilaRM.includes(data[0].product_code)){
					// 	if (level === '1' || level === '6') {
					// 		prc = Math.round(prc + (prc * 0.05))
					// 	}
					// 	prc = prc.toFixed(2)
					// }

					//| Temporary
					if(data[0].ID==75)dprice=prc*0.5;
					total+=(prc*details[1]);
					totalpv+=Number(data[0].pv*details[1]);	
					totalgc+=(data[0].gc_price*details[1]);
					totaldc+=(dprice*details[1]);
					totalpw+=(details[1]*data[0].weight); // plus 150 grams shipping rates

					var rm25Kg = ['RMDIN', 'RMKAL', 'RMMIR', 'RMNF', 'RMRP', 'RMTPG', 'RMGLB', 'RMDBA', 'RMSWS', 'RMLVM', 'RMJ']
					var rm10Kg = ['RMGLB10', 'RMLVM10']
					var rm50Kg = ['RMRS', 'RMSL']

					var tKg = rm25Kg.includes(data[0].product_code) ? 25 : (rm50Kg.includes(data[0].product_code) ? 50 : (rm10Kg.includes(data[0].product_code) ? 10 : data[0].weight))
					var totalpw2 = parseFloat(details[1] * tKg).toFixed(2)
					
					// console.log("total1", totalpw); //total product weight
					// console.log("total2", totalpw2); //weight per product
					// weight_from_KG send to ShippingRate_post to get rates 
					// var totalpw = parseFloat(details[1]*data[0].weight).toFixed(2);
					
					if(txt!='')txt+=',';
					txt+=data[0].product_code+'|'+details[1];
					str+='<tr class="w3-border-bottom">\
							<td class="w3-center">\
								<i class="fa fa-plus-square icon-plus" id="plus" style="font-size:100%" 	onclick="UpdProduct(\''+(x+1)+'\',\''+itm[x]+'\',1)"></i> \
								<i class="fa fa-minus-square icon-minus" id="minus" style="font-size:100%" onclick="UpdProduct(\''+(x+1)+'\',\''+itm[x]+'\',-1)"></i></td>\
							<td class="w3-center">'+details[1]+'</td>\
							<td class="w3-center">'+data[0].product_code+'</td>\
							<td class="w3-center">'+data[0].product_name+'</td>\
							<td class="w3-center tbl-weight" id="tbl-weight">'+totalpw2+'&nbsp;KG'+'</td>\
							<td class="w3-center hideCol Price" >'+Currency(Number(prc*details[1]))+'</td>\
							<td class="w3-center hideCol GC" >'+Currency(Number(data[0].gc_price*details[1]))+'</td>\
							<td class="w3-center hideCol Discount" >'+Currency(Number(dprice*details[1]))+'</td>\
							<td class="w3-center hideCol PV" >'+Currency(Number(data[0].pv*details[1]))+'</td>\
							<td class="w3-center"><i class="fa fa-times" style="font-size:80%" title="Removed" onclick="DelProduct(\''+(x+1)+'\')"></i></td>\
					</tr>';
				}
			}
			$('#List').html(str); 
			$('#total-price').val(Currency(total));
			$('#total-pvprice').val(Currency(totalpv));
			$('#total-dcprice').val(Currency(totaldc));
			$('#total-gcprice').val(Currency(totalgc));
			// var a = str_contains(txt,"RM")
			var ricepackaged = txt.includes('RMDIN') || txt.includes('RMKAL') || txt.includes('RMMIR') || txt.includes('RMNF') || txt.includes('RMRP') || txt.includes('RMRS') || txt.includes('RMSL') || txt.includes('RMTPG') || txt.includes('RMSC') || txt.includes('RMSU') || txt.includes('RMSP') || txt.includes('RMSS');

			var riceCebuPackaged = txt.includes('RMDBA') || txt.includes('RMGLB') || txt.includes('RMLVM') || txt.includes('RMSWS') || txt.includes('RMGLB10') || txt.includes('RMLVM10') || txt.includes('RMJ')

			if(ricepackaged == true){
				const ricepack = new Array(txt);
				const checkmatch = ricepack.find(element => {
					if (element.includes('UPS')) {
						$('.Ricemarts').attr("hidden",false);
						sessionStorage.setItem("RicemartField",'UNHIDE');
					}else{
						$('.Ricemarts').attr("hidden",true);
						sessionStorage.setItem("RicemartField",'HIDE');
					}
				});
				$('.locations').attr("hidden",true);
				$('.vGCPrice').attr("hidden",true);
				$('.vVPrice').attr("hidden",true);
				$('.vVDiscount').attr("hidden",true);
				$('.Ricemart').attr("hidden",true);

				$('#FPickup').addClass("w3-hide");
				$("#radioDeliver").prop("checked", true);
				
				$('#Outlet').val("");
				$('#Outlet').addClass("w3-hide");
				$('#Deliver').removeClass("w3-hide");
				// $('#Delivery').addClass("w3-hide");
				$('#Total-Amount').removeClass("w3-hide");
				$(".Priced").prop("selected", true);
				// $(".LocationRM").prop("selected", true);
				$('.RM_notification').removeClass("w3-hide");
				$('.RMProductManilaWord').attr("hidden",false);
				$('.RMProductCebuWord').attr("hidden",true);
				$('.PType').attr("hidden",true);
				// var ships = '0.00';
				// $('#ShippingRates').val(ships);
				// var TAmount = total;
				var ships = JSON.parse(sessionStorage.getItem('shiprate'));
				var TAmount = total+ships;
			} else if (riceCebuPackaged == true && ricepackaged == false) {
				const ricepack = new Array(txt);
				const checkmatch = ricepack.find(element => {
					if (element.includes('UPS')) {
						$('.Ricemarts').attr("hidden",false);
						sessionStorage.setItem("RicemartField",'UNHIDE');
					}else{
						$('.Ricemarts').attr("hidden",true);
						sessionStorage.setItem("RicemartField",'HIDE');
					}
				});
				$('.locations').attr("hidden",true);
				$('.vGCPrice').attr("hidden",true);
				$('.vVPrice').attr("hidden",true);
				$('.vVDiscount').attr("hidden",true);
				$('.Ricemart').attr("hidden",true);;

				$('#FDeliver').addClass("w3-hide");
				$('#radioPickup').prop("checked", true);
				
				$('#Outlet').val("");
				$('#Outlet').removeClass("w3-hide");
				$('#Deliver').addClass("w3-hide");

				// $('#Delivery').addClass("w3-hide");
				$('#Total-Amount').removeClass("w3-hide");
				$(".Priced").prop("selected", true);
				// $(".LocationRM").prop("selected", true);
				$('.RM_notification').removeClass("w3-hide");
				$('.RMProductManilaWord').attr("hidden",true);
				$('.RMProductCebuWord').attr("hidden",false);
				$('.PType').attr("hidden",true);
				// var ships = '0.00';
				// $('#ShippingRates').val(ships);
				// var TAmount = total;
				var ships = JSON.parse(sessionStorage.getItem('shiprate'));
				var TAmount = total+ships;
			} else  {
				$('.PType').attr("hidden",false);
				$('.locations').attr("hidden",false);
				$('.vGCPrice').attr("hidden",false);
				$('.vVPrice').attr("hidden",false);
				$('.vVDiscount').attr("hidden",false);
				$('.Ricemart').attr("hidden",false);

				$('.RMProductManilaWord').attr("hidden",true);
				$('.RMProductCebuWord').attr("hidden",true);

				$('#FPickup').removeClass("w3-hide");
				$('#FDeliver').removeClass("w3-hide");
				$("#radioDeliver").prop("checked", true);

				$('#Outlet').addClass("w3-hide");
				$('#Deliver').removeClass("w3-hide");

				$('.RM_notification').addClass("w3-hide");

				var ships = JSON.parse(sessionStorage.getItem('shiprate'));
				var TAmount = total+ships;
			}

			var field = sessionStorage.getItem('RicemartField');
			if(field == "HIDE"){
				$('#TAmount').val(Currency(TAmount));
			}else{
				$('#TAmount').val(Currency(totaldc+ships));
			}
			$('#Cart').val(txt);
			viewCol($('#veiwPrice').val());

			//|----------------------| Shipping Rates |---------------|//
			if(totalpw){
				weight_from_KG=parseFloat(totalpw+0.15).toFixed(2);
			}else{
				weight_from_KG=parseFloat(totalpw).toFixed(2);
			}
			
			if($("#ShippingRates").on('change',function(){})){
				if(weight_from_KG <= '0.50'){
					weightid = Math.floor(weight_from_KG);
				}else if(weight_from_KG >= '0.51' && weight_from_KG <= '0.99'){
					weightid = Math.floor(weight_from_KG)+1;
				}else{
					weightid = Math.floor(weight_from_KG)+1;
				}
				sessionStorage.setItem("weight",weightid);
				sessionStorage.setItem("shipweight",weight_from_KG);
			}

			// if(totalpWeight >= "3" && GetValue('remarks')=='For Deliver'){
			// 	$("#plus").addClass("w3-hide");
			// 	// alert(totalpWeight);
			// } else {
			// 	$("#plus").removeClass("w3-hide");
			// }

			
			
			//|-------------------------------------------------------|//
		}
	  //|----------------------| Remove Cart Item |---------------|//
		const DelProduct=(Idx)=>{
			cart=DelIndex(cart,Idx);
			sessionStorage.setItem("Cart",CryptoJS.AES.encrypt(cart,'îîî'));
			readCart();
			hideWeight();
			if(!cart){
				$('#Deliver option').prop('selected', function() {
					return this.defaultSelected;
				});
				$('#ShippingRates').val('0.00');
				readCart();
				hideWeight();
			}	

			if(Idx == 1){
				sessionStorage.removeItem('shiprate');
				$('#ShippingRates').val('0.00');
				readCart();
				hideWeight();
			}else{
				weightid = sessionStorage.getItem("weight").toString();
				weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
				shiprate = weightfromkg[weightid].manila_manila;
				$('#ShippingRates').val(shiprate);
				sessionStorage.setItem("shiprate",shiprate);
				readCart();
				hideWeight();
			}

			var count = $("#List td").closest("tr").length;
			$('#cartCount').text(count);
			$('#ShippingRates').val('0.00');
			sessionStorage.setItem("shiprate",'0');
			$(".LocationRM").prop("selected", true);
			readCart();
		}
	  //|----------------------| Modify Cart Item |---------------|//
		const UpdProduct=(Idx,Itm,Val)=>{
			details=Itm.split('-');
			QTY=Number(details[1])+Val;
			if(QTY>=1){
				cart=UpdIndex(cart,details[0]+'-'+QTY,Idx);
				sessionStorage.setItem("Cart",CryptoJS.AES.encrypt(cart,'îîî'));
				readCart();
				hideWeight();
				var location_id = sessionStorage.getItem("location_id").toString();
				if(location_id == '1'){
					weightid = sessionStorage.getItem("weight").toString();
					shipweightid = sessionStorage.getItem("shipweight").toString();
					weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
					shiprate = weightfromkg[weightid].manila_manila;
					if(shipweightid==0.00){
						shiprate = 0.00;
					}
					$('#ShippingRates').val(shiprate);
					sessionStorage.setItem("shiprate",shiprate);
					readCart();
				}else if(location_id == '2'){
					weightid = sessionStorage.getItem("weight").toString();
					weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
					shiprate = weightfromkg[weightid].manila_luzon;
					$('#ShippingRates').val(shiprate);
					sessionStorage.setItem("shiprate",shiprate);
					readCart();
				}else if(location_id == '3'){
					weightid = sessionStorage.getItem("weight").toString();
					weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
					shiprate = weightfromkg[weightid].visayas_visayas;
					$('#ShippingRates').val(shiprate);
					sessionStorage.setItem("shiprate",shiprate);
					readCart();
				}else if(location_id == '4'){
					weightid = sessionStorage.getItem("weight").toString();
					weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
					shiprate = weightfromkg[weightid].mindanao_mindanao;
					$$('#ShippingRates').val(shiprate);
					sessionStorage.setItem("shiprate",shiprate);
					readCart();
				}else if(location_id == '5'){
					weightid = sessionStorage.getItem("weight").toString();
					weightfromkg = JSON.parse(sessionStorage.getItem('weight_from_KG'));
					shiprate = weightfromkg[weightid].manila_island;
					$('#ShippingRates').val(shiprate);
					sessionStorage.setItem("shiprate",shiprate);
					readCart();
				}
			} 
		}
		const hideWeight=()=>{
			if(GetValue('remarks')=='For Deliver'){
				$('#weight').removeClass("w3-hide");
				$('.tbl-weight').removeClass("w3-hide");
			} else {
				$('#weight').addClass("w3-hide");
				$('.tbl-weight').addClass("w3-hide");
			}	
		}
	  //|----------------------| Calculator |---------------------|//
		const calculator=()=>{
			GetProduct();

			var ricesArr = [
				'RMDIN',
				'RMKAL',
				'RMSC',
				'RMSU',
				'RMSP',
				'RMSS',
				'RMMIR',
				'RMNF',
				'RMRP',
				'RMRS',
				'RMSL',
				'RMTPG',
				'RMDBA',
				'RMGLB',
				'RMLVM',
				'RMSWS',
				'RMGLB10',
				'RMLVM10',
				'RMJ'
			]

			if(ricesArr.includes(data[0].product_code)){
				var price=data[0].price*1;

				cebuRMRgCodes = [
					'RMDBA',
					'RMGLB',
					'RMLVM',
					'RMSWS',
					'RMGLB10',
					'RMLVM10',
					'RMJ'
				]

				// manilaRM = [
				// 	'RMKAL',
				// 	'RMDIN',
				// 	'RMTPG',
				// 	'RMNF',
				// 	'RMMIR',
				// 	'RMSL',
				// 	'RMRS',
				// 	'RMRP'
				// ]

				if (cebuRMRgCodes.includes(data[0].product_code))
				{
					if (level === '7' || level === '16') { //Reorder - ECPC/HUB Price for CEBU
						price = Math.round(price + (price * 0.03))
					} else if (level === '1' || level === '6') { //Reorder - Dealer Price CEBU
						price = Math.round(price + (price * 0.05))
					} else if (level === '5') { //Reorder - Non Member/Retail CEBU
						price = Math.round(price + (price * 0.06))
					}
				}
				// else if(manilaRM.includes(data[0].product_code)){
				// 	if (level === '1' || level === '6') {
				// 		price = Math.round(price + (price * 0.05))
				// 	}
				// }

				if(data[0].ID==75)price=data[0].price*0.5;
				var qty=Number($('#QTY').val());
				var gc=Currency(Number(data[0].gc_price)),gcTotal=Currency(data[0].gc_price*qty);
				//data[0].gc_allow=0;
				$('#GCNote').addClass('w3-hide');
				if(data[0].gc_allow==0){
					$('#GCNote').removeClass('w3-hide');
					gc='No GC Price';
					gcTotal='Not available in GC Payment';
				}
			} else {
				var price=data[0].price*0.7;
				if(data[0].ID==75)price=data[0].price*0.5;						//| Temporary
				var qty=Number($('#QTY').val());
				var gc=Currency(Number(data[0].gc_price)),gcTotal=Currency(data[0].gc_price*qty);
				//data[0].gc_allow=0;
				$('#GCNote').addClass('w3-hide');
				if(data[0].gc_allow==0){
					$('#GCNote').removeClass('w3-hide');
					gc='No GC Price';
					gcTotal='Not available in GC Payment';
				}
			}


			$('#disPrice').html(Currency(price));
			$('#tdPV').html(Currency(Number(data[0].pv)));
			$('#tdGC').html(gc);
			$('#TotalPrice').html(Currency(price*qty));
			$('#TotalPV').html(Currency(data[0].pv*qty));
			$('#TotalGCPrice').html(gcTotal);
		}
	  //|----------------------| GetProduct |---------------------|//
		const GetProduct=(ID)=>{
			var ID=ID||$('#ProductID').html();
			var Code=Code||'';
			data=products.DATA_LIST.filter((data)=>{
			return (data.ID==ID || data.product_code==ID)?data:null;
			});
		}
	  //|----------------------| SelProduct |---------------------|//
		const SelProduct=(ID)=>{
			$('#ProductID').html(ID);
			calculator();
		}
	  //|----------------------| Viewer Div |---------------------|//
		const view=(CL,ID)=>{
			var div=document.getElementsByClassName(CL);
			for(var x=0;x<div.length;x++){
				div[x].className=CL+' w3-hide'; 
			}
			$('#'+ID).removeClass("w3-hide");
		 }
	  //|----------------------| Term Switch |--------------------|//
	    const term=()=>{
			if(GetValue('remarks')=='For Pickup')$('#Outlet').removeClass("w3-hide");
			else $('#Outlet').addClass("w3-hide");

	 //|----------------------|This is for Deliver|------------------|// 
		    // if(GetValue('remarks')=='For Deliver')$('#Delivery').removeClass("w3-hide");
			// else $('#Delivery').addClass("w3-hide");

			// if(GetValue('remarks')=='For Deliver')$('#Deliver').removeClass("w3-hide");
			// else $('#Deliver').addClass("w3-hide");	

			if(GetValue('remarks')=='For Deliver'){
				// $('#Delivery').removeClass("w3-hide");
				$('#Deliver').removeClass("w3-hide");
				$('#weight').removeClass("w3-hide");
				$('.tbl-weight').removeClass("w3-hide");
				$('#Total-Amount').removeClass("w3-hide");
				$('#Outlet').val("");
			} else {
				// $('#Delivery').addClass("w3-hide");
				$('#Deliver').addClass("w3-hide");
				$('#weight').addClass("w3-hide");
				$('.tbl-weight').addClass("w3-hide");
				// $('#Total-Amount').addClass("w3-hide");
				$('#Total-Amount').removeClass("w3-hide");
				$('#Deliver').val("");
			}
		} 
      //|----------------------| View Purchase |------------------|//
		const viewPurchase=()=>{ //console.log('Start Viewing');
			var str='',x,person,act,payType,delivery=0;
			if(purchases.Data!=null){
				var data=purchases.Data.filter((data)=>{
				//return (data.paymentPlatform==Type)?data:null;
							return data;
				}); 
				//data.reverse();
				//console.log(JSON.stringify(data));
				if(R!='1234567')$('#HDAct').addClass("w3-hide");
				for (x in data) {
					d= new Date(data[x].date_purchased);
					person=data[x].Outlet[0].fname+' '+data[x].Outlet[0].lname;
					w3class='';
					act='<input type="button" value="Cancel" class="w3-button w3-ripple w3-red" \
										onclick="UpdOrder(\'Cancelled\',\''+data[x].rowid+'\')" />';
					if(R!='1234567')w3class='w3-hide';				
					if(data[x].remarks!='FOR PICKUP')act='Closed';	
					if(data[x].remarks=='FOR DELIVER' ||data[x].remarks=='DELIVERED' );		
					total=Number(data[x].total_amount)
					if(data[x].payment_type=='GC')total=data[x].total_gc;				
					if(data[x].payment_type=='PV')total=data[x].total_pv;
					payType=data[x].payment_type;
					if(data[x].payment_type=='PV')payType="Voucher";
					str +='<tr>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="150" class="w3-center">'+d.toDateString()+'</td>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="250" class="w3-center" id="trk'+data[x].rowid+'"\
									>'+data[x].trackingno+'</td>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="200">'+data[x].Outlet[0].permanentadd+'</td>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="200">'+person+'</td>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="150" class="w3-center">'+data[x].Outlet[0].mobileno+'</td>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="100" class="w3-right-align"\
									>'+Currency(Number(total))+'</td>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="100" class="w3-center">'+data[x].total_qty+'</td>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="150" class="w3-center">'+payType+'</td>\
								<td onclick="viewCart(\''+data[x].rowid+'\',\'Purchase\')" width="150" class="w3-center" id="rem'+data[x].rowid+'"\
									>'+data[x].remarks+'</td>\
								<td id="act'+data[x].rowid+'" class="w3-center '+w3class+'">'+act+'</td>\
							</tr>';
				}
				//console.log('Str'+str);
			}
			if(str=='')str='<tr><td colspan="100%" class="w3-center"> <h1>No Purchases has been made</h1></td></tr>';
			$('#PurchaseList').html(str); 
			//$('#PurchaseTotal').html('<h4><b>TOTAL PURCHASES: '+data.length+'</b></h4>');
		}
	  //|----------------------| View Order |---------------------|//
		const viewOrder=()=>{ //console.log('Start Viewing');
			var str='',address='',active='',x,d,i,items='',img='',total,person,payType;
			if(orders.Data!=null){
				var data=orders.Data.filter((data)=>{
				//return (data.paymentPlatform==Type)?data:null;
							return data;
				}); 
				//data.reverse();
				//	console.log(JSON.stringify(data));
				for (x in data) {
					d= new Date(data[x].date_purchased);
					person=data[x].Outlet[0].fname+' '+data[x].Outlet[0].lname;
								act='<input type="button" value="Claim" class="w3-button w3-ripple w3-green" \
													onclick="UpdOrder(\'Claimed\',\''+data[x].rowid+'\')" />';
								if(data[x].remarks!='FOR PICKUP')act='Completed';
								total=data[x].total_amount;
								if(data[x].payment_type=='GC')total=data[x].total_gc;
								if(data[x].payment_type=='PV')total=data[x].total_pv;					
								payType=data[x].payment_type;
								if(data[x].payment_type=='PV')payType="Voucher";
								str +='<tr>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="150" class="w3-center">'+d.toDateString()+'</td>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="250" class="w3-center" id="trk'+data[x].rowid+'"\
												>'+data[x].trackingno+'</td>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="200">'+data[x].Outlet[0].permanentadd+'</td>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="200">'+person+'</td>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="150" class="w3-center">'+data[x].Outlet[0].mobileno+'</td>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="100" class="w3-right-align"\
												>'+Currency(Number(total))+'</td>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="100" class="w3-center">'+data[x].total_qty+'</td>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="150" class="w3-center">'+payType+'</td>\
											<td onclick="viewCart(\''+data[x].rowid+'\',\'Orders\')" width="150" class="w3-center" id="rem'+data[x].rowid+'"\
												>'+data[x].remarks+'</td>\
											<td class="w3-center" id="act'+data[x].rowid+'">'+act+'</td>\
										</tr>';
						}
						//console.log('Str'+str);
			}
			if(str=='')str='<tr><td colspan="100%" class="w3-center"> <h1>No Orders has been made</h1></td></tr>';
			$('#OrderList').html(str); 
			//$('#PurchaseTotal').html('<h4><b>TOTAL PURCHASES: '+data.length+'</b></h4>');
		}
	  //|----------------------| View Transaction |---------------|//
		const viewTransaction=(Filter)=>{ //console.log('Start Viewing');
			var str='',address='',active='',x,d,i,items='',img='',total,person,payType,before,after;
			if(transaction.Data!=null){
				var data=transaction.Data.filter((data)=>{
					if(Filter==null || Filter=='') return data;
					else return (data.transType==Filter || (data.transType=='164' && Filter=='159'))?data:null;
					 
				}); 
				//	data.reverse();
				//console.log(JSON.stringify(data));
				for (x in data) {
					before=data[x].balanceBefore;
					after=data[x].balanceAfter;
					d= new Date(data[x].createdAt);
					payType=data[x].wallet;
					if(data[x].wallet=='PV')payType="Voucher";
					if(data[x].wallet=='GC'){
						before=data[x].balanceBefore*50;
						after=data[x].balanceAfter*50;
					}
					
					str +='<tr>\
								<td width="200" class="w3-center">'+d.toDateString()+'</td>\
								<td width="200" class="w3-center">'+data[x].trackingNo+'</td>\
								<td width="200" class="w3-center">'+data[x].transaction_desc+'</td>\
								<td width="90" class="w3-center">'+payType+'</td>\
								<td width="160" class="w3-right-align">'+Currency(Number(data[x].amount))+'</td>\
								<td width="185" class="w3-right-align">'+Currency(Number(before))+'</td>\
								<td width="215" class="w3-right-align">'+Currency(Number(after))+'</td>\
								<td class="w3-center">'+data[x].ip+'</td>\
							</tr>';
				}
				//console.log('Str'+str);
			}
			if(str=='')str='<tr><td colspan="100%" class="w3-center"> <h1>No Orders has been made</h1></td></tr>';
			$('#TransactionList').html(str); 
			//$('#PurchaseTotal').html('<h4><b>TOTAL PURCHASES: '+data.length+'</b></h4>');
		}
	  //|----------------------| GetGC |--------------------------|//
		const GetGC=()=>{
			$('#Task').val('GetGCAmount');
			$.ajax({
				data:GatherData('Main'),
				type:'post',
				url: path+'/MLMShop', 
				beforeSend:function(){
					$('#gc_limit').html('..');	
				},
				success: function(result){
					//console.log('Get GC Response:'+result);
					result=JSON.parse(result);
					if(result.S==2 || result.S==0)GetGC();
					else{
						limit=Number(result.Data.Remain);
						$('#gc_limit').html(Currency(limit));
					}
				}
			});
		}
	  //|----------------------| GetWallet |----------------------|//
		const GetWallet=()=>{
			$('#Task').val('GetWallet');
			var User = $('#Task').val('GetWallet');
			console.log(User)
			console.log("here wallet")
			$.ajax({
				data:GatherData('Main'),
				type:'post',
				url: path+'/MLMShop', 
				beforeSend:function(){
					$('#spanGC').html('&nbsp;..&nbsp;');
					$('#spanPV').html('&nbsp;..&nbsp;');
					$('#spanECash').html('&nbsp;..&nbsp;');
				},
				success: function(result){
					//console.log('Get Wallet Response:'+result);
					wallet=JSON.parse(result);
					console.log("wallet here")
					console.log(wallet)
					if(wallet.S==2 || wallet.S==0)GetWallet();
					else{
						$('#spanEC').html(Currency(Number(wallet.Data[0].ECash)-Number(wallet.Data[0].MLMECash)).replace(/,/gi,''));
						$('#spanECash').html('&nbsp;'+Currency(Number(wallet.Data[0].ECash)-Number(wallet.Data[0].MLMECash))+'&nbsp;');
						$('#spanGC').html('&nbsp;'+Currency(Number(wallet.Data[0].GC)-Number(wallet.Data[0].MLMGC))+'&nbsp;');
						$('#spanPV').html('&nbsp;'+Currency(Number(wallet.Data[0].PV)-Number(wallet.Data[0].MLMPV))+'&nbsp;');
					}
				}
			});
		}	
	  //|----------------------| Upd Order |----------------------|//
		const UpdOrder=(status,ID)=>{
			$('#Track').val($('#trk'+ID).html());
			$('#Task').val(status);
			$.ajax({
				data:GatherData('Main'),
				type:'post',
				url: path+'/MLMShop', 
				beforeSend:function(){
					note('Processing.....',60000);
					//$('#act'+ID).html('Processing...');
				},
				success: function(result){
					//console.log('Status Response:'+result);
					var res=JSON.parse(result);
					var stat='Completed';
					if(res.S==2 || res.S==0)UpdOrder(status,ID);
					else{
						var stat='Completed';
						if(res[0].S==1)	{
							if(status=='Cancelled')stat='Completed';
							$('#act'+ID).html(stat);
							GetWallet();
							GetGC();
						}
						if(res[0].D!='Failed'){
							$('#rem'+ID).html(res[0].D);
							stat='Completed';
							$('#act'+ID).html(stat);
						}
						note(res[0].M);
					}
				}
			});
		}
	  //|----------------------| Report Filter |------------------|//
		const Filter=(Obj,Type)=>{
			viewTransaction(Type);
			var cols=document.getElementsByClassName('btnReport');
			var sz=cols.length;
          	for(var x=0;x<sz;x++){
				cols.item(x).style.fontWeight='';
			}
			Obj.style.fontWeight='bold';
		}
	  //|----------------------| View Column |--------------------|//
		const viewCol=(Val)=>{
			var cols=document.getElementsByClassName('hideCol');
			var sz=cols.length;
          	for(var x=0;x<sz;x++){
				cols.item(x).style.display='none';
			}
			cols=document.getElementsByClassName(Val);
			sz=cols.length;
          	for(var x=0;x<sz;x++){
				cols.item(x).style.display='';
			}
		}	
	  //|----------------------| Note |---------------------------|//
	  	const note=(Msg,Time)=>{
            var obj=$('#Note'),str='',Time=Time||9000;
            str=Msg;
            obj.finish();
            obj.html('').css({"height":"40px","opacity":"1"});
            obj.html(str);
            obj.animate({"padding":"8px"},1000);
            obj.animate({"opacity":"0"},Time);
			obj.animate({"height":"0px","padding":"0px"});
        }	 	 
      //|---------------------------------------------------------|*/ 
    </script>
		<style>
			i.icon-minus{color:red;}
			i.icon-plus{color:lightgreen}
			i:hover{color:orange}
			i:active{color:lightblue}
		</style>
  <form id="Main"><div id="Response"></div>
  <!--===================================| Content |======================================================-->	
	<div class="contentpanel container1" style="max-width: 100%; background:#fff;">
		<div class="row">
			<div class="col-md-12" id="container-cart">
				<div class="w3-orange"><b>
					<?php
					if($user['L']!='7')
					echo'<input type="button" class="w3-button w3-ripple active" value="MLM PRODUCTS" id="btn-products" onclick="view(\'divDisplay\',\'divProducts\')" />
						 <input type="button" class="w3-button w3-ripple" value="MY PURCHASES" id="btn-purchases" onclick="view(\'divDisplay\',\'divPurchases\')"/>
						 <input type="button" class="w3-button w3-ripple" value="TRANSACTION REPORT" id="btn-transaction" onclick="view(\'divDisplay\',\'divTransaction\')"/>';
					if($user['L']=='7')
					echo'<input type="button" class="w3-button w3-ripple" value="MLM PRODUCTS" onclick="view(\'divDisplay\',\'divProducts\')" />
						 <input type="button" class="w3-button w3-ripple" value="MY CUSTOMER ORDERS" onclick="view(\'divDisplay\',\'divOrders\')"/>';
					?></b>
					<span class="w3-button w3-border-orange w3-light-gray w3-border w3-right"/>Voucher 
						<span class="w3-white w3-round w3-border w3-border-orange" id="spanPV">&nbsp;0.00&nbsp;</span></span>
					<span class="w3-button w3-border-orange w3-light-gray w3-border w3-right"/>GC Points 
						<span class="w3-white w3-round w3-border w3-border-orange" style="width:" id="spanGC">&nbsp;0.00&nbsp;</span></span>	
					<span class="w3-button w3-border-orange w3-light-gray w3-border w3-right"/>ECash 
						<span class="w3-white w3-round w3-border w3-border-orange" style="width:" id="spanECash">&nbsp;0.00&nbsp;</span></span>
				</div>
				<div style="font-weight:bold;" id="Note" class="w3-container w3-center w3-green"></div>
				<div class="divDisplay w3-hide" id="divProducts">
					<h4>MLM Products</h4>
					<?php  if($products['S'] == 0){ ?> 
						<div class="col-sm-3 col-md-4 col-lg-6">
						<h5><?php echo $products['M'] ?></h5>
						</div>
					<?php  } else { ?> 
						<!--=======================================| Item List |===================================--> 
							<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="row">
							<div align="right" style="padding: 10px 20px 20px 0px;">
                                <button class="btn btn-primary btn-blockxx" style="background-color: orange;" id="BTNProductCart">
                                    <i class="fa fa-shopping-cart"></i> 
                                    &nbsp; Cart
                                    &nbsp; <span style="background-color: red; color: white; font-weight: bold; font-size: 15px;" class="badge" id="cartCount">0</span>
                                </button>
                            </div>

							<div class="row" style="padding-bottom: 25px"> 
								<div class="col-sm-6 col-md-6 col-lg-10">
									<input type="text" class="w3-input w3-border" placeholder="Search Product" style="width:100%" id="txtSearch" 
									value="<?php echo  $Search?>" onkeypress="Submit(event,'btnSearch')"/>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-2">
									<button type="button" class="btn btn-primary" style="width: 100%" onclick="Submit(event,'btnSearch')">
										<span id="spanSIcon" class="glyphicon glyphicon-search" aria-hidden="true"> Search </span>
									</button>
									<!-- <input type="button" class="btn btn-primary" placeholder="Search Product" style="width:100%" value="Search"
									onclick="Submit(event,'btnSearch')"/> -->
								</div>
							</div>

							

							<?php
							$count = 0;
							if($products['DATA_LIST']){
							foreach ($products['DATA_LIST'] as $key => $row):
								$script ='SelProduct(\''.$row['ID'].'\');modalViewProd(\''.$row['rowid'].'\',\''.$row['product_code'].'\',\''.$row['product_name'].'\',\''.$row['product_desc'].'\',';
								$script.='\''.$row['price'].'\',\''.$row['distributor_price'].'\',\''.$row['pv'].'\',\''.$row['status'].'\',\''.$row['inventory'].'\',';
								$script.='\''.$row['sold'].'\',\'hub\',\''.''.'\',\''.$row['weight'].'\');'; //,\''.$discounted_price.'\'										
							?>	
							<!--=======================================| Item Content |================================-->
								<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 content portfolio-item" style="padding-left: 0px;">
									<div class="panel panel-primary">
										<div class="panel-heading" style="font-size: 2vmin; height: 35px;">
											<p style="font-family: 'Times New Roman', Times, serif; font-size: 15px; margin-top: 0px; overflow:hidden; white-space:nowrap;
												text-overflow: ellipsis; color:#000000;"><span style="color:#FFFFFF;"><strong>
												<?php echo $row['product_code'];?></strong></span> - <span style="color:#000000;">
												<?php echo $row['product_name'];?></span>
												
											</p>
										</div>
										<div class="panel-body" style="font-size: 2vmin 1vmax;">
										<div  style="cursor: pointer; position: relative;">
											<?php if($row['inventory'] <= 0) { ?>
													
												<img src="<?php echo 'https://mobilereports.globalpinoyremittance.com/assets/images/MLMProducts/'.$row['product_code'].'.jpg' ?>" 
													xsrc="<?php echo 'https://s3-ap-southeast-1.amazonaws.com/upsmlmprod/mlm/'.$row['product_code'].'.PNG' ?>"  
													style="height:160px; width:100%; background-image: url('https://s3-ap-southeast-1.amazonaws.com/upsmlmprod/mlm/NO_IMG.PNG'); 
														background-size: 100px; margin:0 auto; display:block; position:relative;"
													class="image-1">
												<img src="/assets/images/soldout.png" 
													style="position: absolute;top: 25px;display: block;margin: 0 auto;width: 100%;opacity: 1.0;"
													class="image-2">
												<span class="text-center" style="margin:0 auto; display:block; font-size:11px;"><b><?php echo $row['product_name'];?></b></span>
										
											<?php } else { ?>
												<a data-toggle="modal" onclick="<?php echo $script ?>" style="cursor: pointer;">	
													<img src="<?php echo 'https://mobilereports.globalpinoyremittance.com/assets/images/MLMProducts/'.$row['product_code'].'.jpg' ?>" 
														xsrc="<?php echo 'https://s3-ap-southeast-1.amazonaws.com/upsmlmprod/mlm/'.$row['product_code'].'.PNG' ?>"  
														style="height:160px; width:100%; background-image: url('https://s3-ap-southeast-1.amazonaws.com/upsmlmprod/mlm/NO_IMG.PNG'); 
															background-size: 100px; margin:0 auto; display:block; position:relative;"
														class="image-1">
													<span class="text-center" style="margin:0 auto; display:block; font-size:11px;"><b><?php echo $row['product_name'];?></b></span>
												</a>
											<?php } ?>
										</div>
																		  	 
										<p style="font-family: 'Times New Roman', Times, serif; margin-top:10px;">
											<strong>Total Stocks : </strong><span style="color:#4e4e4e;"><?php echo number_format($row['sold']);?></span>
											<br/>
											<!-- <strong>Distributed : </strong><span style="color:#4e4e4e;"><?php echo number_format($row['sold']);?></span>
											<br/> -->
											<strong>Available Stocks : </strong>
												<?php if($row['inventory'] <= 50) { ?>
													<span style="color:#ff3000;"><b><?php echo number_format($row['inventory']);?></b></span>
												<?php } else { ?>
													<span style="color:#4e4e4e;"><b><?php echo number_format($row['inventory']);?></b></span>
												<?php } ?>
										</p>
										</div>
									</div>
								</div>
								<?php
								$counter++; 
								endforeach;
								}
								else{
									echo '<center><h1>No Product Found</h1></center>';
								}
								$total_count=($counter/$imageLimit);
							    
								?>
								<input type="hidden" class="tiggerclassProd" data-toggle="modal" data-target=".loadingtsreditcon">
								<span id="totalcount" hidden><?php echo $total_count ?></span>
								<span id="imagelimit" hidden><?php echo $imageLimit ?></span>
							<!--=======================================| Pagination |==================================-->
									<div class="col-sm-12 col-md-12 text-center">
									<ul class="pagination" id="pagin" style="margin-top: 0px;">
										<li>
											<a href="#" id="prev" class="btn">&laquo;</a>
										</li>
										<li class="current">
											<a href="#">1</a>
										</li>
										<?php for ($i=1; $i < $total_count ; $i++) { ?>
											<li>
											<a href="#"><?php echo $i+1 ?></a>
										</li>
										<?php } ?>
										<li>
											<a href="#" id="next" class="btn">&raquo;</a>
										</li>
									</ul>
									</div>
								<!--=======================================================================================-->
							</div>
							</div>
						<!--=======================================| Item List |===================================-->   
					<?php } ?>
						<!--=======================================| Cart List |===================================-->					
						<div class="modal fade table-responsive " id="modalProductCart" data-backdrop="static" role="dialog" style="margin-top: 5%; width: 100%; padding-right: 10%;">
							<div class="modal-dialog" style="width:100%;">
								<div class="modal-content" id="cart-paymentmodal">
									<div class="modal-header" id="modalhead">
										<button type="button" class="close" data-dismiss="modal">
											&times;
										</button>
										<h4 class="modal-title">Product Cart </h4>
									</div>
									<div class="modal-body" id="modalbody">
										<div class="row">
											<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="table table-responsive">
													<div class="alert alert-danger" id="alertCart" style="display: none; word-wrap:break-word;"></div> 
													<div align="right" style="margin-bottom: 20px;">
														<select class="hr2 animated fadeIn handwritten w3-input w3-border" id="veiwPrice" style="width:50%;" onchange="viewCol(this.value)">
															<option class="vVDiscount" value="Discount">View Discounted</option>
															<option class="vGCPrice" value="GC">View GC Price</option>
															<option class="Priced" value="Price">View Price</option>
															<option class="vVPrice" value="PV">View Voucher Price</option>
														</select>
													</div>
													<table class="w3-table w3-border w3-hover" style="width:100%;" >
														<thead style="background-color: orange;">
															<tr style="height:30px">
																<th class="animated fadeIn delay025s" style="text-align: center; color: white;"><i class='glyphicon glyphicon-pencil btn-xs'></i></th>
																<th class="animated fadeIn delay025s" nowrap="" style="text-align: center; color: white;">Qty</th>
																<th class="animated fadeIn delay050s" nowrap="" style="text-align: center; color: white;">Product Code</th>
																<th class="animated fadeIn delay050s" nowrap=""style="text-align: center; color: white;">Product Name</th>
																<th class="animated weight" id="weight" nowrap="" style="text-align: center; color: white;">Weight</th>
																<th class="animated fadeIn hideCol Price "  nowrap="" style="text-align: center; color: white;">Original Price</th>
																<th class="animated fadeIn hideCol GC "  nowrap="" style="text-align: center; color: white;">Gift Check Price</th>
																<th class="animated fadeIn hideCol Discount "  nowrap="" style="text-align: center; color: white;">Discounted Price</th>
																<th class="animated fadeIn hideCol PV "  nowrap="" style="text-align: center; color: white;"> Voucher Price</th>
																<th class="animated fadeIn delay1s" style="text-align: center; color: white;" float="right">Action</th>
															</tr>
														</thead>
														<tbody id="List"></tbody>		
													</table>

													<center><h4 class="RMProductManilaWord" style="color: red;">Ricemart Products Only Applicable in Metro Manila</h4></center>
													<center><h4 class="RMProductCebuWord" style="color: red;">This Ricemart Variants is only applicable in Cebu</h4></center>

													<h4 class="hr2 animated fadeIn handwritten"></h4>
													<table class="w3-table w3-border">
														<tbody>
															<tr><td class="w3-right-align">User's Regcode :</td>
																<td colspan="2">
																	<input type="text" value="F5033230" id="user-regcode" name="user-regcode" class="form-control"/>
																	<!-- <div class="btn btn-primary animated bounceIn delay125s" id="BTNCheckUser">
																		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
																		Check User
																	</div> -->
																</td>
															</tr>
															<tr><td class="w3-right-align">Total Original Price :</td>
																<td colspan="2"><input type="text" id="total-price" readonly class="form-control"/></td>
															</tr>	
															<tr class="Ricemart"><td class="w3-right-align">Total GC Price :</td>
																<td colspan="2"><input type="text" id="total-gcprice" readonly class="form-control"/></td>
															</tr>
															<tr class="Ricemarts"><td class="w3-right-align">Total Discount Price :</td>
																<td colspan="2"><input type="text" id="total-dcprice" readonly class="form-control"/></td>
															</tr>
															<tr class="Ricemart"><td class="w3-right-align">Total Voucher :</td>
																<td colspan="2"><input type="text" id="total-pvprice" readonly class="form-control"/></td>
															</tr>
															<tr class="w3-right-align" id="Delivery"><td class="w3-right-align">Shipping Charges :</td>
																<td colspan="2"><input type="text" name="ShippingRates" id="ShippingRates" readonly class="form-control"/></td>
															</tr>
															<tr class="w3-right-align" id="Total-Amount"><td class="w3-right-align">Total Amount :</td>
																<td colspan="2"><input type="text" id="TAmount" readonly class="form-control"/></td>
															</tr>
															<tr><td class="w3-right-align">Terms :</td>
																<td><label id="FPickup"><input type="radio" name="remarks" value="For Pickup" onchange="term()" id="radioPickup" checked="checked"/> For Pickup </label>
																	&nbsp;&nbsp;&nbsp;
																	<label style="display:nne" id="FDeliver"><input type="radio" name="remarks" value="For Deliver" onchange="term()" id="radioDeliver"/> For Deliver </label></td>
																<td class="col-7 col-xs-7 col-sm-7 col-md-7 col-lg-7"><select class="w3-input w3-border w3-hide" name="Outlet" id="Outlet">
																		<option value="" disabled selected>PLEASE SELECT OUTLET</option>
																	</select>
																<!--===================================		This is for Deliver		===============================-->
																<select class="w3-input w3-border w3-hide" name="Deliver" id="Deliver">
																<option value ="" class="LocationRM" disabled selected>Please Select Location</option>
																<option value ="1" >National Capital Region</option>
																<option value ="2" class="locations">Luzon</option>
																<option value ="3" class="locations">Visayas</option>
																<option value ="4" class="locations">Mindanao</option>
																<option value ="5" class="locations">Island</option>
																</select>	
																<!--===================================		This is for Deliver		===============================-->
																</td>
															</tr>
														</tbody>
													</table>
													<div style="margin-top: 10px;">
														<div class="form-group margin-top-small margin-bottom-large pull-right">
															<div class="btn btn-primary animated bounceIn delay125s pull-right" id="BTNCheckOut" style="margin-left: 5px;" >
																<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> 
																Checkout
															</div>
															<div class="btn btn-default animated bounceIn delay125s"id="BTNCancel" >
																<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
																Cancel
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--=======================================================================================-->  
				</div>
				<div class="divDisplay w3-hide" id="divPurchases"><br/>
					<table cellspacing="0" cellpadding=0 width="100%">
					 <tr><!-- <td width="100">Date From : </td>
					 	 <td width="200"><input type="date" class="w3-input w3-border" placeholder="Date From" style="width:90%"/></td>
						 <td width="100">Date To : </td>
						 <td width="200"><input type="date" class="w3-input w3-border" placeholder="Date To" style="width:90%"/></td> -->
						 <td><input type="text" class="w3-input w3-border" placeholder="Search Tracking No" style="height:50px" 
									onkeyup="Searcher(this,'PurchaseList')"/></td></tr>
					</table></br>
					<table class="w3-table w3-border ">
					  <thead><tr class="w3-indigo">
							<th width="150" class="w3-center">DATE PURCHASE</th>
							<th width="200" class="w3-center">TRACKING NO</th>
							<th width="200" class="w3-center">PICKUP LOCATION</th>
							<th width="250" class="w3-center">CONTACT PERSON</th>
							<th width="150" class="w3-center">CONTACT NO</th>
							<th width="100" class="w3-center">AMOUNT</th>
							<th width="100" class="w3-center">QUANTIY</th>
							<th width="150" class="w3-center">PAYMENT</th>
							<th width="150" class="w3-center">STATUS</th>
							<th class="w3-center" id="HDAct">ACTION</th>
						</tr></thead>
						<tbody><tr ><td colspan="100%" style="padding:0px"><div style="overflow:auto;height:500px">
							<table class="w3-table w3-striped w3-bordered w3-hoverable" id="PurchaseList"></table>	
						<div></td></tr></tbody>
						<tfoot><tr><td colspan="100%" class="w3-blue">
							<b>Note:</b> Please wait to load all the items before start searching for the records </td></tr></tfoot>
					</table>
				</div>
				<div class="divDisplay w3-hide" id="divOrders"><br/>
					<table cellspacing="0" cellpadding=0 width="100%">
					 <tr><!-- <td width="100">Date From : </td>
						 <td width="200"><input type="date" class="w3-input w3-border" placeholder="Date From" style="width:90%"/></td>
						 <td width="100">Date To : </td>
						 <td width="200"><input type="date" class="w3-input w3-border" placeholder="Date To" style="width:90%"/></td> -->
						 <td><input type="text" class="w3-input w3-border" placeholder="Search Tracking No" style="height:50px"
									onkeyup="Searcher(this,'OrderList')"/></td></tr>
					</table></br>
					<table class="w3-table w3-border ">
					  <thead><tr class="w3-indigo">
							<th width="150" class="w3-center">DATE PURCHASE</th>
							<th width="200" class="w3-center">TRACKING NO</th>
							<th width="200" class="w3-center">CUSTOMER LOCATION</th>
							<th width="250" class="w3-center">CUSTOMER</th>
							<th width="150" class="w3-center">CONTACT NO</th>
							<th width="100" class="w3-center">AMOUNT</th>
							<th width="100" class="w3-center">QUANTIY</th>
							<th width="150" class="w3-center">PAYMENT</th>
							<th width="150" class="w3-center">STATUS</th>
							<th class="w3-center">ACTION</th>
						</tr></thead>
						<tbody><tr ><td colspan="100%" style="padding:0px"><div style="overflow:auto;height:500px">
							<table class="w3-table w3-striped w3-bordered w3-hoverable" id="OrderList"></table>	
						<div></td></tr></tbody>
						<tfoot><tr><td colspan="100%" class="w3-blue">
							<b>Note:</b> Please wait to load all the items before start searching for the records </td></tr></tfoot>
					</table>
				</div>
				<div class="divDisplay w3-hide" id="divTransaction"><br/>
					<table cellspacing="0" cellpadding="0" width="100%">
					 <tr><td width="100" valign="top"><div class="w3-button w3-border btnReport" onclick="Filter(this,'')">All Transaction</div></td>
					 	 <td width="80" valign="top"><div class="w3-button w3-border btnReport" style="width:80px" onclick="Filter(this,'159')">ECash</div></td>
						 <td width="80" valign="top"><div class="w3-button w3-border btnReport" style="width:80px" onclick="Filter(this,'160')">GC</div></td>
						 <td width="80" valign="top"><div class="w3-button w3-border btnReport" style="width:80px" onclick="Filter(this,'161')">Voucher</div></td>
					 	 <td><input type="text" class="w3-input w3-border" placeholder="Search Tracking No" onkeyup="Searcher(this,'TransactionList')"/></td></tr>
					</table></br>
					<table class="w3-table w3-border ">
					  <thead><tr class="w3-indigo">
							<th width="200" class="w3-center">DATE PURCHASE</th>
							<th width="200" class="w3-center">TRACKING NO</th>
							<th width="200" class="w3-center">TRANSACTION</th>
							<th width="100" class="w3-center">WALLET</th>
							<th width="200" class="w3-center">AMOUNT</th>
							<th width="200" class="w3-center">BALANCE BEFORE</th>
							<th width="200" class="w3-center">BALANCE AFTER</th>
							<th class="w3-center">IP</th>
						</tr></thead>
						<tbody><tr ><td colspan="100%" style="padding:0px"><div style="overflow:auto;height:500px">
							<table class="w3-table w3-striped w3-bordered w3-hoverable" id="TransactionList" border="0"></table>	
						<div></td></tr></tbody>
						<tfoot><tr><td colspan="100%" class="w3-blue">
							<b>Note:</b> Please wait to load all the items before start searching for the records </td></tr></tfoot>
					</table>
				</div>							
			</div>
    </div>

		


	</div><!-- mainpanel -->
  <!--===================================| View Product Modal |===========================================-->
  	<div id="loadingtsreditcon" class="modal fade loadingtsreditcon" data-backdrop="static" tabindex="-1" role="dialog"
		aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h5 class="modal-title color" id="myModalLabel">UPS Tangible Product Details</h5>
				</div>
				<div class="modal-body">
					<div class="jumbotron" style="padding: 5%; margin-bottom: 0px;">
						<div class="alert flasher" style="display: none;"><strong><span class="mensahe"></span></strong></div>
						<div class="pinoyFirstview" >
						    <div class="table table-responsive" style="overflow: hidden;">
								<div class="container" style="padding-left:0%; padding-right:0%;">
									<div class="row">
									<div class="col-md-12">
										<table class="table table-responsive" >
											<thead id="GCNote"><tr><td colspan="100%" class="w3-light-green w3-center"><b>Not Available GC Payments</b></td></tr></thead>
											<tbody id="EditUPStangibleProd" class="EditUPStangibleProd" style="font-family: 'Times New Roman', Times, serif;">
												<tr class="EditUPStangibleProd2"></tr>
												<tr class="EditUPStangibleProd44"></tr>
												<tr class="EditUPStangibleProd3"></tr>
												<tr class="EditUPStangibleProd4"></tr>
											<?php if($this->user['R'] == 'F7897947'){ ?>
												<tr class="EditUPStangibleProd6"></tr>
												<tr class="EditUPStangibleProd5"></tr>
												<tr class="EditUPStangibleProd7"></tr>
												<tr class="EditUPStangibleProd8"></tr>
											<?php	}?>
												<tr class="EditUPStangibleProd1"></tr>
												<tr class="EditUPStangibleProd13"></tr>
											</tbody>
										</table>
										<table width="100%" cellspacing="0" cellpadding="0" border="0" class="w3-white" style="font-family:Times New Roman">
											<?php if($this->user['R'] == 'F7897947'){ ?><tr class="w3-border-bottom">
												<td width="175"></td>
												<td width="150" align="right" >Discounted Price : </td>
												<td width="80" align="right" id="disPrice" ></td>
												<td></td></tr>
											<tr><td></td>
												<td align="right">GC Price : </td>
												<td id="tdGC" align="right"></td>
												<td></td></tr>	
											<tr><td></td>
												<td align="right">Voucher : </td>
												<td id="tdPV" align="right"></td>
												<td></td></tr>
											<?php }?>
										</table>
									</div>
									</div>
								</div>
								<h4 class="hr2 animated fadeIn handwritten"></h4>
								<table class="table table-hover" style="margin-bottom: 0px;">
									<tbody>
										<tr><td align="right">Quantity:</td>
											<td><input type="number" id="QTY" min="1" value="1" class="form-control col-md-6" name="QTY" onchange="calculator()" 
												onkeyup="EntryCheck(this,'Number')"/></td>
										</tr>
										<?php if ($this->user['R'] != 'F9175006') { ?>
										<tr><td align="right">Total Discounted Amount:</td>
											<td><span id="TotalPrice"></span></td>
										</tr>
										<?php	} ?>
										<tr><td align="right">Total GC Amount:</td>
											<td><span id="TotalGCPrice"></span></td>
										</tr>
										<tr><td align="right">Total Voucher:</td>
											<td><span id="TotalPV"></span></td>
										</tr>
										<input type="hidden" class="tiggerclassEditProd" data-toggle="modal" data-target=".editTangibleprod">
									</tbody>
								</table>
								<span hidden id="product-total-discount"></span></br>
								<span hidden id="product-total-pv"></span>
								</br>
								<span hidden id="product-final-price"></span></br>
								<span hidden id="product-final-discount"></span>
								<span hidden id="product-final-pv"></span>
								<span hidden id="ProductID"></span>  
								<span hidden id="ProductCode"></span>
							</div>

							<div class="form-group margin-top-small margin-bottom-large">
								<div class="btn btn-primary btn-addtocart pull-right animated bounceIn delay125s" id="BTNAddCart" value="" 
									name="BTNAddCart" data-dismiss="modal" style="margin-left: 5px;">
									<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to cart</div>
								<button type="button" class="btn btn-default pull-right animated bounceIn delay75s" data-dismiss="modal">
									<span class="glyphicon glyphicon-remove" aria-hidden="true">Cancel</button>
							</div>
						</div>
					</div>
				</div>    	            
			</div>
		</div>
	 </div>
	<!--===================================| Check Out  Modal |===========================================-->
  	<div class="modal fade" id="modalPaymentMode" data-backdrop="static" role="dialog" style="margin-top: 5%;">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content" id="cart-paymentmodal">
				<div class="modal-header" id="modalhead">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Payment Option</h4>
				</div>
				<div class="modal-body" id="modalbody">
					<p>How would you like to pay?</p>
					<div class="form-group">
						<select class="form-control" name="PaymentType" id="PaymentType" required>
								<option value="" disabled selected>--Choose--</option>
									<option class="PType" value="GC">GIFT CHECK</option> 
									<option class="PType" value="PV">VOUCHER</option>
									<option value="ECASH">E-CASH</option>
						</select>  
					
						<div id="divDelivery"><br/>
							<!-- <p class="w3-text-red">Fixed Delivery Charge:<b> ₱150.00 [ E-Cash ]</b>.<br/>Delivery service is available within Philippines Only.</p> -->
							<br/>
							Contact Person : <br/>
							<input type="text" class="w3-input w3-border" name="ContactPerson" placeholder="Contact Person" value="<?php echo $user['N']?>"/><br/>
							Contact No : <br/>
							<input type="text" class="w3-input w3-border" name="ContactNo" placeholder="Contact No"  value="<?php echo $user['MB']?>"/><br/>
							
							Location : <br/>
							<input type="text" class="w3-input w3-border" name="location" id="location" disabled/><br/>

							Provinces : <br/>
							<select class="w3-input w3-border" name="provinceMLM" id="provinceMLM">
								<option value="" disabled selected>Please Select Province</option>
							</select><br/>
							
							City/Municipality : <br/>
							<select class="w3-input w3-border" name="cityMLM" id="cityMLM">
								<option value="" disabled selected>Please Select City/Municipality</option>
							</select><br/>
							
							Unit/Bldg/House No./Street/Barangay : <br/>
							<center>
							<textarea class="w3-input w3-border" name="DeliveryAddress" placeholder="Delivery Address" id="DeliveryAddress" 
							onkeyup="EntryCheck(this,'MixSpc')" style="resize:none; width:100%"><?php echo $user['AD']?></textarea></center>
						</div>	
					</div>
				</div>
			
				<div class="modal-footer" id="modalfooter" style="display:block;">
					<div class='btn btn-default' data-dismiss="modal" id="BTNClose"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Cancel</div>
					<div class='btn btn-primary' id='BTNPayout'><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;Checkout</div>
				</div>
			</div>
			
		</div>
	 </div>
	<!--===================================| View Cart Content |==========================================-->
	<div class="modal fade" id="viewCart" data-backdrop="static" role="dialog" style="margin-top: 5%; ">
		<div class="modal-dialog" style="width:1000px">
			<!-- Modal content-->
			<div class="modal-content" id="cart-paymentmodal">
				<div class="modal-header" id="modalhead">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Cart Details | Tracking No:  <label id="lblTrack"></label>
					<a id="pdfLink"><i class="fa fa-file-pdf-o" style="color:green" ></i></a></h4>
				</div>
				<div class="modal-body" id="modalbody">
					<table class="w3-table w3-border" >
						<thead><tr class="w3-indigo">
								<th width="150" class="w3-center">CODE</th>
								<th class="w3-center">PRODUCT NAME</th>
								<th width="100" class="w3-center">QUANTITY</th>
							<?php if($this->user['R'] == 'F7897947'){ ?>
								<th width="100" class="w3-center">WEIGHT</th>
							<?php	}?>
								<th width="100" class="w3-center">PRICE</th>
								<th width="100" class="w3-center">GC PRICE</th>
							<?php if($this->user['R'] == '1234567' ){ ?>
								<th width="100" class="w3-center">D-PRICE</th>
							<?php	}?>
								<th width="100" class="w3-center">V-PRICE</th>
							</tr></thead>
						<tbody><tr ><td colspan="100%" style="padding:0px"><div style="overflow:auto;height:300px">
							<table class="w3-table w3-striped w3-bordered" id="cartList" border="0"></table>	
						<div></td></tr></tbody>
						<tfoot><tr class="w3-blue"><th colspan="2">TOTAL</th>
							<th id="tQty" class="w3-center"></th>
						<?php if($this->user['R'] == 'F7897947'){ ?>
							<th id="tWght" class="w3-center"></th>
						<?php	}?>
							<th id="tPrice" class="w3-center"></th>
							<th id="tGCPrice" class="w3-center"></th>
						<?php if($this->user['R'] == '1234567'){  ?>
							<th id="tDPrice" class="w3-center"></th>
						<?php	} ?>
							<th id="tPVPrice" class="w3-center"></th>
						</tr></tfoot>
					</table>
					<!-- Add Shipping Rates E-Cash Charge  -->
					<table class="w3-table w3-border"><tr><td colspan="100%"><b>Note:</b>For all Delivery Transaction will automatically <b>Add E-Cash Shipping Charges</b></td></tr></table>
				</div>
			
				<div class="modal-footer" id="modalfooter" style="display:block;">
					<div class='btn btn-default' data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Close</div>
				</div>
			</div>
			
		</div>
	 </div> 
  <!--====================================================================================================-->
    <div class="w3-hide">
		<input type="text" id="Task" name="Task"/>
		<input type="text" id="Cart" name="Cart"/>
		<input type="text" id="Track"name="Track"/>
		<input type="button" id="btnSearch"/>
	</div>
  </form>
<script>
	$(window).on('load', function () {
		$('.Ricemart').attr("hidden",false);
		sessionStorage.removeItem('location_id');
		$('#ShippingRates').val('0.00');
		sessionStorage.removeItem('shiprate');
		sessionStorage.setItem("Cart",'');
		cart='';
		readCart();
		$.ajax({
			type: 'post',
			url: path+'/ShippingRate',
			success: function(response){
				let res = JSON.parse(response);
				sessionStorage.setItem('weight_from_KG', JSON.stringify(res));
				sessionStorage.setItem('shiprate', '0');
			}
		});	
	})

</script>