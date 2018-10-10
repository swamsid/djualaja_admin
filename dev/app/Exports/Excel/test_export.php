<?php

namespace App\Exports\Excel;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class test_export implements FromView, ShouldAutoSize
{
	public function __construct($view, $data = null)
	{
	    $this->view = $view;
	    $this->data = $data;
	}

    public function view(): View
    {
        return view($this->view, [
        	"data"	=> $this->data
        ]);
    }
}
