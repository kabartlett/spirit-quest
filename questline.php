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

	include("quest.php");

	/**
	 *	QuestLine is a template that acts like a Quest, but contains
	 *	other quests.
	 */
	abstract class QuestLine extends Quest
	{
		public $quests = array();

		/**
		 *	@params array $array contains instance variables indexed
		 *	 	by name.
		 */
		public function __construct($array)
		{
			parent::__construct($array);
			$this->quests = Quest::_getField($array, 'quests');
		}

		public function html()
		{
			echo("<h1>" . $this->getName() . "</h1>\n");
			echo("<p><em>Completing this questline awards an additional "
			     . $this->getReward() . " spirit.</em></p>\n");
			echo("<p>" . $this->getObjective() . "</p>\n");
			echo("<div class='questlist'>\n");
			echo("<ul>\n");
			foreach ($this->quests as $key => $value)
				if ($value->isComplete())
					echo("<li class='complete' onclick='forward(\""
						. $key . "\")'>" . $value->getName() . " (COMPLETE) </li>\n");
				else
					echo("<li onclick='forward(\""
						. $key . "\")'>" . $value->getName() . "</li>\n");
			echo("</ul>\n");
			echo("</div>\n");
		}
	}
?>
