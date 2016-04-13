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


    include_once('database.php');
    include_once('lrc_questline.php');
    include_once('badge.php');

    class User
    {
        private $id;
        private $name;
        private $username;
        private $spirit;
        public $quests;
        public $badges;

        /**
		 *	Ensures a field exists in an array before retrieving it.
		 *
		 *	@throws Exception
		 */
		protected static function _getField($array, $key)
		{
			if (array_key_exists($key, $array)) return $array[$key];
			else throw new Exception(Quest::errorMessage);
		}

        public function __construct($id)
        {
			$row = Database::getRow('User',  'id="' . $id .'"');
            if (!$row) die('User ' . $id . " does not exist.\n");
            $this->id = $id;
			$this->name = $row['name'];
            $this->username = $row['username'];
			$this->spirit = $row['spirit'];
            $this->quests = array('LRC'=>new LRC_QuestLine($id));
            $this->badges = array('SeaPup'=>new SeaPup_Badge($id));
        }

        public function addSpirit($amount)
        {
            $this->spirit += $amount;
        }

        public function getFirstName()
        {
            return strtok($this->name, " ");
        }

        public function getId() { return $this->id; }
        public function getName() { return $this->name; }
        public function getUsername() { return $this->username; }
        public function getSpirit() { return $this->spirit; }

	public function save()
	{
		Database::save($this->getId(), "User", "spirit", (int)$this->getSpirit());
	}
    }
?>
