<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use App\Repository\CleanerRepository;
    use App\Repository\BookingRepository;
    use \Datetime;
    use \Dateinterval;
    use App\Validation;

    /**
     * @Route("/")
     */
    class CleanerController {
        public function index(){
            return new Response('');
        }

        /**
         * returns the list of available cleaners within the requested start time and duration.
         * 
         * 
         * 
         * 
         * 
         */
        public function availableCleaners(Request $request,CleanerRepository $cleanerRepository,BookingRepository $bookingRepository){

            $val = new Validation();
            
            $st = $request->query->get('startTime');
           //$val->validateTime($st);

            $startTime = new DateTime($st);
            $duration = $request->query->get('duration');

            $durVal = $val->validateDuration($duration);
            if($durVal != 'OK'){
                $response = new Response(json_encode(array('error: ' => $durVal)));
                $response->headers->set('Content-Type', 'application/json');
                
                return $response;
            }

            $endTime = $startTime->add(new DateInterval("PT{$duration}H"));
            $startTime = new DateTime($st);



            $startVal = $val->validateStartTime($startTime);
            if($startVal != 'OK'){
                $response = new Response(json_encode(array('error: ' => $startVal)));
                $response->headers->set('Content-Type', 'application/json');
                
                return $response;
            }

            $endVal = $val->validateEndTime($endTime);
            if($endVal != 'OK'){
                $response = new Response(json_encode(array('error: ' => $endVal)));
                $response->headers->set('Content-Type', 'application/json');
                
                return $response;
            }

            $allCleaners = $cleanerRepository->listAll();
            $busyCleaners = $bookingRepository->findCleanerIdByStartTimeEndTime($startTime,$endTime);

            $aTmp1 =[];
            foreach($allCleaners as $aV){
                $aTmp1[] = $aV['cleanerId'];
            }
            
            $aTmp2 =[];
            foreach($busyCleaners as $aV){
                $aTmp2[] = $aV['cleanerId'];
            }
            
            $aTmp3= array_diff($aTmp1,$aTmp2);

            foreach($aTmp3 as $key => $value){
                $availableCleaners[] = $value;
            }
            

            $result=[];
            foreach($availableCleaners as $id){
                $result[] = $cleanerRepository->findById($id);
            }

            $response = new Response(json_encode(array('availableCleaners' => $result)));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }

        public function cleanerBusyTimes(Request $request,BookingRepository $bookingRepository){
            $cleanerId = $request->query->get('cleanerId');
            $result = $bookingRepository->findStartTimeEndTimeByCleanerId($cleanerId);

            $response = new Response(json_encode(array('Cleaner '.$cleanerId.'\'s busy times: ' => $result)));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;

        }

    }
