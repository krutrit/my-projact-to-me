<?php
include_once("./nabar.php");
?>

<section class="home">
    <div class="text">
        จัดการข้อมูลช่าง
    </div>
    <div class="container" style="background-color:ghostwhite;padding: 10px">
        <table class="table table-striped " id="example">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อช่าง</th>
                    <th>เบอร์โทร</th>
                    <th>รหัสผ่าน</th>
                    <th><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_hai" data-bs-whatever="@mdo">เพิ่มบริการ</a></th>
                </tr>
            </thead>
            <tbody>

                <?php
                $i = null;
                $sql_search = "SELECT * FROM `hairdresser` WHERE status_hai != 0 ";
                foreach (Database::query($sql_search, PDO::FETCH_OBJ) as $row) :
                    ++$i;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->name_hai ?></td>
                        <td><?php echo $row->tel_hai ?></td>
                        <td><?php echo $row->pass_hai ?></td>
                        <td>
                            <?php
                            $btn = "";
                            if ($row->name_hai == 'ไม่ระบุช่าง') {
                            } else {

                                $btn = "<button type='button' onclick='link_hai($row->id_hai)' class='btn btn-warning btn-sm'>แก้ไข</button> <button type='button' onclick='delete_hai($row->id_hai)' class='btn btn-danger btn-sm'>ลบ</button>";
                            }
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
<div class="modal fade" id="add_hai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="form-addhai" action="javascript:void(0)" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลช่าง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ชื่อช่าง</label>
                        <input type="text" class="form-control" name="name_hai">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">เบอร์โทร</label>
                        <input type="tel" class="form-control" name="tel_hai">

                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">รหัสผ่าน</label>
                        <input type="password" class="form-control" name="pass_hai">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">เพิ่มบริการ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#example").DataTable();
    });


    $("#form-addhai").submit(function() {
        // alert("sldfj")
        // var inputs = $("#form-addhai : input");
        var $inputs = $("#form-addhai :input");
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        })
        console.log(values);
        $.ajax({
            url: "./controller/hai_cl.php",
            type: "POST",
            data: {
                key: "form-addhai",
                data: values,
            },
            success: function(result, textStatus, jqXHR) {
                console.log(result);
                if (result == "success") {
                    alert("เพิ่มช่างใหม่สำเร็จ");
                    location.reload();
                } else {
                    alert("เพิ่มช่างใหม่ไม่สำเร็จ");
                    location.reload();

                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("เพิ่มบริการไม่สำเร็จ");
                location.reload();
            }
        });

    });

    function link_hai(id) {
        location.assign('./edit_hai?id=' + id);
    }

    function delete_hai(id) {
        if (confirm('Are you sure you want to delete')) {
            $.ajax({
                url: "./controller/hai_cl.php",
                type: "POST",
                data: {
                    key: "delete_hai",
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