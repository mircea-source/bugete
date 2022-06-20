<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buget extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _buget_output($output = null)
	{
		$this->load->view('buget.php',(array)$output);
	}

	public function index()
	{
		$this->_buget_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function afisare_santier($value, $row)
	{
		return "<a href='" . site_url('buget/customers_management/index/' . $row->siteCode) . "'>$value</a>";
	}

	public function offices_management($id = null)
	{
			$crud = new grocery_CRUD();

			$this->load->library('tooltip_gcrud');
			$crud = new tooltip_GCRUD();

			$html_title ="Santiere";
			$this->load->vars( array( 'html_title' => $html_title) );

			$crud->set_table('santiere');
			$crud->set_subject('santier');
			$crud->required_fields('oras', 'adresa1');
			$crud->set_relation('siteCode','parteneri_contract','siteCode');
			$crud->set_relation('siteCode','orders','siteCode');
			$crud->columns('adresa1','oras','adresa2','judet');
			$crud->display_as('adresa1','Denumire')
				 ->display_as('oras','Localitate')
				 ->display_as('adresa2','Adresa');
			$crud->where('santiere.status','1');

			$crud->callback_column('adresa1',array($this,'afisare_santier'));
			$crud->add_action('Parteneri', '', 'buget/customers_management/index', 'user');
		//	$crud->add_action('Documente', '', 'buget/facturi_santier/index', 'list-alt');

			$crud->unset_fields('buget');

			$crud->unset_clone();
			$crud->unset_delete();

		//	$crud->set_rules('adresa1', 'Santier', 'partener_si_santier_unic[' . $id . ']');

			$output = $crud->render();

			$this->_buget_output($output);
	}

	public function afisare_facturi($value, $row)
	{
		return 'orders_management/index' . '?santier=' . $row->siteCode;
	}

	public function capitalize($post_array)
	{
		$post_array['customerName'] = strtoupper($post_array['customerName']);
		$post_array['lastName'] = strtoupper($post_array['lastName']);
		$post_array['firstName'] = strtoupper($post_array['firstName']);
		return $post_array;
	}

	public function customers_management()
	{
			$crud = new grocery_CRUD();

			$this->load->library('tooltip_gcrud');
			$crud = new tooltip_GCRUD();

			$html_title ="Subcontractori";
			$this->load->vars( array( 'html_title' => $html_title) );

			$siteCode = $this->uri->segment(4);

			$crud->set_table('parteneri_contract');
			$crud->set_subject('subcontractor');
			$crud->set_relation('customerID','parteneri_contact','customerName');
			$crud->set_relation('siteCode','santiere','adresa1',array('status' => '1'));
			$crud->add_fields(array('customerID','siteCode','valoare_contract','file_url','contactLastName','phone','city'));
		    $crud->edit_fields(array('customerID','file_url'));
			$crud->required_fields('customerName', 'siteCode');
			$crud->unset_columns(array('addressLine1'));
			$crud->display_as('siteCode','Santier')
				 ->display_as('customerID','Firma')
				 ->display_as('customerName','Firma')
				 ->display_as('file_url','Contract')
				 ->display_as('contactLastName','Persoana contact')
				 ->display_as('phone','Telefon')
				 ->display_as('city','Localitate')
				 ->display_as('valoare_contract','Valoare contract');

			$crud->where('customerName !=','incasari');
			$crud->order_by('customerName','asc');

		//	$crud->callback_column('customerName',array($this,'afisare_partener'));
		//	$crud->add_action('Documente', '', 'buget/orders_management/index', 'list-alt');

		//	$crud->callback_column('valoare_contract',array($this,'_column_valoare_right_align'));
			$crud->callback_before_insert(array($this,'capitalize'));

			if(isset($siteCode)) {
				$crud->where('parteneri_contract.siteCode', $siteCode);
			}

		//	$crud->fields('siteCode','customerName','valoare_contract','file_url','contactLastName','phone','city');
			$crud->set_field_upload('file_url','assets/uploads/files');
	//		$crud->unique_fields(array('customerName'));

/*			if(!isset($siteCode)) {
				$crud->unset_add();
			}*/

			$crud->unset_clone();
			$crud->unset_delete();

			$this->db->select('siteCode, adresa1, status');
            $this->db->from('santiere');
            $this->db->where('siteCode', $siteCode);
            $crud->where('status','1');
            $query = $this->db->get();

            foreach ($query->result() as $row)
            {
                $siteName = $row->adresa1;
            }

			$state = $crud->getState();

			$output = $crud->render();

			if(($state == 'add') && ($siteCode > 0)) {
				$js='<script>
					document.getElementById("field-siteCode").value = "' . $siteCode . '";
					</script>';
				$output->output .= $js;
			}

/*			if($state == 'edit') {
				$js='<script>
					document.getElementById("field-siteCode").disabled = true;
					</script>';
				$output->output .= $js;
			}*/

			if(isset($siteCode) && isset($siteName)) {
				$output->santier = $siteName;
			}

			$this->_buget_output($output);
	}

	public function mail_to($value, $row)
	{
		return '<a href="mailto:' . $row->email . '">' . $row->email . ' </a>';
	}

	public function employees_management()
	{
			$crud = new grocery_CRUD();

			$this->load->library('tooltip_gcrud');
			$crud = new tooltip_GCRUD();

			$html_title ="Manageri proiect";
			$this->load->vars( array( 'html_title' => $html_title) );

			$crud->set_table('ingineri');
			$crud->set_relation('siteCode','santiere','{adresa1} - {oras}, {adresa2}',array('status' => '1'));
			$crud->display_as('siteCode','Santier')
				 ->display_as('extension','Telefon');
			$crud->where('ingineri.status','1');
			$crud->set_subject('inginer');

			$crud->set_relation('employeeNumber','ingineri','{nume} {prenume}');
			$crud->display_as('employeeNumber','Numele');

			$crud->required_fields('nume', 'siteCode');
			$crud->columns('employeeNumber','email','extension','siteCode');

			$crud->callback_column('email',array($this,'mail_to'));

		//	$crud->set_field_upload('file_url','assets/uploads/files');
			$crud->unset_fields('file_url');

			$crud->unset_delete();
			$crud->unset_clone();

			$output = $crud->render();

			$this->_buget_output($output);
	}

	public function partners()
	{
			$crud = new grocery_CRUD();

			$this->load->library('tooltip_gcrud');
			$crud = new tooltip_GCRUD();

			$html_title ="Parteneri";
			$this->load->vars( array( 'html_title' => $html_title) );

			$crud->display_as('customerName','Firma')
				->display_as('contactLastName','Persoana contact')
				->display_as('phone','Telefon')
				->display_as('addressLine1','Adresa')
				->display_as('city','Localitate');

			$crud->set_table('parteneri_contact');
			$crud->set_subject('firma');
			$crud->columns('customerName', 'contactLastName', 'phone', 'addressLine1', 'city');

			$crud->unique_fields(array('customerName','phone'));

			$crud->required_fields('customerName');
			$crud->order_by('customerName');

			$crud->callback_before_insert(array($this,'capitalize'));
			$crud->callback_before_update(array($this,'capitalize'));

		//	$crud->unset_add();
			$crud->unset_clone();
			$crud->unset_delete();

			$output = $crud->render();

			$this->_buget_output($output);
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	public function steel_structures()
	{
			$crud = new grocery_CRUD();

			$this->load->library('tooltip_gcrud');
			$crud = new tooltip_GCRUD();

			$html_title ="Structuri metalice";
			$this->load->vars( array( 'html_title' => $html_title) );

			$crud->display_as('nr_doc','Nr. comanda')
				->display_as('data_doc','Data comanda')
				->display_as('customerName','Client')
				->display_as('cantitate','Cantitate (KG)')
				->display_as('realizat','Realizat (KG)');

			$crud->set_table('confectii_metalice');
			$crud->set_subject('comanda');
			$crud->columns('nr_doc','data_doc','termen', 'customerName', 'cantitate', 'realizat');

			$crud->required_fields('nr_doc','data_doc','termen','cantitate');
			$crud->order_by('data_doc','desc');

			$crud->callback_before_insert(array($this,'capitalize'));

			$crud->unset_fields('articol','um');
		//	$crud->unset_add();
			$crud->unset_clone();
			$crud->unset_delete();
		//	$crud->add_action('Comenzi', '', 'buget/steel_structures/index', 'list-alt');

			$output = $crud->render();

			$this->_buget_output($output);
	}

	public function column_right_align($value,$row)
	{
		return "<span style=\"width:100%;text-align:right;display:block;\">".$value."</span>";
	}

    public function charts()
    {
            $crud = new grocery_CRUD();

            $crud->set_table('santiere');

            $this->db->order_by('adresa1', 'ASC');
            $query = $this->db->get('santiere');
	        $santiere =  $query->result_array();

            $output = $crud->render();

			$this->_buget_output($output);
    }

	public function locations_management()
	{
			$crud = new grocery_CRUD();

			$this->load->library('tooltip_gcrud');
			$crud = new tooltip_GCRUD();

			$html_title ="Locații";
			$this->load->vars( array( 'html_title' => $html_title) );

			$crud->set_table('offices');
			$crud->set_subject('Locatii');
			$crud->required_fields('city');

			$crud->display_as('city','Oras')
				->display_as('phone','Telefon')
				->display_as('addressLine1','Adresa')
				->display_as('addressLine2','Locatia')
				->display_as('postalCode','Cod postal');
			$crud->set_subject('Locatie');

			$crud->columns('addressLine2','addressLine1','city','postalCode','phone');
			$crud->unset_fields('state','country','territory');

			$crud->unset_clone();
			$crud->unset_delete();

			$output = $crud->render();

			$this->_buget_output($output);
	}

	public function hr_management()
	{
			$crud = new grocery_CRUD();

			$this->load->library('tooltip_gcrud');
			$crud = new tooltip_GCRUD();

			$html_title ="Personal TESA";
			$this->load->vars( array( 'html_title' => $html_title) );

			 $crud->set_primary_key('locationID','locatii_ssabag_view');

			$crud->set_table('employees');
			$crud->set_relation('locationID','locatii_ssabag_view','location');
			$crud->set_relation('employeeNumber','employees','{lastName} {firstName}');

			$crud->display_as('employeeNumber','Numele')
				->display_as('lastName','Nume')
				->display_as('firstName','Prenume')
				->display_as('extension','Telefon')
				->display_as('locationID','Locatie')
				->display_as('jobTitle','Departament');
			$crud->where('employees.status','1');
			$crud->set_subject('Personal');

			$crud->required_fields('lastName');
			$crud->columns('employeeNumber','email','extension','locationID','jobTitle');
			$crud->unset_fields('file_url');

			$crud->unique_fields(array('extension','email'));

			$crud->callback_column('email',array($this,'mail_to'));
			$crud->callback_before_insert(array($this,'capitalize'));
			$crud->callback_before_update(array($this,'capitalize'));

			$crud->set_field_upload('file_url','assets/uploads/files');

			$crud->unset_clone();
			$crud->unset_delete();

			$output = $crud->render();

			$this->_buget_output($output);
	}

	public function it_management()
	{
			$crud = new grocery_CRUD();

			$this->load->library('tooltip_gcrud');
			$crud = new tooltip_GCRUD();

			$html_title ="Situatie IT";
			$this->load->vars( array( 'html_title' => $html_title) );

			$crud->set_primary_key('locationID','locatii_ssabag_view');

			$crud->set_table('employees');
			$crud->set_relation('locationID','locatii_ssabag_view','location');
			$crud->set_relation_n_n('Inventar', 'assets_list', 'assets', 'employeeNumber', 'category_id', 'name');
			$crud->set_relation_n_n('RO', 'nas_access_ro', 'nas', 'employeeNumber', 'category_id', 'name');
			$crud->set_relation_n_n('RW', 'nas_access_rw', 'nas', 'employeeNumber', 'category_id', 'name');


			$crud->display_as('lastName','Nume')
				->display_as('firstName','Prenume')
				->display_as('extension','Telefon')
				->display_as('locationID','Locatie')
				->display_as('jobTitle','Departament')
				->display_as('phone','Telefon');
			$crud->where('employees.status','1');
			$crud->set_subject('Personal');

			$crud->fields('lastName','firstName','email','extension','locationID','Inventar','RW','RO');
			$crud->required_fields('lastName');

			$crud->columns('lastName','firstName','email','extension','locationID','Inventar','RW','RO');
			$crud->unset_fields('file_url');

			$crud->unique_fields(array('extension','email'));

			$crud->callback_column('email',array($this,'mail_to'));
			$crud->callback_before_insert(array($this,'capitalize'));
			$crud->callback_before_update(array($this,'capitalize'));

			$crud->unset_clone();
			$crud->unset_delete();

			$output = $crud->render();

			$this->_buget_output($output);
	}


}