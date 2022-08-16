<?php
include_once("./nabar.php");

$id_ser = null;
if (isset($_GET["id"]) && $_GET["id"] != null) {
    $id_ser  = $_GET["id"];
} else {
    header("Location: index");
}


$sql_ser = "SELECT * FROM `hairstyle` WHERE id_style = '$id_ser'";
$row = Database::query($sql_ser, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
?>


<section class="home">
    <div class="text">
        แก้ไขข้อมูล
    </div>
    <div class="container">
        <div class="row" style="padding: 20px">
            <form id="form-edit_ser" action="javascript:void(0)" method="post">
                <input type="hidden" name="id_style" value="<?php echo $row->id_style; ?>" required>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">ชื่อบริการ</label>
                    <input  name="name_style" type="text" class="form-control" value="<?php echo $row->name_style; ?>"required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">ราคา</label>
                    <input type="number" min="0" name="price_style" class="form-control" value="<?php echo $row->price_style; ?>"required>
                </div>

                <div class=" mb-3">
                    <label for="recipient-name" class="col-form-label">เวลาให้บริการ </label>
                    <input type="number" min="0" class="form-control" name="time_ok" value="<?php echo $row->time_ok; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button> <button type="button" onclick="location.assign('index')" class="btn btn-warning">ยกเลิก</button>
                </div>

            </form>
        </div>
    </div>
</section>
<script>
    $("#form-edit_ser").submit(function() {
        var $inputs = $("#form-edit_ser :input");
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        })
        console.log(values);

        $.ajax({
            url: "./controller/services.php",
            type: "POST",

            data: {
                key: "form-edit_ser",
                data: values,
            },
            success: function(result, textStatus, jqXHR) {
                console.log(result);

                if (result == "success") {
                    alert("แก้ไขข้อมูลเรียบร้อย")
                    location.assign('./index')
                } else {
                    alert("แก้ไขข้อมูลไม่สำเร็จ")
                    location.assign('./index')
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