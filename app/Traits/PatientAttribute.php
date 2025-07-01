<?php

namespace App\Traits;

trait PatientAttribute{
	public function getActionsAttribute(){
		$uid = $this->user->id;
		$action = "";

		$action .= 	"<a class='btn btn-success btn-sm' data-toggle='tooltip' title='View' onClick='view($uid)'>" .
				        "<i class='fas fa-search'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-info btn-sm' data-toggle='tooltip' title='Edit' onClick='edit($uid)'>" .
				        "<i class='fas fa-pencil'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-primary btn-sm' data-toggle='tooltip' title='SOAP Note' onClick='soap($uid)'>" .
				        "<i class='fas fa-notes-medical'></i>" .
				    "</a>&nbsp;";

		// if($this->status){
		// 	$action .= 	"<a class='btn btn-danger btn-sm' data-toggle='tooltip' title='Deactivate' onClick='updateStatus($id, 0)'>" .
		// 			        "<i class='fas fa-circle-xmark'></i>" .
		// 			    "</a>&nbsp;";
		// }
		// else{
		// 	$action .= 	"<a class='btn btn-success btn-sm' data-toggle='tooltip' title='Activate' onClick='updateStatus($id, 1)'>" .
		// 			        "<i class='fas fa-circle-check'></i>" .
		// 			    "</a>&nbsp;";
		// }

		return $action;
	}
}