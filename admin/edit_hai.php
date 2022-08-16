<?php
include_once("./nabar.php");

$id_ser = null;
if (isset($_GET["id"]) && $_GET["id"] != null) {
    $id_ser  = $_GET["id"];
} else {
    header("Location: index");
}


$sql_ser = "SELECT * FROM `hairdresser` WHERE id_hai = '$id_ser'";
$row = Database::query($sql_ser, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
?>


<section class="home">
    <div class="text">
        แก้ไขข้อมูล
    </div>
    <div class="container">
        <div class="row" style="padding: 20px">
            <form id="form-edit_hai" action="javascript:void(0)" method="post">
                <input type="hidden" name="id_hai" value="<?php echo $row->id_hai; ?>" required>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">ชื่อช่าง</label>
                    <input  name="name_hai" type="text" class="form-control" value="<?php echo $row->name_hai; ?>"required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">เบอร์โทร</label>
                    <input type="tel" name="tel_hai" class="form-control" value="<?php echo $row->tel_hai; ?>"required>
                </div>

                <div class=" mb-3">
                    <label for="recipient-name" class="col-form-label">รหัสผ่าน </label>
                    <input type="password" class="form-control" name="pass_hai" value="<?php echo $row->pass_hai; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button> <button type="button" onclick="location.assign('./hairdresser_mg')" class="btn btn-warning">ยกเลิก</button>
                </div>

            </form>
        </div>
    </div>
</section>
<script>
    $("#form-edit_hai").submit(function() {
        var $inputs = $("#form-edit_hai :input");
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        })
        console.log(values);

        $.ajax({
            url: "./controller/hai_cl.php",
            type: "POST",

            data: {
                key: "form-edit_hai",
                data: values,
            },
            success: function(result, textStatus, jqXHR) {
                console.log(result);

                if (result == "success") {
                    alert("แก้ไขข้อมูลเรียบร้อย")
                    location.assign('./hairdresser_mg')
                } else {
                    alert("แก้ไขข้อมูลไม่สำเร็จ")
                    location.assign('./hairdresser_mg')
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