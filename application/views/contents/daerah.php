<style>
	#map-canvas {width:100%; height:400px; border:1px solid #999;}
	select {width:240px;}
	#kab_box, #kec_box, #kel_box, #lat_box, #lng_box {display:none;}
</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<table>
	<tr>
		<td>Pilih Provinsi</td>
		<td>:
			<select name="provinsi" id="provinsi" onchange="pilih_kabupaten(this.value)">
				<option value="">Pilih Provinsi</option>
				<?php
					foreach($provinsi as $data){
						echo "<option value=".$data->wilayah_provinsi_id.">".$data->wilayah_provinsi_nama."</option>";
					}
				?>
			</select>
		</td>
	</tr>
	<tr id="kab_box">
		<td>Pilih Kabupaten/Kota</td>
		<td>:
			<select name="kota" id="kota" onchange="pilih_kecamatan(this.value)">
				<option value="">Pilih Kabupaten/Kota</option>
			</select>
		</td>
	</tr>
	<tr id="kec_box">
		<td>Pilih Kecamatan</td>
		<td>:
			<select name="kecamatan" id="kecamatan" onchange="pilih_kelurahan(this.value)">
				<option value="">Pilih Kecamatan</option>
			</select>
		</td>
	</tr>
	<tr id="kel_box">
		<td>Pilih Kelurahan/Desa</td>
		<td>:
			<select name="kelurahan" id="kelurahan" onchange="showCoordinate();">
				<option value="">Pilih Kelurahan/Desa</option>
			</select>
		</td>
	</tr>
	<tr id="lat_box">
		<td>Latitude</td>
		<td><input type="text" id="lat" readonly></td>
	</tr>
	<tr id="lng_box">
		<td>Longitude</td>
		<td><input type="text" id="lng" readonly></td>
	</tr>
</table>

<div id="map-canvas"></div>

