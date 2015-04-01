<?php

/*
* Created By Sublime Text
* Dev  : Serkan KAYABAŞI
* Date : 25.12.2014 02:55
*/

/**
* Özelleştirilmiş bir tablo kullanmak
* bu kadar zor olmasa gerek....
* İnternetteki DataTable örnekleri batık!
*/
class DataTable
{
	
	# Tablo kolonları (gösterilecekler)
	public $columns = array();

	# Kolonlara eklenmiş fonksiyonlar 
	public $columnFunctions = array();

	# Tablo ayarları (arama olsun mu vb.)
	public $options = array();

	# Tablo için ayarlara göre üretilmiş script
	public $script;

	# Tablonun id'si (HTML id)
	public $id;

	# HTML
	public $html;

	# Tablo verileri dizi olarak
	public $data;

	# Satır sayısı
	public $rowCount = 0;

	/**
	 * Tabloda görünecek alanları sınıf
	 * değişkenine eklenmesini sağlar
	 * 
	 * @param array $columns 
	 * @return $this
	 */
	public function setColumn(array $columns)
	{
		$this->columns = array_merge($this->columns,$columns);
		return $this;
	}

	/**
	 * Kolonların bir fonksiyon beraberinde
	 * eklenmesini sağlamak için sınıfımıza set eder. 
	 * Örneğin button eklemek için; 
	 * setColumnFunction(array('button','İşlem'),function() { 
	 * 		return '<a href="#">Düzenle</a><a href="'.$row['id'].'">Sil</a>'; 
	 * })
	 * şeklinde kullanılabilir.
	 * Gelen fonksiyon ne için olursa olsun,
	 * tablonun satırının dizisi fonksiyona 
	 * parametre olarak verilir.
	 * 
	 * @param string $column
	 * @param void
	 * @return $this
	 */
	public function setColumnFunction($column,$function)
	{
		$this->columnFunctions[$column] = $function;
		return $this;
	}

	/**
	 * Tablo ayarlarını sınıfın değişkenine
	 * ekler.
	 * 
	 * @param array $options
	 * @return $this
	 */
	public function setOption(array $options)
	{
		$this->options = array_merge($this->options,$options);
		return $this;
	}

	/**
	 * Tabloda listelenecek verileri sınıfa set
	 * etmek için kullanılır.
	 * 
	 * @param array $data
	 * @return $this
	 */
	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * Önce tablo için kullanılacak bir id oluşturur
	 * daha sonra tablonun HTML halini hazırlar
	 * ve bunları sınıfa set eder
	 * 
	 * @return $this
	 */
	public function make()
	{
		$this->id = uniqid();
		$this->script = '<script type="text/javascript">$("#'.$this->id.'").dataTable({';
		
		foreach ($this->options as $key => $value) 
		{
			$this->script .= $key.' : '.$value;
		}

		$this->script .= '});</script>';
		

		# HTML Tabloyu oluşturma
		$this->html = '
			<table class="table table-bordered table-striped mb-none" id="'.$this->id.'">
				<thead>
					<tr>';

		foreach ($this->columns as $columnName => $niceName) 
		{
			$this->html .= '<th>'.$niceName.'</th>';
		}

		$this->html .= '
					</tr>
				</thead>
				<tbody>';

		if ($this->data) 
		{
			foreach ($this->data as $key => $row) 
			{
				$this->rowCount += 1; 
				$this->html .= '<tr>';
				
				foreach ($this->columns as $columnName => $niceName) 
				{
					if (array_key_exists($columnName, $row)) 
					{
						if (array_key_exists($columnName, $this->columnFunctions))	 
						{
							$this->html .= '<td>'.$this->columnFunctions[$columnName]($row).'</td>';
						} 
						else
						{
							$this->html .= '<td>'.$row[$columnName].'</td>';
						}
					}
					else
					{
						if (array_key_exists($columnName, $this->columnFunctions))	 
						{
							$this->html .= '<td>'.$this->columnFunctions[$columnName]($row).'</td>';
						}
					}
				}

				$this->html .= '</tr>';
			}
		}
		
		$this->html .= '
				</tbody>
			</table>';

		return $this;
	}

	/**
	 * Tablonun html'ini yazdırır
	 */
	public function html()
	{
		echo $this->html;
	}

	/**
	 * Tablonun script ini yazdırır
	 */
	public function script()
	{
		echo $this->script;
	}
}