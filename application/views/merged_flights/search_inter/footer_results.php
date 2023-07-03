<script>
    angular.module('myApp', [])
        .controller('myCtrl', ['$scope', function($scope) {
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


        }]);
</script>

</body>
</html>
