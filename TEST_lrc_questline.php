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

    include_once('lrc_questline.php');
    include_once('user.php');

    $yn = ["No", "Yes"];

    $user = new User("00000009");
    echo($user->getId() . "\n");

    $questline = $user->quests['LRC'];
    $quests = $questline->quests;
    $badge = $user->badges['SeaPup'];

    $questline->html();
    echo("\n");
    foreach ($quests as $key=>$value)
    {
        echo("Name: " . $value->getName() . "\n");
        echo("Active: " . $yn[$value->isActive()] . "\n");
        echo("Complete: " . $yn[$value->isComplete()] . "\n");
        echo("Visible: " . $yn[$value->isVisible()] . "\n");
        echo("Objective: " . $value->getObjective() . "\n");
        echo("Reward: " . $value->getReward() . "\n");
        echo("Question:  " . $value->getQuestion() . "\n");
        $value->html();
        echo("\n");
    }
    echo('Sea Pup requirements: ' . $badge->getRequirements() . "\n");
    echo('Sea Pup achieved: ' . $badge->isAchieved() . "\n\n");

    $questline->html();

    assert(!$quests[0]->isComplete());
    assert(!$quests[1]->isComplete());
    assert(!$quests[2]->isComplete());
    assert(!$quests[3]->isComplete());
    assert(!$quests[4]->isComplete());
    assert(!$quests[5]->isComplete());
    assert(!$quests[6]->isComplete());
    assert(!$quests[7]->isComplete());
    assert(!$quests[8]->isComplete());
    assert(!$questline->isComplete());

    $quests[0]->setUserAnswer('welcome to spirit quest');
    $quests[0]->validate($user);
    $questline->validate($user);

    assert($quests[0]->isComplete());
    assert(!$questline->isComplete());

    $quests[1]->setUserAnswer('orange');
    $quests[1]->validate($user);
    $questline->validate($user);

    assert($quests[1]->isComplete());
    assert(!$questline->isComplete());

    $quests[2]->setUserAnswer('Up up down down left right left right b a');
    $quests[2]->validate($user);
    $questline->validate($user);

    assert($quests[2]->isComplete());
    assert(!$questline->isComplete());

    $quests[3]->setUserAnswer('LRC-X15H');
    $quests[3]->validate($user);
    $questline->validate($user);

    assert($quests[3]->isComplete());
    assert(!$questline->isComplete());

    $quests[4]->setUserAnswer('LRC-Q93J');
    $quests[4]->validate($user);
    $questline->validate($user);

    assert($quests[4]->isComplete());
    assert(!$questline->isComplete());

    $quests[5]->setUserAnswer('Really anything can go here.');
    $quests[5]->validate($user);
    $questline->validate($user);

    assert($quests[5]->isComplete());
    assert(!$questline->isComplete());

    $quests[6]->setUserAnswer('Really anything can go here, too.');
    $quests[6]->validate($user);
    $questline->validate($user);

    assert($quests[6]->isComplete());
    assert(!$questline->isComplete());

    $quests[7]->setUserAnswer('One.');
    $quests[7]->validate($user);
    assert(!$quests[7]->isComplete());
    $quests[7]->setUserAnswer('Two.');
    $quests[7]->validate($user);
    assert(!$quests[7]->isComplete());
    $quests[7]->setUserAnswer('Three.');
    $quests[7]->validate($user);
    assert(!$quests[7]->isComplete());
    $quests[7]->setUserAnswer('Four.');
    $quests[7]->validate($user);
    $questline->validate($user);

    assert($quests[7]->isComplete());
    assert(!$questline->isComplete());

    $quests[8]->setUserAnswer('One.');
    $quests[8]->validate($user);
    assert(!$quests[8]->isComplete());
    $quests[8]->setUserAnswer('Two.');
    $quests[8]->validate($user);
    assert(!$quests[8]->isComplete());
    $quests[8]->setUserAnswer('Three.');
    $quests[8]->validate($user);
    $questline->validate($user);

    assert($quests[8]->isComplete());
    assert($questline->isComplete());

    $user->badges['SeaPup']->validate($user);

    $questline->html();
    foreach ($quests as $key=>$value)
    {
        $value->html();
        echo("\n");
    }
    echo('Sea Pup requirements: ' . $badge->getRequirements() . "\n");
    echo('Sea Pup achieved: ' . $badge->isAchieved() . "\n\n");
    echo($user->getSpirit() . "\n\n");
?>
