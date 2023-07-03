<script type="text/javascript">
    $(document).ready(function(){
       $('span[rel="tooltip"]').tooltip();
    });
</script>

<script type="text/javascript">
  //for international ticketing date select
  $(document).ready(function () {

      $("input[name ='flighttype']:radio").change(function(){
        // console.log($(this).val());
          j = $(this).val();
          if(j==1){
              updateConfig2($('.date_leave').val());
          }else{
              $('.date_return').val('');
          }
      });

      updateConfig();
      updateConfig2($('.date_leave').val());
      function updateConfig() {
          $('.date_leave').daterangepicker({
              "singleDatePicker": true,
              "showDropdowns": true,
              locale: {
                  format: 'YYYY-MM-DD'
              },
              "minDate": moment(),
              "maxDate": moment().add(2,'year')
          }, function(start, end, label) {
              //console.log("New date range selected: " + start.format('YYYY-MM-DD') + " to " + end.format('YYYY-MM-DD') + " (predefined range: " + label + ")");
              // console.log($('#date_leave').val());
              if($("input:radio[name ='flighttype']:checked").val()==1){
                  updateConfig2(start.format('YYYY-MM-DD'));
              }
          });
      }

      function updateConfig2(val){
          $('.date_return').daterangepicker({
              "singleDatePicker": true,
              "showDropdowns": true,
              locale: {
                  format: 'YYYY-MM-DD'
              },
              "minDate": val,
              "maxDate": moment().add(2,'year')
          }, function(start, end, label) {
              //console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
          });
      }

      // $("input[name ='choose_flights']:radio").change(function(){
      //   window.scrollTo(0,document.body.scrollHeight);
      //   $('html,body').animate({scrollTop: document.body.scrollHeight},"fast");
      //   $('html, body').animate({scrollTop:$(document).height()}, 'slow');
      //   return false;
      // });

      $('.btn-moveDown').click(function() {
        // window.scrollTo(0,document.body.scrollHeight);
        // $('html,body').animate({scrollTop: document.body.scrollHeight},"fast");
        $('html,body').animate({scrollTop: document.body.scrollHeight}, 500);
      });

  });


</script>


