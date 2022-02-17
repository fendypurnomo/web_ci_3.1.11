<div class="row">
	<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		<h3>Treeview<h3>
		<h5>Daftar Pulau di Indonesia</h5>
		<div id="treeview"></div>
	</div>
</div>

<script>
	var defaultData = [
		<?php
			$query_pulau = $this->treeview_model->pulauGetAll();

			foreach ($query_pulau as $key_pulau => $value_pulau)
			{
				$query_provinsi = $this->treeview_model->provinsiGetByPulau_id($value_pulau['pulau_id']);
				echo "
				{
					text: '$value_pulau[pulau_nama]',
					tags: ['".count($query_provinsi)."'],
					href: '#$value_pulau[pulau_id]',
					nodes: [";

						foreach ($query_provinsi as $key_provinsi => $value_provinsi)
						{
							$query_kabupaten_kota = $this->treeview_model->kabupatenKotaGetByProvinsi_id($value_provinsi['pulau_id'],$value_provinsi['provinsi_id']);
							echo "
							{
								text: '$value_provinsi[provinsi_nama]',
								tags: ['".count($query_kabupaten_kota)."'],
								nodes: [";

									foreach ($query_kabupaten_kota as $key_kabupaten_kota => $value_kabupaten_kota)
									{
										$query_kecamatan = $this->treeview_model->kecamatanGetByKabupatenKota_id($value_kabupaten_kota['pulau_id'],$value_kabupaten_kota['provinsi_id'],$value_kabupaten_kota['kabupaten_kota_id']);
										echo "
										{
											text: '$value_kabupaten_kota[kabupaten_kota_nama]',
											tags: ['".count($query_kecamatan)."'],
											nodes: [";

												foreach ($query_kecamatan as $key_kecamatan => $value_kecamatan)
												{
													$query_kelurahan_desa = $this->treeview_model->kelurahanDesaGetByKecamatan_id($value_kecamatan['pulau_id'],$value_kecamatan['provinsi_id'],$value_kecamatan['kabupaten_kota_id'],$value_kecamatan['kecamatan_id']);
													echo "
													{
														text: '$value_kecamatan[kecamatan_nama]',
														tags: ['".count($query_kelurahan_desa)."'],
														nodes: [";

															foreach ($query_kelurahan_desa as $key_kelurahan_desa => $value_kelurahan_desa)
															{
																echo "{text: '$value_kelurahan_desa[kelurahan_desa_nama]'},";
															}
															echo "
														]
													},";
												}
												echo "
											]
										},";
									}
									echo "
								]
							},";
						}
						echo "
					]
				},";
			}
		?>
	];

	$('#treeview').treeview({
		levels: 1,
		showTags: true,
		enableLinks: true,
		data: defaultData
	});
</script>
