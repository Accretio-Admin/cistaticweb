$("#btn_continue").click(function () {
    var fname = $("#inputFnamev2").val();
    var mname = $("#inputMnamev2").val();
    var lname = $("#inputLnamev2").val();
    var bday = $("#datetimepicker").val();
    var occu = $("#inputOccupv2").val();
    var email = $("#inputEmailv2").val();
    var number = $("#inputNumberv2").val();
    var add = $("#inputAddressv2").val();
    var bfname = $("#inputBFnamev2").val();
    var bmname = $("#inputBMnamev2").val();
    var blname = $("#inputBLnamev2").val();
    var vcode = $('#voucher_code > span').text();
  
    if (
      fname === "" ||
      lname === "" ||
      bday === "" ||
      occu === "" ||
      email === "" ||
      number === "" ||
      add === "" ||
      bfname === "" ||
      blname === ""
    ) {
      $.alert("Check if some fields are empty.");
      return false;
    } else {
      $("#myModal").modal("show");
      $("#m_firstName").val(fname);
      $("#m_middleName").val(mname);
      $("#m_lastName").val(lname);
      $("#m_birthdate").val(bday);
      $("#m_occupation").val(occu);
      $("#m_email").val(email);
      $("#m_number").val(number);
      $("#m_address").val(add);
      $("#m_bfirstName").val(bfname);
      $("#m_bmiddleName").val(bmname);
      $("#m_blastName").val(blname);
      $("#m_vcode").val(vcode);
    }
  });
  
  $("#myModal").on("click", ".btnConfirm", function () {
    var fname = $("#m_firstName").val();
    var mname = $("#m_middleName").val();
    var lname = $("#m_lastName").val();
    var bday = $("#m_birthdate").val();
    var occu = $("#m_occupation").val();
    var email = $("#m_email").val();
    var number = $("#m_number").val();
    var add = $("#m_address").val();
    var bfname = $("#m_bfirstName").val();
    var bmname = $("#m_bmiddleName").val();
    var blname = $("#m_blastName").val();
    var coverageDetails = $("#inputCoveragev2").children("option:selected").val();
    var res = coverageDetails.split("|");
    var coverage = res[0];
    var option = $("#selInsuranceFederalv2").children("option:selected").data("id");
    var paymentType = '';
    var voucher_code = $("#m_vcode").val();

    if($('#voucher_code').data('voucher') === 1)
    {
      paymentType = 'VOUCHER';
    }
    else
    {
      paymentType = 'ECASH';
    }
  
    $.confirm({
      title: "<i class=''></i>",
      content:
        "" +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        "<label>Transaction Password</label>" +
        '<input type="password" placeholder="Input Transaction Password" class="password form-control" required />' +
        "</div>" +
        "</form>",
      buttons: {
        formSubmit: {
          text: "Submit",
          btnClass: "btn-blue",
          keys: ["enter"],
          action: function () {
            var pass = this.$content.find(".password").val();
            if (!pass) {
              $.alert("Please provide a transaction password!");
              return false;
            }
            $.ajax({
              method: "POST",
              // dataType: 'HTML',
              url: site_url + "/Einsurance/ajax_confirm_fpg",
              data: {
                option: option,
                coverage: coverage,
                fname: fname,
                mname: mname,
                lname: lname,
                bday: bday,
                occu: occu,
                email: email,
                number: number,
                add: add,
                paymentType: paymentType,
                bfname: bfname,
                bmname: bmname,
                blname: blname,
                pass: pass,
                voucher_code: voucher_code
              },
              beforeSend: function () {
                $(".btn").prop("disabled", true);
              },
              complete: function () {
                $(".btn").prop("disabled", null);
              },
              success: function (response) {
                var res = JSON.parse(response);
                if (res["S"] == 1) {
                  $.dialog({
                    icon: "fa fa-thumbs-up",
                    theme: "modern",
                    closeIcon: true,
                    onClose: function()
                    {
                      $('#selInsuranceFederalv2').prop('selectedIndex',0);
                      $('#inputCoveragev2').prop('selectedIndex',0);
                      $('#inputCoveragev2').prop('disabled',true);
                      $("#inputFnamev2").val('');
                      $("#inputMnamev2").val('');
                      $("#inputLnamev2").val('');
                      $("#datetimepicker").val('');
                      $("#inputOccupv2").val('');
                      $("#inputEmailv2").val('');
                      $("#inputAddressv2").val('');
                      $("#inputBFnamev2").val('');
                      $("#inputBMnamev2").val('');
                      $("#inputBLnamev2").val('');
                      $('#frmFederalv2 input').prop('disabled', true);
                      $('#voucher_code').prop('hidden', true);
                      $('#voucher_code').attr('data-voucher', '0');
                      $('#myModal').modal('hide');
                    },
                    animation: "scale",
                    type: "green",
                    title: "Congratulation!",
                    content:
                      '<a id="print_coc" target="_blank" type="button" class="btn btn-success" href="https://mobilereports.globalpinoyremittance.com/portal/federal_receipt/' +
                      res["TN"] +
                      '">Print Certificate</a>',
                  });
                } else if (res["S"] === null) {
                  $.alert({
                    title: "Information",
                    content: res["M"],
                  });
                } else {
                  $.alert({
                    title: "Transaction Failed!",
                    content: res["M"],
                  });
                }
              },
              error: function () {
                $.alert({
                  title: "Error!",
                  content: "Failed to show modal!",
                });
              },
            });
          },
        },
        cancel: function () {},
      },
    });
  });
  
  $("#selInsuranceFederalv2").change(function () {
    $("#federalNotev2").css("display", "none");
    var mnote = $(this).children("option:selected").data("id"); // select attribute (data-desc)
    // console.log(mnote);
    $("#fpgOption").val(mnote);
  
    coverage_limits();
  });
  
  $("#inputCoveragev2").change(function () {
    $("#federalNotev2").css("display", "block");
    var coverageDetails = $(this).children("option:selected").val();
    var res = coverageDetails.split("|");
  
    // document.getElementById("note60").innerHTML =
    //   "PHP " +
    //   parseFloat(res[2])
    //     .toFixed(2)
    //     .replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,");
  });

  $("#myVoucherModalv2").on('click','#btn_voucher',function (e) {
    e.preventDefault();

    var vcode = $('#vcode').val();

    // console.log(vcode);

    // return false;

    $.ajax({
      method: "POST",
      url: site_url + "/Einsurance/ajax_validate_voucher",
      data: { vcode: vcode },
      dataType: "HTML",
      beforeSend: function () {
        // $('.btn').prop('disabled', true);
      },
      complete: function () {
        // $('.btn').prop('disabled', null);
      },
      success: function (response) {
        var voucher = JSON.parse(response);

        if(voucher['message'])
        {
          $.alert(voucher['message']);
        }

        if(voucher['T_DATA']['voucher_code'])
        {
          $('#voucher_code > span').text(voucher['T_DATA']['voucher_code']);
          $('#voucher_code').prop('hidden', null);
          $('#voucher_code').attr('data-voucher', '1');
        }

        $('#selInsuranceFederalv2').empty();
        $('#selInsuranceFederalv2').append('<option value="0" data-id="1" selected>Option 1</option>');

        $('#inputCoveragev2').empty();
        $('#inputCoveragev2').append('<option value="1|Annual|80" selected>Annual</option>');

        $('#selInsuranceFederalv2').prop('disabled',true);
        $('#inputCoveragev2').prop('disabled',true);

        $("#federalNotev2").css("display", "block");
        
        var option = $("#selInsuranceFederalv2").children("option:selected").data("id");
        $('#frmFederalv2 input').prop('disabled', null);

        $.ajax({
          method: "POST",
          url: site_url + "/Einsurance/ajax_federal_coverage",
          data: { option: option },
          dataType: "HTML",
          beforeSend: function () {
            // $('.btn').prop('disabled', true);
          },
          complete: function () {
            // $('.btn').prop('disabled', null);
          },
          success: function (response) {
            var rate = JSON.parse(response);
            // $.each(rate, function (key, data) {
            $("#federalNotev2").css("display", "block");

            document.getElementById("note10v2").innerHTML =
              "PHP " + Number(rate[0]["amount"]).toFixed(2);
            document.getElementById("note20v2").innerHTML =
              "PHP " + Number(rate[1]["amount"]).toFixed(2);
            document.getElementById("note30v2").innerHTML =
              "PHP " + Number(rate[2]["amount"]).toFixed(2);
            document.getElementById("note40v2").innerHTML =
              "PHP " + Number(rate[3]["amount"]).toFixed(2);
            document.getElementById("selling_price").innerHTML =
              "PHP " + Number(rate[0]["selling_price"]).toFixed(2);
            document.getElementById("discount").innerHTML =
              "PHP " + Number(rate[0]["discount"]).toFixed(2);
            document.getElementById("amount_due").innerHTML =
              "PHP " + Number(rate[0]["amount_due"]).toFixed(2);
            
            $("#m_federalNote").css("display", "block");

            document.getElementById("m_note10").innerHTML =
              "PHP " + Number(rate[0]["amount"]).toFixed(2);
            document.getElementById("m_note20").innerHTML =
              "PHP " + Number(rate[1]["amount"]).toFixed(2);
            document.getElementById("m_note30").innerHTML =
              "PHP " + Number(rate[2]["amount"]).toFixed(2);
            document.getElementById("m_note40").innerHTML =
              "PHP " + Number(rate[3]["amount"]).toFixed(2);
            document.getElementById("m_selling_price").innerHTML =
              "PHP " + Number(rate[0]["selling_price"]).toFixed(2);
            document.getElementById("m_discount").innerHTML =
              "PHP " + Number(rate[0]["discount"]).toFixed(2);
            document.getElementById("m_amount_due").innerHTML =
              "PHP " + Number(rate[0]["amount_due"]).toFixed(2);

            $("#myVoucherModalv2").modal('hide');
            $(".modal-backdrop").hide();
            
          },
          error: function () {
            alert("FAILED!");
          },
        });
      },
      error: function () {
        alert("FAILED!");
      }
    });
    
  });


  
  $("#federalNoteConfirmv2").css("display", "block");
  // var mnote = $("#optionId").val();
  // var coverageDetails = $("#coverage").val();
  // var res = coverageDetails.split("|");
  
  // if (mnote == 1) {
  //   document.getElementById("note10").innerHTML = "PHP 100,000.00";
  //   document.getElementById("note20").innerHTML = "PHP 50,000.00";
  //   document.getElementById("note30").innerHTML = "PHP 10,000.00";
  //   document.getElementById("note40").innerHTML = "PHP 10,000.00";
  // } else if (mnote == 2) {
  //   document.getElementById("note10").innerHTML = "PHP 60,000.00";
  //   document.getElementById("note20").innerHTML = "PHP 30,000.00";
  //   document.getElementById("note30").innerHTML = "PHP 6,000.00";
  //   document.getElementById("note40").innerHTML = "PHP 6,000.00";
  // } else if (mnote == 3) {
  //   document.getElementById("note10").innerHTML = "PHP 50,000.00";
  //   document.getElementById("note20").innerHTML = "PHP 5,000.00";
  //   document.getElementById("note30").innerHTML = "PHP 5,000.00";
  //   document.getElementById("note40").innerHTML = "PHP 25,000.00";
  // } else if (mnote == 4) {
  //   document.getElementById("note10").innerHTML = "PHP 40,000.00";
  //   document.getElementById("note20").innerHTML = "PHP 4,000.00";
  //   document.getElementById("note30").innerHTML = "PHP 4,000.00";
  //   document.getElementById("note40").innerHTML = "PHP 20,000.00";
  // } else if (mnote == 5) {
  //   document.getElementById("note10").innerHTML = "PHP 20,000.00";
  //   document.getElementById("note20").innerHTML = "PHP 2,000.00";
  //   document.getElementById("note30").innerHTML = "PHP 2,000.00";
  //   document.getElementById("note40").innerHTML = "PHP 10,000.00";
  // }
  
  // document.getElementById("note60").innerHTML =
  //   "PHP " +
  //   parseFloat(res[2])
  //     .toFixed(2)
  //     .replace(/(\d)(?=(\d{3})+\.\d\d$)/g, "$1,");
  
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
  
  function getCert(tn) {
    window.open(
      "https://mobilereports.globalpinoyremittance.com/portal/federal_receipt/" +
        tn +
        "",
      "",
      "width=800,height=600"
    );
  }
  
  function validateDate(dateInput) {
    var bDay = new Date($(".bday").val());
    // alert(bDay.getFullYear());
    var todayDate = new Date();
    //todayDate= todayDate.getFullYear()+"-"+todayDate.getMonth()+"-"+todayDate.getDate()
    if (todayDate.getFullYear() - bDay.getFullYear() < 18) {
      $.alert("Age should be 18-65 years old");
  
      $(".bday").val("");
      return false;
    }
    if (todayDate.getFullYear() - bDay.getFullYear() > 65) {
      $.alert("Age should be 18-65 years old");
      $(".bday").val("");
      return false;
    }
  }
  
  function coverage_limits() {
    var option = $("#selInsuranceFederalv2").children("option:selected").data("id");
  
    $.ajax({
      method: "POST",
      url: site_url + "/Einsurance/ajax_federal_coverage",
      data: { option: option },
      dataType: "HTML",
      beforeSend: function () {
        // $('.btn').prop('disabled', true);
      },
      complete: function () {
        // $('.btn').prop('disabled', null);
      },
      success: function (response) {
        var rate = JSON.parse(response);
        // $.each(rate, function (key, data) {
        $("#inputCoveragev2").change(function () {
          $("#federalNotev2").css("display", "block");
          var coverageDetails = $(this).children("option:selected").val();
          var res = coverageDetails.split("|");
          var coverageid = res[0];
  
          if (coverageid === "1") {
            document.getElementById("note10v2").innerHTML =
              "PHP " + Number(rate[0]["amount"]).toFixed(2);
            document.getElementById("note20v2").innerHTML =
              "PHP " + Number(rate[1]["amount"]).toFixed(2);
            document.getElementById("note30v2").innerHTML =
              "PHP " + Number(rate[2]["amount"]).toFixed(2);
            document.getElementById("note40v2").innerHTML =
              "PHP " + Number(rate[3]["amount"]).toFixed(2);
            document.getElementById("selling_price").innerHTML =
              "PHP " + Number(rate[0]["selling_price"]).toFixed(2);
            document.getElementById("discount").innerHTML =
              "PHP " + Number(rate[0]["discount"]).toFixed(2);
            document.getElementById("amount_due").innerHTML =
              "PHP " + Number(rate[0]["amount_due"]).toFixed(2);
          } else if (coverageid === "2") {
            document.getElementById("note10v2").innerHTML =
              "PHP " + Number(rate[4]["amount"]).toFixed(2);
            document.getElementById("note20v2").innerHTML =
              "PHP " + Number(rate[5]["amount"]).toFixed(2);
            document.getElementById("note30v2").innerHTML =
              "PHP " + Number(rate[6]["amount"]).toFixed(2);
            document.getElementById("note40v2").innerHTML =
              "PHP " + Number(rate[7]["amount"]).toFixed(2);
            document.getElementById("selling_price").innerHTML =
              "PHP " + Number(rate[4]["selling_price"]).toFixed(2);
            document.getElementById("discount").innerHTML =
              "PHP " + Number(rate[4]["discount"]).toFixed(2);
            document.getElementById("amount_due").innerHTML =
              "PHP " + Number(rate[4]["amount_due"]).toFixed(2);
          } else if (coverageid === "3") {
            document.getElementById("note10v2").innerHTML =
              "PHP " + Number(rate[8]["amount"]).toFixed(2);
            document.getElementById("note20v2").innerHTML =
              "PHP " + Number(rate[9]["amount"]).toFixed(2);
            document.getElementById("note30v2").innerHTML =
              "PHP " + Number(rate[10]["amount"]).toFixed(2);
            document.getElementById("note40v2").innerHTML =
              "PHP " + Number(rate[11]["amount"]).toFixed(2);
            document.getElementById("selling_price").innerHTML =
              "PHP " + Number(rate[8]["selling_price"]).toFixed(2);
            document.getElementById("discount").innerHTML =
              "PHP " + Number(rate[8]["discount"]).toFixed(2);
            document.getElementById("amount_due").innerHTML =
              "PHP " + Number(rate[8]["amount_due"]).toFixed(2);
          }
  
          $("#m_federalNote").css("display", "block");
          var coverageDetails = $(this).children("option:selected").val();
          var res = coverageDetails.split("|");
          var coverageid = res[0];
  
          if (coverageid === "1") {
            document.getElementById("m_note10").innerHTML =
              "PHP " + Number(rate[0]["amount"]).toFixed(2);
            document.getElementById("m_note20").innerHTML =
              "PHP " + Number(rate[1]["amount"]).toFixed(2);
            document.getElementById("m_note30").innerHTML =
              "PHP " + Number(rate[2]["amount"]).toFixed(2);
            document.getElementById("m_note40").innerHTML =
              "PHP " + Number(rate[3]["amount"]).toFixed(2);
            document.getElementById("m_selling_price").innerHTML =
              "PHP " + Number(rate[0]["selling_price"]).toFixed(2);
            document.getElementById("m_discount").innerHTML =
              "PHP " + Number(rate[0]["discount"]).toFixed(2);
            document.getElementById("m_amount_due").innerHTML =
              "PHP " + Number(rate[0]["amount_due"]).toFixed(2);
          } else if (coverageid === "2") {
            document.getElementById("m_note10").innerHTML =
              "PHP " + Number(rate[4]["amount"]).toFixed(2);
            document.getElementById("m_note20").innerHTML =
              "PHP " + Number(rate[5]["amount"]).toFixed(2);
            document.getElementById("m_note30").innerHTML =
              "PHP " + Number(rate[6]["amount"]).toFixed(2);
            document.getElementById("m_note40").innerHTML =
              "PHP " + Number(rate[7]["amount"]).toFixed(2);
            document.getElementById("m_selling_price").innerHTML =
              "PHP " + Number(rate[4]["selling_price"]).toFixed(2);
            document.getElementById("m_discount").innerHTML =
              "PHP " + Number(rate[4]["discount"]).toFixed(2);
            document.getElementById("m_amount_due").innerHTML =
              "PHP " + Number(rate[4]["amount_due"]).toFixed(2);
          } else if (coverageid === "3") {
            document.getElementById("m_note10").innerHTML =
              "PHP " + Number(rate[8]["amount"]).toFixed(2);
            document.getElementById("m_note20").innerHTML =
              "PHP " + Number(rate[9]["amount"]).toFixed(2);
            document.getElementById("m_note30").innerHTML =
              "PHP " + Number(rate[10]["amount"]).toFixed(2);
            document.getElementById("m_note40").innerHTML =
              "PHP " + Number(rate[11]["amount"]).toFixed(2);
            document.getElementById("m_selling_price").innerHTML =
              "PHP " + Number(rate[8]["selling_price"]).toFixed(2);
            document.getElementById("m_discount").innerHTML =
              "PHP " + Number(rate[8]["discount"]).toFixed(2);
            document.getElementById("m_amount_due").innerHTML =
              "PHP " + Number(rate[8]["amount_due"]).toFixed(2);
          }
        });
        
      },
      error: function () {
        alert("FAILED!");
      },
    });
  }