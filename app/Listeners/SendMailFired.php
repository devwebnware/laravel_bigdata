<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Models\ScheduledInterview;
use Illuminate\Support\Facades\Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendMail $reponseId)
    {
        $scheduledInterview = ScheduledInterview::where('job_response_id', $reponseId)->latest()->first();
        $interviewer = $scheduledInterview->employee;
        $data = ['scheduledInterview' => $scheduledInterview];

        $filename = "invite.ics";

        Mail::send('backend.emails.interviewer', $data, function ($message) use ($interviewer, $filename, $data) {

            $meeting_duration = (3600 * 2); // 2 hours
            $meetingstamp = strtotime($data['scheduledInterview']->created_at . " UTC");
            $dtstart = gmdate('Ymd\THis\Z', $meetingstamp);
            $dtend =  gmdate('Ymd\THis\Z', $meetingstamp + $meeting_duration);
            $todaystamp = gmdate('Ymd\THis\Z');
            $uid = date('Ymd') . 'T' . date('His') . '-' . rand() . '@lancersglobal.com';
            $description = "A interview has been scheduled";
            $location = "Online Meet";
            $titulo_invite = "Interview Scheduled";
            $organizer = "CN=Organizer name:hr@lancersglobal.com";

            // ICS
            $data[0]  = "BEGIN:VCALENDAR";
            $data[1] = "PRODID:-//Google Inc//Google Calendar 70.9054//EN";
            $data[2] = "VERSION:2.0";
            $data[3] = "CALSCALE:GREGORIAN";
            $data[4] = "METHOD:REQUEST";
            $data[5] = "BEGIN:VEVENT";
            $data[6] = "DTSTART;TZID=America/Sao_Paulo:" . $dtstart;
            $data[7] = "DTEND;TZID=America/Sao_Paulo:" . $dtend;
            $data[8] = "DTSTAMP;TZID=America/Sao_Paulo:" . $todaystamp;
            $data[9] = "UID:" . $uid;
            $data[10] = "ORGANIZER;" . $organizer;
            $data[11] = "CREATED:" . $todaystamp;
            $data[12] = "DESCRIPTION:" . $description;
            $data[13] = "LAST-MODIFIED:" . $todaystamp;
            $data[14] = "LOCATION:" . $location;
            $data[15] = "SEQUENCE:0";
            $data[16] = "STATUS:CONFIRMED";
            $data[17] = "SUMMARY:" . $titulo_invite;
            $data[18] = "TRANSP:OPAQUE";
            $data[19] = "END:VEVENT";
            $data[20] = "END:VCALENDAR";
            $mail = implode("\r\n", $data);
            header("text/calendar");
            file_put_contents($filename, $mail);
            $message->to($interviewer['email_address'])->subject('New Interview Scheduled');
            if ($data['scheduledInterview']->type == 'online') {
                $message->attach($filename, array('mime' => "text/calendar"));
            }
        });


        // Mail::send('backend.emails.interviewer', $data, function ($message) use ($interviewer) {
        //     $message->to($interviewer['email_address']);
        //     $message->subject('New Interview Scheduled');
        // });
        // Mail::send('backend.emails.applicant', $data, function ($message) use ($applicant) {
        //     $message->to($applicant['email']);
        //     $message->subject('Email Sent Successfully');
        // });
    }
}
