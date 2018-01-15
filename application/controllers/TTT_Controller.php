<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class TTT_Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('TTT_Model', 'model');	//makes the calling name of TTT_Model model
		}

		//Makes the player_name_view the default view when the controller (TTT_Controller) is called
		public function index()
		{
			$names['games'] = $this->model->getLastFiveMatches();  //loads the last 5 matches so they can be displayed in the view
			$this->load->view('player_name_view', $names);	
		}
		
		//This function is called when the play button is clicked on the player_name_view view; calls the submit function in the TTT_Model to submit the data (player names) to the database
		public function submit()
		{
			$result = $this->model->submit();
			
			redirect(base_url('TTT_Controller/game', $result));
		}

		//Function to display the game_view view; the player names that were submitted in the player_name_view view are passed along in the view call so that the messages can display whos turn it is and who won (unless a tie)
		public function game()
		{
			$names['games'] = $this->model->getPlayerNames();
			$this->load->view('game_view', $names);
		}

		//Submits the match results the database using the posting_results TTT_Model function
		public function posting_results()
		{
			$result = $this->model->posting_results();
			
			redirect(base_url('TTT_Controller/results', $result));
		}

		//Function that displays the results of the previous matches; uses CodeIgniter pagination
		public function results()
		{
			$config = array();
			$config["base_url"] = base_url(). "TTT_Controller/results";
			$config["total_rows"] = $this->model->results_count();
			$config["per_page"] = 10;
			$config["uri_segment"] = 3;

			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["results"] = $this->model->fetch_results($config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();

			$this->load->view('results_view', $data);
		}

		//Function that submits the player's name to the database in case a AI match is decided upon
		public function submitVsCpu()
		{
			$result = $this->model->submit1P();

			redirect(base_url('TTT_Controller/gameVsCpu', $result));
		}

		//Function that allows the display of the game_vs_cpu_view view; both the player name and the AI is passed along for messages (turn and victory)
		public function gameVsCpu()
		{
			$names['games'] = $this->model->getPlayerNames();
			$this->load->view('game_vs_cpu_view', $names);
		}
	}
?>