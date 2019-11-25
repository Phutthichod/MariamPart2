<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="views/intruder/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">นามสกุล</th>
                <th scope="col">ประวัติการบุกรุก</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                    $name = '';
                    $lname = '';
                 foreach($this->data as $row){ 
                   
                    if($row['firstname'] != $name || $lname != $row['lastname']){
                        $name = $row['firstname'];
                        $lname = $row['lastname'];
                    ?>
                <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $row['firstname'];?></td>
                <td><?php echo $row['lastname'];?></td>
                <td>
                        <?php $j = 0;  foreach($this->data as $row2){
                            
                            if($row['firstname'] == $row2['firstname'] && $row2['lastname'] == $row['lastname']){
                                if($j != 0) echo " ,";
                                echo $row2['name']."  ".$row2['time'];
                                $j++;
                            }
                        }?>
                    <!-- <div class="grid-operator">
                        <button class="btn btn-warning btn-edit" id = "<?php echo $row['id'];?>">แก้ไข</button>
                        <button class="btn btn-danger">ลบ</button>
                    </div> -->
                </td>
                </tr>
                <?php $i++;}} ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Insert-->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">เพิ่มผู้บุกรุก</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">ชื่อ</label>
                        <input type="text" class="form-control col-6">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">นามสกุล</label>
                        <input type="text" class="form-control col-6">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">บันทึก</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
        </div>
    </div>
    </div>
    <!--end modal Insert -->
</body>
</html>