<?php
/*红客联盟  hon123.com*/
class Excel_FxModel
{
	protected function column_str($key)
	{
		$array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ', 'EA', 'EB', 'EC', 'ED', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ');
		return $array[$key];
	}

	protected function column($key, $columnnum = 1)
	{
		return $this->column_str($key) . $columnnum;
	}

	/**
     * 导出Excel
     * @param type $list
     * @param type $params
     */
	public function export($list, $params = array())
	{
		require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
		$data = m('common')->getSysset('shop');
		$excel = new PHPExcel();
		$excel->getProperties()->setCreator(empty($data['name']) ? '活动报名' : $data['name'])->setLastModifiedBy(empty($data['name']) ? '活动报名' : $data['name'])->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
		$sheet = $excel->setActiveSheetIndex(0);
		$rownum = 1;

		foreach ($params['columns'] as $key => $column) {
			$sheet->setCellValue($this->column($key, $rownum), $column['title']);

			if (!empty($column['width'])) {
				$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
			}
		}

		++$rownum;
		$len = count($params['columns']);

		foreach ($list as $row) {
			$i = 0;

			while ($i < $len) {
				$value = isset($row[$params['columns'][$i]['field']]) ? $row[$params['columns'][$i]['field']] : '';
				$sheet->setCellValue($this->column($i, $rownum), $value);
				++$i;
			}

			++$rownum;
		}

		$excel->getActiveSheet()->setTitle($params['title']);
		$filename = urlencode($params['title'] . '-' . date('YmdHi', time()));
		ob_end_clean();
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
		header('Cache-Control: max-age=0');
		$writer = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$this->SaveViaTempFile($writer);
		exit();
	}

	/**
     * 分页追加导出Excel，防止内存溢出
     * @param type $list
     * @param type $params
     */
	public function exportExcel($list, $params = array(), $path = '', $page = 1, $exflag = false)
	{
		session_start();
		if (!is_dir($path)) {
			@mkdir($path, 511);
		}
		
		$tmp_date = $_SESSION['tmp_date'] = empty($_SESSION['tmp_date']) ? date('YmdHis') : $_SESSION['tmp_date'];//缓存时间戳锁定正在执行任务;
		$filename = $tmp_date . '.xls';
		
		if (!empty($params['title'])) {
			$filename = $params['title'] . '-' . $filename;
		}
		
		$savepath = $path . $filename;
		
		if ($exflag) {
			$_SESSION['tmp_date'] = '';
			$file = $savepath;
			if (file_exists($file)) {
				load()->func('file');
				header('Content-type:application/octet-stream');				
				header('Content-Disposition:attachment;filename = ' . $filename);
				header('Accept-ranges:bytes');
				header('Accept-length:' . filesize($file));
				readfile($file);
				file_delete($file);				
			}
			else {
				echo '<script>alert(\'文件不存在\')</script>';
			}
			exit();
		}
		
		require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
		$rownum = 1;
		if ($page == 1) {
			$data = m('common')->getSysset('shop');
			$excel = new PHPExcel();
			$excel->getProperties()->setCreator(empty($data['name']) ? '活动报名' : $data['name'])->setLastModifiedBy(empty($data['name']) ? '活动报名' : $data['name'])->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
			$sheet = $excel->setActiveSheetIndex(0);
			foreach ($params['columns'] as $key => $column) {
				$sheet->setCellValue($this->column($key, $rownum), $column['title']);
	
				if (!empty($column['width'])) {
					$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
				}
			}
		}else{
			date_default_timezone_set('PRC');
			// 读取excel文件
			try {
				$inputFileType = \PHPExcel_IOFactory::identify($savepath);
				$objReader = \PHPExcel_IOFactory::createReader($inputFileType);
				$excel = $objReader->load($savepath);
				$sheet = $excel->getSheet(0);
				$rownum = $sheet->getHighestRow();
			} catch(\Exception $e) {
				die('加载文件发生错误："'.pathinfo($savepath,PATHINFO_BASENAME).'": '.$e->getMessage());
			}			
		}
		++$rownum;
		$len = count($params['columns']);

		foreach ($list as $row) {
			$i = 0;

			while ($i < $len) {
				$value = isset($row[$params['columns'][$i]['field']]) ? $row[$params['columns'][$i]['field']] : '';
				$sheet->setCellValue($this->column($i, $rownum), $value);
				++$i;
			}

			++$rownum;
		}		
		
		$excel->getActiveSheet()->setTitle($params['title']);
		ob_end_clean();
		$writer = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$writer->save($savepath);
		
		return true;
	}

	/**
     * @author MaoMao
     * @param $list
     * @param array $columns
     * @param string $title
     * @param string $path
     * @param string $appName
     * @return array
     * @throws null
     */
	public function exportCSV($list, $columns = array(), $path = '', $page = 1, $exflag = false)
	{
		set_time_limit(0);
		session_start();
		if (empty($path)) {
			throw new Exception('Excel::exportCSV  should only be run from a Web Browser');
		}

		if (!is_dir($path)) {
			@mkdir($path, 511);
		}
		
		$tmp_date = $_SESSION['tmp_date'] = empty($_SESSION['tmp_date']) ? date('YmdHis') : $_SESSION['tmp_date'];//缓存时间戳锁定正在执行任务;
		$filename = $tmp_date . '.csv';

		if (!empty($columns['title'])) {
			$filename = $columns['title'] . '-' . $filename;
		}

		//导出下载找不到文件时，请尝试183行代码，并注释185行
		//$savepath = iconv('UTF-8', 'GBK//TRANSLIT', $path . $filename);
		
		$savepath = $path . $filename;

		if ($page == 1) {
			$tableheader = array();

			foreach ($columns['columns'] as $col) {
				$tableheader[] = $col['title'];
			}

			$tableheader_str = '"' . implode('","', $tableheader) . '"' . '
';
			$html = iconv('UTF-8', 'GBK//TRANSLIT', $tableheader_str);
		}

		foreach ($list as $value) {
			foreach ($columns['columns'] as $col) {
				$type = '';
				if (isset($col['type']) && $col['type'] === 'string') {
					$type = '	';
				}

				$html .= '"' . iconv('UTF-8', 'GBK//TRANSLIT', $value[$col['field']]) . ($type . '",');
			}

			$html .= '
';
		}$newcell = sprintf("[%35s]", $cell);

		if ($exflag) {	
			$file = $savepath;
			if (file_exists($file)) {
				error_reporting(0);
				require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
				
				$filename = str_replace('.csv' , '.xls' , $filename);
                $objReader = \PHPExcel_IOFactory::createReader('CSV');
                $objReader->setDelimiter(',')
						  ->setInputEncoding('GBK')
						  ->setEnclosure('"')
						  //->setLineEnding("\r\n")
						  ->setSheetIndex(0);
				
                $objPHPExcel = $objReader->load($file);
				$sheet = $objPHPExcel->getSheet(0);
				
				foreach ($columns['columns'] as $key => $column) {
					if (!empty($column['width'])) {
						$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
					}
				}
				
				ob_end_clean();
				header('Content-type:application/octet-stream');				
				header('Content-Disposition:attachment;filename = ' . $filename);
				header('Accept-ranges:bytes');
				header('Accept-length:' . filesize($file));
				
				$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$this->SaveViaTempFile($objWriter);
				
				$_SESSION['tmp_date'] = '';
				load()->func('file');
				file_delete($file);
			}
			else {
				echo '<script>alert(\'文件不存在\')</script>';
			}
			exit();
		}

		if (!empty($html)) {
			file_put_contents($savepath, $html, 8);
		}

		return true;
	}

	/**
     * @param $objWriter PHPExcel_Writer_IWriter
     */
	public function SaveViaTempFile($objWriter)
	{
		global $_W;
		$path = FX_DATA . '/' . $_W['uniacid'];
		if (!is_dir($path)) {
			@mkdir($path, 511);
		}
		$filePath = $path . '/' . rand(0, getrandmax()) . rand(0, getrandmax()) . '.tmp';
		$objWriter->save($filePath);
		readfile($filePath);
		unlink($filePath);
	}

	/**
     * 生成模板文件Excel
     * @param type $list
     * @param type $params
     */
	public function temp($title, $columns = array())
	{
		require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
		$excel = new PHPExcel();
		$excel->getProperties()->setCreator('活动报名')->setLastModifiedBy('活动报名')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
		$sheet = $excel->setActiveSheetIndex(0);
		$rownum = 1;

		foreach ($columns as $key => $column) {
			$sheet->setCellValue($this->column($key, $rownum), $column['title']);

			if (!empty($column['width'])) {
				$sheet->getColumnDimension($this->column_str($key))->setWidth($column['width']);
			}
		}

		++$rownum;
		$len = count($columns);
		$k = 1;

		while ($k <= 5000) {
			$i = 0;

			while ($i < $len) {
				$sheet->setCellValue($this->column($i, $rownum), '');
				++$i;
			}

			++$rownum;
			++$k;
		}

		$excel->getActiveSheet()->setTitle($title);
		$filename = urlencode($title);
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
		header('Cache-Control: max-age=0');
		$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
		$writer->save('php://output');
		exit();
	}

	public function import($excefile)
	{
		global $_W;
		require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';
		require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel/IOFactory.php';
		require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel/Reader/Excel5.php';
		$path = FX_DATA . '/tmp/';

		if (!is_dir($path)) {
			load()->func('file');
			mkdirs($path, '0777');
		}

		$filename = $_FILES[$excefile]['name'];
		$tmpname = $_FILES[$excefile]['tmp_name'];

		if (empty($tmpname)) {
			message('请选择要上传的Excel文件!', '', 'error');
		}

		$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
		if ($ext != 'xlsx' && $ext != 'xls') {
			message('请上传 xls 或 xlsx 格式的Excel文件!', '', 'error');
		}

		$file = time() . $_W['uniacid'] . '.' . $ext;
		$uploadfile = $path . $file;
		$result = move_uploaded_file($tmpname, $uploadfile);

		if (!$result) {
			message('上传Excel 文件失败, 请重新上传!', '', 'error');
		}

		$reader = PHPExcel_IOFactory::createReader($ext == 'xls' ? 'Excel5' : 'Excel2007');
		$excel = $reader->load($uploadfile);
		$sheet = $excel->getActiveSheet();
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$highestColumnCount = PHPExcel_Cell::columnIndexFromString($highestColumn);
		$values = array();
		$row = 1;

		while ($row <= $highestRow) {
			$rowValue = array();
			$col = 0;

			while ($col < $highestColumnCount) {
				$rowValue[] = (string) $sheet->getCellByColumnAndRow($col, $row)->getValue();
				++$col;
			}

			$values[] = $rowValue;
			++$row;
		}

		return $values;
	}
}

if (!defined('IN_IA')) {
	exit('Access Denied');
}

?>