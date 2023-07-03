

<script>

    angular.module('myApp', [])
        .controller('myCtrl', ['$scope', function($scope) {
            $scope.formatTime = function(str){
                arr = str.split(' ');
                d = arr[0].split('-');
                t = arr[1].split(':');
                return new Date(d[0],d[1]-1,d[2], t[0],t[1],t[2],0);
            }
        }]);
</script>



</body>
</html>



