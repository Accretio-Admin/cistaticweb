<script>
    var app = angular.module('MyApp',['ngMessages', 'material.svgAssetsCache']);
    app.controller('myCtrl', function($scope){
        $scope.rqid = '<?php echo $rqid;?>';
        $scope.passengers = <?php echo json_encode($passengers,1); ?>;


        $scope.isSenior = function(bdate){
            var d1 = new Date(bdate);
            var d2 = new Date();
            var miliseconds = d2-d1;
            console.log(miliseconds);
            return miliseconds;
        }
        $scope.range = function(count){
            var x = [];
            for (var i = 0; i < count; i++) {
                x.push(i)
            }
            return x;
        }
    });


</script>


<!--<script>
    $(document).ready(function(){
        $(".adultbdate").blur(function(){
            var dob = $(this).val();
            console.log(dob);
            /*if(dob != ''){
                var str=dob.split('/');
                var firstdate=new Date(str[2],str[0],str[1]);
                var today = new Date();
                var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);
                var age = parseInt(dayDiff);
                if (age<=12) {
                    alert("Invalid Age for Adult");
                    $(this).val("");

                }
                console.log(age);
            }*/
        });
    });
</script>-->