<script>
	var ajaxdaerah = buatajax();

	function pilih_kabupaten(id) {
		var url = "daerah/getKabupaten/" + id + "/" + Math.random();
		ajaxdaerah.onreadystatechange = stateChanged;
		ajaxdaerah.open("GET", url, true);
		ajaxdaerah.send(null);
	}

	function pilih_kecamatan(id) {
		var url = "daerah/getKecamatan/" + id + "/" + Math.random();
		ajaxdaerah.onreadystatechange = stateChangedKecamatan;
		ajaxdaerah.open("GET", url, true);
		ajaxdaerah.send(null);
	}

	function pilih_kelurahan(id) {
		var url = "daerah/getKelurahan/" + id + "/" + Math.random();
		ajaxdaerah.onreadystatechange = stateChangedKelurahan;
		ajaxdaerah.open("GET", url, true);
		ajaxdaerah.send(null);
	}

	function buatajax() {
		if (window.XMLHttpRequest) {
			return new XMLHttpRequest();
		}
		if (window.ActiveXObject) {
			return new ActiveXObject("Microsoft.XMLHTTP");
		}
		return null;
	}

	function stateChanged() {
		var data;
		if (ajaxdaerah.readyState == 4) {
			data = ajaxdaerah.responseText;
			if (data.length >= 0) {
				document.getElementById("kota").innerHTML = data
			} else {
				document.getElementById("kota").value = "<option selected>Pilih Kabupaten/Kota</option>";
			}
			document.getElementById("kab_box").style.display = 'table-row';
			document.getElementById("kec_box").style.display = 'none';
			document.getElementById("kel_box").style.display = 'none';
			document.getElementById("lat_box").style.display = 'none';
			document.getElementById("lng_box").style.display = 'none';
		}
	}

	function stateChangedKecamatan() {
		var data;
		if (ajaxdaerah.readyState == 4){
			data = ajaxdaerah.responseText;
			if (data.length >= 0) {
				document.getElementById("kecamatan").innerHTML = data
			} else {
				document.getElementById("kecamatan").value = "<option selected>Pilih Kecamatan</option>";
			}
			document.getElementById("kec_box").style.display = 'table-row';
			document.getElementById("kel_box").style.display = 'none';
			document.getElementById("lat_box").style.display = 'none';
			document.getElementById("lng_box").style.display = 'none';
		}
	}

	function stateChangedKelurahan() {
		var data;
		if (ajaxdaerah.readyState == 4){
			data = ajaxdaerah.responseText;
			if (data.length >= 0) {
				document.getElementById("kelurahan").innerHTML = data
			} else {
				document.getElementById("kelurahan").value = "<option selected>Pilih Kelurahan/Desa</option>";
			}
			document.getElementById("kel_box").style.display = 'table-row';
			document.getElementById("lat_box").style.display = 'none';
			document.getElementById("lng_box").style.display = 'none';
		}
	}

	var map;
	var geocoder;
	var marker;
	var markersArray = [];

	function initialize() {
		geocoder = new google.maps.Geocoder();
		var myLatlng = new google.maps.LatLng(-6.176655999999999, 106.83058389999997);
		var mapOptions = {
			center: myLatlng,
			zoom: 14
		};
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: 'Jakarta'
		});
		markersArray.push(marker);
		google.maps.event.addListener(marker, "click", function(){});
	}

	function clearOverlays() {
		for (var i = 0; i < markersArray.length; i++) {
			markersArray[i].setMap(null);
		}
		markersArray.length = 0;
	}

	function showCoordinate() {
		var provinsi = document.getElementById("provinsi");
		var kabupaten = document.getElementById("kota");
		var kecamatan = document.getElementById("kecamatan");
		var kelurahan = document.getElementById("kelurahan");
		var s = kelurahan.options[kelurahan.selectedIndex].text + ', ' + kecamatan.options[kecamatan.selectedIndex].text;
				s2 = s + ', ' + kabupaten.options[kabupaten.selectedIndex].text + ', ' + provinsi.options[provinsi.selectedIndex].text;
		geocoder.geocode({'address': s}, function(results, status) {
			document.getElementById("lat_box").style.display = 'table-row';
			document.getElementById("lng_box").style.display = 'table-row';
			if (status == google.maps.GeocoderStatus.OK) {
				clearOverlays();
				var position = results[0].geometry.location;
				document.getElementById("lat").value = position.lat();
				document.getElementById("lng").value = position.lng();
				map.setCenter(results[0].geometry.location);
				marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: s2
				});
				markersArray.push(marker);
				google.maps.event.addListener(marker, "click", function(){});
			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<!--

Daerah
======
[versi yang sudah sesuai dengan permendagri No 137 tahun 2017 ada di https://github.com/cahyadsn/wilayah]

Menampilkan data provinsi, kabupaten/kota, kecamatan dan kelurahan/desa menggunakan AjAX
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/cahyadsn/daerah.svg)](https://github.com/cahyadsn/daerah/issues)
[![GitHub forks](https://img.shields.io/github/forks/cahyadsn/daerah.svg)](https://github.com/cahyadsn/daerah/network)
[![GitHub stars](https://img.shields.io/github/stars/cahyadsn/daerah.svg)](https://github.com/cahyadsn/daerah/stargazers)

Database daerah sesuai Permendagri no 39 tahun 2015

|-----------------------------------------------------------------------|
| id_prov | nama                      | kab  | kota | kec | kel  | desa |
|---------|---------------------------|------|------|-----|------|------|
| 11      | Aceh                      |   18 |    5 | 289 |    0 | 6474 |
| 12      | Sumatera Utara            |   25 |    8 | 436 |  691 | 5389 |
| 13      | Sumatera Barat            |   12 |    7 | 179 |  259 |  880 |
| 14      | Riau                      |   10 |    2 | 163 |  243 | 1592 |
| 15      | Jambi                     |    9 |    2 | 138 |  163 | 1398 |
| 16      | Sumatera Selatan          |   13 |    4 | 231 |  377 | 2817 |
| 17      | Bengkulu                  |    9 |    1 | 126 |  172 | 1341 |
| 18      | Lampung                   |   13 |    2 | 225 |  205 | 2435 |
| 19      | Kepulauan Bangka Belitung |    6 |    1 |  47 |   78 |  309 |
| 21      | Kepulauan Riau            |    5 |    2 |  66 |  141 |  275 |
| 31      | DKI Jakarta               |    1 |    5 |  44 |  267 |    0 |
| 32      | Jawa Barat                |   18 |    9 | 626 |  641 | 5319 |
| 33      | Jawa Tengah               |   29 |    6 | 573 |  750 | 7809 |
| 34      | DI Yogyakarta             |    4 |    1 |  78 |   46 |  392 |
| 35      | Jawa Timur                |   29 |    9 | 664 |  776 | 7723 |
| 36      | Banten                    |    4 |    4 | 155 |  313 | 1238 |
| 51      | Bali                      |    8 |    1 |  57 |   80 |  636 |
| 52      | Nusa Tenggara Barat       |    8 |    2 | 116 |  142 |  995 |
| 53      | Nusa Tenggara Timur       |   21 |    1 | 306 |  318 | 2950 |
| 61      | Kalimantan Barat          |   12 |    2 | 174 |   89 | 1908 |
| 62      | Kalimantan Tengah         |   13 |    1 | 136 |  138 | 1434 |
| 63      | Kalimantan Selatan        |   11 |    2 | 152 |  143 | 1864 |
| 64      | Kalimantan Timur          |    7 |    3 | 103 |  196 |  833 |
| 65      | Kalimantan Utara          |    4 |    1 |  50 |   35 |  447 |
| 71      | Sulawesi Utara            |   11 |    4 | 167 |  332 | 1490 |
| 72      | Sulawesi Tengah           |   12 |    1 | 174 |  168 | 1839 |
| 73      | Sulawesi Selatan          |   21 |    3 | 306 |  785 | 2253 |
| 74      | Sulawesi Tenggara         |   15 |    2 | 209 |  377 | 1820 |
| 75      | Gorontalo                 |    5 |    1 |  77 |   72 |  657 |
| 76      | Sulawesi Barat            |    6 |    0 |  69 |   71 |  576 |
| 81      | Maluku                    |    9 |    2 | 118 |   33 | 1191 |
| 82      | Maluku Utara              |    8 |    2 | 113 |  117 | 1063 |
| 91      | Papua Barat               |   28 |    1 | 524 |  107 | 5118 |
| 92      | Papua                     |   12 |    1 | 203 |   87 | 1628 |
|-----------------------------------------------------------------------|
|         | TOTAL                     |  416 |   98 |7094 | 8412 |74093 |
|-----------------------------------------------------------------------|

link demo bisa dilihat [di sini]
- http://cahyadsn.dev.php.or.id/extra/daerah
- http://cahyadsn.dev.php.or.id/daerah
- http://phpindonesia.id1945.com/daerah

penambahan versi codeigniter memakai codeigniter 3.0 

## UPDATE
Perubahan data sesuai permendagri no 56 tahun 2015 (versi yang sudah sesuai dengan permendagri No 56 tahun 2015 ada di https://github.com/cahyadsn/wilayah)

|-----------------------------------------------------------------------|
| id_prov | nama                      | kab  | kota | kec | kel  | desa |
|---------|---------------------------|------|------|-----|------|------|
| 11      | Aceh                      |   18 |    5 | 289 |    0 | 6474 |
| 12      | Sumatera Utara            |   25 |    8 | 436 |  692 | 5418 |
| 13      | Sumatera Barat            |   12 |    7 | 179 |  245 |  880 |
| 14      | Riau                      |   10 |    2 | 163 |  243 | 1592 |
| 15      | Jambi                     |    9 |    2 | 141 |  163 | 1399 |
| 16      | Sumatera Selatan          |   13 |    4 | 231 |  377 | 2859 |
| 17      | Bengkulu                  |    9 |    1 | 128 |  172 | 1341 |
| 18      | Lampung                   |   13 |    2 | 227 |  205 | 2435 |
| 19      | Kepulauan Bangka Belitung |    6 |    1 |  47 |   78 |  309 |
| 21      | Kepulauan Riau            |    5 |    2 |  70 |  141 |  275 |
| 31      | DKI Jakarta               |    1 |    5 |  44 |  267 |    0 |
| 32      | Jawa Barat                |   18 |    9 | 626 |  643 | 5319 |
| 33      | Jawa Tengah               |   29 |    6 | 573 |  750 | 7809 |
| 34      | DI Yogyakarta             |    4 |    1 |  78 |   46 |  392 |
| 35      | Jawa Timur                |   29 |    9 | 664 |  777 | 7724 |
| 36      | Banten                    |    4 |    4 | 155 |  313 | 1238 |
| 51      | Bali                      |    8 |    1 |  57 |   80 |  636 |
| 52      | Nusa Tenggara Barat       |    8 |    2 | 116 |  142 |  995 |
| 53      | Nusa Tenggara Timur       |   21 |    1 | 306 |  318 | 2995 |
| 61      | Kalimantan Barat          |   12 |    2 | 174 |   99 | 1977 |
| 62      | Kalimantan Tengah         |   13 |    1 | 136 |  138 | 1434 |
| 63      | Kalimantan Selatan        |   11 |    2 | 152 |  143 | 1866 |
| 64      | Kalimantan Timur          |    7 |    3 | 103 |  196 |  836 |
| 65      | Kalimantan Utara          |    4 |    1 |  50 |   35 |  447 |
| 71      | Sulawesi Utara            |   11 |    4 | 167 |  332 | 1505 |
| 72      | Sulawesi Tengah           |   12 |    1 | 175 |  175 | 1842 |
| 73      | Sulawesi Selatan          |   21 |    3 | 306 |  785 | 2253 |
| 74      | Sulawesi Tenggara         |   15 |    2 | 212 |  377 | 1846 |
| 75      | Gorontalo                 |    5 |    1 |  77 |   72 |  657 |
| 76      | Sulawesi Barat            |    6 |    0 |  69 |   71 |  576 |
| 81      | Maluku                    |    9 |    2 | 118 |   33 | 1198 |
| 82      | Maluku Utara              |    8 |    2 | 115 |  117 | 1064 |
| 91      | Papua                     |   28 |    1 | 558 |  110 | 5419 |
| 92      | Papua Barat               |   12 |    1 | 218 |   95 | 1744 |
|-----------------------------------------------------------------------|
|         | TOTAL                     |  416 |   98 |7160 | 8430 |74754 |
|-----------------------------------------------------------------------|

todo : perubahan data sesuai permendagri no 137 tahun 2017 (in progress)

|-----------------------------------------------------------------------|
| id_prov | nama                      | kab  | kota | kec | kel  | desa |
|---------|---------------------------|-----:|-----:|-----|-----:|-----:|
| 11      | Aceh                      |   18 |    5 | 289 |    0 | 6496 |
| 12      | Sumatera Utara            |   25 |    8 | 444 |  693 | 5417 |
| 13      | Sumatera Barat            |   12 |    7 | 179 |  230 |  928 |
| 14      | Riau                      |   10 |    2 | 166 |  268 | 1591 |
| 15      | Jambi*                    |    9 |    2 | 141 |  163 | 1399 |
| 16      | Sumatera Selatan          |   13 |    4 | 236 |  386 | 2853 |
| 17      | Bengkulu*                 |    9 |    1 | 128 |  172 | 1341 |
| 18      | Lampung                   |   13 |    2 | 228 |  205 | 2435 |
| 19      | Kepulauan Bangka Belitung |    6 |    1 |  47 |   82 |  309 |
| 21      | Kepulauan Riau*           |    5 |    2 |  70 |  141 |  275 |
| 31      | DKI Jakarta*              |    1 |    5 |  44 |  267 |    0 |
| 32      | Jawa Barat                |   18 |    9 | 627 |  645 | 5312 |
| 33      | Jawa Tengah*              |   29 |    6 | 573 |  750 | 7809 |
| 34      | DI Yogyakarta*            |    4 |    1 |  78 |   46 |  392 |
| 35      | Jawa Timur                |   29 |    9 | 666 |  777 | 7724 |
| 36      | Banten*                   |    4 |    4 | 155 |  313 | 1238 |
| 51      | Bali*                     |    8 |    1 |  57 |   80 |  636 |
| 52      | Nusa Tenggara Barat*      |    8 |    2 | 116 |  142 |  995 |
| 53      | Nusa Tenggara Timur       |   21 |    1 | 309 |  327 | 3026 |
| 61      | Kalimantan Barat          |   12 |    2 | 174 |   99 | 2031 |
| 62      | Kalimantan Tengah         |   13 |    1 | 136 |  139 | 1432 |
| 63      | Kalimantan Selatan        |   11 |    2 | 153 |  144 | 1864 |
| 64      | Kalimantan Timur          |    7 |    3 | 103 |  197 |  841 |
| 65      | Kalimantan Utara          |    4 |    1 |  53 |   35 |  447 |
| 71      | Sulawesi Utara            |   11 |    4 | 171 |  332 | 1507 |
| 72      | Sulawesi Tengah*          |   12 |    1 | 175 |  175 | 1842 |
| 73      | Sulawesi Selatan          |   21 |    3 | 307 |  792 | 2255 |
| 74      | Sulawesi Tenggara         |   15 |    2 | 219 |  377 | 1915 |
| 75      | Gorontalo*                |    5 |    1 |  77 |   72 |  657 |
| 76      | Sulawesi Barat            |    6 |    0 |  69 |   73 |  575 |
| 81      | Maluku                    |    9 |    2 | 118 |   35 | 1198 |
| 82      | Maluku Utara              |    8 |    2 | 115 |  117 | 1063 |
| 91      | Papua                     |   28 |    1 | 560 |  110 | 5411 |
| 92      | Papua Barat               |   12 |    1 | 218 |  106 | 1742 |
|-----------------------------------------------------------------------|
|         | TOTAL                     |  416 |   98 |7201 | 8490 |74957 |
|-----------------------------------------------------------------------|

(* data tetap/tidak berubah

## DONASI
untuk donasi via [paypal], atau bca 1451332193

[paypal]: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=K6YRM43CZ44UQ
[di sini]: http://cahyadsn.dev.php.or.id/extra/daerah/

-->
