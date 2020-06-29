<?php 
namespace App\Controllers;
// use App\Models\general_manager;

class Home extends BaseController
{
	public function index()
	{
		$data['a'] = "HAHAHAHA";
		return view('welcome_message', $data);
	}

	public function landing(){
		// session()->set('item', 'some_value');
		// echo session('item');
		$gm = model('general_manager');
		dd($gm->join('direktur', 'direktur.id_direktur = general_manager.id_direktur')->first());
		echo "INI LANDING LOH";
	}

	//--------------------------------------------------------------------

}