<script>
    $(document).ready(function () {
        updateConfig();
        updateConfig2();
        updateConfig3();
        updateConfig4();
        function updateConfig() {
            $('.datepickerExpiry').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment(),
                // "minDate": moment().subtract(3,'year'),
                "minDate": moment(),
                "maxDate": moment().add(15,'year')
                }, function(start, end, label) {

            });
            
            $('.datepickerAdult0').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
            $('.datepickerAdult1').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
            $('.datepickerAdult2').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
            $('.datepickerAdult3').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
            $('.datepickerAdult4').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
            $('.datepickerAdult5').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
            $('.datepickerAdult6').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
            $('.datepickerAdult7').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
            $('.datepickerAdult8').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(12,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(11,'year')
            }, function(start, end, label) {

            });
        }


        function updateConfig2() {
            $('.datepickerSenior0').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
            $('.datepickerSenior1').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
            $('.datepickerSenior2').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
            $('.datepickerSenior3').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
            $('.datepickerSenior4').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
            $('.datepickerSenior5').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
            $('.datepickerSenior6').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
            $('.datepickerSenior7').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
            $('.datepickerSenior8').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(60,'year'),
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
        }

        function updateConfig3() {
            $('.datepickerChildren0').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
            $('.datepickerChildren1').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
            $('.datepickerChildren2').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
            $('.datepickerChildren3').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
            $('.datepickerChildren4').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
            $('.datepickerChildren5').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
            $('.datepickerChildren6').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
            $('.datepickerChildren7').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
            $('.datepickerChildren8').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(2,'year'),
                "minDate": moment().subtract(12,'year'),
                // "maxDate": moment().subtract(2,'year')
                "maxDate": moment().subtract(1,'year')
            }, function(start, end, label) {

            });
        }

        function updateConfig4() {
            $('.datepickerInfant0').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
            $('.datepickerInfant1').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
            $('.datepickerInfant2').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
            $('.datepickerInfant3').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
            $('.datepickerInfant4').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
            $('.datepickerInfant5').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
            $('.datepickerInfant6').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
            $('.datepickerInfant7').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
            $('.datepickerInfant8').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                "startDate": moment().subtract(1,'month'),
                "minDate": moment().subtract(24,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
        }

        $('.Intlinput').bind('keypress', function (event) {
            var regex = new RegExp("^[ñÑa-zA-Z ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });


        $('.datepickerAdult0').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge0").html(y);//display it
        });
        $('.datepickerAdult1').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge1").html(y);//display it
        });
        $('.datepickerAdult2').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge2").html(y);//display it
        });
        $('.datepickerAdult3').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge3").html(y);//display it
        });
        $('.datepickerAdult4').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge4").html(y);//display it
        });
        $('.datepickerAdult5').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge5").html(y);//display it
        });
        $('.datepickerAdult6').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge6").html(y);//display it
        });
        $('.datepickerAdult7').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge7").html(y);//display it
        });
        $('.datepickerAdult8').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getAdultAge8").html(y);//display it
        });


        $('.datepickerChildren0').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge0").html(y);//display it
        });
        $('.datepickerChildren1').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge1").html(y);//display it
        });
        $('.datepickerChildren2').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge2").html(y);//display it
        });
        $('.datepickerChildren3').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge3").html(y);//display it
        });
        $('.datepickerChildren4').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge4").html(y);//display it
        });
        $('.datepickerChildren5').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge5").html(y);//display it
        });
        $('.datepickerChildren6').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge6").html(y);//display it
        });
        $('.datepickerChildren7').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge7").html(y);//display it
        });
        $('.datepickerChildren8').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getChildAge8").html(y);//display it
        });


        $('.datepickerInfant0').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge0").html(m);//display it
        });
        $('.datepickerInfant1').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge1").html(m);//display it
        });
        $('.datepickerInfant2').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge2").html(m);//display it
        });
        $('.datepickerInfant3').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge3").html(m);//display it
        });
        $('.datepickerInfant4').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge4").html(m);//display it
        });
        $('.datepickerInfant5').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge5").html(m);//display it
        });
        $('.datepickerInfant6').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge6").html(m);//display it
        });
        $('.datepickerInfant7').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge7").html(m);//display it
        });
        $('.datepickerInfant8').on('change',function(){
                var selectedYear = $(this).val();
                // alert(selectedYear);
                var dateofbirth = moment(selectedYear,'MM/DD/YYYY');
                var y = moment().diff(dateofbirth,'year');
                var m = moment().diff(dateofbirth,'month');
                // alert(y);
                $(".getInfantAge8").html(m);//display it
        });

    });


