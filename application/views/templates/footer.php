<script src="<?php echo base_url(); ?>assets/admin_assets/bundles/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/bundles/libscripts.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/newjscss/datatable.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/tables/jquery-datatable.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/newjscss/jquery.doubleScroll.js"></script> 
<script src="<?php echo base_url(); ?>assets/newjscss/dragscroll.js"></script> 
<script src="<?php echo base_url(); ?>assets/newjscss/dtatable-btn.js"></script> 
<script src="<?php echo base_url(); ?>assets/newjscss/pdfmake.js"></script> 
<script src="<?php echo base_url(); ?>assets/newjscss/html-exprtdtatable.js"></script> 
<script src="<?php echo base_url(); ?>assets/newjscss/moment.js"></script> 
<script src="<?php echo base_url(); ?>assets/newjscss/daterangepicker.js"></script> 
<script type="text/javascript" src="<?php echo base_url().'assets/select/choosen.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/admin_assets/jquery-datatable/dataTables.rowsGroup.js'?>"></script>
<script> 
	$.fn.serializeObject=function(){var e={},i=this.serializeArray();return $.each(i,function(){e[this.name]?(e[this.name].push||(e[this.name]=[e[this.name]]),e[this.name].push(this.value||"")):e[this.name]=this.value||""}),e};
function ldg(){$('#popup_loading').show()}
var show_parent=(contex)=>{
	if(contex.prop("tagName")!="BODY"){
		var parent=contex.parent();
		if(parent.attr('id')!='main-menu'){
			if(parent.prop("tagName")=='UL')parent.addClass('in');
			if(parent.prop("tagName")=='LI')parent.addClass('active');
			show_parent(parent)
		}
	}
}
$(document).ready(function(){   
	$('.table-responsive').doubleScroll({resetOnWindowResize: true});
	window.setTimeout(function(){ $(".alert").hide();},30000);
	$('#loading_data').hide();
	var spl=location.href.replace("<?=base_url()?>","").split("/");
	var contex=$('[href="<?=base_url()?>'+spl[0]+(typeof spl[1]!=='undefined'?'/'+spl[1].replace("edit_",""):'')+'"]');
	if(contex.length>0)show_parent(contex);
	$('li').click(function(e){
		e.stopPropagation();
		var contex=$(this);
		if(!contex.hasClass('active')){
			$('#main-menu ul').removeClass('in');
			$('#main-menu li').removeClass('active');
			contex.addClass('active');
			contex.find('ul').eq(0).addClass('in');
		}else{		
			$('#main-menu ul').removeClass('in');
			$('#main-menu li').removeClass('active');
		}
		show_parent(contex)
	});
	$('.left_block').click(function(e){
		if(!$('body').hasClass('show_sidebar')&&$(document).width()<=800) $('body').addClass('show_sidebar');
		else $('body').removeClass('show_sidebar');
	});
});
function export_kadal(e, dt, button, config) { //export excel server side
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        data.start = 0;
        data.length = -1;
        //data.search['value']=''; //kalo mau export all data
        dt.one('preDraw', function (e, settings) {
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            setTimeout(dt.ajax.reload, 0);
            return false;
    	});
    });
    dt.ajax.reload();
};
</script>
</body>

</html>