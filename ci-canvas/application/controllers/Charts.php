<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charts extends CI_Controller {

	public function index($page = 'grafice')
	{
		$this->load->helper('url');

                $data['title'] = ucfirst($page);

                if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
                {
                        show_404();
                }

                $this->load->view('header', $data);
                $this->load->view('sidebar', $data);
                $this->load->view($page, $data);
                $this->load->view('footer', $data);
	}

        public function centralizator($page = 'centralizator')
        {
                $this->load->database();
                $this->load->helper('url');

                $data['title'] = ucfirst($page);

                if ( ! file_exists(APPPATH.'views/'.$page.'.php'))
                {
                        show_404();
                }

                 if ($this->uri->segment(3) === FALSE)
                {
                        $id = 0;
                }
                else
                {
                        $id = $this->uri->segment(3);
                }

                $this->load->model('chart_model');

                $data['santiere'] = $this->chart_model->santiere();
                $data['siteName'] = $this->chart_model->aerostar($id);

                $data['data_b'] = $this->chart_model->bugetat();
                $data['data_c'] = $this->chart_model->contractat();
                $data['data_f'] = $this->chart_model->facturat();

                $this->load->view('header', $data);
                $this->load->view('sidebar', $data);
                $this->load->view($page, $data);
                $this->load->view('footer', $data);
        }

        public function santiere($id)
        {
                $this->load->database();
                $this->load->helper('url');

                $page = 'grafice';
                $data['title'] = ucfirst($page);

                if ($this->uri->segment(3) === FALSE)
                {
                        $id = 0;
                }
                else
                {
                        $id = $this->uri->segment(3);
                }

                $this->load->model('chart_model');

                $data['santiere'] = $this->chart_model->santiere();
                $data['siteName'] = $this->chart_model->aerostar($id);

                $data['data_b_s'] = $this->chart_model->bugetat_s($id);
                $data['data_c_s'] = $this->chart_model->contractat_s($id);
                $data['data_f_s'] = $this->chart_model->facturat_s($id);

                $data['data1'] = $this->chart_model->cheltuieli_lunare($id);
                $data['data2'] = $this->chart_model->tip_lucrare($id);
                $data['data3i'] = $this->chart_model->total_incasari($id);
                $data['data3c'] = $this->chart_model->total_cheltuieli($id);

                $this->load->view('header', $data);
                $this->load->view('sidebar', $data);
                $this->load->view($page, $data);
                $this->load->view('footer', $data);
        }

        public function grafic_productie($page = 'grafic_productie')
        {
                $this->load->database();
                $this->load->helper('url');

                $data['title'] = "Grafic productie";

                $this->load->model('chart_model');

                $data['data_cm'] = $this->chart_model->confectii_metalice();
                $data['comandat'] = $this->chart_model->procent_comandat();
                $data['procent'] = $this->chart_model->procent_realizat();

                $this->load->view('header', $data);
                $this->load->view('sidebar_hala', $data);
                $this->load->view($page, $data);
                $this->load->view('footer', $data);
        }

}