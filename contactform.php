<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';


    $messageSucces = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        $sujet = $_POST["sujet"];


        // Configurer PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Utilisez votre serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'kaissanesaidahmed@gmail.com';  // Votre adresse email
        $mail->Password = 'hspmfojvquftplpg';  // Votre mot de passe
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        
      

        $mail->setFrom('kaissanesaidahmed@gmail.com', 'KATEC');
        $mail->addAddress('kaissanesaidahmed@gmail.com', 'KATEC');  // L'adresse email à laquelle vous souhaitez recevoir les messages

        $mail->isHTML(true);
        $mail->Subject = $sujet;
        $mail->Body = ' <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <tr>
                    <td align="center" style="padding:40px 0 30px 0;background:#70bbd9; font-size:30px;">
                    KATEC
                    </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px ">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="color:#153643;">
                                        <p><b style="margin-right: 20px;">Nom et prenom:</b> '. $nom .'</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#153643;">
                                        <p>
                                            <b style="margin-right: 20px;">Email:</b> '. $email .'</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color:#153643;">
                                        <p>
                                            <b style="margin-right: 20px;">sujet:</b> '. $sujet .'</p>
                                    </td>
                                </tr>
                                <tr>
                              
                            </tr>
                        
                                <tr>
                                    <td style="color:#153643;">
                                        <p><b style="margin-right: 20px;">Message:</b>'. $message .' </p>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;background:#ee4c50;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;width:50%;" align="left">
                                        <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                            &reg; KATEC <br/>
                                            <a href="" style="color:#ffffff;text-decoration:underline;"></a>
                                        </p>
                                    </td>
                                    <td style="padding:0;width:50%;" align="right">
                                        <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="" style="color:#ffffff;"><img src="images/tw.gif" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                                </td>
                                                <td style="padding:0 0 0 10px;width:38px;">
                                                    <a href="" style="color:#ffffff;"><img src="images/fb.gif" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>';

        // Envoyer l'email
        if ($mail->send()) {
            // Envoyer un email de confirmation à l'expéditeur
            $mail->clearAddresses();
            $mail->addAddress($email, $nom);
            $mail->Subject = 'Merci pour votre message';
            $mail->Body =  '
            <html>
            <head>
                
                    
            </head>
            <body>
           <h1 style="border-bottom:2px solid blue; font-size:20px;">
                       KATEC</h1>
                           <p> Bonjour .'$nom'. <br>
                           
                                            Merci infiniment de nous avoir contactés sur notre site !<br> Nous sommes ravis de votre intérêt et sommes prêts à répondre à toutes vos questions. <br>À bientôt !
                                            <br><br>
                                            Cordialement,
                                            KATEC 
                                            </p>
                                      
            </body>
            </html>
        ';
            $mail->send();
header("location:../index.php");
            $messageSucces = 'Votre message a été envoyé avec succès!';
        } else {
            $messageSucces = 'Erreur lors de l\'envoi du message: ' . $mail->ErrorInfo;
        }
    }
?>