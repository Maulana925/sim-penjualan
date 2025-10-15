function plgn(){
	plh = $('#kategori').val();
	if(plh=="Pelanggan"){
		$('#id_plgn').show("slow");
		$('#nm_plgn').show("slow");
		$('#id_pelanggan').show("slow");
		$('#nama_pelanggan').show("slow");
	}else if(plh=="--Pilih--"){
		$('#id_plgn').show("slow");
		$('#nm_plgn').show("slow");
		$('#id_pelanggan').show("slow");
		$('#nama_pelanggan').show("slow");
	}else{
		$('#id_plgn').hide("slow");
		$('#nm_plgn').hide("slow");
		$('#id_pelanggan').hide("slow");
		$('#nama_pelanggan').hide("slow");
	}
}


// Pelanggan Otomatis
function idp(){

	$.ajax({
		url:"content/cari_plg.php",
		type:"POST",
		dataType:"json",
		data:{
			id_pelanggan:$('#id_pelanggan').val()
		},
		success:function(hasil){
			if(!hasil || hasil.id_pelanggan === ""){
				$('#nama_pelanggan').val("");
				return;
			}
			$('#nama_pelanggan').val(hasil.nama_pelanggan);
		}

	});
}

// Barang Otomatis
function idb(){
	$.ajax({
		url:"content/cari_brg.php",
		type:"POST",
		dataType:"json",
		data:{
			id_barang:$('#id_barang').val()
		},
		success:function(hasil){
			if(!hasil || hasil.id_barang === ""){
				$('#nama_barang').val("");
				$('#harga').val("");
				$('#total').val("");
				return;
			}
			$('#nama_barang').val(hasil.nama_barang);
			$('#harga').val(hasil.harga);
			t();
		}

	});
}



function hapus_detail(h){

	$.ajax({
		url:"crud/hapus_detail.php",
		type:"POST",
		dataType:"json",
		data:{
			id_detail_transaksi:h
		},
		success:function(res){
			if(window.AppToast){
				AppToast.show({
					message: res && res.message ? res.message : "Detail transaksi berhasil dihapus.",
					type: res && res.success ? "success" : "error"
				});
			}
			if(res && res.success){
				buka_tab();
			}
		},
		error:function(xhr){
			var msg = "Gagal menghapus data. Silakan coba lagi.";
			if(xhr.responseJSON && xhr.responseJSON.message){
				msg = xhr.responseJSON.message;
			}
			if(window.AppToast){
				AppToast.show({
					message: msg,
					type: "error"
				});
			}
		}

	});
}


// Total
function t(){
	hrg = $('#harga').val();
	jml = $('#jumlah').val();
	if(hrg === "" || jml === ""){
		$('#total').val("");
		return;
	}
	tot = hrg * jml;
	$('#total').val(tot);
}


// Simpan Detail
function simpan_detail(){
	if($('#id_barang').val() === "" || $('#jumlah').val() === "" || $('#total').val() === ""){
		if(window.AppToast){
			AppToast.show({
				message: "Lengkapi data barang dan jumlah terlebih dahulu.",
				type: "error"
			});
		}
		return;
	}
	$.ajax({
		url:"crud/simpan_detail.php",
		type:"POST",
		dataType:"json",
		data:{
			id_transaksi:$('#id_transaksi').val(),
			id_barang:$('#id_barang').val(),
			jumlah_beli:$('#jumlah').val(),
			total:$('#total').val()
		},
		success:function(res){
			var msg = res && res.message ? res.message : "Detail transaksi berhasil disimpan.";
			var type = res && res.success ? "success" : "error";

			if(window.AppToast){
				AppToast.show({
					message: msg,
					type: type
				});
			}

			if(res && res.success){
				buka_tab();
				$('#id_barang').val("");
				$('#nama_barang').val("");
				$('#harga').val("");
				$('#jumlah').val("");
				$('#total').val("");
				$('#id_barang').focus();
			}
		},
		error:function(xhr){
			var msg = "Gagal menyimpan detail transaksi. Silakan coba lagi.";
			if(xhr.responseJSON && xhr.responseJSON.message){
				msg = xhr.responseJSON.message;
			}
			if(window.AppToast){
				AppToast.show({
					message: msg,
					type: "error"
				});
			}
		}

	});
}


function buka_tab(){
	id = $('#id_transaksi').val();
	$('#kotak-detail').load('content/detail_trans.php?idt='+id);

}


function byr(){
	b = $('#bayar').val();
	tb = $('#totalbayar').val();
	rsl = b-tb;
	$('#kembali').val(rsl);
}
$(document).ready(function(){
	$('#lpr1').hide();
	$('#lpr2').hide();
	$('#lpr3').hide();
	$('#lpr').click(function(){
		$('#lpr1').slideToggle("slow");
		$('#lpr2').slideToggle("slow");
		$('#lpr3').slideToggle("slow");
	});
});
