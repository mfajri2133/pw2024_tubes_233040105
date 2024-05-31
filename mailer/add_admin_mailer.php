<?php


function add_admin_mailer($name, $username)
{
     return '
<html>
     <body>
          <div style="text-align: center">
               <h2 style="color: #333; margin: 0">Hello ' . $name . '</h2>
               <p style="margin: 0">
                    Your admin account has been successfully created.
               </p>
               <p style="margin: 0">Please login with your account below:</p>
               <table
                    border="1"
                    cellspacing="0"
                    cellpadding="8"
                    style="
                         width: 85%;
                         text-align: center;
                         margin: auto;
                         margin-top: 20px;
                         border-collapse: collapse;
                    "
               >
                    <tr style="background-color: #eef7ff">
                         <th colspan="2">
                              <h3>Your Admin Account</h3>
                         </th>
                    </tr>
                    <tr style="background-color: #eef7ff">
                         <th colspan="2">Name</th>
                    </tr>
                    <tr>
                         <td colspan="2">' . $name . '</td>
                    </tr>
                    <tr style="background-color: #eef7ff">
                         <th>Username</th>
                         <th>Password</th>
                    </tr>
                    <tr>
                         <td>' . $username . '</td>
                         <td>fwebAdmin123!</td>
                    </tr>
                    <tr style="background-color: #eef7ff">
                         <th colspan="2">Note</th>
                    </tr>
                    <tr>
                         <td colspan="2" style="text-align: center">
                              After successfully logging in, please change the
                              password.
                              <p style="padding-top: 10px">Thank you.</p>
                         </td>
                    </tr>
                    <tr style="background-color: #eef7ff">
                         <td colspan="2">FWeb Movie</td>
                    </tr>
               </table>
          </div>
     </body>
</html>
';
}

function mailer_subject()
{
     return 'Admin Invitation';
}
