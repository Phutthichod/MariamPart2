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
        <div class="header-mariam"><h1>Survey</h1></div>
        <div class="grid-option">
            <input class="form-control" type="date" id="select-date-option" disabled  value="เลือกวันที่" />
            <select class="custom-select " id="select-date">
                <option value="0" >ทุกวัน</option>
                <option value="1" >กำหนดวัน</option>
            </select> 
            <select class="custom-select " id="select-round">
                <option value="0" selected>ทุกรอบ</option>
                <?php foreach($this->round as $row) { ?>
                <option value="<?php echo $row['id'];?>"><?php echo $row['id']; ?></option>
                <?php } ?>
            </select> 
            <select class="custom-select" id="select-zone">
                <option value="0" selected>ทุกพื้นที่</option>
                <?php foreach($this->zone as $row) { ?>
                <option value="<?php echo $row['id_zone'];?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
            <select class="custom-select" id="select-intruder">
                <option value=0 selected>ทุกพื้นที่</option>
                <option value=1>พื้นที่ถูกบุกรุก</option>
                <option value=2>พื้นที่ที่ไม่ถูกบุกรุก</option>
            </select>
            <select class="custom-select" id="select-group">
                <option value="0" selected>ทุกกลุ่ม</option>
                <?php foreach($this->staff as $row) { ?>
                <option value="<?php echo $row['id_group_staff'];?>"><?php echo $row['id_group_staff']; ?></option>
                <?php } ?>
            </select>    
            <div></div> <!-- //สร้างหลอกไว้ -->
            <button class="btn btn-info">5 item</button>
            <div class="insert">
                <button class="btn btn-success" data-toggle="modal" data-target="#insertModal">เพิ่มข้อมูล</button>
            </div>
        </div>
        <div class="grid-content">
            <?php if(sizeOf($this->data)>0){ foreach($this->data as $row) {?> 
            <div class="card ">
                <div class="grid-body grid-card">
                    <div class="zone click" id=<?php echo $row['id_zone']; ?>>
                        <?php echo $row['name']; ?>
                    </div>
                    <div class="date click" value="<?php echo $row['date']; ?>">
                        วันที่ <?php echo $row['date']; ?> 
                    </div>
                    <div class="time click" value="<?php echo $row['time']; ?>">
                        เวลา <?php echo $row['time_SZ']; ?><span> 
                    </div>
                    <div class="grid-GR">    
                        <div class="round click">
                            <span id =<?php echo $row['id_round']; ?> >รอบที่ <?php echo $row['id_round']; ?> 
                        </div>
                        <div class="group click">
                            <span id = <?php echo $row['id_group_staff']; ?> >กลุ่ม <?php echo $row['id_group_staff']; ?><span>
                        </div>
                    </div>
                   
                    <div class="intruder">
                        ถูกบุกรุก <?php echo $row['amountI']; ?> ครั้ง
                    </div>
                    <div class="edit">
                       <button id_SZ="<?php echo $row['id_SZ']; ?>" id_SR="<?php echo $row['id_SR']; ?>" class="btn btn-warning btn-edit" data-toggle="modal" data-target="#updateModal">แก้ไข</button>
                    </div>
                    <div class="delete">
                        <button class="btn btn-danger">ลบ</button>
                    </div>
                    <div class="detail">
                        <button class="btn btn-info"><a href="?controller=survey&action=detail&zone=<?php echo $row['name']; ?>&idRound=<?php echo $row['id_round'];?>&id=<?php echo $row['id_SZ']; ?>">
                        รายละเอียด</a></button>
                    </div>
                </div>
                
            </div>
            <?php }} ?>
            
           
            
        </div>
        
    </div>

    <!-- Modal Insert-->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">เพิ่มช้อมูลการสำรวจ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="?controller=survey&action=insertSurvey">
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เลือกพื้นที่</label>
                        <select id="select1" name="zone" class="custom-select col-4" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
                            <?php foreach($this->zone as $row) { ?>
                            <option value="<?php echo $row['id_zone'];?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เลือกรอบตรวจ</label>
                        <select id="select2" name="round" class="custom-select col-4" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
                            <?php foreach($this->round as $row) { ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['id']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="inlineFormCustomSelect">เลือกกุ่มเจ้าหน้าที่</label>
                        <select id="select3" name="staff" class="custom-select col-4" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
                            <?php foreach($this->staff as $row) { ?>
                            <option value="<?php echo $row['id_group_staff'];?>"><?php echo $row['id_group_staff']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="" class="col-4">วันที่</label>
                        <input type="date" class="form-control col-4" max="2019-11-24" name="date" id="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="" class="col-4">เวลา</label>
                        <input type="text" class="form-control col-4"  name="time" id="">
                    </div>
                </div>
           
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
            <h5 class="modal-title" id="">แก้ไขช้อมูลการสำรวจ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="?controller=survey&action=updateSurvey" >
            <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="">เลือกพื้นที่</label>
                        <select id="select4" name="zone-edit" class="custom-select col-4" >
                            <option selected>Choose...</option>
                            <?php foreach($this->zone as $row) { ?>
                            <option value="<?php echo $row['id_zone'];?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="">เลือกรอบตรวจ</label>
                        <select id="select5" name="round-edit" class="custom-select col-4" >
                            <option selected>Choose...</option>
                            <?php foreach($this->round as $row) { ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['id']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="col-4" for="">เลือกกุ่มเจ้าหน้าที่</label>
                        <select id="select6" name="staff-edit" class="custom-select col-4" >
                            <option selected>Choose...</option>
                            <?php foreach($this->staff as $row) { ?>
                            <option value="<?php echo $row['id_group_staff'];?>"><?php echo $row['id_group_staff']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="" class="col-4">วันที่</label>
                        <input type="date" class="form-control col-4" max="2019-11-24" name="date-edit" id="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-inline">
                        <label for="" class="col-4">เวลา</label>
                        <input type="text" class="form-control col-4"  name="time-edit" id="">
                    </div>
                </div>
                <input type="hidden" name="id_SR">
                <input type="hidden" name="id_SZ">
                
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        </div>
        </form>
        </div>
    </div>
    </div>
    <!--end modal Update -->
</body>
</html>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(".zone,.time,.round,.intruder").hover(
            function() {
                $(this).parent().children().first().css("color","rgb(240, 69, 2)");
            }, function() {
                $(this).parent().children().first().css("color","white");
            }
        );
        // $("#datepicker" ).datepicker();
        $("input[name=time],input[name=time-edit]").timepicker({
            timeFormat: 'H:mm p',
            interval: 60,
            minTime: '24:00am',
            maxTime: '23:00am',
            defaultTime: '8:00am',
            startTime: '00:00am',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $(document).on('click','.btn-edit',function(){
            $('input[name=id_SZ]').val($(this).attr('id_SZ'));
            $('input[name=id_SR]').val($(this).attr('id_SR'));
            $('#select4').children().first().text($(this).parent().parent().children().first().text());
            $('#select4').children().first().val($(this).parent().parent().children().first().attr('id'));
            $('#select5').children().first().text($(this).parent().parent().children().next().next().next().children().first().children().attr('id'));
            $('#select5').children().first().val($(this).parent().parent().children().next().next().next().children().first().children().attr('id'));
            $('#select6').children().first().text($(this).parent().parent().children().next().next().next().children().first().next().children().attr('id'));
            $('#select6').children().first().val($(this).parent().parent().children().next().next().next().children().first().next().children().attr('id'));
            $('input[name=date-edit]').val($(this).parent().parent().children().first().next().attr('value'));
            $('input[name=time-edit]').val($(this).parent().parent().children().first().next().next().attr('value'));
        })

        let status_option;
        $('#select-date,#select-date-option,#select-round,#select-zone,#select-intruder,#select-group').change(function(){
            let date = $('#select-date-option').val()
            if($('#select-date').val() == 0) date = '0'
            let round = $('#select-round').val()
            let zone = $('#select-zone').val()
            let intruder = $('#select-intruder').val()
            let group = $('#select-group').val()

            console.log(round+"    "+zone+"    "+group+"    "+date)
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
              let data = JSON.parse(this.responseText)
              let text = ''
              for(i in data){
                text+=`
                <div class="card ">
                <div class="grid-body grid-card">
                    <div class="zone click" id=${data[i].id_zone}>
                            ${data[i].name}
                    </div>
                    <div class="date click" value="${data[i].date}">
                        วันที่ ${data[i].date} 
                    </div>
                    <div class="time click" value="${data[i].time_SZ} ">
                        เวลา ${data[i].time_SZ}<span> 
                    </div>
                    <div class="grid-GR">    
                        <div class="round click">
                            <span id =${data[i].id_round} >รอบที่ ${data[i].id_round} 
                        </div>
                        <div class="group click">
                            <span id = ${data[i].id_group_staff} >กลุ่ม ${data[i].id_group_staff} <span>
                        </div>
                    </div>
                   
                    <div class="intruder">
                        ถูกบุกรุก${data[i].amountI} ครั้ง
                    </div>
                    <div class="edit">
                       <button id_SZ="${data[i].id_SZ}" id_SR="${data[i].id_SR}" class="btn btn-warning btn-edit" data-toggle="modal" data-target="#updateModal">แก้ไข</button>
                    </div>
                    <div class="delete">
                        <button class="btn btn-danger">ลบ</button>
                    </div>
                    <div class="detail">
                        <button class="btn btn-info"><a href="?controller=survey&action=detail&zone=${data[i].name}&idRound=${data[i].id_round}&id=${data[i].id_SZ}">
                        รายละเอียด</a></button>
                    </div>
                </div>
                
            </div>
                
                `
              }
              $('.grid-content').html(text);
            }
            
        }
        xhttp.open("POST", `?controller=survey&action=getDataOption`, false);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`date=${date}&round=${round}&zone=${zone}&intruder=${intruder}&group=${group}`);
        })
        $('#select-date').change(function(){
            if($(this).val() == 0) $('#select-date-option').prop('disabled',true);
            else $('#select-date-option').prop('disabled',false);
        })
    </script>
</script>


