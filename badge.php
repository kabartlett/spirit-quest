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

    abstract class Badge
    {
        protected $name;
        protected $achieved;
        protected $requirements;
        protected $label;

        public function __construct($name, $achieved, $requirements, $label)
        {
            $this->name = $name;
            $this->achieved = $achieved;
            $this->requirements = $requirements;
            $this->label = $label;
        }

        public function getName() { return $this->name; }
        public function getRequirements() { return $this->requirements; }
        public function isAchieved() { return $this->achieved; }

        abstract function validate(&$user);
    }

    class SeaPup_Badge extends Badge
    {
        public function __construct($id)
        {
            $name = "Sea Pup";
            $label = "SeaPup";
            $achieved = Database::getBadgeState($id, $label);
            $requirements = Database::getBadgeRequirements($label);
            parent::__construct($name, $achieved, $requirements, $label);
        }

        public function validate(&$user)
        {
            if (!$this->achieved && $user->getSpirit() >= 20)
            {
                $this->achieved = TRUE;
                return TRUE;
            }
            else return FALSE;
        }
    }
?>
