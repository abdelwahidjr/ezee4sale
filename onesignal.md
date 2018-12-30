#OneSignal Notification
+ **Install dependencies :**
  - GuzzleHttp
    ```
    php composer require guzzlehttp/guzzle
    ```
   - add environment variables
    ```
   ONESIGNAL_APP_ID=
   ONESIGNAL_REST_API_KEY=
    ```
    - import  class OnSignalNotifierController.php
    
+ **Usage :**
   - create notifier object 
   ```
    $notifier = new OnSignalNotifierController();
   ```
   - code samples :
     - by users players ids
       ```
        $notifier->addMessage($key,$message)
        ->addPlayerIDS($players_ids)->send();
        
       ```
   
     - by segments
   
          ```
           $notifier->addMessage($key,$message)
           ->addSegment($segment)->send();
           
          ```
     - additional data
         ```
         $notifier->addData($data)->send();
         ```