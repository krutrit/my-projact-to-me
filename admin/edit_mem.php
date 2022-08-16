<?php
include_once("./nabar.php");

$id_ser = null;
if (isset($_GET["id"]) && $_GET["id"] != null) {
    $id_ser  = $_GET["id"];
} else {
    header("Location: index");
}


$sql_ser = "SELECT * FROM `user` WHERE id_user='$id_ser'";
$row = Database::query($sql_ser, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
?>


<section class="home">
    <div class="text">
        แก้ไขข้อมูลลูกค้า
    </div>
    <div class="container">
        <div class="row" style="padding: 20px">
            <form id="form-edit_user" action="javascript:void(0)" method="post">
                <input type="hidden" name="id_user" value="<?php echo $row->id_user ; ?>" required>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                    <input  name="name_user" type="text" class="form-control" value="<?php echo $row->name_user; ?>"required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">นามสกุลลูกค้า</label>
                    <input  name="lastname_user" type="text" class="form-control" value="<?php echo $row->lastname_user; ?>"required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">เบอร์โทร</label>
                    <input type="tel" name="tel_user" class="form-control" value="<?php echo $row->tel_user; ?>"required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">อีเมล</label>
                    <input type="tel" name="e_mail" class="form-control" value="<?php echo $row->e_mail; ?>"required>
                </div>
                <div class=" mb-3">
                    <label for="recipient-name" class="col-form-label">รหัสผ่าน </label>
                    <input type="password" class="form-control" name="pass_user" value="<?php echo $row->pass_user; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button> <button type="button" onclick="location.assign('./member_mg')" class="btn btn-warning">ยกเลิก</button>
                </div>

            </form>
        </div>
    </div>
</section>
<script>
    $("#form-edit_user").submit(function() {
        var $inputs = $("#form-edit_user :input");
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        })
        console.log(values);

        $.ajax({
            url: "./controller/member_cl.php",
            type: "POST",

            data: {
                key: "form-edit_user",
                data: values,
            },
            success: function(result, textStatus, jqXHR) {
                console.log(result);

                if (result == "success") {
                    alert("แก้ไขข้อมูลเรียบร้อย")
                    location.assign('./member_mg')
                } else {
                    alert("แก้ไขข้อมูลไม่สำเร็จ")
                    location.assign('./member_mg')
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {

            }
        });
    });
</script>
<?php
include_once("./footer.php");
?>