<?php

/**
 * 
 * 
 * controllers/Admin.php
 *
 * ------------------------------------------------------------------------
 */
class Admin extends Application {

    function __construct()
    {
	parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index()
    {
	$this->data['title'] = 'Quotation Maintenance';
    $this->data['quotes'] = $this->quotes->all();
    $this->data['pagebody'] = 'admin_list';    // this is the view we want shown
    $this->render();
    }
    function add() {
        $quotes = $this->quotes->create();
        $this->present($quotes);
    }

    function present($quote) {
        $this->load->helper('formfields');

        $this->data['fid'] = makeTextField('ID#', 'id', $quote->id);
        $this->data['fwho'] = makeTextField('Author', 'who', $quote->who);
        $this->data['fmug'] = makeTextField('Picture', 'mug', $quote->mug);
        $this->data['fwhat'] = makeTextArea('The Quote', 'what', $quote->what);
        $this->data['pagebody'] = 'quote_edit';
        $this->data['fsubmit'] = makeSubmitButton('Process Quote', "Click here to validate the quotation data", 'btn-success');
        $this->render();    
    }
    function confirm() {
        $record = $this->quotes->create();
          // Extract submitted fields
        $record->id = $this->input->post('id');
        $record->who = $this->input->post('who');
        $record->mug = $this->input->post('mug');
        $record->what = $this->input->post('what');
        if (empty($record->id)){
            $this->quotes->add($record);
        }
        else {
            $this->quotes->update($record);
        }
            
        redirect('/admin');
    }
}

/* End of file Welcome.php */
/* Location: application/controllers/Welcome.php */