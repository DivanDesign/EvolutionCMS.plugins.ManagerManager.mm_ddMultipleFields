<?php
/**
 * mm_ddMultipleFields
 * @version 4.6 (2014-10-24)
 * 
 * @desc Widget for plugin ManagerManager that allows you to add any number of fields values (TV) in one document (values is written as one with using separator symbols). For example: a few images.
 * 
 * @uses PHP >= 5.4.
 * @uses MODXEvo.plugin.ManagerManager >= 0.7.
 * 
 * @param $fields {string_commaSeparated} — Names of TV for which the widget is applying. @required
 * @param $roles {string_commaSeparated} — The roles that the widget is applied to (when this parameter is empty then widget is applied to the all roles). Default: ''.
 * @param $templates {string_commaSeparated} — Templates IDs for which the widget is applying (empty value means the widget is applying to all templates). Default: ''.
 * @param $columns {string_commaSeparated} — Column types: field — field type column; text — text type column; textarea — multiple lines column; richtext — column with rich text editor; date — date column; id — hidden column containing unique id; select — list with options (parameter “columnsData”). Default: 'field'.
 * @param $columnsTitles {string_commaSeparated} — Columns titles. Default: ''.
 * @param $columnsWidth {string_commaSeparated} — Columns width (one value can be set). Default: 180;
 * @param $rowDelimiter {string} — Strings separator. Default: '||'.
 * @param $colDelimiter {string} — Columns separator. Default: '::'.
 * @param $previewWidth {integer} — Maximum value of image preview width. Default: 300.
 * @param $previewHeight {integer} — Maximum value of image preview height. Default: 100.
 * @param $minRowsNumber {integer} — Minimum number of strings. Default: 0.
 * @param $maxRowsNumber {integer} — Maximum number of strings. Default: 0 (без лимита).
 * @param $columnsData {separated string} — List of valid values in json format (with “||”). Default: ''.
 * 
 * @event OnDocFormPrerender
 * @event OnDocFormRender
 * 
 * @link http://code.divandesign.biz/modx/mm_ddmultiplefields/4.6
 * 
 * @copyright 2012–2014 DivanDesign {@link http://www.DivanDesign.biz }
 */

function mm_ddMultipleFields(
	$fields = '',
	$roles = '',
	$templates = '',
	$columns = 'field',
	$columnsTitles = '',
	$columnsWidth = '180',
	$rowDelimiter = '||',
	$colDelimiter = '::',
	$previewWidth = 300,
	$previewHeight = 100,
	$minRowsNumber = 0,
	$maxRowsNumber = 0,
	$columnsData = ''
){
	if (!useThisRule($roles, $templates)){return;}
	
	global $modx;
	$e = &$modx->Event;
	
	$output = '';
	
	$site = $modx->config['site_url'];
	$widgetDir = $site.'assets/plugins/managermanager/widgets/ddmultiplefields/';
	
	if ($e->name == 'OnDocFormPrerender'){
		global $_lang;
		
		$output .= includeJsCss($site.'assets/plugins/managermanager/js/jquery-ui-1.10.3.min.js', 'html', 'jquery-ui', '1.10.3');
		$output .= includeJsCss($widgetDir.'ddmultiplefields.css', 'html');
		$output .= includeJsCss($widgetDir.'jQuery.ddMM.mm_ddMultipleFields.js', 'html', 'jQuery.ddMM.mm_ddMultipleFields', '2.0');
		
		$output .= includeJsCss('$j.ddMM.lang.edit = "'.$_lang['edit'].'";', 'html', 'mm_ddMultipleFields_plain', '1', true, 'js');
		
		$e->output($output);
	}else if ($e->name == 'OnDocFormRender'){
		global $mm_current_page;
		
		if ($columnsData){
			$columnsDataTemp = explode('||', $columnsData);
			$columnsData = [];
			
			foreach ($columnsDataTemp as $value){
				//Евалим знение и записываем результат или исходное значени
				$eval = @eval($value);
				$columnsData[] = $eval ? addslashes(json_encode($eval)) : addslashes($value);
			}
			//Сливаем в строку, что бы передать на клиент
			$columnsData = implode('||', $columnsData);
		}
		
		//Стиль превью изображения
		$previewStyle = 'max-width:'.$previewWidth.'px; max-height:'.$previewHeight.'px; margin: 4px 0; cursor: pointer;';
		
		$fieldsArr = tplUseTvs($mm_current_page['template'], $fields, 'image,file,text,email,textarea', 'id,type');
		if ($fieldsArr == false){return;}
		
		$output .= '//---------- mm_ddMultipleFields :: Begin -----'.PHP_EOL;
		
		//For backward compatibility
		$columns = makeArray($columns);
		//Находим колонки, заданные как «field», теперь их нужно будет заменить на «image» и «file» соответственно
		$columns_fieldIndex = array_keys($columns, 'field');
		
		foreach ($fieldsArr as $field){
			//For backward compatibility
			if (
				$field['type'] == 'image' ||
				$field['type'] == 'file'
			){
				//Проходимся по всем колонкам «field» и заменяем на соответствующий тип
				foreach($columns_fieldIndex as $val){
					$columns[$val] = $field['type'];
				}
			}
			
			$output .=
'
$j("#tv'.$field['id'].'").mm_ddMultipleFields({
	rowDelimiter: "'.$rowDelimiter.'",
	colDelimiter: "'.$colDelimiter.'",
	columns: "'.implode(',', $columns).'",
	columnsTitles: "'.$columnsTitles.'",
	columnsData: "'.$columnsData.'",
	columnsWidth: "'.$columnsWidth.'",
	previewStyle: "'.$previewStyle.'",
	minRowsNumber: "'.$minRowsNumber.'",
	maxRowsNumber: "'.$maxRowsNumber.'"
});
';
		}
		
		//Поругаемся
		if (!empty($columns_fieldIndex)){
			$modx->logEvent(1, 2, '<p>You are currently using the deprecated column type “field”. Please, replace it with “image” or “file” respectively.</p><p>The plugin has been called in the document with template id '.$mm_current_page['template'].'.</p>', 'ManagerManager: mm_ddMultipleFields');
		}
		
		$output .= '//---------- mm_ddMultipleFields :: End -----'.PHP_EOL;
		
		$e->output($output);
	}
}
?>