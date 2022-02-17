<?php

	foreach ($query as $row)
	{
		if (!isset($info[$row->prov_id]))
		{
			$info[$row->prov_id] = [
				'prov_id' => $row->prov_id,
				'prov_nama' => $row->prov_nama,
				'kab' => []
			];
		}

		$info[$row->prov_id]['kab'][] = [
			'kab_id' => $row->kab_id,
			'kab_nama' => $row->kab_nama
		];
	}

	$data = array_values($info);
	echo json_encode($data);
