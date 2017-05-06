# q2a-fb-answer
Share question to FB when expert answers. 
# Generate Permanent Token for page
https://adamboother.com/blog/automatically-posting-to-a-facebook-page-using-the-facebook-sdk-v5-for-php-facebook-api/

Next up, if you want to automatically post content to your Facebook page like I needed to…you’re going to need to get a non-expiring Access Token for your page. Firstly, visit the Facebook Graph API Explorer page. You’ll see an ‘Application’ button in the top right as show below:

<img src="https://adamboother.com/images/blog/facebook-api-auto-post/access-token.png" alt="Create A Facebook App">

Create A Facebook App

As you can see, currently this is set to ‘Graph API Explorer’. Select your Facebook App instead. Now click the ‘get token’ button which you can also see in the image above. Select ‘Get User Access Token’ and make sure the ‘publish_pages’ and ‘manage_pages’ permissions are ticked, then click the ‘Get Access Token’ button. Now click the ‘get token’ button again and select your Facebook page. You now have your Access Token which we need to convert into the non-expiring Access Token. To do so, pass your App ID, App Secret and Access Token into the following U

https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&client_id=appid&client_secret=appsecret&fb_exchange_token=accesstoken

Now copy the token provided.
