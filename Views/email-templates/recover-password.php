<body
    style='; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
    <table border='0' cellpadding='0' cellspacing='0' class='body'
        style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: linear-gradient(to right, #14213d 0%, #000000 100%);'>
        <tr>
            <td style='font-size: 16px; vertical-align: top;'>&nbsp;</td>
            <td class='container'
                style='font-size: 16px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;'>
                <div class='content'
                    style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>

                    <!-- START CENTERED WHITE CONTAINER -->
                    <table class='main'
                        style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;'>
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class='wrapper'
                                style=' font-size: 16px; vertical-align: top; box-sizing: border-box; padding: 20px;'>
                                <table border='0' cellpadding='0' cellspacing='0'
                                    style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                                    <tr>
                                        <td style='font-size: 16px; vertical-align: top;'>
                                            <p>Ha solicitado recientemente restablecer su contraseña, puede continuar
                                                haciendo clic en el siguiente enlace <a
                                                    href="<?= SITE_URL ?>/password-reset/?code=<?= $data['reset_code'] ?>"
                                                    style="color: #14213d;"><?= SITE_URL ?>/password-reset?code=<?= $data['reset_code'] ?></a>.
                                                <br>
                                                <br>
                                                <span style="text-align: center;">
                                                    Si no ha realizado ninguna solicitud, puede ignorar este correo electrónico.
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
        </tr>
    </table>
</body>