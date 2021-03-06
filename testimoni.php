<?php
/*
Plugin Name: Testimoni Form Plugin
Description: Simple non-bloated WordPress Contact Form
Version: 1.0
Author: farah shofiatul
*/

class testimoni{

	public $blog_id;
	
	public function __construct(){
		$this->blog_id = get_current_blog_id();
		add_action('admin_menu', array($this, 'setup_admin_menu'));
		add_shortcode('shortcode_testimoni', array($this, 'add_to_database'));
		add_shortcode('shortcode_testimoni_table', array($this, 'show_testimoni_frontend'));
	}

	public function setup_admin_menu() {
		add_menu_page( 'Admin', 'Admin', 'manage_options', 'show_testimoni', array($this, 'show_testimoni'), 'dashicons-tickets', 6  );
   	}

	function add_to_database(){
		global $wpdb;
		$tableName = $wpdb->base_prefix."testimoni";
	 	if ( isset( $_POST['cf-submitted'] ) ) {
       		 $data = array('name'=>$_POST["cf-name"],
			'email'=>$_POST["cf-email"],
			'phone'=>$_POST["cf-phone"],
			'testimoni'=>$_POST["cf-testimoni"],
			'blog_id'=>$_POST['blogId']
			);
       		 if($data['name'] == null || $data['email'] == null || $data['phone'] == null || $data['testimoni'] == null){
       		 	?><script>alert('field is empty')</script><?php
        	}else{
        		$formatData = array('%s','%s','%s','%s');
				$wpdb->insert($tableName, $data, $formatData);
        	}
			
			if($wpdb->insert_id){
				?><script>alert('Insert Data Success')</script><?php
			}		   
    	}
		echo '<form action="" method="post">';
		echo '<input type="hidden" name="blogId" value="'.$this->blog_id.'"/>';
		echo '<p>';
		echo 'Name (required) <br />';
		echo '<input type="text" name="cf-name"  pattern="[a-zA-Z0-9 ]+" value="" size="40" />';
		echo '</p>';
		echo '<p>';
		echo 'Email (required) <br />';
		echo '<input type="email" name="cf-email"  value="" size="40" />';
		echo '</p>';
		echo '<p>';
		echo 'Phone Number (required) <br />';
		echo '<input type="text" name="cf-phone"  value="" size="40" />';
		echo '</p>';
		echo '<p>';
		echo 'Testimoni (required) <br />';
		echo '<textarea rows="10" cols="35"  name="cf-testimoni"></textarea>';
		echo '</p>';
		echo '<p><input type="submit" name="cf-submitted" value="Send"/></p>';
		echo '</form>';	
	}

	function show_testimoni(){
		global $wpdb;
		$tableName = $wpdb->base_prefix."testimoni";
		if(isset($_GET['id'])){
			$deletedata = $wpdb->delete( $tableName, array( 'id' => $_GET['id'], 'blog_id' => $this->blog_id ) );
			if(! $deletedata ){
				?><script>alert('Not Deleted')</script><?php
			}
			?><script>alert('Deleted')</script><?php
		}
		$data = $wpdb->get_results( "SELECT * FROM $tableName WHERE blog_id = $this->blog_id");
		echo "<table id='testimoni'>";
		echo "</tr>";
		echo "<th>Name</th><th>Email</th><th>phone</th><th>testimoni</th><th>hapus</th>";
		echo "</tr>";
		foreach($data as $value){
			$id = $value->id;
			echo '<tr>';
			echo '<td>'.$value->name.'</td>';
			echo '<td>'.$value->email.'</td>';
			echo '<td>'.$value->phone.'</td>';
			echo '<td>'.$value->testimoni.'</td>';
			echo '<td><a href="'.admin_url('admin.php?page=show_testimoni&id='.$id.'').'">Delete</a></td>';
			echo '</tr>';	
		}
		echo '</table>';	
	}

	function show_testimoni_frontend(){
		global $wpdb;
		$tableName = $wpdb->base_prefix."testimoni";
		$data = $wpdb->get_results( "SELECT * FROM $tableName WHERE blog_id = $this->blog_id");
		echo "<table id='testimoni'>";
		echo "</tr>";
		echo "<th>id</th><th>Name</th><th>Email</th><th>phone</th><th>testimoni</th>";
		echo "</tr>";
		foreach($data as $value){
			echo '<tr>';
			echo '<td>'.$value->id.'</td>';
			echo '<td>'.$value->name.'</td>';
			echo '<td>'.$value->email.'</td>';
			echo '<td>'.$value->phone.'</td>';
			echo '<td>'.$value->testimoni.'</td>';
			echo '</tr>';
		}
		echo "</table>";
	}
}


class My_Widget extends WP_Widget {

	public $blog_id;

	public function __construct() {
		add_action( 'widgets_init', array($this, 'register_widget'));
		$this->blog_id = get_current_blog_id();
		$widget_ops = array( 
			'classname' => 'my_widget',
			'description' => 'My Widget is awesome',
		);
		parent::__construct( 'my_widget', 'My Widget', $widget_ops );
	}

	public function register_widget(){
		register_widget( 'My_Widget' );
	}
	public function widget( $args, $instance ) {
		global $wpdb;
		$tableName = $wpdb->base_prefix."testimoni";
		$data = $wpdb->get_results("
        SELECT *
        FROM $tableName WHERE blog_id = $this->blog_id
        ORDER BY RAND()
        LIMIT 1");
		echo $args['before_widget'];
		echo ('Testimoni');
		echo '</br>';
		foreach ($data as $value) {
			echo $value->testimoni;
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		// outputs the options form on admin
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

new testimoni();
new My_Widget();
?>
