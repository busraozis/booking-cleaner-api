# booking-cleaner-api

This program includes 3 services for a booking cleaner application. 

Available Cleaners service:
This service takes a starting time and duration as input and reads the free cleaners for that starting time and that duration from the db
and then shows this result in json format.

Cleaner Busy Times service:
This service takes a cleaner id and extracts the busy timeslots from db and then shows this cleaner's busy times in json format.

Booking Create service:
This service takes a cleaner id, a customer id, a starting time and a duration hour for booking operation and if everything is fine,
it creates a booking record in db with this inputs.

The design approach with more detail is available in "booking api explanation.txt" and a couple of request and response examples foreach service
can be found in "sample request response couples.txt".
