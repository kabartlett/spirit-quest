<?php
/**
 * UAA Spirit Quest
 * Copyright (c) 2016, Kevin Bartlett
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

	class Database extends mysqli
	{
		private $dbhost = 'localhost';
		private $dbuser = 'theuser@localhost';
		private $dbpass = 'thepassword';
		private $dbname = 'thedbname';

		public function __construct()
		{
			parent::__construct(
				$this->dbhost,
				$this->dbuser,
				$this->dbpass,
				$this->dbname
			);
		}

		public static function getRow($from, $where)
		{
			$db = new Database();
			$result = $db->query('SELECT * FROM ' . $from . ' WHERE ' . $where);
			$row = $result->fetch_assoc();
			$db->close();
			return $row;
		}

		public static function getQuestRow($from, $id, $fields, $defValues)
		{
			$db = new Database();
			$result = $db->query('SELECT * FROM ' . $from . ' WHERE id="' . $id . '"');
			if ($result->num_rows === 0)
			{
				$success = $db->query('INSERT INTO ' . $from . ' (id, ' .
					$fields . ') VALUES ("' . $id . '", ' . $defValues . ')');
				if (!$success) die("Could not create quest entry for user.\n");
				$result = $db->query('SELECT * FROM ' .
					$from . ' WHERE id="' . $id . '"');
			}
			$row = $result->fetch_assoc();
			$db->close();
			return $row;
		}

		public static function getBadgeState($id, $label)
		{
			$db = new Database();
			$result = $db->query('SELECT ' . $label . ' FROM Badge WHERE id="' . $id .'"');
			if ($result->num_rows === 0)
			{
				$success = $db->query('INSERT INTO Badge (id) VALUES ("' . $id . '")');
				$result = $db->query('SELECT ' . $label . ' FROM Badge WHERE id="' . $id .'"');
				if (!$success) die ("Could not create badge entry for user.\n");
				$result = $db->query('SELECT ' . $label . ' FROM Badge WHERE id="' . $id .'"');
			}
			$row = $result->fetch_assoc();
			$db->close();
			return $row[$label];
		}

		public static function getBadgeRequirements($label)
		{
			$db = new Database();
			$result = $db->query('SELECT * FROM Badge_Req WHERE label="' . $label . '"');
			if (!$result->num_rows === 0) die('Requirements for ' . $label . " cannot be found.\n");
			$row = $result->fetch_assoc();
			$db->close();
			return $row['requirements'];
		}

		public static function save($id, $label, $field, $value)
		{
			$db = new Database();
			$query = "UPDATE $label SET " . $field .  "=" . $value . " WHERE id='" . $id . "'";
			$result = $db->query($query);
				
			$db->close();
		}
	}
?>
