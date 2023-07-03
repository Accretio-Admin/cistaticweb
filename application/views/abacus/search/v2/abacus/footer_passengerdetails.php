<script>

    $(document).ready(function () {



        updateConfig();
        updateConfig2();
        updateConfig3();
        updateConfig4();
        function updateConfig() {
            $('.datepickerAdult').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                /*"startDate": moment().subtract(12,'year'),*/
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(12,'year')
            }, function(start, end, label) {

            });
        }


        function updateConfig2() {
            $('.datepickerSenior').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                /*"startDate": moment().subtract(60,'year'),*/
                "minDate": moment().subtract(110,'year'),
                "maxDate": moment().subtract(60,'year')
            }, function(start, end, label) {

            });
        }

        function updateConfig3() {
            $('.datepickerChildren').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                /*"startDate": moment().subtract(2,'year'),*/
                "minDate": moment().subtract(11,'year'),
                "maxDate": moment().subtract(2,'year')
            }, function(start, end, label) {

            });
        }

        function updateConfig4() {
            $('.datepickerInfant').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                locale: {
                    format: 'MM/DD/YYYY'
                },
                /*"startDate": moment().subtract(1,'month'),*/
                "minDate": moment().subtract(23,'month'),
                "maxDate": moment().subtract(1,'month')
            }, function(start, end, label) {

            });
        }

        $('.input').bind('keypress', function (event) {
            var regex = new RegExp("^[ñÑa-zA-Z ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

    });

</script>

<script>

    angular.module('myApp', [])
        .controller('myCtrl', ['$scope', function($scope) {
            $scope.getAgeInfant = function(dateofbirth){
                dateofbirth = moment(dateofbirth,'MM/DD/YYYY');
                y = moment().diff(dateofbirth,'year');
                m = moment().diff(dateofbirth,'month');
                return m;
            }
            $scope.getAge = function(dateofbirth){
                dateofbirth = moment(dateofbirth,'MM/DD/YYYY');
                y = moment().diff(dateofbirth,'year');
                return y;
            }

            <?php if($passengers){
                echo str_replace('\/','/','$scope.p = '.json_encode($passengers,true));
                }?>

            <?php if($contacts){
               echo '$scope.c = '.json_encode($contacts,true);
               }?>

            $scope.$watch('c.contactno',function(newValue,oldValue){
                if(oldValue!=null && newValue!=null){
                    str = "";
                    arr = newValue.split("");
                    for(i=0;i<arr.length;i++){
                        if(!isNaN(parseInt(arr[i])) && angular.isNumber(parseInt(arr[i]))){
                            str += parseInt(arr[i]);
                        }
                    }
                    if(str.length>11){
                        $scope.c.contactno = oldValue;
                    }else{
                        $scope.c.contactno = str;
                    }
                }
            });

            $scope.formatTime = function(str){
                arr = str.split('T');
                d = arr[0].split('-');
                t = [parseInt(arr[1].substr(0,2)),parseInt(arr[1].substr(2,4))];
                return new Date(d[0],d[1]-1,d[2], t[0],t[1],0,0);
            }
            $scope.startDate = {
                "Adult" : moment().subtract(12,'year').format('MM/DD/YYYY'),
                "Senior" : moment().subtract(12,'year').format('MM/DD/YYYY'),
                "Children" : moment().subtract(2,'year').format('MM/DD/YYYY'),
                "Infant" : moment().format('MM/DD/YYYY')
            };



            $scope.getPassengerSTR = function(){
                //GUIDE

                /*<option value="1">Mr</option>
                 <option value="2">Mrs</option>
                 <option value="3">Miss</option>
                 <option value="4">Mstr</option>*/
                /*T:A|^@^|TL:1|^@^|FN:Joe Ryan |^@^|LN:De Chavez|^@^|DOB:12/06/1979|^@^|S:|^@^|OB:1|^@^|RB:1|*|T:A|^@^|TL:2|^@^|FN:Raine|^@^|LN:Mora|^@^|DOB:19/10/1983|^@^|S:|^@^|OB:1|^@^|RB:1",*/

                str = '';

                for(var key in $scope.p){
                    obj = $scope.p[key];
                    kx = key.toUpperCase().substring(0,1);

                    for(i=0;i<Object.keys(obj).length;i++){
                        _obj = obj[i];

                        if(str.length>0){
                            str += '|*|';
                        }
                        var _gender = (_obj.gender?(_obj.gender=='M'?'1':(_obj.gender=='F'?'3':'')):'');
                        var _dob = (_obj.DOB?moment(_obj.DOB,'MM/DD/YYYY').format('DD/MM/YYYY'):'');
                        str += 'T:'+kx+'|^@^|' +
                            'TL:'+(_obj.TL?_obj.TL:'')+'|^@^|' +
                            'FN:'+(_obj.FN?_obj.FN:'')+'|^@^|' +
                            'LN:'+(_obj.LN?_obj.LN:'')+'|^@^|' +
                            'DOB:'+_dob+'|^@^|' +
                            'S:'+(_obj.S?_obj.S:'')+'|^@^|' +
                            'OB:'+(_obj.OB?_obj.OB:'1')+'|^@^|RB:'+(_obj.RB?_obj.RB:'1');
                    }
                }

                return str;
            };



            /*$scope.getotherdetailsSTR = function(){

                str = '';
                str += $scope.contactno + "|^@^|" +
                $scope.emailadd + "|^@^|" +
                $scope.street + "|^@^|" +
                $scope.city + "|^@^|" +
                $scope.zipcode + "|^@^|" +
                $scope.country;

                return str;
            }*/



        }]);
</script>



</body>
</html>



