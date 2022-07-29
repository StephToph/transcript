<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/flags-icon/css/flag-icon.min.css"> 

        <!-- END Template CSS-->      

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/main.css">

        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->    
    <body>
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div class="loader"></div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" id="cad">
                            <table class="table">
                                <thead>
	                                <tr bgcolor="#f0c51c">
	                                    <td colspan="2"><img src="<?php echo base_url('assets/logo.png'); ?>" width="200px" height="100px"></td>
	                                    <td align="center" colspan="2" style="float: center"><center>
	                                        <h3 style="color: white"><?php echo strtoupper(app_name); ?></h3></center>
	                                    </td>
	                                    <td colspan="2" align="right" width="400px" style="color: white"><b>
											Generated:<br><?php echo date("F j, Y, g:ia"); ?><br></b>
	                                    </td>
                                    </tr>
                                </thead>
	                                <thead>
		                                <tr>
		                                    <th style="text-align: center;" colspan="3"><h6><b>Student Information</b></h6></th>
		                                    <th  style="text-align: center;" colspan="3"><h6><b>School  Information</b></h6></th>
		                                </tr>
		                                <tr>
		                                    <th style="text-align: centr;" colspan="3"><h6><b>Name:</b> <?php echo strtoupper($this->Crud->read_field('student_id', $student_id, 'student', 'surname').' '.$this->Crud->read_field('student_id', $student_id, 'student', 'firstname')) ?></h6></th>
		                                    <th style="text-align: ;" colspan="3"><h6><b>School Name:</b> OGUN STATE INSTITUTE OF TECHNOLOGY, IGBESA. </h6></th>
		                                </tr>
		                                <tr>
		                                    <th style="text-align: centr;" colspan="3"><h6><b>Address:</b> <?php echo ucwords($this->Crud->read_field('student_id', $student_id, 'student', 'address')) ?></h6></th>
		                                    <th style="text-align: ;" colspan="3"><h6><b>School Address:</b> Oba Adesola Market Road, P.M.B, 2005, Igbesa, Ogun State, Nigeria. </h6></th>
		                                </tr>
		                                <tr>
		                                    <th style="text-align: centr;" colspan="3"><h6><b>Sex:</b> <?php echo ucwords($this->Crud->read_field('student_id', $student_id, 'student', 'gender')) ?></h6></th>
		                                    <th style="text-align: ;" colspan="3"><h6><b>School Phone Number:	</b>08164819150. </h6></th>
		                                </tr>
		                                <tr>
		                                    <th style="text-align: centr;" colspan="3"><h6><b>Date of Graduation:</b> <?php echo str_replace('_', '/', $this->Crud->read_field('student_id', $student_id, 'student', 'admission_session')) ?></h6></th>
		                                    <th style="text-align: ;" colspan="3"><h6><b>School Email Address:	</b> registrar@ogitech.edu.ng </h6></th>
		                                </tr>
		                                
		                                <tr>
		                                    <th style="text-align: centr;"><h6><b>Degree Earned:</b> <?php echo ucwords($this->Crud->read_field('student_id', $student_id, 'student', 'level')); $cpa = $this->Crud->read_single('student_id', $student_id, 'result_grade');
												$t_cgpa = 0;
												if (empty($cpa)) {
													$t_cgpa = 0;
													$tot = 0.00;
												} else {
													foreach ($cpa as $key) {
														$cgpa = $key->gpa;
														$t_cgpa += $cgpa;
													}$tot = round($t_cgpa/count($cpa), 2);

												}
												?></h6></th>
		                                    <th style="text-align: ;" colspan="2"><h6><b>C.G.P.A:	<?php echo $tot; ?></b> </h6></th>
		                                    <th style="text-align: ;" colspan="3"><span><i>I hereby affrim that this official academic record is accurate and complete. <br></i></span><h6><b>Administrator Approved:	</b> Admin</h6></th>
		                                </tr>
		                                <tr>
		                                    <th style="text-align: center;" colspan="3"><h6><b>ND1 First Semester</b></h6></th>
		                                     <th style="text-align: center;" colspan="3"><h6><b>ND1 Second Semester</b></h6></th>
		                                </tr>

		                                <tr>
		                                	<th colspan="3">
			                                	<table class="table  table-sm">
		                                			 <tr>
					                                    <th style="text-align: centr;"><h6>Course Name</h6></th>
					                                    <th style="text-align: centr;"><h6>Course Unit</h6></th>
					                                    <th style="text-align: centr;"><h6>Score Unit</h6></th>
					                                </tr>
				                                	<?php
				                                		$degree = $this->Crud->read_field('student_id', $student_id, 'student', 'level');
				                                		$units = 0;
				                                		$score = 0;
				                                		$cou1 = $this->Crud->read2('semester', 'First', 'level', $degree.'1', 'course_allocate');
				                                		foreach ($cou1 as $key1) {

				                                			?>
						                               <tr>
						                                	
						                                	<th><?php echo strtoupper($this->Crud->read_field('code', $key1->course_code, 'course', 'name')); ?></th>
						                                	<th><?php echo strtoupper($this->Crud->read_field('code', $key1->course_code, 'course', 'unit')); ?></th>
						                                	<th>
						                                		<?php

						                                		$total = $this->Crud->read_field4('student_id', $student_id, 'course_code', $key1->course_code, 'semester', 'First', 'approve_status', '1', 'result', 'total');
						                                		///////////////////////Grade Point///////////////////////
																	if($total >= 75){
														              $gp = 4.00;
														              $lg = 'AA';
														            } elseif ($total >=70 && $total <= 74) {
														              $gp = 3.50;
														              $lg = 'A';
														            } elseif ($total >=65 && $total <= 69) {
														              $gp = 3.25;
														              $lg = 'AB';
														            } elseif ($total >=60 && $total <= 64) {
														              $gp = 3.00;
														              $lg = 'B';
														            } elseif ($total >=55 && $total <= 59) {
														              $gp = 2.75;
														              $lg = 'BC';
														            } elseif ($total >=50 && $total <= 54) {
														              $gp = 2.50;
														              $lg = 'C';
														            } elseif ($total >=45 && $total <= 49) {
														              $gp = 2.25;
														              $lg = 'CD';
														            } elseif ($total >=40 && $total <= 44) {
														              $gp = 2.00;
														              $lg = 'D';
														            } elseif ($total >=35 && $total <= 39) {
														              $gp = 1.75;
														              $lg = 'DD';
														            } elseif ($total >=30 && $total <= 34) {
														              $gp = 1.50;
														              $lg = 'DE';
														            } elseif ($total >=25 && $total <= 29) {
														              $gp = 1.25;
														              $lg = 'E';
														            } elseif ($total >=20 && $total <= 24) {
														              $gp = 1.00;
														              $lg = 'EE';
														            } elseif ($total >=0 && $total <= 19) {
														              $gp = 0.00;
														              $lg = 'F';
														            } else {
														              $gp = 0.00;
														              $lg = 'F';
														            }
												            	/////////////////////////////////////////////////////
							

						                                			$unit = $this->Crud->read_field('code', $key1->course_code, 'course', 'unit');

						                                			$sc = round($gp * $unit, 2);
						                                			echo $sc;
						                                			$units +=$unit;
						                                			$score += $sc;

						                                			$gpa = round($score/$units, 2);
						                                		?>

						                                	</th>
						                               </tr>
					                                <?php } ?>
					                                <tr>
					                                	<th>Total</th>
					                                	<th><?php echo $units; ?></th>
					                                	<th><?php echo $score; ?></th>
					                                </tr>
					                                <tr>
					                                	<th>G.P.A = <?php echo $gpa; ?></th>
					                                </tr>
				                                </table>
				                            </th>

			                                <th colspan="3" style="padding-top: 1px">
			                                	<table class="table  table-sm">
			                                		<tr>
					                                    <th style="text-align: centr;"><h6>Course Name</h6></th>
					                                    <th style="text-align: centr;"><h6>Course Unit</h6></th>
					                                    <th style="text-align: centr;"><h6>Score Unit</h6></th>
					                                </tr>
				                                	<?php
				                                		$units2 = 0;
				                                		$score2 = 0;
			                                		$cou2 = $this->Crud->read2('semester', 'Second', 'level', $degree.'1', 'course_allocate');
			                                		foreach ($cou2 as $key2) {?>
				                                	<tr >
				                                		<th><?php echo strtoupper($this->Crud->read_field('code', $key2->course_code, 'course', 'name')); ?></th>
					                                	<th><?php echo strtoupper($this->Crud->read_field('code', $key2->course_code, 'course', 'unit')); ?></th>
					                                	<th>
						                                		<?php

						                                		$total = $this->Crud->read_field4('student_id', $student_id, 'course_code', $key2->course_code, 'semester', 'Second', 'approve_status', '1', 'result', 'total');
						                                		////////////////////////////////////////////Grade Point///////////////////////
																if($total >= 75){
													              $gp = 4.00;
													              $lg = 'AA';
													            } elseif ($total >=70 && $total <= 74) {
													              $gp = 3.50;
													              $lg = 'A';
													            } elseif ($total >=65 && $total <= 69) {
													              $gp = 3.25;
													              $lg = 'AB';
													            } elseif ($total >=60 && $total <= 64) {
													              $gp = 3.00;
													              $lg = 'B';
													            } elseif ($total >=55 && $total <= 59) {
													              $gp = 2.75;
													              $lg = 'BC';
													            } elseif ($total >=50 && $total <= 54) {
													              $gp = 2.50;
													              $lg = 'C';
													            } elseif ($total >=45 && $total <= 49) {
													              $gp = 2.25;
													              $lg = 'CD';
													            } elseif ($total >=40 && $total <= 44) {
													              $gp = 2.00;
													              $lg = 'D';
													            } elseif ($total >=35 && $total <= 39) {
													              $gp = 1.75;
													              $lg = 'DD';
													            } elseif ($total >=30 && $total <= 34) {
													              $gp = 1.50;
													              $lg = 'DE';
													            } elseif ($total >=25 && $total <= 29) {
													              $gp = 1.25;
													              $lg = 'E';
													            } elseif ($total >=20 && $total <= 24) {
													              $gp = 1.00;
													              $lg = 'EE';
													            } elseif ($total >=0 && $total <= 19) {
													              $gp = 0.00;
													              $lg = 'F';
													            } else {
													              $gp = 0.00;
													              $lg = 'F';
													            }
												            	/////////////////////////////////////////////////////
							

						                                			$unit2 = $this->Crud->read_field('code', $key2->course_code, 'course', 'unit');

						                                			$sc2 = round($gp * $unit2, 2);
						                                			echo $sc2;
						                                			$units2 +=$unit2;
						                                			$score2 += $sc2;

						                                			$gpa = round($score2/$units2, 2);
						                                		?>

						                                	</th>
					                                </tr>
				                                	<?php } ?>
				                                	 <tr>
					                                	<th>Total</th>
					                                	<th><?php echo $units2; ?></th>
					                                	<th><?php echo $score2; ?></th>
					                                </tr>
					                                <tr>
					                                	<th>G.P.A = <?php echo $gpa; ?></th>
					                                </tr>
				                                </table>
				                            </th>

			                            </tr>
			                            <tr>
		                                    <th style="text-align: center;" colspan="3"><h6><b>ND2 First Semester</b></h6></th>
		                                     <th style="text-align: center;" colspan="3"><h6><b>ND2 Second Semester</b></h6></th>
		                                </tr>

		                                <tr>
		                                	<th colspan="3">
			                                	<table class="table  table-sm">
		                                			 <tr>
					                                    <th style="text-align: centr;"><h6>Course Name</h6></th>
					                                    <th style="text-align: centr;"><h6>Course Unit</h6></th>
					                                    <th style="text-align: centr;"><h6>Score Unit</h6></th>
					                                </tr>
				                                	<?php
				                                		$units = 0;
				                                		$score = 0;
				                                		$cou1 = $this->Crud->read2('semester', 'First', 'level', $degree.'2', 'course_allocate');
				                                		foreach ($cou1 as $key1) {

				                                			?>
						                               <tr>
						                                	
						                                	<th><?php echo strtoupper($this->Crud->read_field('code', $key1->course_code, 'course', 'name')); ?></th>
						                                	<th><?php echo strtoupper($this->Crud->read_field('code', $key1->course_code, 'course', 'unit')); ?></th>
						                                	<th>
						                                		<?php

						                                		$total = $this->Crud->read_field4('student_id', $student_id, 'course_code', $key1->course_code, 'semester', 'First', 'approve_status', '1', 'result', 'total');
						                                		///////////////////////Grade Point///////////////////////
																	if($total >= 75){
														              $gp = 4.00;
														              $lg = 'AA';
														            } elseif ($total >=70 && $total <= 74) {
														              $gp = 3.50;
														              $lg = 'A';
														            } elseif ($total >=65 && $total <= 69) {
														              $gp = 3.25;
														              $lg = 'AB';
														            } elseif ($total >=60 && $total <= 64) {
														              $gp = 3.00;
														              $lg = 'B';
														            } elseif ($total >=55 && $total <= 59) {
														              $gp = 2.75;
														              $lg = 'BC';
														            } elseif ($total >=50 && $total <= 54) {
														              $gp = 2.50;
														              $lg = 'C';
														            } elseif ($total >=45 && $total <= 49) {
														              $gp = 2.25;
														              $lg = 'CD';
														            } elseif ($total >=40 && $total <= 44) {
														              $gp = 2.00;
														              $lg = 'D';
														            } elseif ($total >=35 && $total <= 39) {
														              $gp = 1.75;
														              $lg = 'DD';
														            } elseif ($total >=30 && $total <= 34) {
														              $gp = 1.50;
														              $lg = 'DE';
														            } elseif ($total >=25 && $total <= 29) {
														              $gp = 1.25;
														              $lg = 'E';
														            } elseif ($total >=20 && $total <= 24) {
														              $gp = 1.00;
														              $lg = 'EE';
														            } elseif ($total >=0 && $total <= 19) {
														              $gp = 0.00;
														              $lg = 'F';
														            } else {
														              $gp = 0.00;
														              $lg = 'F';
														            }
												            	/////////////////////////////////////////////////////
							

						                                			$unit = $this->Crud->read_field('code', $key1->course_code, 'course', 'unit');

						                                			$sc = round($gp * $unit, 2);
						                                			echo $sc;
						                                			$units +=$unit;
						                                			$score += $sc;

						                                			$gpa = round($score/$units, 2);
						                                		?>

						                                	</th>
						                               </tr>
					                                <?php } ?>
					                                <tr>
					                                	<th>Total</th>
					                                	<th><?php echo $units; ?></th>
					                                	<th><?php echo $score; ?></th>
					                                </tr>
					                                <tr>
					                                	<th>G.P.A = <?php echo $gpa; ?></th>
					                                </tr>
				                                </table>
				                            </th>

			                                <th colspan="3" style="padding-top: 1px">
			                                	<table class="table  table-sm">
			                                		<tr>
					                                    <th style="text-align: centr;"><h6>Course Name</h6></th>
					                                    <th style="text-align: centr;"><h6>Course Unit</h6></th>
					                                    <th style="text-align: centr;"><h6>Score Unit</h6></th>
					                                </tr>
				                                	<?php
				                                		$units2 = 0;
				                                		$score2 = 0;
			                                		$cou2 = $this->Crud->read2('semester', 'Second', 'level', $degree.'2', 'course_allocate');
			                                		foreach ($cou2 as $key2) {?>
				                                	<tr >
				                                		<th><?php echo strtoupper($this->Crud->read_field('code', $key2->course_code, 'course', 'name')); ?></th>
					                                	<th><?php echo strtoupper($this->Crud->read_field('code', $key2->course_code, 'course', 'unit')); ?></th>
					                                	<th>
						                                		<?php

						                                		$total = $this->Crud->read_field4('student_id', $student_id, 'course_code', $key2->course_code, 'semester', 'Second', 'approve_status', '1', 'result', 'total');
						                                		////////////////////////////////////////////Grade Point///////////////////////
																if($total >= 75){
													              $gp = 4.00;
													              $lg = 'AA';
													            } elseif ($total >=70 && $total <= 74) {
													              $gp = 3.50;
													              $lg = 'A';
													            } elseif ($total >=65 && $total <= 69) {
													              $gp = 3.25;
													              $lg = 'AB';
													            } elseif ($total >=60 && $total <= 64) {
													              $gp = 3.00;
													              $lg = 'B';
													            } elseif ($total >=55 && $total <= 59) {
													              $gp = 2.75;
													              $lg = 'BC';
													            } elseif ($total >=50 && $total <= 54) {
													              $gp = 2.50;
													              $lg = 'C';
													            } elseif ($total >=45 && $total <= 49) {
													              $gp = 2.25;
													              $lg = 'CD';
													            } elseif ($total >=40 && $total <= 44) {
													              $gp = 2.00;
													              $lg = 'D';
													            } elseif ($total >=35 && $total <= 39) {
													              $gp = 1.75;
													              $lg = 'DD';
													            } elseif ($total >=30 && $total <= 34) {
													              $gp = 1.50;
													              $lg = 'DE';
													            } elseif ($total >=25 && $total <= 29) {
													              $gp = 1.25;
													              $lg = 'E';
													            } elseif ($total >=20 && $total <= 24) {
													              $gp = 1.00;
													              $lg = 'EE';
													            } elseif ($total >=0 && $total <= 19) {
													              $gp = 0.00;
													              $lg = 'F';
													            } else {
													              $gp = 0.00;
													              $lg = 'F';
													            }
												            	/////////////////////////////////////////////////////
							

						                                			$unit2 = $this->Crud->read_field('code', $key2->course_code, 'course', 'unit');

						                                			$sc2 = round($gp * $unit2, 2);
						                                			echo $sc2;
						                                			$units2 +=$unit2;
						                                			$score2 += $sc2;

						                                			$gpa = round($score2/$units2, 2);
						                                		?>

						                                	</th>
					                                </tr>
				                                	<?php } ?>
				                                	 <tr>
					                                	<th>Total</th>
					                                	<th><?php echo $units2; ?></th>
					                                	<th><?php echo $score2; ?></th>
					                                </tr>
					                                <tr>
					                                	<th>G.P.A = <?php echo $gpa; ?></th>
					                                </tr>
				                                </table>
				                            </th>

			                            </tr>
			                        </thead>
		                        </table>
		                        
                        </div>
                        <input type="hidden" name="sed_id" id="sed_id" value="<?php echo $id; ?>">
                        <i>This document should be treated as confidencial</i> | <?php if($param == 'download'){ ?><a href="javascript:;" onClick="downloadImage();"><b>Print Report</b></a>  |<?php } else {?> <a href="javascript:;" onClick="dowImage();"><b>Send Transcript</b></a> | <?php } ?>  <a class="text-primary" href="<?php echo base_url('transcript'); ?>" data-toggle="tooltip" title="Go Back"><i class=" icon-arrow-left-circle fa-1x"></i></a>
                    </div>
											
											
                </div> 

            </div>
        </div>
    
        <!-- START: Back to top-->
        <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/html2pdf.bundle.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/html2canvas.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jspdf.umd.min.js"></script>

        <!-- START: Template JS-->
        <script src="<?php echo base_url(); ?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/moment/moment.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?php echo base_url(); ?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- END: Template JS-->

        <!-- START: APP JS-->
        <script src="<?php echo base_url(); ?>assets/dist/js/app.js"></script>
        <script type="text/javascript">
			function dowImage(){
			  	var sed_id = $('#sed_id').val();
                
				 html2canvas(document.querySelector("#cad")).then(canvas => {
				 	const d = new Date();
					a = document.createElement('a'); 
					document.body.appendChild(a); 
					a.download = 'file'+d.getTime()+'.pdf';
					//a.href =  canvas.toDataURL();
					dataURL =  canvas.toDataURL();
					$.ajax({
                        type: "POST",
                        url: "<?php echo base_url('transcript/canvass/'); ?>"+ sed_id,
                        data: {
                            imgBase64: dataURL
                        }
                    }).done(function(o) {
                        console.log('saved');
                    });
					//a.click();

				});
			}	 
			 
			 function downloadImage(){
				 html2canvas(document.querySelector("#cad")).then(canvas => {
				 	const d = new Date();
					a = document.createElement('a'); 
					document.body.appendChild(a); 
					a.download = 'file'+d.getTime()+'.pdf';
					a.href =  canvas.toDataURL();
					dataURL =  canvas.toDataURL();
					a.click();

				});
			 }	 


			
		</script>
    </body>
    <!-- END: Body-->
</html>
