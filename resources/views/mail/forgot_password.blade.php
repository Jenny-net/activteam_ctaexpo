<!DOCTYPE html>
        <html>
            <head>
                <title>Forgot Password</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
                <div style="max-width:640px; margin:0 auto;">
                    <div style="background:#F5F5F3; border:1px solid #dcd7d7;">
                        <div style="float: none; text-align: center; margin-top: 0px; background:url('{{ URL::to('#') }}') repeat center center">
                             <img src="{{ URL::to('public/assets/images/logo.png') }}" width="240" alt="">
                        </div>
                    </div>
                    <div style="max-width:620px; border:1px solid #f0f0f0; margin:0 0; padding:15px; ">
                        <h1 style="font-family:Arial; font-size:16px; font-weight:500; margin:5px 0 12px 0;">Dear {{@$user['name']}} ,</h1>

                        <div style="display:block;overflow:hidden; width:100%; margin: 5px 0px 10px 0px;">
                            <p style="font-family:Arial; font-size:14px; font-weight:500; text-align:center; color:#000;padding: 4px; background:#f5f5f5;">
                                Please click the button below to change password :
                            </p>
                        </div>
                        <div style="display:block;overflow:hidden; width:100%; text-align:center; margin: 0px 0px 10px 0px;">          
                            <a href="{{ route('user.changepassword',$user['otp']) }}" style="font-family:Arial; border-radius:17px;font-size:15px; font-weight:500; color:#FFF; display:inline-block; padding: 7px 12px; background:#41b749; text-decoration:none;">Click here</a>                        
                        </div>
                        <p style="font-family:Arial; font-size:14px; font-weight:500; color:#363839;margin: 0px 0px 0px 0px;">Thank you,<br>Team LandCapture</p>
                    
                    </div>
                </div>
            </body>
        </html>