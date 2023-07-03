


<div style="padding-top:20px;" class="container-fluid">
    <table id="tbl_gocab_account_details" class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">NAME</th>
            <th class="text-center">BIRTHDATE</th>
            <th class="text-center">ID NUMBER</th>
            <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php if($DATA):?>
            <?php foreach($DATA as $row):?>
                <tr>
                    <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];?></td>
                    <td><?php echo $row['birthdate'];?></td>
                    <td><?php echo $row['number'];?></td>
                    <?php if($row['status'] == 'APPROVED'):?>
                        <td><center><button data-id="<?php echo $row['id']?>" class="btn btn-primary selectedID">SELECT</button></center></td>
                    <?php else:?>
                        <td><center>WAITING FOR APPROVAL</center></td>
                    <?php endif;?>
                </tr>
            <?php endforeach;?>
        <?php else:?>
            <tr>
                <td colspan="4"><center>NO RESULT</center></td>
            </tr>
        <?php endif;?>
    </tbody>
    </table>
</div>

<script>
    $('#tbl_gocab_account_details').on('click','.selectedID', function(){
        let id = $(this).attr('data-id');

        $.ajax({
            method: "POST",
            url: "/Ecash_payout/get_gocab_account_details",
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function (response) {
                $('.account_details_modal').html(response['MODAL'])
                $('#gocab_account_details_modal').modal('show');
            }
       });
    });
</script>