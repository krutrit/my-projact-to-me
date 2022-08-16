<?php
include_once("./nabar.php");
?>

<section class="home">
    <div class="text">
        จัดการข้อมูลลูกค้า
    </div>
    <div class="container" style="background-color:ghostwhite;padding: 10px">
        <table class="table table-striped " id="example">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อลูกค้า</th>
                    <th>เบอร์โทร</th>
                    <th>อีเมล</th>
                    <th><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_user" data-bs-whatever="@mdo">เพิ่มบริการ</a></th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = null;
                $sql_search = "SELECT * FROM `user` WHERE status_user != 0";
                foreach (Database::query($sql_search, PDO::FETCH_OBJ) as $row) :
                    ++$i;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->name_user. " ".$row->lastname_user ?></td>
                        <td><?php echo $row->tel_user ?></td>
                        <td><?php echo $row->e_mail ?></td>
                        <td>
                            <?php
                                $btn = "<button type='button' onclick='link($row->id_user )' class='btn btn-warning btn-sm'>แก้ไข</button> <button type='button' onclick='delete_user($row->id_user )' class='btn btn-danger btn-sm'>ลบ</button>";
                            // }
                            echo $btn;
                            ?>
                        </td>

                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</section>
<div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มลูกค้าใหม่</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-addUser" action="javascript:void(0)" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                        <input type="text" class="form-control" name="name_user">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">นามสกุล</label>
                        <input type="text" class="form-control" name="lastname_user">

                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">เบอร์โทร</label>
                        <input type="tel" class="form-control" name="tel_user">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">อีเมล</label>
                        <input type="email" class="form-control" name="e_mail">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">รหัสผ่าน</label>
                        <input type="password" class="form-control" name="pass_user">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">เพิ่มลูกค้าใหม่</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#example").DataTable();
    });

    $("#form-addUser").submit(function() {

        var $inputs = $("#form-addUser :input");
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        })
        console.log(values);
        $.ajax({
            url: "../controllers/register_cl.php",
            type: "POST",
            data: {
                key: "form-signup",
                data: values,
            },
            success: function(result, textStatus, jqXHR) {
                console.log(result);
                if (result == "success") {
                    alert("สมัครสมาชิกสำเร็จ!!!");
                    location.reload();
                } else if (result == "x541") {
                    alert("ท่านเคยสมัครก่อนหน้านี้แล้ว")
                } else if (result == "error") {
                    alert("ระบบตรวจพบข้อผิดพลาด")
                    location.reload();
                } else {
                    alert("ระบบตรวจพบข้อผิดพลาด")
                    location.reload();
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("เพิ่มลูกค้าไม่สำเร็จ");
                location.reload();
            }
        });

    });

    function link(id){
        location.assign("./edit_mem?id="+id)
    }
    function delete_user(id) {
        if (confirm('Are you sure you want to delete')) {
            $.ajax({
                url: "./controller/member_cl.php",
                type: "POST",
                data: {
                    key: "delete_user",
                    id: id
                },
                success: function(result, textStatus, status) {
                    // alert(result);
                    if (result == "success") {
                        alert("ลบสำเร็จ")
                        location.reload();
                    } else {
                        alert("ลบไม่สำเร็จ")
                        location.reload();
                    }
                },
                error: function(result, textStatus) {

                }
            });
        }
    }
</script>
<?php
include_once("./footer.php")
?>