var _validFileExtensions = [".jpg", ".jpeg", ".png"];    
function ValidateUploadFile(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                alert("Your uploaded file type is not allowed \n\n Allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}

/*INSERT NEW ID */
$(".btnUploadPassport").change(function(){

      var number = $(this).data('mynumber');

      $("#uploadmessage"+number).hide();
      $("#passportImg"+number).val('');

      var fileInput = document.getElementById('filepassport'+number);   
      var file = fileInput.files[0];

      if (file == "" || file == undefined) {
        console.log('no upload');

      } else {

        

        var formData = new FormData();    
        formData.append('file', file);
        formData.append('type', 'PASSPORT');


        $.ajax({
            url: "/Merged_intl_flights/add_newid_payout",
            type: 'POST',
            // data: parameters,
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            
            success: function (data) {

                var jsondata = JSON.parse(data);
                // console.log(jsondata);

                if(jsondata.S != 1){
                    $("#uploadmessage"+number).html('Passport '+jsondata.M);
                    $("#uploadmessage"+number).last().addClass( "alert alert-success" );
                    $("#uploadmessage"+number).show();
                    $("#passportImg"+number).val(jsondata.A);

                    //validate begin: 
                      var empty_flds = 0;
                      $(".required").each(function() {
                          if(!$.trim($(this).val())) {
                              empty_flds++;
                          }    
                      });

                      var uploadcount = $("#uploadcount").val();
                      var noblank = 0;
                      var x = 0;
                      while(x < uploadcount){

                        var passportImgVal = $("#passportImg"+x).val();
                        var visaImgVal = $("#visaImg"+x).val();

                        if(passportImgVal == ""){
                          noblank++;
                        }

                        if(visaImgVal == ""){
                          noblank++;
                        }

                        x++;
                      }

                        if (empty_flds == 0 && noblank == 0) { 
                            $('#btnBookFlights').removeAttr("disabled");
                        } else {
                            $('#btnBookFlights').attr("disabled",true);
                        }
                    //validate end: 
                }
                else
                {
                    $("#uploadmessage"+number).html(jsondata.M);
                    $("#uploadmessage"+number).last().addClass( "alert alert-danger" );
                    $("#uploadmessage"+number).show();

                }
            }

        });
      }



    return false;

});

/*INSERT NEW ID */
$(".btnUploadVisa").change(function(){

      var number = $(this).data('mynumbervisa');

      $("#uploadmessagevisa"+number).hide();
      $("#visaImg"+number).val('');

      var fileInput = document.getElementById('filevisa'+number);   
      var file = fileInput.files[0];

      if (file == "" || file == undefined) {
        console.log('no upload');

      } else {

        var formData = new FormData();    
        formData.append('file', file);
        formData.append('type', 'VISA');

        $.ajax({
            url: "/Merged_intl_flights/add_newid_payout",
            type: 'POST',
            // data: parameters,
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            
            success: function (data) {

                var jsondata = JSON.parse(data);
                // console.log(jsondata);

                if(jsondata.S != 1){
                    $("#uploadmessagevisa"+number).html('Visa '+jsondata.M);
                    $("#uploadmessagevisa"+number).last().addClass( "alert alert-success" );
                    $("#uploadmessagevisa"+number).show();
                    $("#visaImg"+number).val(jsondata.A);

                    //validate begin: 
                      var empty_flds = 0;
                      $(".required").each(function() {
                          if(!$.trim($(this).val())) {
                              empty_flds++;
                          }    
                      });

                      var uploadcount = $("#uploadcount").val();
                      var noblank = 0;
                      var x = 0;
                      while(x < uploadcount){

                        var passportImgVal = $("#passportImg"+x).val();
                        var visaImgVal = $("#visaImg"+x).val();

                        if(passportImgVal == ""){
                          noblank++;
                        }

                        if(visaImgVal == ""){
                          noblank++;
                        }

                        x++;
                      }

                        if (empty_flds == 0 && noblank == 0) { 
                            $('#btnBookFlights').removeAttr("disabled");
                        } else {
                            $('#btnBookFlights').attr("disabled",true);
                        }
                    //validate end: 
                }
                else
                {
                    $("#uploadmessagevisa"+number).html(jsondata.M);
                    $("#uploadmessagevisa"+number).last().addClass( "alert alert-danger" );
                    $("#uploadmessagevisa"+number).show();

                }
            }

        });
      }



    return false;

});


/*INSERT NEW ID RTT */
$(".btnUploadRTT").change(function(){

      var number = $(this).data('mynumberrtt');

      $("#uploadmessagertt"+number).hide();
      $("#rttImg"+number).val('');

      var fileInput = document.getElementById('filertt'+number);   
      var file = fileInput.files[0];

      if (file == "" || file == undefined) {
        console.log('no upload');

      } else {

        var formData = new FormData();    
        formData.append('file', file);
        formData.append('type', 'RTT');

        $.ajax({
            url: "/Merged_intl_flights/add_newid_payout",
            type: 'POST',
            // data: parameters,
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            
            success: function (data) {

                var jsondata = JSON.parse(data);
                // console.log(jsondata);

                if(jsondata.S != 1){
                    $("#uploadmessagertt"+number).html('Reduced Travel Tax '+jsondata.M);
                    $("#uploadmessagertt"+number).last().addClass( "alert alert-success" );
                    $("#uploadmessagertt"+number).show();
                    $("#rttImg"+number).val(jsondata.A);

                    //validate begin: 
                      var empty_flds = 0;
                      $(".required").each(function() {
                          if(!$.trim($(this).val())) {
                              empty_flds++;
                          }    
                      });

                      var uploadcount = $("#uploadcount").val();
                      var noblank = 0;
                      var x = 0;
                      while(x < uploadcount){

                        var passportImgVal = $("#passportImg"+x).val();
                        var visaImgVal = $("#visaImg"+x).val();
                        var rttImgVal = $("#rttImg"+x).val();

                        if(passportImgVal == ""){
                          noblank++;
                        }

                        if(visaImgVal == ""){
                          noblank++;
                        }

                        if(rttImgVal == ""){
                          noblank++;
                        }


                        x++;
                      }

                        if (empty_flds == 0 && noblank == 0) { 
                            $('#btnBookFlights').removeAttr("disabled");
                        } else {
                            $('#btnBookFlights').attr("disabled",true);
                        }
                    //validate end: 
                }
                else
                {
                    $("#uploadmessagertt"+number).html(jsondata.M);
                    $("#uploadmessagertt"+number).last().addClass( "alert alert-danger" );
                    $("#uploadmessagertt"+number).show();

                }
            }

        });
      }



    return false;

});

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.checkRTT').click(function(){
            if($(this).is(':checked')){
                // alert('checked');
                $(".rttFileCHILD").show();
                $('.btnUploadRTTCHILD').attr("disabled",false);
                $('.rttuploadCHILD').attr("disabled",false);
                $('.btnUploadRTTCHILD').attr("required",true);
                $(".btnUploadRTTCHILD").addClass( "required");

            }else {
                // alert('wala');
                $(".rttFileCHILD").hide();
                $(".rttuploadCHILD").val('');
                $(".btnUploadRTTCHILD").val('');
                $('.btnUploadRTTCHILD').attr("disabled",true);
                $('.rttuploadCHILD').attr("disabled",true);
                $('.btnUploadRTTCHILD').attr("required",false);
                $(".btnUploadRTTCHILD").removeClass( "required");
                $(".uploadmessagerttCHILD").hide();

            }
        });

        $('.checkRTTinf').click(function(){
            if($(this).is(':checked')){
                // alert('checked');
                $(".rttFileINF").show();
                $('.btnUploadRTTINF').attr("disabled",false);
                $('.rttuploadINF').attr("disabled",false);
                $('.btnUploadRTTINF').attr("required",true);
                $(".btnUploadRTTINF").addClass( "required");

            }else {
                // alert('wala');
                $(".rttFileINF").hide();
                $(".rttuploadINF").val('');
                $(".btnUploadRTTINF").val('');
                $('.btnUploadRTTINF').attr("disabled",true);
                $('.rttuploadINF').attr("disabled",true);
                $('.btnUploadRTTINF').attr("required",false);
                $(".btnUploadRTTINF").removeClass( "required");
                $(".uploadmessagerttINF").hide();

            }
        });

    })
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#destination2').change(function(){
            // var val = $(this).val();
            var result = $(this).val().split('|');
            var val = result[0];
            // alert(val);
            $(".airportClass b").remove();
            
            if(val == 'MPH' || val == 'KLO' || val == 'RXS'){
                // $('#myIntlSearchModal').modal('show');
                if(val == 'MPH') {
                    $('.airportClass').append( "<b>BORACAY (CATICLAN)</b>" );
                } else if (val == 'KLO') {
                    $('.airportClass').append( "<b>KALIBO, if going to BORACAY</b>" );
                } else if (val == 'RXS') {
                    $('.airportClass').append( "<b>ROXAS CITY, if going to BORACAY</b>" );
                }
            }
        });

        $('.btnNoNo').click(function(){
            $('#destination').val('');
            $('#destination2').val('');
            $('#myIntlSearchModal').modal('hide');
        });

        $('.check_agree').click(function(){
            var checkBox = document.getElementById("checkagree");
            if (checkBox.checked == true){
                // alert("OKAY");
                $(".btn-booknow").prop("disabled", false);
            } else {
                // alert("no");
                $(".btn-booknow").prop("disabled", true);
            }
        });

    });
</script>
