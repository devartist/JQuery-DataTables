# DataTables
<b>PHP DataTables</b> - 
<b>Jquery DataTables</b><br>
Jquery Datatables (Javascript) Class - Library

<b>I'm writting Turkish, because my English is not very good.<br>
A friend can help to translate the English language properly.</b>

Arkadaşlar, <b>Jquery</b> ile hazırlanmış olan <b>DataTables Kütüphanesi</b>'ndeki tablo satır sütünlarını otomatik oluşturmak 
için yazdığım <b>kullanımı çok basit</b> bir sınıf. Kütüphanenin bir çok özelliğini kullanabiliyoruz. Kullanımını aşağıda anlatıyorum <b>buyrun</b>;

Öncelikle JQuery DataTables kullanmayı öğrenmek, indirmek için https://www.datatables.net 'i ziyaret edin;

<br>
<code>
  //code.jquery.com/jquery-1.11.1.min.js<br>
  //cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js<br>
  //cdn.datatables.net/1.10.5/css/jquery.dataTables.css
</code>

<code>
  // $orders : key-value array şeklinde olması gerek. yani;
  
  $orders = Array
  (
    [0] => Array
        (
            [id] => 758
            [customer_id] => 247
            [deadline] => 2015-05-01 09:36:00
            [manufacturing_deadline] => 1970-01-01 00:00:00
            [width] => 95
            [height] => 28
            [skittle] => 40
            [turn] => 1000
            [turn_type_id] => 1
            [cut_type_id] => 1
            [paper_type_id] => 5
            [paper_sub_type_id] => 51
            [paper_firm_id] => 1
            [perforated] => 0
            [color] => 0
            [turn_order] => 0
            [sursaj] => 0
            [sample] => 0
            [description] => 
            [accounting_description] => 
            [quantity] => 500000
            [quantity_type_id] => 1
            [dispatch1] => 0
            [dispatch2] => 0
            [dispatch3] => 0
            [dispatch4] => 0
            [dispatch5] => 0
            [cut_bill] => 0
            [cut_personel_id] => 0
            [cut_machine_id] => 0
            [winding_personel_id] => 0
            [winding_machine_id] => 0
            [invoice_amount] => 0.00
            [step_id] => 1
            [insert_id] => 1
            [insert_table] => users
            [parent_id] => 756
            [delete_status] => a
            [created_at] => 2015-03-31 10:31:55
            [updated_at] => 2015-03-31 10:32:06
            [customer_name] => 23123DDQWWD
            [quantity_type_name] => Adet
            [paper_type_name] => Eco Termal
            [paper_sub_type_name] => Akrilik
            [cut_type_name] => Tekli
            [turn_type_name] => Adet
            [file] => 4148426059644ff603d77cc34758d2f5
        )
    [1] => Array
        (
            [id] => 757
            [customer_id] => 247
            [deadline] => 2015-03-29 09:36:00
            [manufacturing_deadline] => 1970-01-01 00:00:00
            [width] => 95
            [height] => 28
            [skittle] => 40
            [turn] => 1000
            [turn_type_id] => 1
            [cut_type_id] => 1
            [paper_type_id] => 5
            [paper_sub_type_id] => 51
            [paper_firm_id] => 15
            [perforated] => 1
            [color] => 1
            [turn_order] => 0
            [sursaj] => 1
            [sample] => 0
            [description] => TEST ÜRÜNÜDÜR, Byy
            [accounting_description] => 
            [quantity] => 500000
            [quantity_type_id] => 1
            [dispatch1] => 23232
            [dispatch2] => 343434
            [dispatch3] => 0
            [dispatch4] => 0
            [dispatch5] => 0
            [cut_bill] => 0
            [cut_personel_id] => 0
            [cut_machine_id] => 0
            [winding_personel_id] => 0
            [winding_machine_id] => 0
            [invoice_amount] => 0.00
            [step_id] => 3
            [insert_id] => 57
            [insert_table] => users
            [parent_id] => 
            [delete_status] => a
            [created_at] => 2015-03-27 09:37:09
            [updated_at] => 2015-03-30 16:00:43
            [customer_name] => 23123DDQWWD
            [quantity_type_name] => Adet
            [paper_type_name] => Eco Termal
            [paper_sub_type_name] => Akrilik
            [cut_type_name] => Tekli
            [turn_type_name] => Adet
            [file] => 
        )
  );
</code>

