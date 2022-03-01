<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="https://www.goragod.com/js/gajax.js"></script>
<p><input type="text"  id="text2" /></p>
<p><input type="text"  id="sel2" /></p>
<p><input type="button" value="GModal.show()" id="show" /></p>

<script type="text/javascript">
var modal;
var doModal = function(event){
 // ร้องขอข้อมูล ด้วย ajax ไปยัง get.php
 new  GAjax().send('get.php', null, function(xhr){
  // เมื่อได้รับค่าตอบกลับมา ก็ไปแสดง modal
  modal = new GModal();
  modal.show(xhr.responseText);
 });
};
function doClose(){
 // เมื่อกด OK คืนค่าไปยังฟอร์มหลัก
 $E('text2').value = $E('text1').value;
 $E('sel2').value = $E('sel1').value;
 // ยกเลิก modal
 modal.hide();
};
$G('show').addEvent('click', doModal);
</script>
<body>
</body>
