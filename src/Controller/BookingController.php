<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use App\Repository\BookingRepository;
    use App\Repository\CleanerRepository;
    use App\Entity\Booking;
    use \Datetime;
    use App\Validation;
    use \Dateinterval;
    use Doctrine\ORM\EntityManagerInterface;


    class BookingController { 
 
        /**
         * creates a booking if conditions are valid.
         */
        public function bookingCreate(Request $request,EntityManagerInterface $entityManager,BookingRepository $bookingRepository, CleanerRepository $cleanerRepository){

            
            $val = new Validation();

            $cleanerId =  $request->query->get('cleanerId');
            $st = $request->query->get('startTime');

            //$val->validateTime($st);

            $startTime = new DateTime($st);
            $duration = $request->query->get('duration');
            $customerId = $request->query->get('customerId');

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

            //checks if requested cleaner exists.
            $cleaner = $cleanerRepository->findById($cleanerId);
            if(count($cleaner) == 0){
                $response = new Response(json_encode(array('error: ' => 'Cleaner '.$cleanerId. ' does not exist in the system. Booking cannot be made.')));
                $response->headers->set('Content-Type', 'application/json');
                
                return $response;
            }

            //checks if requested cleaner is busy during requested time.
            $bookingList = $bookingRepository->findBookingByCleanerIdStartTimeEndTime($cleanerId,$startTime,$endTime);
            if (count($bookingList) > 0){
                $response = new Response(json_encode(array('error: ' => 'Selected cleaner is busy during selected hours')));
                $response->headers->set('Content-Type', 'application/json');
                
                return $response;
            }



            //checks if customer books cleaners from different companies
            $companyId = $cleaner[0]['companyId'];
            $bookedCleaners = $bookingRepository->findCleanerIdByCustomerIdStartTimeEndTime($customerId,$startTime,$endTime);
            foreach($bookedCleaners as $bC){
                $currentCleanerId = $bC['cleanerId'];
                $currentCleaner = $cleanerRepository->findById($currentCleanerId);
                $currentCompanyId = $currentCleaner[0]['companyId'];

                if($currentCompanyId != $companyId){
                    $response = new Response(json_encode(array('error: ' => 'There exists a booking with a cleaner from another company during selected hours. Booking cannot be made.')));
                    $response->headers->set('Content-Type', 'application/json');
                    
                    return $response;
                }
            }

            $booking = new Booking();
            $booking->setCleanerId($cleanerId);
            $booking->setStartTime($startTime);
            $booking->setEndTime($endTime);
            $booking->setCustomerId($customerId);

            $entityManager->persist($booking);

            $entityManager->flush();


            $createdBooking = array(
                "bookingId" => $booking->getId(),
                "cleanerId" => $booking->getCleanerId(),
                "customerId" => $booking->getCustomerId(),
                "startTime" => $booking->getStartTime(),
                "endTime" => $booking->getEndTime()
              ); 


            $response = new Response(json_encode(array('Created Booking Details: ' => $createdBooking)));
            $response->headers->set('Content-Type', 'application/json');
            
            return $response;
        }
    }