<code>
  $orderList->setColumn(array(
	'id'			=> '<span data-toggle="tooltip" data-placement="top" title="Sıra No">S.No</span>',
	'customer_name'		=> 'Firma Adı',
	'width'			=> 'En',
	'height'		=> 'Boy',
	'paper_type_name'	=> 'Kağıt',
	'cut_type_name'		=> 'Kesim',
	'skittle'		=> 'Kuka',
	'turn'			=> 'Sarım',
	'created_at'		=> '<span data-toggle="tooltip" data-placement="top" title="Oluşturulma Tarihi">O.Tarihi</span>',
	'deadline'		=> '<span data-toggle="tooltip" data-placement="top" title="Termin Tarihi">T.Tarihi</span>',
	'quantity'		=> '<span data-toggle="tooltip" data-placement="top" title="Sipariş Miktarı">S.M.</span>',
	'dispatch1'		=> '<span data-toggle="tooltip" data-placement="top" title="Sevk 1">S.1</span>',
	'dispatch2'		=> '<span data-toggle="tooltip" data-placement="top" title="Sevk 2">S.2</span>',
	'total_dispatch'	=> '<span data-toggle="tooltip" data-placement="top" title="Toplam Sipariş">T.S.</span>',
	'action'		=> 'İşlemler',
	'file'			=> 'Ek'
	))
	->setColumnFunction('action',function($row) {
		return '<div data-row-id="row'.$row['id'].'" class="btn-group" role="group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    			İşlemler
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu list-menu" role="menu">
    				<li><a data-toggle="tooltip" data-placement="left" title="'.$row['description'].'" class="btn-xs btn-default"> <i class="fa fa-list"></i> Açıklama</a></li>
				<li><a data-toggle="tooltip" data-placement="left" title="'.$row['accounting_description'].'" class="btn-xs btn-default"> <i class="fa fa-list-alt"></i> M. Açıklama</a></li>
				<li><a onclick="askChangeStatusPrint('.$row['id'].');" data-toggle="tooltip" data-placement="left" title="Yazdır" class="btn-xs btn-default"> <i class="fa fa-print"></i> Yazdır</a></li>
				<li><a onclick="askChangeStatusProcess('.$row['id'].');" data-toggle="tooltip" data-placement="left" title="İşleme Al" class="btn-xs btn-default"> <i class="fa fa-scissors"></i> İşleme Al</a></li>
				<li><a onclick="onDispatch('.$row['id'].');" data-toggle="tooltip" data-placement="left" title="Sevk Gir" class="btn-xs btn-default"> <i class="fa fa-send"></i> Sevk Gir</a></li>
				<li><a onclick="askChangeStatusComplete('.$row['id'].');" data-toggle="tooltip" data-placement="left" title="Tamamla" class="btn-xs btn-default"> <i class="fa fa-check"></i> Tamamla</a></li>
				<li><a onclick="askChangeStatusBill('.$row['id'].');" data-toggle="tooltip" data-placement="left" title="Faturalandır" class="btn-xs btn-default"> <i class="fa fa-bookmark"></i> Faturalandır</a></li>
				<li><a href="repeat.php?id='.$row['id'].'" data-toggle="tooltip" data-placement="left" title="Tekrarla" class="btn-xs btn-default"> <i class="fa fa-copy"></i> Tekrarla</a></li>
				<li><a href="detail.php?id='.$row['id'].'" data-toggle="tooltip" data-placement="left" title="Detay" class="btn-xs btn-default"> <i class="fa fa-edit"></i> Düzenle</a></li>
				<li><a onclick="askDelete('.$row['id'].');" data-toggle="tooltip" data-placement="left" title="Sil" class="btn-xs btn-danger"> <i class="fa fa-trash-o"></i> Sil</a></li>
			</ul>
		</div>';
	})
	->setOption(array('"order"' => '[[0, "desc"]]', ',"pageLength"' => '100', ',"responsive"' => true))
	->setColumnFunction('file', function($row) {
		if ($row['file'] != "") 
			return '<center><a onclick="getOrderImages('.$row['id'].')" class="mb-xs mt-xs mr-xs btn btn-xs btn-default" style="margin-top:6px;">
				<i class="fa fa-camera"></i>
			</a></center>';
	})
	->setColumnFunction('paper_type_name',function($row) {
		return $row['paper_type_name'].'<br><span style="font-size:11px;font-style:italic;">'.$row['paper_sub_type_name'].'</spna>';
	})
	->setColumnFunction('turn',function ($row){
		return number_format($row['turn'], 0, ',', ',').'<br><span style="font-size:11px;font-style:italic;">'.$row['turn_type_name'].'</span>';
	})
	->setColumnFunction('skittle',function ($row){
		return number_format($row['skittle'], 0, ',', ',');
	})
	->setColumnFunction('quantity',function ($row){
		return number_format($row['quantity'], 0, ',', ',').'<br><span style="font-size:11px;font-style:italic;">'.$row['quantity_type_name'].'</span>';
	})
	->setColumnFunction('turn',function ($row){
		return number_format($row['turn'], 0, ',', ',').'<br><span style="font-size:11px;font-style:italic;">'.$row['turn_type_name'].'</span>';
	})
	->setColumnFunction('skittle',function ($row){
		return number_format($row['skittle'], 0, ',', ',');
	})
	->setColumnFunction('dispatch1',function ($row){
		return number_format($row['dispatch1'], 0, ',', ',');	
	})
	->setColumnFunction('dispatch2',function ($row){
		return number_format($row['dispatch2'], 0, ',', ',');	
	})
	->setColumnFunction('created_at',function($row) {
		return date("d.m.Y",strtotime($row['created_at'])).'<br><span style="font-size:11px;font-style:italic;">'.date("H:i:s",strtotime($row['created_at'])).'</spna>';
	})
	->setColumnFunction('deadline',function($row) {
		return date("d.m.Y",strtotime($row['deadline']));
	})
	->setColumnFunction('manufacturing_deadline',function($row) {
		return date("d.m.Y",strtotime($row['manufacturing_deadline'])).'<br><span style="font-size:11px;font-style:italic;">'.date("H:i:s",strtotime($row['manufacturing_deadline'])).'</spna>';
	})
	->setColumnFunction('total_dispatch',function($row) {
		return number_format($row['dispatch1']+$row['dispatch2']+$row['dispatch3']+$row['dispatch4']+$row['dispatch5'], 0, ',', ',');
	})
	->setData($orders) 
	->make();
}
</code>
