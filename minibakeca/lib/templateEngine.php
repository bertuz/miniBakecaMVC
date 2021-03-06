<?php
 
/**
 * Esegue un template contenente codice PHP e ritorna il risultato in forma di Stringa.
 * 
 */
function apply_template($tpl_file, $vars = array()) {
	extract($vars);
 
	ob_start();
 
	require($tpl_file);
 
	$applied_template = ob_get_contents();
	ob_end_clean();
 
	return $applied_template;
}
 
?>