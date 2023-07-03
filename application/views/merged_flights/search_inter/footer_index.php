<script>

    $(document).ready(function () {

        $("input[name ='journey']:radio").change(function(){
            j = $(this).val();
            if(j=='RT'){
                updateConfig2($('#datepicker1').val());
            }else{
                $('#datepicker2').val('');
            }
        });

        updateConfig();
        updateConfig2($('#datepicker1').val());
        function updateConfig() {
            $('#datepicker1').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                "minDate": moment(),
                "maxDate": moment().add(1,'year')
            }, function(start, end, label) {
                //console.log("New date range selected: " + start.format('YYYY-MM-DD') + " to " + end.format('YYYY-MM-DD') + " (predefined range: " + label + ")");
                // console.log($('#datepicker1').val());
                if($("input:radio[name ='journey']:checked").val()=='RT'){
                    updateConfig2(start.format('YYYY-MM-DD'));
                }
            });
        }

        function updateConfig2(val){
            $('#datepicker2').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                "minDate": val,
                "maxDate": moment().add(1,'year')
            }, function(start, end, label) {
                //console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
            });
        }


    });

</script>


<script>

    angular.module('myApp', [])
        .controller('myCtrl', ['$scope', function($scope) {
            $scope.col = [0,1,2,3,4,5,6,7,8,9];

            $scope.airportcollection = <?php echo json_encode($airports,true); ?>;
            $scope.airports = function(origin){

                <?php if($menu=='dom'): ?>
                var res = [];
                <?php else:?>
                var res = {};
                <?php endif;?>

                if(origin!=null){
                    arr = Object.keys($scope.airportcollection);
                    for(i=0;i<arr.length;i++){
                        k = arr[i];
                        if(origin!=k){
                            <?php if($menu=='dom'): ?>
                                res.push($scope.airportcollection[k]);
                            <?php else:?>
                                res[k] = $scope.airportcollection[k];
                            <?php endif;?>
                        }
                    }
                }
                return res;
            }


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

            $scope.addme = function(num){
                var total = 0;
                for(i=0;i<num.length;i++){
                    total += parseInt(num[i]);
                }
                return total;
            }

            $scope.getcityfrom = function(countrycode){
                if(countrycode){
                    return $scope.airportcollection[countrycode].airports;
                }else{
                    return [];
                }
            }

        }]);
</script>



</body>
</html>



