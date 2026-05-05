// app/Notifications/ConductRecordCreated.php

<?php

// namespace App\Notifications;

use App\Models\ConductRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConductRecordCreated extends Notification
{
    use Queueable;

    public function __construct(public ConductRecord $conduct)
    {
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $subject = $this->conduct->type === 'positive' 
            ? 'Positive Conduct Record' 
            : 'Conduct Issue Notification';

        return (new MailMessage)
            ->subject($subject)
            ->line("A {$this->conduct->type} conduct record has been created for your child.")
            ->line("Title: {$this->conduct->title}")
            ->line("Date: {$this->conduct->incident_date->format('M d, Y')}")
            ->action('View Details', url('/parent/child/' . $this->conduct->student_id . '/behavior'));
    }

    public function toArray($notifiable)
    {
        return [
            'conduct_id' => $this->conduct->id,
            'type' => $this->conduct->type,
            'title' => $this->conduct->title,
            'student_id' => $this->conduct->student_id,
        ];
    }
}