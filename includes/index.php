<?php 
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class Posts_list extends WP_List_Table {
//$date=date();
	
	var $data = array(
	array('Title' => 'Poshaq' ,'Shortcode' => '[Poshaq]', 'description' => 'sdhhsdgkh'
	));
 	function get_columns() {
		return $columns= array(
		  'cb' => '<input type="checkbox" />',
		  'Title'=>__('Title'),
		  'Shortcode'=>__('Shortcode'),
		  'description'=>__('description') 
	   );
   }
function prepare_items() {
  $columns = $this->get_columns();
  $hidden = array();
  $sortable = $this->get_sortable_columns();
  $this->_column_headers = array($columns, $hidden, $sortable);
  $this->items = $this->data;
}
	
	function column_default( $item, $column_name ) {
	switch( $column_name ) { 
    case 'Title':
    case 'Shortcode':
    case 'description':
	return $item[ $column_name ];
    default:
    return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
  }
}
function get_sortable_columns() {
  $sortable_columns = array(
    'Title'  => array('Title', false),
    'Shortcode' => array('Shortcode',false),
    'description'   => array('description',false),
	 );
  return $sortable_columns;
}
function get_bulk_actions() {
	$actions= array(
	'delete'=>'Delete'
	);
	return $actions;
}
}
