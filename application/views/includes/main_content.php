<?php
	$this->load->view('includes/page_header');
?>
<div id="" class="grid_12">
	
	<div id="" class="grid_8">
    	<?php $this->load->view($page_main); ?>
	</div>
        <!-- end of main area -->
	<div id="" class="grid_4">
    	<?php 
            if (isset($page_side_1)) {
                $this->load->view($page_side_1);
            }
            if (isset($page_side_2)) {
                $this->load->view($page_side_2);
            }
            
            if (isset($page_side_2)) {
                $this->load->view($page_side_3);
            }
            ?>
	</div>
</div>
<?php
	$this->load->view('includes/page_footer');
?>