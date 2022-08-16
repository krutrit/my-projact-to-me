<?php
include_once("./nabar.php");
date_default_timezone_set("Asia/Bangkok");
?>
<link href='../plugins/fullcalendar/main.css' rel='stylesheet' />
<script src='../plugins/fullcalendar/main.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var input_data = document.getElementById('date-input');
        var date = new Date();

        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'Asia/Bangkok',
            dateClick: function(info) {
                // alert('Date: ' + info.dateStr);
                // alert('Resource ID: ' + info.resource.id);
                $("#date-input").val(info.dateStr);

            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek'
            },
            locale: 'th',
            initialDate: date,
            editable: false,
            navLinks: true, // can click day/week names to navigate views
            dayMaxEvents: true, // allow "more" link when too many events
            events: {
                url: 'php/get-events.php',
                failure: function() {
                    document.getElementById('script-warning').style.display = 'block'
                }
            },
            loading: function(bool) {
                document.getElementById('loading').style.display =
                    bool ? 'block' : 'none';
            }
        });

        calendar.render();
    });
</script>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #script-warning {
        display: none;
        background: #eee;
        border-bottom: 1px solid #ddd;
        padding: 0 10px;
        line-height: 40px;
        text-align: center;
        font-weight: bold;
        font-size: 12px;
        color: red;
    }

    #loading {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    #calendar {
        max-width: 700px;
        margin: 40px auto;
        padding: 0 10px;
    }
</style>
<section class="home">
    <div class="container">
        <div class="text">ปฏิทินจองคิว</div>

        <div class="row">
            <div class="col-md-8">
                <div id='script-warning'>
                    <code>php/get-events.php</code> must be running.
                </div>

                <div id='loading'>loading...</div>
                <div id='calendar' style="background-color:ghostwhite; padding: 10px "></div>
            </div>
            <div class="col-md-4" style="background-color:ghostwhite; padding: 10px ">
                <div class="text">จองคิว</div>
                <form id="form-reserve" action="javascript:void(0)" method="post">
                    <input type="hidden" name="id_user" value="<?php echo $ID; ?>" required>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">เลือกวันจอง:</label>
                        <input id="date-input" name="date_reserve" type="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">เลือกเวลาจอง:</label>
                        <input type="time" name="Time_reserve" class="form-control" required>
                    </div>

                    <div class=" mb-3">
                        <label for="recipient-name" class="col-form-label">เลือกบริการ </label><span style="color:red;"> * แต่ละบริการใช้เวลาประมาณ 45 นาที * </span>
                        <select class="form-select" name="id_style">
                            <!-- <option value="0" selected>ยังไม่ตัดสินใจเลือก</option> -->
                            <?php
                            foreach (Database::query("SELECT * FROM `hairstyle` WHERE status != 0 ", PDO::FETCH_OBJ) as $row) :
                            ?>
                                <option value="<?php echo $row->id_style ?>"><?php echo $row->name_style ?></option>

                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>

                    <div class=" mb-3">
                        <label for="recipient-name" class="col-form-label">เลือกช่าง:</label>
                        <select class="form-select" name="id_hai" required>
                            <option value="">กรุณาเลือกช่าง</option>
                            <?php
                            foreach (Database::query("SELECT * FROM `hairdresser` WHERE status_hai != 0 ", PDO::FETCH_OBJ) as $row) :
                            ?>
                                <option value="<?php echo $row->id_hai ?>"><?php echo $row->name_hai ?></option>

                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">จองคิว</button>
                    </div>

                </form>


                <script>
                    $("#form-reserve").submit(function() {
                        var $inputs = $("#form-reserve :input");
                        var values = {};
                        $inputs.each(function() {
                            values[this.name] = $(this).val();
                        })

                        var datetime = new Date(values['date_reserve'] + ' ' + values['Time_reserve']);
                        datetime.setMinutes(datetime.getMinutes() + 30);

                        values['Time_reserve_end'] = datetime.getHours() + ":" + datetime.getMinutes();

                        console.log(values);

                        $.ajax({
                            url: "./controller/reserve_cl.php",
                            type: "POST",

                            data: {
                                key: "form-reserve",
                                data: values,
                            },
                            success: function(result, textStatus, jqXHR) {
                                console.log(result);

                                if(result == "success"){
                                    alert("จองคิวบริการเรียบร้อย")
                                    location.reload();
                                }else{
                                    alert("จองคิวบริการไม่สำเร็จ")
                                }

                            },
                            error: function(jqXHR, textStatus, errorThrown) {

                            }
                        });
                    });
                </script>
            </div>
        </div>

    </div>
</section>



<?php
include_once("./footer.php");
?>