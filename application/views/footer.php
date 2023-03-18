<script src="<?=base_url()?>assets/js/dragscroll.js"></script>
<script src="<?=base_url()?>assets/lib/superfish/superfish.min.js"></script>
<script src="<?=base_url()?>assets/lib/wow/wow.min.js"></script>
<script src="<?=base_url()?>register.js"></script>
<script src="<?=base_url()?>assets/lib/superfish/hoverIntent.js"></script>
<script type="text/javascript">
	function includeJs(jsFilePath,fn=null){
		var js = document.createElement("script");
			js.type = "text/javascript";
			js.src = jsFilePath;
			document.body.appendChild(js);
			if(fn!=null)fn();
	}
	$(document).ready(function(){
		let request_header = $.ajax({
			type: 'POST',
			url: '<?=base_url()?>api_v2/get_all_header_template/',
			data : {tipe_ajax:btoa(0)},
			dataType: 'json'
		});
		request_header.done(function(result){
			let all_render="";
			if(result.length>0){
				let sort_page=result.sort(function(b,a){return a.id_page-b.id_page});
				for (var i=sort_page.length-1;i>=0;i--){
					if(sort_page[i].sts_page==1){
						if(sort_page[i].sub_page.length>0){
							if(sort_page[i].desc_order==1){
								var sort_sub_page=sort_page[i].sub_page.sort(function(a,b){return a.id_sub_page-b.id_sub_page});
							}else{
								var sort_sub_page=sort_page[i].sub_page.sort(function(b,a){return a.id_sub_page-b.id_sub_page});
							}
							all_render+='<li class="menu-has-children"><a href="#">'+sort_page[i].nama_header+'</a><ul>';
							for (var x=sort_sub_page.length-1;x>=0;x--){
								all_render+='<li><a href="'+encodeURI(sort_sub_page[x].url_sub)+'">'+sort_sub_page[x].name_sub+'</a></li>';
							}
							all_render+='</ul></li>';
						}
					}else{
						all_render+='<li><a href="'+encodeURI(sort_page[i].url_page)+'">'+sort_page[i].nama_header+'</a></li>';
					}
				}
			}
			$('#site-page').html(all_render).show();
		},()=>{
			includeJs("<?=base_url()?>assets/js/main.js",()=>{
				$("#popup_loading").hide();
			});
		});

		let request_footer = $.ajax({
			type: 'POST',
			url: '<?=base_url()?>api_v2/get_footer/',
			data : {tipe_ajax:btoa(0)},
			dataType: 'json'
		});
		request_footer.done(function(result_footer){
			let copyright="-";
			let footer_top="";
			let footer_bottom="<br>";
			let ket_footer_bottom="";
			if(result_footer.length>0){
				let sort_page_footer=result_footer.sort(function(b,a){return a.id_sns-b.id_sns});
				for (var i=sort_page_footer.length-1;i>=0;i--){
					if(sort_page_footer[i].status_sns==2){
						footer_top += '<h3 style="color:#fff">UNDUH BERITA</h3><p style="color:#fff">Dapatkan file berita terbaru dari '+sort_page_footer[i].name_sns+'.</p><div class="row"><a style="margin-left:15px;" href="'+encodeURI(sort_page_footer[i].url_sns)+'" class="btn-border default"><i class="fa fa-cloud-download"></i> UNDUH</a></div>';
						copyright = sort_page_footer[i].name_sns;
						ket_footer_bottom = sort_page_footer[i].keterangan;
					}else{
						footer_bottom +='<a href="'+encodeURI(sort_page_footer[i].url_sns)+'" target="_blank" class="'+sort_page_footer[i].class_sns+'"><i class="fa fa-'+sort_page_footer[i].class_sns+'"></i></a>';
					}
				}
				$('#data_footer').html(footer_top).show();
				$('#data_sns').html(footer_bottom).show();
				$('#data_name_footer').text(copyright);
				$('#ket_footer_bottom').html(ket_footer_bottom);
			}
		});
	});
