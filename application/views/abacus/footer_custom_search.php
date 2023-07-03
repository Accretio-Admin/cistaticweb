
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $('#dp_leave').blur(function (){
        var d_l = $(this).val();
        $('#dleave').val(d_l);
    });

    $('#dp_return').blur(function (){
        var d_l = $(this).val();
        $('#dreturn').val(d_l).childNodes('')
    });
</script>

<script>
    $(document).ready(function() {
        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        var minday =
            d.getFullYear() + '-' +
            (month<10 ? '0' : '') + month + '-' +
            (day<10 ? '0' : '') + day + '-' ;


        var maxday =
            (d.getFullYear()+1) + '-' +
            (month<10 ? '0' : '') + month + '-' +
            (day<10 ? '0' : '') + day + '-' ;


        $('#datePicker')
            .datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                startDate: minday,
                endDate: maxday
            })
            .on('changeDate', function(e) {
                // Revalidate the date field
            });

        $('#datePicker2')
            .datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                startDate: minday,
                endDate: maxday
            })
            .on('changeDate', function(e) {
                // Revalidate the date field
            });


    });
</script>

<script>
    var app = angular.module('MyApp',['ngMessages', 'material.svgAssetsCache']);
    app.controller('myCtrl', function($scope){
        //data collection
        $scope.airports = <?php echo json_encode($airports,true); ?>;
        $scope.airports2 = function(origin){
            var a = origin;
            var res = [];
            if(a!=null){
                for(i=0;i<$scope.airports.length;i++){
                    if(a!=$scope.airports[i].countrycode+':'+$scope.airports[i].airportcode && a.split(':')[0]!=$scope.airports[i].countrycode){
                        res.push($scope.airports[i]);
                    }
                }
            }
            return res;
        }
        $scope.$watch('origin', function(newValue, oldValue) {
            if(newValue!=null){
                $scope.destination = null;
            }
        });

        $scope.$watch('adultcount', function(newValue, oldValue) {
            if(newValue!=null){
                if((parseInt(newValue)+parseInt($scope.seniorcount)+parseInt($scope.childcount)+parseInt($scope.infantcount))>9){
                    $scope.seniorcount = '0';
                    $scope.childcount = '0';
                    $scope.infantcount = '0';
                }
                $scope.adultscount = $scope.addme([$scope.adultcount,$scope.seniorcount]);
            }
        });

        $scope.$watch('seniorcount', function(newValue, oldValue) {
            if(newValue!=null){
                if((parseInt(newValue)+parseInt($scope.adultcount)+parseInt($scope.childcount)+parseInt($scope.infantcount))>9){
                    $scope.childcount = '0';
                    $scope.infantcount = '0';
                }
                $scope.adultscount = $scope.addme([$scope.adultcount,$scope.seniorcount]);
            }
        });

        $scope.$watch('childcount', function(newValue, oldValue) {
            if(newValue!=null){
                if((parseInt(newValue)+parseInt($scope.seniorcount)+parseInt($scope.adultcount)+parseInt($scope.infantcount))>9){
                    $scope.infantcount = '0';
                }
            }
        });




        $scope.airlines = <?php echo json_encode($airlines,true); ?>;
        $scope.number = 5;
        $scope.getNumber = function(num) {
            return new Array(num);
        }

        $scope.col = [0,1,2,3,4,5,6,7,8,9];

        $scope.location = {
            origin : null,
            destination : null,
        };


        $scope.passengers = {
            adultcount : 0,
            seniorcount : 0,
            childcount : 0,
            infantcount : 0
        };


        //init
        $scope.journey = 'RT';
        $scope.airline = 'AL';
        $scope.seatclass = 'A';

        $scope.airlinefilter = {$ : 'N/A'};

        /*$scope.$watch('destination', function(newValue, oldValue,$scope) {
            if(newValue!=null){
                $scope.airlinefilter = {
                    countrycode:newValue.split(':')[0]
                };
            }
        });*/






        $scope.addme = function(num){
            var total = 0;
            for(i=0;i<num.length;i++){
                total += parseInt(num[i]);
            }
            return total;
        }



        $scope.add = function(num1,num2,num3){
            return parseInt(num1)+parseInt(num2)+parseInt(num3);
        }

        $scope.typeOptions = [
            { name: 'Feature', value: 'feature' },
            { name: 'Bug', value: 'bug' },
            { name: 'Enhancement', value: 'enhancement' }
        ];

        $scope.form = {type : $scope.typeOptions[0].value};
    });
</script>

