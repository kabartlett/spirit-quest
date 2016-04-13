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

	include("questline.php");

	class SkyQuest extends MultipleChoiceQuest
	{
		public function __construct()
		{
			parent::__construct(array
			(	'active'=>TRUE,
				'complete'=>FALSE,
				'visible'=>TRUE,
				'question'=>'What color is the sky on a clear day?',
				'answers'=>array(
					'0'=>'Green',
					'1'=>'Blue'
				),
				'correctIndex'=>'1'
			));
		}
	}

	class NightSkyQuest extends MultipleChoiceQuest
	{
		public function __construct()
		{
			parent::__construct(array
			(	'active'=>TRUE,
				'complete'=>FALSE,
				'visible'=>TRUE,
				'question'=>'What color is the sky on a cloudy night?',
				'answers'=>array(
					'0'=>'Black',
					'1'=>'White'
				),
				'correctIndex'=>'0'
			));
		}
	}

	class ExampleQuestLine extends QuestLine
	{
		public function __construct()
		{
			parent::__construct(array
			(
				'active'=>TRUE,
				'complete'=>FALSE,
				'visible'=>TRUE,
				'quests'=>array(
					0=>new SkyQuest(),
					1=>new NightSKyQuest()
				)
			));
		}

		public function validate()
		{
			foreach($this->quests as $key => $value)
			{
				if (!$this->quests[$key]->isComplete())
					return FALSE;
			}

			$this->complete = TRUE;
			$this->active = FALSE;
			return TRUE;
		}
	}

	$questline = new ExampleQuestLine();
	$quests = $questline->getQuests();

	foreach($quests as $key => $value)
	{
		echo ($value->getQuestion() . "\n");
		foreach($value->getAnswers() as $akey => $avalue)
		{
			echo($akey . " : " . $avalue . "\n");
		}
	}

	$quests[0]->setUserIndex('1');
	$quests[0]->validate();
	$quests[1]->setUserIndex('0');
	$quests[1]->validate();
	$questline->validate();

	if ($questline->isComplete())
		echo ("Questline complete\n\n");
	else
		echo ("Questline incomplete\n\n");

?>
