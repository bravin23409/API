<?php
require 'ClassAutoLoad.php';
require 'dbConnect.php';
// pick up objects (adjust if your autoloader uses ObjLayouts/ObjForms)
$layouts
            'name_from' => 'BBIT Systems Admin',
            'mail_from' => 'bravin.too@strathmore.edu',
            'name_to'   => $userName,
            'mail_to'   => $userEmail,
            'subject'   => 'Welcome to BBIT Enterprise',
            'body'      => "Welcome <b>$userName</b>,<br>We’re glad to have you on board!<br><br>
                            Regards,<br>
                            System Admin<br>
                            BBIT 2.2<br>"
        ];

        // Send email
        if ($ObjSendMail) {
            $ObjSendMail->Send_Mail($conf, $mailCnt);
        }

        // ✅ Save user to DB
        $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $userName, $userEmail);
        $stmt->execute();

        // Success message
        echo "<p style='color:green; font-weight:bold;'>
                Welcome {$userName}, a confirmation email has been sent to {$userEmail}.
              </p>";

    } else {
        echo "<p style='color:red;'>Invalid name or email.</p>";
    }
}


// show signup form
$forms->signup();

// show footer
$layouts->footer($conf);
