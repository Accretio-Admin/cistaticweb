
<script>
    angular.module('myApp', [])

        .controller('myCtrl', ['$anchorScroll', '$location', '$scope', function($anchorScroll, $location, $scope) {

            $scope.data = <?php echo json_encode($data,true); ?>;

            $scope.chosen_onward = {provider:'',index:-1};
            $scope.chosen_return = {provider:'',index:-1};

            $scope.formatDate = function(str){
                arr = str.split('T');
                d = arr[0].split('-');
                t = [parseInt(arr[1].substr(0,2)),parseInt(arr[1].substr(2,4))];
                return new Date(d[0],d[1]-1,d[2], t[0],t[1],0,0);
            }

            $scope.formatTime = function(str){
                arr = str.split('T');
                d = arr[0].split('-');
                t = [parseInt(arr[1].substr(0,2)),parseInt(arr[1].substr(2,4))];
                return new Date(d[0],d[1]-1,d[2], t[0],t[1],0,0);
            }

            $scope.dateDiff = function(datefrom,dateto){
                datefrom = moment(datefrom,'YYYY-MM-DDTHHmm');
                dateto = moment(dateto,'YYYY-MM-DDTHHmm');

                D = 0;
                h = 0;
                m = dateto.diff(datefrom,'minutes');

                while(m>=60){
                    m -=60;
                    h +=1;
                }
                while(h>=24){
                    h -=24;
                    D +=1;
                }

                str = '';
                if(D>0)
                    str = D+'d ';
                if(h>0)
                    str += h+'h ';
                if(m>0)
                    str += m+'m ';

                return str;
            }

            $scope.hello = function(){
                alert('ha');
            }

            $scope.getBookingClass = function (cabin, classx) {

                if (classx&&classx.length>0) {
                    switch (cabin) {
                        // case 'Y':
                        //     switch (classx) {
                        //         case'V':
                        //         case'B':
                        //         case'X':
                        //         case'K':
                        //         case'E':
                        //         case'T':
                        //         case'U':
                        //         case'O':
                        //             return 'Budget Economy';

                        //         case'Y':
                        //         case'S':
                        //         case'L':
                        //         case'M':
                        //         case'H':
                        //         case'Q':
                        //             return 'Regular Economy';

                        //         case'W':
                        //         case'N':
                        //             return 'Premium Economy';

                        //         default:
                        //             return 'Economy';
                        //     }
                        //     break;
                        // case 'S':
                        //     return 'Premium Economy';
                        // case 'C':
                        //     return 'Business Class';
                        // case 'J':
                        //     return 'Premium Business Class';
                        // case 'F':
                        //     return 'First Class';
                        // case 'P':
                        //     return 'Premium First Class';
                        // default:
                        //     return cabin;

                        case'V':
                        case'B':
                        case'X':
                        case'K':
                        case'E':
                        case'T':
                        case'U':
                        case'O':
                            return 'Budget Economy';
                        case'Y':
                        case'S':
                        case'L':
                        case'M':
                        case'H':
                        case'Q':
                            return 'Regular Economy';
                        case'W':
                        case'N':
                            return 'Premium Economy';
                        default:
                            return cabin;
                            
                    }
                } else {

                    switch (cabin) {
                        case'V':
                        case'B':
                        case'X':
                        case'K':
                        case'E':
                        case'T':
                        case'U':
                        case'O':
                            return 'Budget Economy';
                        // case'D':
                        // case'Z':
                        //     return 'Business Class';
                        case'Y':
                        case'S':
                        case'L':
                        case'M':
                        case'H':
                        case'Q':
                            return 'Regular Economy';
                        case'W':
                        case'N':
                            return 'Premium Economy';
                        default:
                            return cabin;
                    }
                }
            }

            $scope.gotoTop = function() {
                // set the location.hash to the id of
                // the element you wish to scroll to.
                //$location.hash('top');

                // call $anchorScroll()
                //$anchorScroll();
                document.getElementById('top').scrollIntoView();
            };

            $scope.selectOnward = function(provider,index){
                $scope.chosen_onward = {provider:provider,index:index};
                $scope.gotoTop();
            };
            $scope.selectReturn = function(provider,index){
                $scope.chosen_return = {provider:provider,index:index};
                $scope.gotoTop();
            };

            $scope.details = {
                Journey:        ('results_return' in $scope.data)?'Roundtrip':'One-way',
                Origin:         $scope.data['results_onward']['result'][0]['Flights'][0]['Source'],
                Destination:    $scope.data['results_onward']['result'][0]['Flights'][$scope.data['results_onward']['result'][0]['Flights'].length-1]['Destination'],
            };

            $scope.pricing = {
                BaseFareFee:    0,
                TaxFee:         0,
                TotalFee:       0
            };

            $scope.$watch('chosen_onward',function(newValue,oldValue){

                // onward_provider = newValue['provider'];
                onward_provider = 'result';
                onward_index = newValue['index'];
                // return_provider = $scope.chosen_return['provider'];
                return_provider = 'result';
                return_index = $scope.chosen_return['index'];

                basefare = 0;
                taxfee = 0;
                totalfee = 0;

                if(onward_index>=0){
                    onward = $scope.data['results_onward'][onward_provider][onward_index];
                    totalfee += parseFloat(onward['Pricing']['TotalFee']);
                    taxfee += parseFloat(onward['Pricing']['TaxFee'])+parseFloat(onward['Pricing']['SystemFee'])+parseFloat(onward['Pricing']['MarkupFee']);
                    basefare += parseFloat(onward['Pricing']['BaseFareFee']);
                }

                if(return_index>=0){
                    returning = $scope.data['results_return'][return_provider][return_index];
                    totalfee += parseFloat(returning['Pricing']['TotalFee']);
                    taxfee += parseFloat(returning['Pricing']['TaxFee'])+parseFloat(returning['Pricing']['SystemFee'])+parseFloat(returning['Pricing']['MarkupFee']);
                    basefare += parseFloat(returning['Pricing']['BaseFareFee']);
                }

                $scope.pricing['BaseFareFee'] = basefare;
                $scope.pricing['TaxFee'] = taxfee;
                $scope.pricing['TotalFee'] = totalfee;


            });

            $scope.$watch('chosen_return',function(newValue,oldValue){
                // onward_provider = $scope.chosen_onward['provider'];
                onward_provider = 'result';
                onward_index = $scope.chosen_onward['index'];
                // return_provider = newValue['provider'];
                return_provider = 'result';
                return_index = newValue['index'];

                basefare = 0;
                taxfee = 0;
                totalfee = 0;

                if(onward_index>=0){
                    onward = $scope.data['results_onward'][onward_provider][onward_index];
                    totalfee += parseFloat(onward['Pricing']['TotalFee']);
                    taxfee += parseFloat(onward['Pricing']['TaxFee'])+parseFloat(onward['Pricing']['SystemFee'])+parseFloat(onward['Pricing']['MarkupFee']);
                    basefare += parseFloat(onward['Pricing']['BaseFareFee']);
                }

                if(return_index>=0){
                    returning = $scope.data['results_return'][return_provider][return_index];
                    totalfee += parseFloat(returning['Pricing']['TotalFee']);
                    taxfee += parseFloat(returning['Pricing']['TaxFee'])+parseFloat(returning['Pricing']['SystemFee'])+parseFloat(returning['Pricing']['MarkupFee']);
                    basefare += parseFloat(returning['Pricing']['BaseFareFee']);
                }
                $scope.pricing['BaseFareFee'] = basefare;
                $scope.pricing['TaxFee'] = taxfee;
                $scope.pricing['TotalFee'] = totalfee;
            });

            /*Onwards Flight

            Carrier :

                Flight No : 5J-579

            Source : MNL

            Destination : CEB

            Class : TC

            Fare Status : Fare is non-refundable.

                Payment Details

            Passenger :
                1 (Adult)
            Base Fare : PHP 988.00

            Taxes & Fees : 641.56

            Total Amount : PHP 1,629.56*/





        }]);



</script>
<style>
    .disabled.displaynone {
        display: none;
    }
</style>
