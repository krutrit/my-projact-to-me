<?php
include_once("./nabar.php");
?>

<section class="home">
    <div class="text">จัดการจองคิว</div>

    <!-- ส่วนต่าราง -->
    <div class="container" style="background-color:ghostwhite;padding: 10px">
        <span style="color:red">* กรุณายกเลิกบริการก่อนเวลา 1 ชั่วโมง * </span>
        <table class="table table-striped " id="example">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>บริการ</th>
                    <th>ช่าง</th>
                    <th>วันที่</th>
                    <th>สถานะ</th>
                    <th>ตัวเลือก</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = null;
                $sql_search = "SELECT *,DATE_FORMAT(re.dateTime_reserve, '%H:%i %W %e %M  %Y') as data_ , re.status as sta FROM `reserve` as re INNER JOIN hairstyle as hstly ON hstly.id_style = re.id_style INNER JOIN hairdresser as hser ON hser.id_hai = re.id_hai WHERE re.id_hai = '$ID' AND re.status != 0;";
                foreach (Database::query($sql_search, PDO::FETCH_OBJ) as $row) :
                    ++$i;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->name_style ?></td>
                        <td><?php echo $row->name_hai ?></td>
                        <td><?php echo $row->data_ ?></td>
                        <td><?php
                            $st = $row->sta;
                            if ($st == 1) :
                                echo '<span class="btn-sm btn-success">ยืนยันแล้ว</span>';
                            // echo $row->sta;
                            else :
                                echo '<span class="btn-sm btn-warning">รอยืนยัน</span>';
                            endif;
                            ?></td>
                        <td><?php echo $row->sta == 2 ? "<button class='btn  btn-sm btn-success ' onclick='success_reserve( $row->id_reserve)'>ยืนยัน </button> <button class='btn  btn-sm btn-danger ' onclick='delete_reserve( $row->id_reserve)'>ยกเลิก</button>" : "<button class='btn  btn-sm btn-success ' onclick='update_reserve($row->id_reserve)'>บริการเสร็จสิ้น</button>" ?></td>
                        <!-- <button class="btn btn-primary btn-sm ">แก้ไข</button> -->
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>

    </div>

    <div class="text">คิวที่ถูกยกเลิก/บริการเสร็จสิ้น</div>

<!-- ส่วนต่าราง -->
<div class="container" style="background-color:ghostwhite;padding: 10px">
    <!-- <span style="color:red">* กรุณายกเลิกบริการก่อนเวลา 1 ชั่วโมง * </span> -->
    <table class="table table-striped " id="example1">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>บริการ</th>
                <th>ช่าง</th>
                <th>วันที่จอง</th>
                <!-- <th>สถานะ</th> -->
            </tr>
        </thead>
        <tbody>

            <?php
            $i = null;
            $sql_search = "SELECT *,DATE_FORMAT(re.dateTime_reserve, '%H:%i %W %e %M  %Y') as data_ , re.status as sta FROM `reserve` as re INNER JOIN hairstyle as hstly ON hstly.id_style = re.id_style INNER JOIN hairdresser as hser ON hser.id_hai = re.id_hai WHERE re.id_hai = '$ID' AND re.status = 0;";
            foreach (Database::query($sql_search, PDO::FETCH_OBJ) as $row) :
                ++$i;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->name_style ?></td>
                    <td><?php echo $row->name_hai ?></td>
                    <td><?php echo $row->data_ ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

</div>
</section>
<script>
    $(document).ready(function() {
        $("#example").DataTable();
        $("#example1").DataTable();
    });

    function delete_reserve(id) {
        if (confirm("Are you sure you want to delete this!")) {
            $.ajax({
                url: "./controller/reserve_cl.php",
                type: "POST",
                data: {
                    key: 'delete_reserve',
                    id: id
                },
                success: function(result) {
                    // alert(result);
                    if (result == "success") {
                        alert('ลบสำเร็จ')
                        location.reload();
                    } else {
                        alert('พบข้อผิดพลาด')
                    }

                },
                error: function(result) {
                    alert('พบข้อผิดพลาด')

                }
            })
        }
    }

    function success_reserve(id) {
        if (confirm("ยืนยันการจอง")) {
            $.ajax({
                url: "./controller/reserve_cl.php",
                type: "POST",
                data: {
                    key: 'success_reserve',
                    id: id
                },
                success: function(result) {
                    // alert(result);
                    if (result == "success") {
                        alert('ยืนยันการจองสำเร็จ')
                        location.reload();
                    } else {
                        alert('พบข้อผิดพลาด')
                    }

                },
                error: function(result) {
                    alert('พบข้อผิดพลาด')

                }
            })
        }
    }

    function update_reserve(id) {
        if (confirm("ให้บริการลูกค้าเรียบร้อย?")) {
            $.ajax({
                url: "./controller/reserve_cl.php",
                type: "POST",
                data: {
                    key: 'delete_reserve',
                    id: id
                },
                success: function(result) {
                    // alert(result);
                    if (result == "success") {
                        alert('ให้บริการลูกค้าเรียบร้อย')
                        location.reload();
                    } else {
                        alert('พบข้อผิดพลาด')
                    }

                },
                error: function(result) {
                    alert('พบข้อผิดพลาด')

                }
            })
        }
    }
</script>

<?php
include_once("./footer.php");
?>