<?php
namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class StatusLaporanUpdated extends Notification
{
    use Queueable;

    public function __construct(public Laporan $laporan) {}

    public function via($notifiable): array { return ['mail','database']; }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Update Laporan {$this->laporan->kode_tiket}")
            ->greeting("Halo {$notifiable->name},")
            ->line("Status laporan Anda telah diperbarui menjadi: **{$this->laporan->status}**")
            ->line("Judul: {$this->laporan->judul}")
            ->action('Lihat Laporan', url("/laporan/{$this->laporan->id}"))
            ->line('Terima kasih telah menggunakan Reportly.');
    }

    public function toArray($notifiable): array
    {
        return [
            'laporan_id' => $this->laporan->id,
            'status'     => $this->laporan->status,
        ];
    }
}