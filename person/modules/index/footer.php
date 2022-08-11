
      </div>
      <!-- /.row -->
</section>
</div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b><?php echo _heading_main_title_eng." ["._footer_main_title."]";?></b>
        </div>
        <strong>Copyright &copy; 2017-2019 <a href="<?php echo WEB_URL;?>"><?php echo _footer_main_title;?></a></strong> All rights reserved.
      </footer>

</div><!-- ./wrapper -->





<?php //$db->closedb (); ?>

        <!-- jQuery UI 1.10.3 -->
        <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js" type="text/javascript" ></script>
        <!-- html2canvas
        <script src="../js/html2canvas.js" type="text/javascript" ></script>-->
		<!-- Select2 -->
		<script src="../plugins/select2/select2.full.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
		<!-- validator -->
		<script src="../plugins/validator/validator.js" type="text/javascript" ></script>
		<!-- validator -->
		<script src="../plugins/bootstrapvalidator/js/bootstrapValidator.js" type="text/javascript" ></script>
        <!-- INPUT FILE -->
        <script src="../js/bootstrap-filestyle.min.js" type="text/javascript"></script>
		<script src="../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="../plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

        <!--<script src="../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>-->
		<script src="../plugins/datatables/extensions/TableTools/js/dataTables.tableTools.js" type="text/javascript"></script>
		<script src="../plugins/datatables/extensions/Buttons/js/dataTables.buttons.js" type="text/javascript"></script>
		<script src="../plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js" type="text/javascript"></script>
		<script src="../plugins/datatables/extensions/Buttons/js/buttons.flash.min.js" type="text/javascript"></script>
		<script src="../plugins/datatables/extensions/Buttons/js/buttons.html5.min.js" type="text/javascript"></script>
		<script src="../plugins/datatables/extensions/Buttons/js/buttons.print.min.js" type="text/javascript"></script>
		<script src="../plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js" type="text/javascript"></script>
		<!-- pdf thai-->
		<script src="../dist/js/pdfmake.min.js" type="text/javascript"></script>
		<script src="../dist/js/vfs_fonts.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
		<!-- date-range-picker -->
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>-->
		<script src="../plugins/daterangepicker/daterangepicker.js"></script>
		<!-- date-picker -->
		<script src="../plugins/datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>
		<script src="../plugins/datepicker/js/bootstrap-datepicker-thai.js" type="text/javascript" ></script>
		<!-- bootstrap time picker -->
		<script src="../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript" ></script>
		<!-- datetimepicker -->
		<script src="../plugins/moment.js/moment-with-locales.js"></script>
		<script src="../plugins/datetimepicker/js/bootstrap-datetimepicker.js"></script>
		<!-- ChartJS 1.0.1 -->
		<script src="../plugins/chartjs/Chart.min.js" type="text/javascript" ></script>
		<!-- Morris.js charts -->
        <script src="../plugins/raphael/raphael.min.js" type="text/javascript" ></script>
        <script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
		<!-- sparkline -->
	    <script src="../plugins/jquery-sparkline/dist/jquery.sparkline.min.js" type="text/javascript"></script>
		<!-- jQuery Knob Chart -->
		<script src="../plugins/knob/jquery.knob.js"></script>
        <!-- CK Editor -->
        <script src="../plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
		<!-- lightbox -->
		<script src="../plugins/lightbox/ekko-lightbox.min.js"></script>
		<!-- fullCalendar 2.2.5 -->
		<script src="../plugins/fullcalendar/moment.js" type="text/javascript"></script>
		<script src="../plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
		<!-- autocomplate -->
	    <script src="../plugins/autocomplate/bootstrap3-typeahead.js" type="text/javascript"></script>
		<!-- bootstrap-toggle -->
	    <script src="../plugins/bootstrap-toggle/js/bootstrap-toggle.min.js" type="text/javascript"></scrip
		<!-- Material Design -->
		<script src="../dist/js/material.min.js"></script>
		<script src="../dist/js/ripples.min.js"></script>
		<script>
			$.material.init();
		</script>
		<!-- AdminLTE App 
		<script src="../dist/js/adminlte.min.js"></script>-->
        <!-- AdminLTE App -->
        <script src="../dist/js/app.js" type="text/javascript"></script>

        <script type="text/javascript">
        $(document).ready(function() {	

			$(".alert").delay(5000).slideUp(200, function() {
				$(this).alert('close');
			});


			$(".btn-pref .btn").click(function () {
				$(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
				// $(".tab").addClass("active"); // instead of this do the below 
				$(this).removeClass("btn-default").addClass("btn-primary");   
			});

		});
		</script>

</body>
</html>