</script>
</body>
<footer id="footer">
    <div class="footer-top">
		<div class="container" id="data_footer" style="display: none;"></div>
    </div>

    <div class="container">
        <div class="social-links text-center" id="data_sns" style="display: none;"></div>
		<div class="copyright">
	    	<div id="ket_footer_bottom"></div>
			&copy; Copyright <strong id="data_name_footer"></strong>
		</div>
    </div>
</footer>

<div id="btn_chat" class="floating-btn bubble_pop"></div>
<div class="floating-contentainer-chat">
	<div id="content_chat">
		<div id="list_chat_sales">
			<div class="floating-content-header">
				Kontak Kami
				<button id="minimize" class="btn btn-sm" style="float: right; color:#fff;"><i class="fa fa-minus"></i></button>
			</div>
			<input type="text" autocomplete="off" id="cari_sales" class="form-control carisales_x" placeholder="Cari / Ketik disini..." />
			<div id="results" class="content-list-chat vertical dragscroll scrollbar style-1"></div>
		</div>
		<div id="private_chat"></div>
	</div>
</div>
<script language="JavaScript">
	function you_can_do_this(filter,xxx){
		count = 0;
		if($('#'+xxx).length>0){
			$('#'+xxx+' div').each(function() {
				if ($(this).text().search(new RegExp(filter, "i")) < 0) {
					$(this).hide();
				}else{
					$(this).show();
					count++;
				}
			});
		}
	}
	$("#cari_sales").keyup(function() {
		var xfilter=$(this).val();
		you_can_do_this(xfilter,'results');
	});
	$("#btn_chat").click(function(){
		$('#btn_chat,#footer::after').hide();
		$(".floating-contentainer-chat").show();
		list_chat();
	});
	function list_chat(){
		$('#list_chat_sales #results').html('')
		$('[xdatelist]').remove()
		$.ajax({
			url: "<?=base_url('api_v2/get_sales_online');?>",
			method: "POST",
			dataType:"JSON",
			beforeSend: function (){
				$('#popup_loading').show();
				$("#cari_sales").val('');
			}, success: function (result){
				if(result.length>0){
					let render_list_cht='';
					let xsort_data_ms=result.sort(function(b, a){return a.sort - b.sort});
					for (var i=xsort_data_ms.length-1;i>=0;i--){
						render_list_cht+=
							`<a href='`+xsort_data_ms[i].online+`' target="_blank">
								<div class="list-chat">
									<img class="profile" src='`+xsort_data_ms[i].foto+`' /> 
									<div class="list-chat-title">
										<b> <i class="fa fa-circle" 
												aria-hidden="true" 
												style="color:`+xsort_data_ms[i].css_on+`">
											</i> `+xsort_data_ms[i].nama_sales+`
										</b>
									</div>
								</div>
							</a>`;
					}
					$(".content-list-chat").html(render_list_cht);
					$('#btn_chat').hide();
				}
				$('#popup_loading').hide();	
			}, error: function (){
				if(('Jaringan gagal!\nIngin mencoba kembali?')){
					list_chat()
				}else{
					$("#btn_chat").show();
					$('#popup_loading').hide();
				}
			}
		});
	}

	$("#minimize").click(function(){
		$(".floating-contentainer-chat").hide();
		$('#btn_chat').show();
	});

	function auto_resize_text(){
		var layar = $(window).width();
		if(layar<=340){
			var karakter = 18;
		}else if(layar<=575){
			var karakter = 28;
		}else if(layar<=765){
			var karakter = 15;
		}else if(layar<=800){
			var karakter = 14;
		}else if(layar<=900){
			var karakter = 18;
		}else if(layar<=1000){
			var karakter = 14;
		}else{
			var karakter = 15;
		}

		$('.resize_font').html(function(i, oldtext) {
			if(oldtext.length > karakter){
				var res = oldtext.substring(0, karakter);
				return oldtext.replace(oldtext, res+'...');
			}
		});
	}

	$(window).resize(function() {
		auto_resize_text();
	});
</script>
</html>