<?php 
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
require_once plugin_dir_path( dirname( __FILE__ ) ) .'includes\class-poshaqplug.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) .'admin\js\poshaqplug-admin.js';

class Posts_list extends WP_List_Table {
	private $data;
	public function __construct() {
	add_filter('page_row_actions', 'copy_text', 1, 2);
	parent::__construct();
	$this->data = array(
	array('Title' => 'Poshaq' ,
	'Shortcode' => '<div style="cursor:pointer; color: RGB(52, 152, 219)" class="btnn" data-clipboard-text="[poshaq]">[poshaq id=1]</div>', 
	'description' => 'you can describe me here'
	));
	}
 	function get_columns() {
		return $columns= array(
		  'cb' => '<input type="checkbox" />',
		  'Title'=>__('Title'),
		  'Shortcode'=>__('Shortcode'),
		  'description'=>__('description') 
	   );
	}
	
	function copy_text($actions, $always_visible=true) {
		$actions['copy']= '<div style="cursor:pointer; color: RGB(52, 152, 219)" class="btnn" data-clipboard-text="[poshaq]">'.__('copy').'</div>';
		return $actions;
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