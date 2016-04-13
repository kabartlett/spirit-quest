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
	
	$quest = new MultipleChoiceQuest(array (
		'active'=>TRUE,
		'visible'=>TRUE,
		'question'=>'What color is the sky on a clear day?',
		'answers'=>array (
			'0'=>'Blue',
			'1'=>'Green'
		),
		'correctIndex'=>'0',
	));
	
	echo ($quest->getQuestion(). "\n");
	foreach($quest->getAnswers() as $key => $value)
	{
		echo ($key . ": " . $value . "\n");
	}

	echo ("\nChoosing '1'...\n");
	$quest->setUserIndex('1');
	$quest->validate();

	if ($quest->isComplete())
		echo ("Quest Complete\n");
	else
		echo ("Quest Incomplete\n");

	echo ("\nChoosing '0'...\n");
	$quest->setUserIndex('0');
	$quest->validate();
	if ($quest->isComplete())
		echo ("Quest Complete\n");
	else
		echo ("Quest Incomplete\n");
	
	echo ("\n");

?>
