<?php

namespace App\Traits;

trait ClinicAttribute{
	public function getActionsAttribute(){
		$id = $this->id;
		$action = "";

		// $action .= 	"<a class='btn btn-success' data-toggle='tooltip' title='View' onClick='view($id)'>" .
		// 		        "<i class='fas fa-search'></i>" .
		// 		    "</a>&nbsp;";

		if($this->status){
			$action .= 	"<a class='btn btn-danger' data-toggle='tooltip' title='Deactivate' onClick='updateStatus($id, 0)'>" .
					        "<i class='fas fa-circle-xmark'></i>" .
					    "</a>&nbsp;";
		}
		else{
			$action .= 	"<a class='btn btn-success' data-toggle='tooltip' title='Activate' onClick='updateStatus($id, 1)'>" .
					        "<i class='fas fa-circle-check'></i>" .
					    "</a>&nbsp;";
		}

		return $action;
	}
}