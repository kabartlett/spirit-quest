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

	/**
	 *	The abstract Quest class is the template with which the programmer may
	 *		create different kinds of quests.
	 */
	abstract class Quest
	{
		private $name;
		protected $active;
		protected $complete;
		protected $visible;
		protected $objective;
		protected $reward;
		public static $errorMessage =
			'Quest Array does not contain proper fields.';

		/**
		 *	Put success logic here when extending the class.
		 */
		public abstract function validate(&$user);

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

		/**
		 *	@params array $array which holds the instance variables indexed
		 *		by name.
		 */
		public function __construct($array)
		{
			$this->complete = FALSE;
			$this->name = Quest::_getField($array, 'name');
			$this->active = Quest::_getField($array, 'active');
			$this->visible = Quest::_getField($array, 'visible');
			$this->objective = Quest::_getField($array, 'objective');
			$this->reward = Quest::_getField($array, 'reward');
		}

		public function html()
		{
			echo("<h1>" . $this->getName() . "</h1>\n");
			echo("<p>" . $this->getObjective() . "</p>\n");
		}

		public function isActive() { return $this->active; }
		public function isComplete() { return $this->complete; }
		public function isVisible() { return $this->visible; }
		public function getName() { return $this->name; }
		public function getObjective() { return $this->objective; }
		public function getReward() { return $this->reward; }
	}

	/**
	 *	The MultipleChoiceQuest is a type of Quest that can be
	 *	implemented in the game.
	 */
	class MultipleChoiceQuest extends Quest
	{
		private $question;
		private $answers;
		private $userIndex;
		private $correctIndex;

		/**
		 *	Success logic implemented.
		 */
		public function validate(&$user)
		{
			if ($this->correctIndex === $this->userIndex)
			{
				$this->active = FALSE;
				$this->complete = TRUE;
				return TRUE;
			}
			else return FALSE;
		}

		/**
		 *	@params array $array containing instance variables indexed
		 *		by name.
		 */
		public function __construct($array)
		{
			parent::__construct($array);
			$this->question = Quest::_getField($array, 'question');
			$this->answers = Quest::_getField($array, 'answers');
			$this->correctIndex = Quest::_getField($array, 'correctIndex');
		}

		/**
		 *	@params $userIndex which correlates with an index in
		 *		$answers.
		 */
		public function setUserIndex($userIndex)
		{
			$this->userIndex = $userIndex;
		}

		public function getUserIndex() { return $this->userIndex; }
		public function getCorrectIndex() { return $this->correctIndex; }
		public function getQuestion() { return $this->question; }
		public function getAnswers() { return $this->answers; }
	}

	abstract class TextFieldQuest extends Quest
	{
		protected $question;
		protected $userAnswer;

		public function __construct($array)
		{
			parent::__construct($array);
			$this->question = Quest::_getField($array, 'question');
			$this->userAnswer = "";
		}

		public function setUserAnswer($userAnswer)
		{
			$this->userAnswer = $userAnswer;
		}

		public function html()
		{
			parent::html();
			echo("<div class='form-viewport'>\n");
			echo("<p>" . $this->getQuestion() . "</p>\n");
			echo("<form action=''>\n");
			echo("<p><input type='text' name='answer'/></p>\n");
			echo("<p><input class='button' type='submit' value='Submit'/></p>\n");
			echo("</form>\n");
			echo("</div>\n");
		}

		public function getQuestion() { return trim($this->question); }
		public function getUserAnswer() { return trim($this->userAnswer); }
	}

	class CodeQuest extends TextFieldQuest
	{
		protected $verificationString;

		public function __construct($array)
		{
			parent::__construct($array);
			$this->verificationString = Quest::_getField($array, 'verificationString');
		}

		public function getVerificationString()
		{
			return trim($this->verificationString);
		}

		public function validate(&$user)
		{
			if (strtolower($this->getUserAnswer()) === strtolower($this->getVerificationString()))
			{
				$this->complete = TRUE;
				$this->active = FALSE;
				$user->addSpirit($this->getReward());
				return TRUE;
			}
			else return FALSE;
		}
	}

	class ParticipationTextQuest extends TextFieldQuest
	{
		public function __construct($array)
		{
			parent::__construct($array);
		}

		public function validate(&$user)
        {
            if ($this->getUserAnswer() !== '')
            {
                $this->complete = TRUE;
                $this->active = FALSE;
				$user->addSpirit($this->getReward());
                return TRUE;
            }
            else return FALSE;
        }
	}

	class RepeatableParticipationTextQuest extends Quest
	{
		protected $question;
		protected $userAnswers;
		protected $currentIndex;
		protected $maxRepetitions;

		public function __construct($array)
		{
			parent::__construct($array);
			$this->question = Quest::_getField($array, 'question');
			$this->maxRepetitions = Quest::_getField($array, 'maxRepetitions');
			$this->currentIndex = Quest::_getField($array, 'currentIndex');
			$this->userAnswers = [];
		}

		public function setUserAnswer($userAnswer)
		{
			$this->userAnswers[$this->currentIndex] = $userAnswer;
		}

		public function getCurrentIndex() { return $this->currentIndex; }
		public function getQuestion() { return trim($this->question); }
		public function getUserAnswers() { return $this->userAnswers; }

		public function validate(&$user)
        {
			if ($this->currentIndex === $this->maxRepetitions)
			{
				return FALSE;
			}
			else if ($this->getUserAnswers()[$this->currentIndex] !== '')
            {
				$this->currentIndex += 1;
				if ((int)$this->currentIndex === (int)$this->maxRepetitions)
				{
					$this->complete = TRUE;
					$this->active = FALSE;
				}
				$user->addSpirit($this->getReward());
            	return TRUE;
            }
            else return FALSE;
        }

		public function html()
		{
			parent::html();
			echo("<p><em>This quest is repeatable " . $this->maxRepetitions . " times.</em></p>\n");
			echo("<div class='form-viewport'>\n");
			echo("<p>" . $this->getQuestion() . "</p>\n");
			for ($i = 0; $i < $this->currentIndex; $i++)
				echo("Previous Answer " . $i . ": " . $this->userAnswers[$i] . "</p>\n");
			echo("<form action=''>\n");
			echo("<p><input type='text' name='answer'/></p>\n");
			echo("<p><input class='button' type='submit' value='Submit'/></p>\n");
			echo("</form>\n");
			echo("</div>\n");
		}
	}
?>
