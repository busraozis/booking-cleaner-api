<?php
    namespace App;

    use \Datetime;
    use Symfony\Component\Config\Definition\Exception\Exception;

    class Validation extends Exception {

        public function validateStartTime($startTime){
            
            $nameOfDay = date('D', strtotime($startTime->format('Y-m-d H:i:s')));
            if($nameOfDay == 'Fri'){
                return 'Friday is off day for cleaners.';
            }

            $seconds = $startTime->format('H') * 3600;
            $seconds += $startTime->format('i') * 60;
            $seconds += $startTime->format('s');

            $baseSeconds = 8*3600;


            if($seconds < $baseSeconds){
                return 'Start time should not be before 8 am.';
            }

            $seconds = $startTime->format('H') * 3600;
            $seconds += $startTime->format('i') * 60;
            $seconds += $startTime->format('s');

            $baseSeconds = 22*3600;

            if($seconds > $baseSeconds){
                return 'Start time should not pass 10 pm.';
            }

            return 'OK'; 
        }

        public function validateEndTime($endTime){

            $nameOfDay = date('D', strtotime($endTime->format('Y-m-d H:i:s')));
            if($nameOfDay == 'Fri'){
                return 'Friday is off day for cleaners.';
            }

            $seconds = $endTime->format('H') * 3600;
            $seconds += $endTime->format('i') * 60;
            $seconds += $endTime->format('s');

            $baseSeconds = 22*3600;

            if($seconds > $baseSeconds){
                return 'End time should not pass 10 pm.';
            }

            $seconds = $endTime->format('H') * 3600;
            $seconds += $endTime->format('i') * 60;
            $seconds += $endTime->format('s');

            $baseSeconds = 8*3600;

            if($seconds < $baseSeconds){
                return 'End time should not be before 8 am.';
            }

            return 'OK';
        
        }

        public function validateDuration($duration){

            if($duration == 2 or $duration == 4){
                return 'OK';
            }
            return 'Duration should be 2 or 4';
        }
    
        public function validateTime($time){
            if(!($time instanceof Datetime)){
                throw new Exception('Time is invalid.');
            }
        }
    }