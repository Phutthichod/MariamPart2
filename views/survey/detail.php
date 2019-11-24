<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="views/survey/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header-detail"><h1>การพบผู้บุกรุก</h1></div>
        <div class="grid-option-detail">
            <button class="btn btn-success" data-toggle="modal" data-target="#insertModal">เพิ่มกลุ่มผู้บุกรุก</button>
        </div>
        <div class="grid-main-detail">
            <?php $i = 1; 
                $statusId = 0;
            foreach($this->data as $row) { 
                if($statusId!=$row['id_intruder_group']){
                    $statusId = $row['id_intruder_group']
                
                ?>
                <div class="card" id = <?php echo $row['id_intruder_group'];?>>
                        <div class="grid-content-detail">
                            <div class="round-detail">
                           ครั้งที่ <?php echo $i; ?> 
                            </div>
                            <div class="time-detail">
                                เวลา <?php echo $row['time']; ?>
                            </div>
                            <div class="operation-detail" value=<?php echo $row['operator']; ?>>
                                การจัดการ <?php echo $row['operator']; ?>
                            </div>
                            <div class="list-name-deatail">
                                รายชื่อ
                                <?php foreach($this->data as $row2) {
                                    if($row2['id_intruder_group'] == $statusId)
                                    echo "<br>".$row2['firstname']." ".$row2['lastname'];
                                }
                                ?>

                            </div>
                            <div class="button-detail">
                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#updateModal">แก้ไข</button>
                                <button class="btn btn-danger">ลบ</button>
                            </div>
                        </div>
                </div>
            <?php $i++;}} ?>
                
            
        </div>
    </div>

    <!-- Modal Insert-->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">เพิ่มพื้นที่ถูกบุกรุก</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="?controller=survey&action=insertGI" id="formInsert">
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect" >พื้นที่</label>
                        <input type="text" class="form-control col-4"  disabled value=<?php echo $_GET['zone'];?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">รอบที่</label>
                        <input type="text" class="form-control col-4" disabled value=<?php echo $_GET['idRound'];?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เวลา</label>
                        <input type="text" name="time" class="timepicker form-control col-4">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">การดำเนินการ</label>
                        <textarea  class="form-control col-6" name="operation"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">รายชื่อผู้บุกรุก</label>
                        <input type="text" name="fname[]" class="form-control col-3 mr-2">
                        <input type="text" name="lname[]" class="form-control col-3">
                        <button type="button" class="btn btn-success col-1 ml-2" id="btn-addIntruder">เพิ่ม</button>
                    </div>
                </div>
            <input type="hidden" name='zone' value=<?php echo $_GET['zone'];?>>
            <input type="hidden" name='idR' value=<?php echo $_GET['idRound'];?>>
            <input type="hidden" name='id' value=<?php echo $_GET['id'];?>>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
        </form>
        </div>
    </div>
    </div>
    <!--end modal Insert -->
    <!-- Modal update-->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">เพิ่มพื้นที่ถูกบุกรุก</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="?controller=survey&action=updateGI" id="formUpdate">
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect" >พื้นที่</label>
                        <input type="text" class="form-control col-4"  disabled value=<?php echo $_GET['zone'];?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">รอบที่</label>
                        <input type="text" class="form-control col-4" disabled value=<?php echo $_GET['idRound'];?>>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เวลา</label>
                        <input type="text" name="time-edit" class="timepicker form-control col-4">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">การดำเนินการ</label>
                        <textarea id="text-edit" class="form-control col-6" name="operation-edit"></textarea>
                    </div>
                </div>
                <div class="add-element">
                                
                </div>
            <input type="hidden" name='id' >

            <div class="idI">
                                
            </div>
            
            <input type="hidden" name='zone' value=<?php echo $_GET['zone'];?>>
            <input type="hidden" name='idR' value=<?php echo $_GET['idRound'];?>>
            <input type="hidden" name='id_zone' value=<?php echo $_GET['id'];?>>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
        </form>
        </div>
    </div>
    </div>
    <!--end modal update -->
</body>

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
    $(document).on('click','#btn-addIntruder',function(){ // more condition
        $('#formInsert').append(`
            <div class="form-group">
                <div class="form-inline">
                    <div class="col-4"></div>
                    <input type="text" name="fname[]" class="form-control col-3 mr-2">
                    <input type="text" name="lname[]" class="form-control col-3">
                    <button type="button" class="btn btn-danger col-1 ml-2" id="btn-removeIntruder">ลบ</button>
                </div>
            </div>
            
        `)
        $('.add-element').append(`
            <div class="form-group">
                <div class="form-inline">
                    <div class="col-4"></div>
                    <input type="text" name="fname-edit[]" class="form-control col-3 mr-2">
                    <input type="text" name="lname-edit[]" class="form-control col-3">
                    <button type="button" class="btn btn-danger col-1 ml-2" id="btn-removeIntruder">ลบ</button>
                </div>
            </div>
            
        `)
        
    })
    $(document).on('click','#btn-removeIntruder',function(){ // delete condition
        $(this).parent().parent().parent().children().last().remove();
        $(this).remove();
    })
    $('input.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 50,
        minTime: '10',
        maxTime: '5:00pm',
        defaultTime: '11',
        startTime: '10:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
    $(document).on('click','.btn-edit',function(){
        $('#text-edit').val($(this).parent().prev().prev().attr('value'))
        let id = $(this).parent().parent().parent().attr('id');
        let idI = [];
        $('input[name=id]').val(id);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
             
              let data = JSON.parse(this.responseText);
              let text = '';
              console.log(this.responseText+" "+Object.keys(data).length);
              if(Object.keys(data).length>0){
                  let i = 0;
                  for(i in data){
                    idI.push(data[i].id)
                      
                      if(i==0){
                          text+=`
                            <div class="form-group">
                                <div class="form-inline">
                                    <label class="col-4" for="inlineFormCustomSelect">รายชื่อผู้บุกรุก</label>
                                    <input type="text" name="fname-edit[]" value=${data[i].firstname} class="form-control col-3 mr-2">
                                    <input type="text" name="lname-edit[]" value=${data[i].lastname}  class="form-control col-3">
                                    <button type="button" class="btn btn-success col-1 ml-2" id="btn-addIntruder">เพิ่ม</button>
                                </div>
                            </div>`
                      }else{
                        text+=`
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="col-4"></div>
                                    <input type="text" name="fname-edit[]" value=${data[i].firstname} class="form-control col-3 mr-2">
                                    <input type="text" name="lname-edit[]" value=${data[i].lastname}  class="form-control col-3">
                                    <button type="button" class="btn btn-danger col-1 ml-2" id="btn-removeIntruder">ลบ</button>
                                </div>
                            </div>`

                      }
                        
                        i++;
                  }
              }else{
                  text+=`
                        <div class="form-group">
                            <div class="form-inline">
                                <label class="col-4" for="inlineFormCustomSelect">รายชื่อผู้บุกรุก</label>
                                <input type="text" name="fname-edit[]"  class="form-control col-3 mr-2">
                                <input type="text" name="lname-edit[]"  class="form-control col-3">
                                <button type="button" class="btn btn-success col-1 ml-2" id="btn-addIntruder">เพิ่ม</button>
                            </div>
                        </div>`
              } 
            $('.add-element').html(text);
            for(i in idI){
                $('.idI').append(`<input type="hidden" id="idI2" name='idI[]' value=${idI[i]} >`);
            }
            
            console.log(Object.keys(data).length)
          }
        }
        xhttp.open("POST", `?controller=survey&action=getListIntruder`, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`id=${id}`);
    })
</script>
</html>