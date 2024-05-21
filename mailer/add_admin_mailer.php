<?php


function add_admin_mailer($name, $username)
{
     return '
<html>
     <body style="font-family: Arial, sans-serif; color: #333; background-color: #f7f7f7; padding: 20px;">
          <div style="background-color: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
               <h2 style="color: #333; margin: 0">Hello $name,</h2>
               <p style="margin: 0">Your admin account has been successfully created.</p>
               <p style="margin: 0">Please login with your account below:</p>
               <table style="background-color: #f7f7f7; margin: 15px auto; border: 2px solid;">
                    <thead>
                         <tr>
                              <td colspan="3" style="padding: 10px 0; text-align: center; border-bottom: 2px solid;">Your account</td>
                         </tr>
                    </thead>
                    <tbody>
                         <tr>
                              <td style="padding: 8px">Username</td>
                              <td style="padding: 8px">=</td>
                              <td style="padding: 8px">' . $username . '</td>
                         </tr>
                         <tr>
                              <td style="padding: 8px">Password</td>
                              <td style="padding: 8px">=</td>
                              <td style="padding: 8px">fwebAdmin123!</td>
                         </tr>
                    </tbody>
               </table>
               <p style="margin: 0">After successfully logging in, please change the password.</p>
               <p style="margin: 0">Thank you.</p>
          </div>
     </body>
</html>
';
}

function mailer_subject()
{
     return 'Admin Invitation';
}
