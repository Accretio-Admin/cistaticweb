<script>
    var app = angular.module('MyApp',['ngMessages', 'material.svgAssetsCache']);
    app.controller('myCtrl', function($scope){
        $scope.errormsg = '<?php echo $errormessage; ?>';
        $scope.flights = <?php echo json_encode($result,true);?>;
        $scope.rqid = <?php echo json_encode($rqid,true); ?>;
        $scope.passengers = <?php echo json_encode($passenger,true);?>;




        $scope.c_onward = null;
        $scope.c_return = null;
        $scope.c_pricing = null;

        $scope.data = null;
        $scope.datamd = 9;

        $scope.showOnPanel = function(i){
            $scope.datamd = 6;
            $scope.data = {
                onward:[],
                return:[],
                pricing:[],
                adultcount: 0,
                childcount: 0,
                infantcount: 0
            };

            $scope.c_onward = i[0].onward;
            for(var n=0;n<i[0].onward.length;n++){
                oward = i[0].onward[n];
                $scope.data.onward.push({
                    carriername: oward.Carrier,
                    carrier: oward.CarrierID,
                    flightno: oward.FlightNumber,
                    source: oward.Source,
                    destination: oward.Destination,
                    dateleave : oward.DepartureTimeStamp,
                    datearrive : oward.ArrivalTimeStamp,
                    class: oward.Class
                });
            }

            switch(i.length){
                case 2:
                    $scope.c_pricing = i[1].pricing;
                    for(var n=0;n<i[1].pricing.length;n++){
                        pcing = i[1].pricing[n];
                        $scope.data.pricing.push({
                            systemfee: parseInt(pcing.SystemFee),
                            markupfee: parseInt(pcing.MarkupFee),
                            currency: pcing.currency,
                            basefare: pcing.BaseFareFee,
                            taxfee: parseInt(pcing.TaxFee),
                            taxnfee: parseInt(pcing.SystemFee)+parseInt(pcing.MarkupFee)+parseInt(pcing.TaxFee),
                            totalfee: pcing.TotalFee,
                            is_available : pcing.is_available
                        });
                    }
                    break;
                case 3:
                    $scope.c_return = i[1].return;
                    for(var n=0;n<i[1].return.length;n++){
                        rturn = i[1].return[n];
                        $scope.data.return.push({
                            carriername: rturn.Carrier,
                            carrier: rturn.CarrierID,
                            flightno: rturn.FlightNumber,
                            source: rturn.Source,
                            destination: rturn.Destination,
                            dateleave : rturn.DepartureTimeStamp,
                            datearrive : rturn.ArrivalTimeStamp,
                            class: rturn.Class,
                        });
                    }

                    $scope.c_pricing = i[2].pricing;
                    for(var n=0;n<i[2].pricing.length;n++){
                        pcing = i[2].pricing[n];
                        $scope.data.pricing.push({
                            systemfee: parseInt(pcing.SystemFee),
                            markupfee: parseInt(pcing.MarkupFee),
                            currency: pcing.currency,
                            basefare: pcing.BaseFareFee,
                            taxfee: parseInt(pcing.TaxFee),
                            taxnfee: parseInt(pcing.SystemFee)+parseInt(pcing.MarkupFee)+parseInt(pcing.TaxFee),
                            totalfee: pcing.TotalFee,
                            is_available : pcing.is_available
                        });
                    }
                    break;
            }

            for(var x=0;x<$scope.passengers.length;x++){
                pa = $scope.passengers[x];
                if(pa.Type=='A'){
                    $scope.data.adultcount++;
                }else if(pa.Type=='C'){
                    $scope.data.childcount++;
                }else if(pa.Type=='I'){
                    $scope.data.infantcount++;
                }
            }

        };
        //data collection
        /*$scope.airports = <?php /*echo json_encode($airports,true);*/ ?>;
        $scope.airlines = <?php /*echo json_encode($airlines,true);*/ ?>;
        $scope.col = [0,1,2,3,4,5,6,7,8,9];

        //init
        $scope.journey = 'RT';

        $scope.origin;
        $scope.destination;
        $scope.adultcount = 1;
        $scope.childcount = 0;
        $scope.infantcount = 0;
        $scope.airline = 'AL';
        $scope.seatclass = 'A';

        $scope.airlinefilter = {$ : 'N/A'};

        $scope.$watch('destination', function(newValue, oldValue,$scope) {
            $scope.airlinefilter = {
                countrycode:newValue.split(':')[0]
            };
        });

*/
        $scope.add = function(num1,num2){
            return parseInt(num1)+parseInt(num2)+parseInt(num3);
        }
    });
</script>