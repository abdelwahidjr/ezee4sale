# ezee4sale
# SMS Notification

The sms messaging is based on  **[TWILIO](https://www.twilio.com/)** Service.  

 - STEPS :

 
1. create TWILIO account
2. install the SDK  

> **composer require twilio/sdk**
3. through the twilio website dashboard you can obtain a trial **number for testing**
4. request you **ACCOUNT SID** and **AUTH TOKEN**
5. add the previous attribute to .env file 
> TWILIO_SID=
TWILIO_TOKEN=
TWILIO_NUMBER=
6. code sample
> use Twilio\Rest\Client;  
  public function send($to, $body)  
 {  
 $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));  
  $message = $$twilio->messages  
  ->create($to,  array("from" => env('TWILIO_NUMBER'), "body" => $body)  
 );
  }
  

	
