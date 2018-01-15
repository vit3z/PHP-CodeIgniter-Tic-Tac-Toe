<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class TTT_Model extends CI_Model
	{
		//Function that submits the player names into the database
		public function submit()
		{
			$player1 = $this->input->post("player1name");
			$player2 = $this->input->post("player2name");
			var_dump($player2);
			if($this->input->post("player1name") != $this->input->post("player2name")) //Checks if the player 1 name is the same as the name of player 2
			{
				$data = array(
					"player1name" => $this->input->post("player1name"),
					"player2name" => $this->input->post("player2name")
				);	

				$this->db->insert('results', $data);
			}
			else
			{
				$this->session->set_flashdata('error_msg', 'Problem With Entering Names');
				redirect(base_url('TTT_Controller/index'));
				return false;
			}
		}

		//Function that gets the last names that were entered into the database; used in the game_veiw to have the player names in messages
		public function getPlayerNames()
		{
			$this->db->order_by('id', 'desc');
			$this->db->limit(1);
			$query = $this->db->get('results');

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
		}

		//Function that updates the database with the match results; in case the post button is pressed early the game is considered cancelled
		public function posting_results()
		{
			$this->db->order_by('id', 'desc');
			$this->db->limit(1);

			if($this->input->post('winner') == "")
			{
				$cancelled = "Cancelled game";
				$data = array(
					'winner' => $cancelled
				);

			}
			else
			{
				$data = array(
					'winner' => $this->input->post('winner')
				);	
			}
			
			$this->db->update('results', $data);
		}

		//Function used for pagination to get all the rows in the "results" table
		public function results_count()
		{
			return $this->db->count_all("results");
		}

		//Gets all the results from the "results" table. Used for pagination
		public function fetch_results($limit, $start)
		{
			$this->db->limit($limit, $start);
			$query = $this->db->get("results");

			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row) 
				{
					$data[]=$row;
				}
				return $data;
			}
			else
			{
				return false;
			}
		}

		//Function used to get the last 5 matches from the table. Used to display the fetched data in the player_name_view view
		public function getLastFiveMatches()
		{
			$this->db->order_by('id', 'desc');
			$this->db->limit(5);
			$query = $this->db->get('results');

			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return false;
			}
		}

		//Function used to submit the name of the player who will square off against the AI; also, the name of the AI player is submitted to the database
		public function submit1P()
		{
			$player1 = $this->input->post("player1name");
			$player2 = "AI_John";
			
			$data = array(
				"player1name" => $this->input->post("player1name"),
				"player2name" => $player2
			);	

			$this->db->insert('results', $data);
		}
	}
?>