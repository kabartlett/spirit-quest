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

    include_once("questline.php");
    include_once("database.php");
    include_once("user.php");

    class LRC_Visit extends CodeQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="Visit"');
            $row_v = Database::getQuestRow(
                'LRC_Visit', '' . $id,
                'active, complete, visible', '1, 0, 1');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
                'verificationString'=>$row_c['answer']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_Visit", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_Visit", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_Visit", "visible", $bin[$this->isVisible()]);
        }
    }

    class LRC_GetPlanner extends CodeQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="GetPlanner"');
            $row_v = Database::getQuestRow(
                'LRC_GetPlanner', '' . $id,
                'active, complete, visible', '1, 0, 1');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
                'verificationString'=>$row_c['answer']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_GetPlanner", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_GetPlanner", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_GetPlanner", "visible", $bin[$this->isVisible()]);
        }
    }

    class LRC_SayingOnWall extends CodeQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="SayingOnWall"');
            $row_v = Database::getQuestRow(
                'LRC_SayingOnWall', '' . $id,
                'active, complete, visible', '1, 0, 1');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
                'verificationString'=>$row_c['answer']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_SayingOnWall", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_SayingOnWall", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_SayingOnWall", "visible", $bin[$this->isVisible()]);
        }
    }

    class LRC_VisitWritingCenter extends CodeQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="VisitWritingCenter"');
            $row_v = Database::getQuestRow(
                'LRC_VisitWritingCenter', '' . $id,
                'active, complete, visible', '1, 0, 1');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
                'verificationString'=>$row_c['answer']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_VisitWritingCenter", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_VisitWritingCenter", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_VisitWritingCenter", "visible", $bin[$this->isVisible()]);
        }
    }

    class LRC_VisitLRCMathLab extends CodeQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="VisitLRCMathLab"');
            $row_v = Database::getQuestRow(
                'LRC_VisitLRCMathLab', '' . $id,
                'active, complete, visible', '1, 0, 1');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
                'verificationString'=>$row_c['answer']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_VisitLRCMathLab", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_VisitLRCMathLab", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_VisitLRCMathLab", "visible", $bin[$this->isVisible()]);
        }
    }

    class LRC_TypesOfCoaching extends ParticipationTextQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="TypesOfCoaching"');
            $row_v = Database::getQuestRow(
                'LRC_TypesOfCoaching', '' . $id,
                'active, complete, visible', '1, 0, 1');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
		'userAnswer'=>$row_v['answer']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_TypesOfCoaching", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_TypesOfCoaching", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_TypesOfCoaching", "visible", $bin[$this->isVisible()]);
            Database::save($id, "LRC_TypesOfCoaching", "answer", '"' . $this->getUserAnswer() . '"');
        }
    }

    class LRC_Appointment extends ParticipationTextQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="Appointment"');
            $row_v = Database::getQuestRow(
                'LRC_Appointment', '' . $id,
                'active, complete, visible', '1, 0, 1');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
		'userAnswer'=>$row_v['answer']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_Appointment", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_Appointment", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_Appointment", "visible", $bin[$this->isVisible()]);
            Database::save($id, "LRC_Appointment", "answer", '"' . $this->getUserAnswer() . '"');
        }
    }

    class LRC_TopicsOfACC extends RepeatableParticipationTextQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="TopicsOfACC"');
            $row_v = Database::getQuestRow(
                'LRC_TopicsOfACC', '' . $id,
                'active, complete, visible, currentIndex', '1, 0, 1, 0');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'currentIndex'=>$row_v['currentIndex'],
                'maxRepetitions'=>$row_c['maxRepetitions'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
                'answer0'=>$row_v['answer0'],
                'answer1'=>$row_v['answer1'],
                'answer2'=>$row_v['answer2'],
                'answer3'=>$row_v['answer3']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_TopicsOfACC", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_TopicsOfACC", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_TopicsOfACC", "visible", $bin[$this->isVisible()]);
            Database::save($id, "LRC_TopicsOfACC", "currentIndex", $this->getCurrentIndex());
            for ($i = 0; $i < $this->getCurrentIndex() && $i < $this->maxRepetitions; $i++)
                Database::save($id, "LRC_TopicsOfACC", "answer" . $i, '"' . $this->userAnswers[$i] . '"');
        }
    }

    class LRC_WednesdayWorkshop extends RepeatableParticipationTextQuest
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="WednesdayWorkshop"');
            $row_v = Database::getQuestRow(
                'LRC_WednesdayWorkshop', '' . $id,
                'active, complete, visible, currentIndex', '1, 0, 1, 0');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'currentIndex'=>$row_v['currentIndex'],
                'maxRepetitions'=>$row_c['maxRepetitions'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'question'=>$row_c['question'],
                'answer0'=>$row_v['answer0'],
                'answer1'=>$row_v['answer1'],
                'answer2'=>$row_v['answer2']
            ));
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_WednesdayWorkshop", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_WednesdayWorkshop", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_WednesdayWorkshop", "visible", $bin[$this->isVisible()]);
            Database::save($id, "LRC_WednesdayWorkshop", "currentIndex", $this->getCurrentIndex());
            for ($i = 0; $i < $this->getCurrentIndex() && $i < $this->maxRepetitions; $i++)
                Database::save($id, "LRC_WednesdayWorkshop", "answer" . $i, '"' . $this->userAnswers[$i] . '"');
        }
    }

    /**
     *  Wrap above quests into a quest line.
     */
    class LRC_QuestLine extends QuestLine
    {
        public function __construct($id)
        {
            $row_c = Database::getRow('LRC', 'label="LRC_Quest"');
            $row_v = Database::getQuestRow(
                'LRC_Quest', '' . $id,
                'active, complete, visible', '1, 0, 1');
            parent::__construct(array
            (   'name'=>$row_c['name'],
                'active'=>$row_v['active'],
                'complete'=>$row_v['complete'],
                'visible'=>$row_v['visible'],
                'objective'=>$row_c['objective'],
                'reward'=>$row_c['reward'],
                'quests'=>array(
                    0=>new LRC_Visit($id),
                    1=>new LRC_GetPlanner($id),
                    2=>new LRC_SayingOnWall($id),
                    3=>new LRC_VisitWritingCenter($id),
                    4=>new LRC_VisitLRCMathLab($id),
                    5=>new LRC_TypesOfCoaching($id),
                    6=>new LRC_Appointment($id),
                    7=>new LRC_TopicsOfACC($id),
                    8=>new LRC_WednesdayWorkshop($id)
                )
            ));
        }

        public function validate(&$user)
        {
            if ($this->isComplete()) return FALSE;
            foreach($this->quests as $key => $value)
            {
                if (!$this->quests[$key]->isComplete())
                    return FALSE;
            }
            $user->addSpirit($this->getReward());
            $this->complete = TRUE;
            $this->active = FALSE;
            return TRUE;
        }

        public function submit($answer)
        {
        }

        public function save($id)
        {
            $bin = array("0", "1");
            Database::save($id, "LRC_Quest", "active", $bin[$this->isActive()]);
            Database::save($id, "LRC_Quest", "complete", $bin[$this->isComplete()]);
            Database::save($id, "LRC_Quest", "visible", $bin[$this->isVisible()]);
        }
    }
?>
