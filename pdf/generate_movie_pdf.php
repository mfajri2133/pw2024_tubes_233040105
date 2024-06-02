<?php
require_once '../vendor/autoload.php';
include_once '../lib/general.php';
include_once '../helpers/users.php';
$mpdf = new \Mpdf\Mpdf();


$id = $_GET['id'];
$movie = getMovieById($id);

$html = '
     <body>
          <table
               border="1"
               cellspacing="0"
               cellpadding="15"
               style="width: 100%; text-align: center"
          >
               <tr style="border: 1px solid black" style="background-color: #eef7ff">
                    <th colspan="4">
                         <h1>' . htmlspecialchars($movie['name']) . '(' . date('Y', strtotime($movie['release_date'])) . ')</h1>
                    </th>
               </tr>
               <tr>
                    <td colspan="5">
                         <img
                              src="' . base_url($movie['poster_path']) . '"
                              alt="' . htmlspecialchars($movie['name']) . '"
                              style="width: 250px; padding: 0 5px"
                         />
                    </td>
               </tr>
               <tr style="background-color: #eef7ff">
                    <th colspan="4">Category</th>
               </tr>
               <tr>
                    <td colspan="4">' . htmlspecialchars($movie['categories']) . '</td>
               </tr>
               <tr style="background-color: #eef7ff">
                    <th>Release Date</th>
                    <th>Duration</th>
                    <th>Director</th>
                    <th>Producer</th>
               </tr>
               <tr>
                    <td>' . date('j F, Y', strtotime($movie['release_date'])) . '</td>
                    <td>' . htmlspecialchars($movie['duration']) . ' min</td>
                    <td>' . htmlspecialchars($movie['director']) . '</td>
                    <td>' . htmlspecialchars($movie['producer']) . '</td>
               </tr>
               <tr style="background-color: #eef7ff">
                    <th colspan="4">Synopsis</th>
               </tr>
               <tr>
                    <td colspan="4" style="text-align: justify">
                    ' . htmlspecialchars($movie['description']) . '
                    </td>
               </tr>
               <tr>
                    <td colspan="4" style="text-align: end; font-size: small">
                         FWeb Movie
                    </td>
               </tr>
          </table>
     </body>
';

$mpdf->WriteHTML($html);

$filename = htmlspecialchars($movie['name']) . "(" . date('Y', strtotime($movie['release_date'])) . ").pdf";
$mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
