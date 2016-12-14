<?php
    class WorkerFootballJson extends LoaderFootballJson 
    {
        
    }

    class LoaderFootballJson
    {
        require_once "/var/www/html/core/functions/template.php";
        private $path;
        private $file;
        private $jsonArray;
        
        public function __construct($path){
            if (file_exists($path)) {
                $this->path = $path;
            }
        }
        
        public function MakeHTMLs() {
            
        }
        
        public function loadFile($path)
        {
            if (file_exists($path)) {
                $this->file = file_get_contents($path);
                return true;
            }
            return false;
        }
        
        public function getFromJson()
        {
            if ($this->file)
            {
                try {
                    $this->jsonArray = json_decode($this->file, true);
                    return $this->jsonArray;
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            }
            return false;
        }
        
        public static function getByKey($key)
        {
            if (!empty($key)) {
                $result = array();
                if ($this->jsonArray) {
                    foreach($this->jsonArray as $moment) {
                        if ($moment['type'] == $key) {
                            $result[] = $moment;
                        }
                    }
                    return $result;
                }    
                return false;
            }
            return false;
        }
        
        public function getTeamsTitles() {
            $startPeriod = $this->getByKey('startPeriod');
            $teams = array();
            if ($startPeriod) {
                $teams[] = $startPeriod[0]['details']['team1']['title'];
                $teams[] = $startPeriod[0]['details']['team2']['title']; 
                return $teams;
            }
            return false;
        }
        
        public function getTeamCoachByTitle($title)
        {
            $startPeriod = $this->getByKey('startPeriod');
            if ($startPeriod) {
                if ($startPeriod[0]['details']['team1']['title'] == $title) {
                    return $startPeriod[0]['details']['team1']['coach'];
                } else {
                    return $startPeriod[0]['details']['team2']['coach'];
                }
            }
            return false;
        }
        
        public function getTeamByTitle($title)
        {
            $startPeriod = $this->getByKey('startPeriod');
            if ($startPeriod) {
                if ($startPeriod[0]['details']['team1']['title'] == $title) {
                    return $startPeriod[0]['details']['team1']['players'];
                } else {
                    return $startPeriod[0]['details']['team2']['players'];
                }
            }
            return false;
        }
        
        public function getImportantMoments()
        {
            $dangerous = $this->getByKey('dangerousMoment');
            $goals = getByKey('goal');
            if ($dangerous && $goals) {
                return array_merge($dangerous, $goals);
            }
            return false;
        }
        
        public function getTotalScore()
        {
            $teams = getTeamsTitles();
            $goals = getByKey('goal');
            if ($goals && $teams) {
                $total_score[] = ['team' => $teams[0], 'score' => 0];
                $total_score[] = ['team' => $teams[1], 'score' => 0];
                foreach($goals as $goal) {
                    if ($goal['details']['team'] == $total_score[0]['team']){
                        $total_score[0]['score']++;
                    } else {
                        $total_score[1]['score']++;
                    }
                }
                return $total_score;
            }
            return false;
        }
        public function where($condition) {
            echo 1;
        }
        
        public function getYellowCardByNumber($number)
        {
            $yellows = $this->getByKey('yellowCard');
            $result = array();
            if ($yellows) {
                foreach($yellows as $yellow) {
                    if ($yellow['details']['playerNumber'] == $number) {
                        $result[] = $yellow;
                    }  
                }
                return $result;
            }
            return 0;
        }
    }

    $folder = "/var/www/html/shop/core/t2/source/matches/";
    $listJson = scandir($folder);
    foreach($listJson as $element) {
        if (preg_match('/^(.)+\.json$/', $element)) {
            $page = new FootballJson($folder.$element);
            $t1 = FootballJson::getFromJson();  
            exit(1);
            $fileName = explode('.',$element);
            $name = null;
            if (count($fileName) > 2) {
                array_pop($fileName);
                $name = implode('.',$fileName);
            } else {
               $name = $fileName[0]; 
            }
            //$fp = fopen("/var/www/html/shop/core/t2/result/".$name.".html", 'w');
            $totalScore = FootballJson::getTotalScore();

            echo FootballJson::getByKey('goal')->where('id=5');

            Template::setFile("/var/www/html/shop/core/t2/template/player-el.html");
            $playersFirstTeam = FootballJson::getTeamByTitle($totalScore[0]['team']);
            foreach($playersFirstTeam as $player) {
                Template::setMarker('id',$player['number']);
                Template::setMarker('yellow_count', count(FootballJson::getYellowCardByNumber($player['number'])));
                Template::setMarker('name',$player['name']);
                Template::combine('first_players');
            }
            $playersSecondTeam = FootballJson::getTeamByTitle($totalScore[1]['team']);
            foreach($playersSecondTeam as $player) {
                Template::setMarker('id', $player['number']);
                Template::setMarker('name', $player['name']);
                Template::combine('second_players');
            }

            Template::setFile("/var/www/html/shop/core/t2/Templates/moment-el.html");
            $importantMoments = FootballJson::getImportantMoments();
            foreach($importantMoments as $moment) {
                Template::setMarker('time', $moment['time']);
                Template::setMarker('description', $moment['description']);
                Template::combine('moments');
            }


            Template::setFile("/var/www/html/shop/core/t2/result/".$name.".html");
            Template::setMarker('team1', $totalScore[0]['team']);
            Template::setMarker('team2', $totalScore[1]['team']);
            Template::setMarker('coach1', FootballJson::getTeamCoachByTitle($totalScore[0]['team']));
            Template::setMarker('coach2', FootballJson::getTeamCoachByTitle($totalScore[1]['team']));
            Template::setMarker('total_score', $totalScore[0]['score']." : ".$totalScore[1]['score']);

            Template::setMarker('first_players', Template::getBlock('first_players'));
            Template::setMarker('second_players', Template::getBlock('second_players'));

            Template::setMarker('moments', Template::getBlock('moments'));
            Template::combine('page');
            echo Template::getBlock('page'); 
        }
    }

    //echo var_dump($listJson);
    //$footbalJson = FootbalJson::loadFile("source/");
