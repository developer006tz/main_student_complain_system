<!DOCTYPE html> 
<html lang="en-US"> 
    <head> <meta charset="utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
         <style> body { font-family: "[Helvetica](poe://www.poe.com/_api/key_phrase?phrase=Helvetica&prompt=Tell%20me%20more%20about%20Helvetica.)", sans-serif; font-size: 16px; line-height: 1.5; margin: 0; padding: 0; } .container { max-width: 600px; margin: 0 auto; border-radius: 5px; overflow: hidden; } .header { background: #333; padding: 30px; color: #fff; } .header img { height: 50px; margin-bottom: 15px; } .header h1 { font-size: 30px; margin: 0; } .content { background: #f9f9f9; padding: 30px; } h2 { font-weight: 700; font-size: 24px; color: #333; margin: 0 0 10px 0; } p { color: #555; margin-bottom: 20px; } .footer { background: #222; padding: 30px; text-align: center; } .footer p { color: #fff; font-size: 14px; margin: 0; }
        </style> 
        </head> 
        <body> 
            <div class="container">
                 <div class="header">
                     <img src="https://www.ludovickonyo.com/img/dev.png" width="50" height="50" alt="Logo">
                      <h1>{{$subject}}</h1>
                     </div> 
                <div class="content">
                   <h2>Dear {{$name}}</h2>
                    <p>{{ $test_message }}</p> </div> <div class="footer"> <p><a href="#" style="color: #fff;">Unsubscribe</a> from these emails</p> </div> </div>
                 </body>
                  </html>